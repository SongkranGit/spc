<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class Page_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('pages');
        $this->db->where('id', $id);
        $this->db->where('is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getByName($name){
        $data = array();
        $this->db->select("p.* , t.name as template");
        $this->db->from('pages p');
        $this->db->join('templates t' , 't.id=p.template_id' );
        $this->db->where('p.name', strtolower($name));
        $this->db->where('p.is_deleted', 0);
        //$this->db->where('published', 1);
        $query = $this->db->get();;
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getPageAndGalleryByPageName($name){
        $data = array();
        $this->db->select("p.* , g.name as gallery_name , g.description as gallery_desc ");
        $this->db->from('pages p');
        $this->db->join('galleries g' , 'g.id=p.gallery_id');
        //$this->db->join('galleries_images gi' , 'gi.gallery_id=g.id');
        $this->db->where('p.name', strtolower($name));
        $this->db->where('p.is_deleted', 0);
        //$this->db->where('published', 1);
        $query = $this->db->get();;
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getLatestOrderNumber(){
        $this->db->select_max('order');
        $query = $this->db->get('pages');
        $latestOrder = $query->row()->order;
        return $latestOrder;
    }

    public function getAll()
    {
        $data = array();
        $this->db->select('p.id , p.name , p.parent_id , p.order, p.title_en , p.title_th' );
        $this->db->select('(select name from pages where id = p.parent_id ) as parent_name' );
        $this->db->from('pages p');
        $this->db->where('is_deleted', 0);
        $this->db->where('published', 1);
        $this->db->order_by('order' , 'ASC');
        $query = $this->db->get();
       // dump($this->db->last_query());
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function getPagesWithoutParent($current_id=NULL)
    {
        // get without parent
        $pages = array();
        $this->db->select("id , title_en, title_th");
        $this->db->where('parent_id', 0);
        $this->db->where('is_deleted=', 0);
        if($current_id != NULL){
            $this->db->where('id <>', $current_id);
        }
        $query = $this->db->get('pages');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $pages[] = $row;
            }
        }

        $data = array(0 => $this->lang->line("pages_no_parent"));
        if (count($pages)) {
            foreach ($pages as $page) {
                $data[$page["id"]] = (isEnglishLang())?$page["title_en"]:$page["title_th"];
            }
        }
        $query->free_result();
        return $data;
    }

    public function getNestedPages()
    {
        $pages = $this->getAll();
        $data = array();
        if ($pages != null && count($pages) > 0) {
            foreach ($pages as $key => $page) {
                if (intval($page["parent_id"])==0) {
                    $data[$page["id"]] = $page;
                } else {
                    $data[$page["parent_id"]]["children"][] = $page;
                }
            }
        }
        return $data;
    }


    public function isRecursiveParent( $primary_key , $parent_id){
        // for loop check pk is same
        $is_recursive = false;
        $this->db->select('id');
        $this->db->from('pages');
        $this->db->where('is_deleted', 0);
        $this->db->where('parent_id=',  $parent_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
               if($primary_key == $row["id"]){
                    $is_recursive = true;
               }
            }
        }
        $query->free_result();
        return $is_recursive;
    }

    public function loadPagesDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("p.*, p.title_th as title_thai , p.title_en as title_eng ,(select title_en from pages where id=p.parent_id) as parent_title ");
        $this->db->from("pages p");
        $this->db->where("p.is_deleted =", 0);
        $this->db->order_by("p.created_date", 'DESC');
        $query = $this->db->get();

        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "name" => $row->name,
                    "title" =>  (isEnglishLang())?$row->title_eng:$row->title_thai ,
                    "parent_title" => $row->parent_title,
                    "published" => $row->published,
                    "updated_date" => Calendar::formatDateTimeToDDMMYYYY($row->updated_date)
                );
            }
        }

        $data['data'] = $rows;
        $query->free_result();
        return $data;
    }


    public function save($data)
    {
        $this->db->insert('pages', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveOrderPages($pages){
        if(count($pages)){
            foreach($pages as $order => $page){
                if($page['item_id'] != ''){
                    $data = array('parent_id'=> (int)$page['parent_id'] , 'order'=>$order);
                    $this->db->set($data);
                    $this->db->where('id' , $page["item_id"]);
                    $this->db->update('pages');
                }
            }
            return true;
        }else{
            return false;
        }
    }


    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateChildWhenDeleteParent($data, $id)
    {
        $this->db->where('parent_id', $id);
        $this->db->update('pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $data = array('is_deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
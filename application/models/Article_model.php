<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class Article_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('articles');
        $this->db->where('id', $id);
        $this->db->where('is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getByName($name)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('articles');
        $this->db->where('LOWER(name_en)', strtolower($name));
        $this->db->where('is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }


    public function getArticleByPageId($page_id , $limit= null){
        $data = array();
        $this->db->select("a.* , p.id as page_id , p.name as page_name ");
        $this->db->from('articles a');
        $this->db->join("pages p", "p.id = a.page_id");
        $this->db->where('a.page_id', strtolower($page_id) );
        $this->db->where('p.published', 1 );
        $this->db->where('a.is_deleted', 0);
        $this->db->order_by("a.order_seq", 'ASC');
        if($limit != NULL){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function getArticleByPageName($page_name , $limit= null){
        $data = array();
        $this->db->select("a.* , p.id as page_id , p.name as page_name ");
        $this->db->from('articles a');
        $this->db->join("pages p", "p.id = a.page_id");
        $this->db->where('p.name', strtolower($page_name) );
        $this->db->where('p.published', 1 );
        $this->db->where('a.is_deleted', 0);
        $this->db->order_by("a.order_seq", 'ASC');
        if($limit != NULL){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function getAll()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function getListOfArticle($limit, $start , $page_id = NULL)
    {
        $data = array();
        $this->db->select('a.*');
        $this->db->from('articles a');
        $this->db->join("pages p", "p.id = a.page_id");
        $this->db->where('a.is_deleted=', 0);
        $this->db->where('a.page_id', $page_id);
        $this->db->order_by("a.order_seq", 'ASC');
        if ($limit != NULL && $limit != 0) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        // dump($this->db->last_query()) ;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function loadArticlesDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("a.* , p.id as page_id , p.title_th as page_name_th , p.title_en as page_name_en ");
        $this->db->from("articles a");
        $this->db->join("pages p", "p.id = a.page_id");
        $this->db->where("a.is_deleted ", 0);
        $this->db->order_by("order_seq", 'ASC');
        $this->db->order_by("created_date", 'DESC');
        $query = $this->db->get();

        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "page_id" => $row->page_id,
                    "page_name" => (isEnglishLang())?$row->page_name_en:$row->page_name_th,
                    "name" =>  (isEnglishLang())?$row->name_en:$row->name_th,
                    "title" => (isEnglishLang())?character_limiter($row->title_en  , 100):character_limiter( $row->title_th, 100),
                    "order_seq" => $row->order_seq,
                    "published_date" => Calendar::formatDateToDDMMYYYY($row->published_date),
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
        $this->db->insert('articles', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('articles', $data);
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
        $this->db->update('articles', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
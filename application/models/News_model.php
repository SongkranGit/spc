<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class News_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('news');
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getAll()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('is_deleted=', 0);
        $this->db->order_by("order_seq", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function getListOfNews( $limit , $start ){
        $data = array();
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('is_deleted', 0);
        $this->db->where('published', 1);
        $this->db->order_by("order_seq", 'ASC');
        if($limit != null && $limit != 0){
            $this->db->limit($limit ,$start );
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

    public function getNewsShowOnHomePage( ){
        $data = array();
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('is_deleted', 0);
        $this->db->where('is_show_on_home_page', 1);
        $this->db->where('published', 1);
        $this->db->order_by("order_seq", 'ASC');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function loadNewsDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("*");
        $this->db->from("news");
        $this->db->where("is_deleted =", 0);
        $this->db->order_by("order_seq", 'ASC');
        $this->db->order_by("created_date", 'ASC');
        $query = $this->db->get();

        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "name" => isEnglishLang()?$row->name_en:$row->name_th ,
                    "file_name" => $row->file_name,
                    "order_seq" => $row->order_seq,
                    "is_show_on_home_page" => $row->is_show_on_home_page,
                    "published" => $row->published,
                    "published_date"=> Calendar::formatDateToDDMMYYYY($row->published_date),
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
        $this->db->insert('news', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('news', $data);
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
        $this->db->update('news', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
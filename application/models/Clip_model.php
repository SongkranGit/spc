<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class Clip_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('clips');
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getByTopOfSeq()
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('clips');
        $this->db->order_by("order_seq", 'ASC');
        $this->db->where('is_deleted', 0);
        $this->db->where('published', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getListOfClip($limit , $start , $category_id = null)
    {
        $data = array();
        $this->db->select('c.* , cat.name_th as category_name_th , cat.name_en as category_name_en');
        $this->db->from('clips c');
        $this->db->join("clip_categories cat" , "c.category_id = cat.id");
        $this->db->where('c.is_deleted', 0);
        $this->db->where('c.published', 1);
        $this->db->order_by("c.order_seq", 'ASC');
        if($category_id != null){
            $this->db->where('c.category_id', $category_id);
        }

        if($limit != null && $limit != 0){
            $this->db->limit($limit ,$start );
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
        $this->db->from('clips');
        $this->db->where('is_deleted', 0);
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

    public function getAllClipsByCategory($category_id)
    {
        $data = array();
        $this->db->select('c.*');
        $this->db->from("clips c");
        $this->db->join("clip_categories cat" , "c.category_id = cat.id");
        $this->db->where('c.published', 1);
        $this->db->where('c.category_id', $category_id);
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

    public function getClipsShowOnHomePage($limit = null){
        $data = array();
        $this->db->select('c.*');
        $this->db->from("clips c");
        $this->db->where('c.published', 1);
        $this->db->where('is_deleted', 0);
        $this->db->where('c.is_show_on_home_page', 1);
        $this->db->order_by("order_seq", 'ASC');
        if($limit != null){
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

    public function loadClipsDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("c.* , cat.name_en as category_name_en , cat.name_th as category_name_th , cat.id as category_id");
        $this->db->from("clips c");
        $this->db->join("clip_categories cat" , "c.category_id = cat.id");
        $this->db->order_by("order_seq", 'ASC');
        $this->db->order_by("created_date", 'ASC');
        $query = $this->db->get();

        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "youtube_link" => $row->youtube_link,
                    "description" => isEnglishLang()?$row->description_en: $row->description_th,
                    "order_seq" => $row->order_seq,
                    "published" => $row->published,
                    "is_show_on_home_page" => $row->is_show_on_home_page,
                    "category_id" => $row->category_id,
                    "category_name" => isEnglishLang()?$row->category_name_en:$row->category_name_th,
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
        $this->db->insert('clips', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('clips', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clips');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
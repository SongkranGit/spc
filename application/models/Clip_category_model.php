<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 1/3/2560
 * Time: 22:33
 */
class Clip_category_model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('clip_categories');
        $this->db->where('id', $id);
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
        $this->db->from('clip_categories');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function save($data)
    {
        $this->db->insert('clip_categories', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('clip_categories', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clip_categories');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
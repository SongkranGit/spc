<?php
/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */

class Template_Model extends  CI_Model{

    function getById($template_id){
        $data = array();
        $this->db->select("*");
        $this->db->from('templates');
        $this->db->where('id', $template_id);
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
        $this->db->from('templates');
        $this->db->order_by("id", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }


}
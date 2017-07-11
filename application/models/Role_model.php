<?php
/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */

class Role_Model extends  CI_Model{

    function getListOfRoles(){
        $data = array();
        $this->db->where('is_deleted =' , 0 );
        $query  =  $this->db->get('roles');
        if($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    




}
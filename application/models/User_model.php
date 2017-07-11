<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class User_Model extends CI_Model
{

    public function checkUserLogin($username, $password)
    {
        $data = array();
        $this->db->select(' u.* , r.role_id , r.role_name ');
        $this->db->from('users u');
        $this->db->join('roles r', 'r.role_id = u.role_id', 'left');
        $this->db->where('u.username', $username);
        $this->db->where('u.password', md5($password));

        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function updateLoggedInTime($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $data = array();
        $this->db->select(" u.* ", FALSE);
        $this->db->from('users u');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getUserByFacebookId($id)
    {
        $data = array();
        $this->db->select(" u.* ", FALSE);
        $this->db->from('users u');
        $this->db->where('facebook_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function loadUsersDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select(" u.* , r.role_id , r.role_name ");
        $this->db->select(" CONCAT( u.firstname, '.', u.lastname) as user_fullname ", FALSE);
        $this->db->from("users u");
        $this->db->join("roles r", 'r.role_id = u.role_id');
        $this->db->order_by("u.updated_date", 'DESC');
        $query = $this->db->get();

        //  echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "user_id" => $row->user_id,
                    "username" => $row->username,
                    "user_fullname" => $row->firstname . " " . $row->lastname,
                    "email" => $row->email,
                    "logged_in_date" => Calendar::formatDateTimeToDDMMYYYY($row->logged_in_date),
                    "role_id" => $row->role_id,
                    "role_name" => $row->role_name
                );
            }
        }

        $data['data'] = $rows;
        $query->free_result();
        return $data;
    }


    public function save($data)
    {
        $this->db->insert('users', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
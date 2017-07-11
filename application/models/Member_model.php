<?php

class Member_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('members');
        $this->db->where('id', $id);
        $this->db->where("is_deleted" , 0);
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
        $this->db->from('members');
        $this->db->where("is_deleted" , 0);
        $this->db->order_by("updated_date", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function loadGridDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("*");
        $this->db->from("members");
        $this->db->where("is_deleted" , 0);
        $this->db->order_by("updated_date", 'ASC');
        $query = $this->db->get();

        //  echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "full_name" => $row->full_name,
                    "phone" => $row->phone,
                    "email" => $row->email,
                    "address" => $row->address,
                    "status" => $row->is_deleted,
                    "created_date" => Calendar::formatDateTimeToDDMMYYYY($row->created_date),
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
        $this->db->insert('members', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('members', $data);
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
        $this->db->update('members', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
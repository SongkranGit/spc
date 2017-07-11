<?php

class Contact_Model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("con.* , ed.education_th , ed.education_en , ed.id");
        $this->db->from('contacts con');
        $this->db->join('educations ed' , 'ed.id=con.education');
        $this->db->where('con.id', $id);
        $this->db->where('con.is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function findByQrCode($code)
    {
        $data = array();
        $this->db->select("con.* , ed.education_th , ed.education_en , ed.id");
        $this->db->from('contacts con');
        $this->db->join('educations ed' , 'ed.id=con.education');
        $this->db->where('con.qr_code_id', $code);
        $this->db->where('con.is_deleted', 0);
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
        $this->db->from('contacts');
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

    public function getListOfEducations()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('educations');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        $query->free_result();
        return $data;
    }

    public function loadContactsDataTable()
    {
        $data = array();
        $rows = array();
        $this->db->select("*");
        $this->db->from("contacts");
        $this->db->where("is_deleted =", 0);
        $this->db->order_by("created_date", 'ASC');
        $query = $this->db->get();

        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = array(
                    "id" => $row->id,
                    "full_name" => $row->full_name,
                    "phone" => $row->phone,
                    "note" => $row->note,
                    "email" => $row->email,
                    "age" => $row->age,
                    "line_id" => $row->line_id,
                    "is_approve" => $row->is_approve,
                    "created_date" => Calendar::formatDateTimeToDDMMYYYY($row->created_date)
                );
            }
        }

        $data['data'] = $rows;
        $query->free_result();
        return $data;
    }


    public function save($data)
    {
        $this->db->insert('contacts', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('contacts', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function approveCoupon($qr_code_id , $data){
        $this->db->where('qr_code_id', $qr_code_id);
        $this->db->update('contacts', $data);
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
        $this->db->update('contacts', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
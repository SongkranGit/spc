<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 21/12/2558
 * Time: 7:14
 */
class Article_images_model extends CI_Model
{

    public function getById($id)
    {
        $data = array();
        $this->db->select("*");
        $this->db->from('article_images');
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
        $this->db->from('article_images');
        $this->db->where('LOWER(name)', $name);
        $this->db->where('is_deleted=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

    public function getImagesByArticleId($article_id){
        $data = array();
        $this->db->select('*');
        $this->db->from('article_images');
        $this->db->where('article_id', $article_id);
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


    public function getAll()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('article_images');
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

    public function getListOfArticle($limit, $start)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('article_images');
        $this->db->where('is_deleted=', 0);
        $this->db->order_by("order_seq", 'ASC');
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

    public function save($data)
    {
        $this->db->insert('article_images', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('article_images', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateByImageUUID($data, $image_uuid)
    {
        $this->db->where('image_uuid', $image_uuid);
        $this->db->update('article_images', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('article_images');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteByImageName($image_name)
    {
        $this->db->where('image_name', $image_name);
        $this->db->delete('article_images');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


}
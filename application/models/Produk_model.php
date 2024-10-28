<?php

class Produk_model extends CI_Model {
  public function get_all_product($limit, $offset, $search = null)
    {
        $this->db->select('*');
        $this->db->from('produk');
        
        if ($search) {
            $this->db->like('nama_produk', $search);
        }

        $this->db->limit($limit, $offset);
        return $this->db->get()->result(); 
    }

  public function insert_produk($data) 
  {
    $this->db->insert('produk', $data);
    return $this->db->insert_id();
  }

  public function get_data_by_id($id)
  {
      return $this->db->get_where('produk', ['id_produk' => $id])->row();
  }

  public function update_produk($id, $data) 
  {
    $this->db->where('id_produk', $id);
    $this->db->update('produk', $data);
  }

  public function delete_produk($id) 
  {
    $this->db->where('id_produk', $id);
    $this->db->delete('produk');
  }

  public function count_all_product($search = null) {
    if ($search) {
      $this->db->like('nama_produk', $search);
    }

    return $this->db->count_all_results('produk');
  }

  
}
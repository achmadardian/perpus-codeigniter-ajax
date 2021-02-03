<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{

    function getData()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('buku')->result(); // me-return hasil dari get buku
    }

    function insertData($data)
    {
        $this->db->insert('buku', $data); // menginsert pada buku dengan variabel data
    }

    function getDataById($id)
    {
        $this->db->where('id', $id); // where no induk
        return $this->db->get('buku')->result(); // me-return hasil dari get buku
    }

    function updateData($id, $data)
    {
        $this->db->where('id', $id); // where no induk
        $this->db->update('buku', $data); //mengupdate buku sesuai kondisi di atas
    }

    function deleteData($id)
    {
        $this->db->where('id', $id); // where no induk
        $this->db->delete('buku'); // mendelete buku sesuai kondisi di atas
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_model extends CI_Model
{
    public function getAllAnggota()
    {
        $this->db->order_by('nis', 'DESC');
        return $this->db->get('anggota')->result_array();
    }

    function insertData($data)
    {
        $this->db->insert('anggota', $data); // menginsert pada buku dengan variabel data
    }

    function getDataByNis($nis)
    {
        $this->db->where('nis', $nis); // where no induk
        return $this->db->get('anggota')->result(); // me-return hasil dari get buku
    }

    function updateData($nis, $data)
    {
        $this->db->where('nis', $nis); // where no induk
        $this->db->update('anggota', $data); //mengupdate buku sesuai kondisi di atas
    }

    function deleteData($nis)
    {
        $this->db->where('nis', $nis); // where no induk
        $this->db->delete('anggota'); // mendelete buku sesuai kondisi di atas
    }
}

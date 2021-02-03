<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{
    public function viewPengembalian($status)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis = anggota.nis');
        $this->db->join('buku', 'peminjaman.id = buku.id');
        $this->db->where($status);
        $this->db->order_by("tanggal_kembali", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteTransaksi($id_transaksi)
    {
        //$this->db->where('id_transaksi', $id_transaksi);
        $this->db->delete('peminjaman', ['id_transaksi' => $id_transaksi]);
    }

    public function alertDelete()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
        Data <strong>Transaksi Pengembalian</strong> berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }
}

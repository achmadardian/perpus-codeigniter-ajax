<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{
    public function getAnggota()
    {
        return $this->db->get('anggota');
    }

    public function getBuku()
    {
        return $this->db->get('buku');
    }

    public function viewTransaksi($status)
    {

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis = anggota.nis');
        $this->db->join('buku', 'peminjaman.id = buku.id');
        $this->db->where($status);
        $this->db->order_by("id_transaksi", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPeminjaman()
    {
        $data =
            [
                "nis" => $this->input->post('nis', true),
                "id" => $this->input->post('id', true),
            ];
        $this->db->set('tanggal_pinjam', 'NOW()', FALSE);
        $this->db->set('status', '1');
        $this->db->insert('peminjaman', $data);
    }

    public function kembaliBuku($id_transaksi)
    {
        $this->db->set('tanggal_kembali', 'NOW()', false);
        $this->db->set('status', '2');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('peminjaman');
    }

    public function deleteTransaksi($id_transaksi)
    {
        //$this->db->where('id_transaksi', $nis);
        $this->db->delete('peminjaman', ['id_transaksi' => $id_transaksi]);
    }

    public function alertInsert()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
        Data <strong>Transaksi</strong> berhasil ditambahkan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }

    public function alertKembali()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
        Data <strong>buku</strong> berhasil dikembalikan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }

    public function alertDelete()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
        Data <strong>transaksi</strong> berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }
}

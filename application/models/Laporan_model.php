<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function excel1($status)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis = anggota.nis');
        $this->db->join('buku', 'peminjaman.id = buku.id');
        $this->db->where($status);
        $this->db->order_by('id_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function excel2($status)
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

    public function chart1()
    {
        // $query = $this->db->query("SELECT peminjaman.id, nama_buku from peminjaman , buku where peminjaman.id = buku.id");
        // return $query;
        // $query = $this->db->query("SELECT peminjaman.id, COUNT( * ) AS total FROM peminjaman GROUP BY id");
        // return $query;
        $query = $this->db->query("SELECT n.id, n.nama_buku, COUNT( * ) AS total 
        FROM buku n
        JOIN peminjaman s ON s.id = n.id
        WHERE status = 1 
        GROUP BY nama_buku");
        return $query;
    }

    public function chart2()
    {
        $query = $this->db->query("SELECT n.id, n.nama_buku, COUNT( * ) AS total 
        FROM buku n
        JOIN peminjaman s ON s.id = n.id 
        WHERE status = 2
        GROUP BY nama_buku");
        return $query;
    }

    public function pdf1($status)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis = anggota.nis');
        $this->db->join('buku', 'peminjaman.id = buku.id');
        $this->db->where($status);
        $this->db->order_by('id_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function pdf2($status)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis = anggota.nis');
        $this->db->join('buku', 'peminjaman.id = buku.id');
        $this->db->where($status);
        $this->db->order_by('id_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}

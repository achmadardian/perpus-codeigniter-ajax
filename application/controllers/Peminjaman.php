<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $status = array('status' => '1');
        $data['transaksi'] = $this->Peminjaman_model->viewTransaksi($status);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function addPeminjaman()
    {
        $data['title'] = 'Peminjaman';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['anggota'] = $this->Peminjaman_model->getAnggota()->result();
        $data['buku'] = $this->Peminjaman_model->getBuku()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/peminjaman/addPeminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules(
            'nis',
            'NIS',
            'required|numeric|max_length[4]',
            [
                'required' => 'NIS wajib diisi',
                'numeric' => 'Wajib angka',
                'max_length' => 'Kolom Maksimal 4 digit'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Peminjaman';
            $data['user'] = $this->db->get_where('admin', ['username' =>
            $this->session->userdata('username')])->row_array();
            $data['anggota'] = $this->Peminjaman_model->getAnggota()->result();
            $data['buku'] = $this->Peminjaman_model->getBuku()->result();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/peminjaman/addPeminjaman', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Peminjaman_model->insertPeminjaman();
            $this->Peminjaman_model->alertInsert();
            redirect('peminjaman');
        }
    }

    public function kembali($id_transaksi)
    {
        $this->Peminjaman_model->kembaliBuku($id_transaksi);
        $this->Peminjaman_model->alertKembali();
        redirect('peminjaman');
    }

    public function delete($id_transaksi)
    {
        $this->Peminjaman_model->deleteTransaksi($id_transaksi);
        $this->Peminjaman_model->alertDelete();
        redirect('peminjaman');
    }
}

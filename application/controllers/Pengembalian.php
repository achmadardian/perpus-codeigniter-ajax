<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengembalian_model');
    }

    public function index()
    {
        $data['title'] = 'Pengembalian';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $status = array('status' => '2');
        $data['pengembalian'] = $this->Pengembalian_model->viewPengembalian($status);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengembalian/pengembalian', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id_transaksi)
    {
        $this->Pengembalian_model->deleteTransaksi($id_transaksi);
        $this->Pengembalian_model->alertDelete();
        redirect('pengembalian');
    }
}

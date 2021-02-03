<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']  = 'Buku';
        $data['user']   = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/buku/buku', $data);
        $this->load->view('templates/footer');
    }

    public function ambilData()
    {
        $data = $this->Buku_model->getData(); // Menampung value return dari fungsi getData ke variabel data
        echo json_encode($data); // Mengencode variabel data menjadi json format
    }

    public function tambahData()
    {
        $this->form_validation->set_rules(
            'id',
            'ID',
            'required|max_length[3]',
            [
                'required' => 'Kolom Wajib diisi',
                'max_length' => 'Kolom Maksimal 3 digit'
            ]
        );
        $this->form_validation->set_rules('nama_buku', 'Nama Buku', 'required', ['required' => 'Kolom Wajib diisi']);
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required', ['required' => 'Wajib dipilih']);
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required', ['required' => 'Wajib dipilih']);
        $this->form_validation->set_rules(
            'tahun_terbit',
            'tahun_terbit',
            'required|numeric|max_length[4]',
            [
                'required' => 'Kolom Wajib diisi',
                'numeric' => 'Wajib angka',
                'max_length' => 'Kolom Maksimal 4 digit'
            ]
        );

        if ($this->form_validation->run() == true) {
            $id            = $this->input->post('id');
            $nama_buku     = $this->input->post('nama_buku');
            $pengarang     = $this->input->post('pengarang');
            $penerbit      = $this->input->post('penerbit');
            $tahun_terbit  = $this->input->post('tahun_terbit');

            $data =
                [
                    'id'            => $id,
                    'nama_buku'     => $nama_buku,
                    'pengarang'     => $pengarang,
                    'penerbit'      => $penerbit,
                    'tahun_terbit'  => $tahun_terbit
                ];
            $data = $this->Buku_model->insertData($data);
            echo json_encode('sukses', $data);
        } else {
            $data =
                [
                    'id'            => form_error('id'),
                    'nama_buku'     => form_error('nama_buku'),
                    'pengarang'     => form_error('pengarang'),
                    'penerbit'      => form_error('penerbit'),
                    'tahun_terbit'  => form_error('tahun_terbit')
                ];
            echo json_encode($data);
        }
    }

    public function ambilDataById()
    {
        $id     = $this->input->post('id'); //Menangkap inputan no induk
        $data   = $this->Buku_model->getDataById($id); // Menampung value return dari fungsi getDataByNoinduk ke variabel data
        echo json_encode($data); // Mengencode variabel data menjadi json format
    }

    public function update()
    {
        $id            = $this->input->post('id');
        $nama_buku     = $this->input->post('nama_buku');
        $pengarang     = $this->input->post('pengarang');
        $penerbit      = $this->input->post('penerbit');
        $tahun_terbit  = $this->input->post('tahun_terbit');

        $data =
            [
                'id'            => $id,
                'nama_buku'     => $nama_buku,
                'pengarang'     => $pengarang,
                'penerbit'      => $penerbit,
                'tahun_terbit'  => $tahun_terbit
            ];

        $data = $this->Buku_model->updateData($id, $data);
        echo json_encode($data);
    }

    public function hapusData()
    {
        $id     = $this->input->post('id');
        $data   = $this->Buku_model->deleteData($id);
        echo json_encode($data); // Mengencode variabel data menjadi json format
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Anggota';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/anggota/anggota', $data);
        $this->load->view('templates/footer');
    }

    public function view()
    {
        $data = $this->Anggota_model->getAllAnggota();
        echo json_encode($data);
    }

    public function tambahData()
    {
        $this->form_validation->set_rules(
            'nis',
            'NIS',
            'required|numeric|max_length[4]',
            [
                'required' => 'Nis Wajib diisi',
                'numeric' => 'Wajib angka',
                'max_length' => 'Kolom Maksimal 4 digit'
            ]
        );
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required', ['required' => 'Kolom Wajib diisi']);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', ['required' => 'Wajib dipilih']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', ['required' => 'Kolom Wajib diisi', 'valid_email' => 'Format email tidak valid']);

        if ($this->form_validation->run() == true) {
            $nis            = $this->input->post('nis');
            $nama_siswa     = $this->input->post('nama_siswa');
            $jenis_kelamin  = $this->input->post('jenis_kelamin');
            $email          = $this->input->post('email');

            $data =
                [
                    'nis'            => $nis,
                    'nama_siswa'     => $nama_siswa,
                    'jenis_kelamin'  => $jenis_kelamin,
                    'email'          => $email
                ];
            $data = $this->Anggota_model->insertData($data);
            echo json_encode('sukses', $data);
        } else {
            $data =
                [
                    'nis'                   => form_error('nis'),
                    'nama_siswa'            => form_error('nama_siswa'),
                    'jenis_kelamin'         => form_error('jenis_kelamin'),
                    'email'                 => form_error('email')
                ];
            echo json_encode($data);
        }
    }

    public function ambilDataByNis()
    {
        $nis     = $this->input->post('nis'); //Menangkap inputan no induk
        $data   = $this->Anggota_model->getDataByNis($nis); // Menampung value return dari fungsi getDataByNoinduk ke variabel data
        echo json_encode($data); // Mengencode variabel data menjadi json format
    }

    public function update()
    {
        $nis            = $this->input->post('nis');
        $nama_siswa     = $this->input->post('nama_siswa');
        $jenis_kelamin  = $this->input->post('jenis_kelamin');
        $email          = $this->input->post('email');

        $data =
            [
                'nis'           => $nis,
                'nama_siswa'    => $nama_siswa,
                'jenis_kelamin' => $jenis_kelamin,
                'email'         => $email,
            ];

        $data = $this->Anggota_model->updateData($nis, $data);
        echo json_encode($data);
    }

    public function hapusData()
    {
        $nis     = $this->input->post('nis');
        $data   = $this->Anggota_model->deleteData($nis);
        echo json_encode($data); // Mengencode variabel data menjadi json format
    }
}

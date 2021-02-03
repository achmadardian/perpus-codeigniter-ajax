<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./assets/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require('./application/third_party/fpdf/fpdf.php');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->library('pdf');
    }

    function peminjamanPdf()
    {
        $status = array('status' => '1');
        $transaksi = $this->Laporan_model->pdf1($status);
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'PERPUSTAKAAN SEKOLAH', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'LAPORAN PEMINJAMAN BUKU', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'NO', 1, 0);
        $pdf->Cell(11, 6, 'NIM', 1, 0);
        $pdf->Cell(40, 6, 'NAMA SISWA', 1, 0);
        $pdf->Cell(60, 6, 'NAMA BUKU', 1, 0);
        $pdf->Cell(35, 6, 'TANGGAL PINJAM', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($transaksi as $row) {
            $pdf->Cell(8, 6, $no++, 1, 0);
            $pdf->Cell(11, 6, $row->nis, 1, 0);
            $pdf->Cell(40, 6, $row->nama_siswa, 1, 0);
            $pdf->Cell(60, 6, $row->nama_buku, 1, 0);
            $pdf->Cell(35, 6, $row->tanggal_pinjam, 1, 1);
        }
        $pdf->Output();
    }

    function pengembalianPdf()
    {
        $status = array('status' => '2');
        $transaksi = $this->Laporan_model->pdf2($status);
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'PERPUSTAKAAN SEKOLAH', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'LAPORAN PENGEMBALIAN BUKU', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'NO', 1, 0);
        $pdf->Cell(11, 6, 'NIM', 1, 0);
        $pdf->Cell(40, 6, 'NAMA SISWA', 1, 0);
        $pdf->Cell(60, 6, 'NAMA BUKU', 1, 0);
        $pdf->Cell(35, 6, 'TANGGAL PINJAM', 1, 0);
        $pdf->Cell(37, 6, 'TANGGAL KEMBALI', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($transaksi as $row) {
            $pdf->Cell(8, 6, $no++, 1, 0);
            $pdf->Cell(11, 6, $row->nis, 1, 0);
            $pdf->Cell(40, 6, $row->nama_siswa, 1, 0);
            $pdf->Cell(60, 6, $row->nama_buku, 1, 0);
            $pdf->Cell(35, 6, $row->tanggal_pinjam, 1, 0);
            $pdf->Cell(37, 6, $row->tanggal_kembali, 1, 1);
        }
        $pdf->Output();
    }

    public function peminjamanExcel()
    {
        $status = array('status' => '1');
        $transaksi = $this->Laporan_model->excel1($status);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Achmad Ardian')
            ->setLastModifiedBy('Achmad Ardian')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D1', 'LAPORAN PEMINJAMAN BUKU')
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'ID Transaksi')
            ->setCellValue('C3', 'Tanggal Pinjam')
            ->setCellValue('D3', 'NIS')
            ->setCellValue('E3', 'Nama Siswa')
            ->setCellValue('F3', 'Nama Buku');

        $i = 4;
        $no = 1;
        foreach ($transaksi as $trs) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++)
                ->setCellValue('B' . $i, $trs->id_transaksi)
                ->setCellValue('C' . $i, $trs->tanggal_pinjam)
                ->setCellValue('D' . $i, $trs->nis)
                ->setCellValue('E' . $i, $trs->nama_siswa)
                ->setCellValue('F' . $i, $trs->nama_buku);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel ' . date('d-m-Y H'));

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Peminjaman.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function pengembalianExcel()
    {
        $status = array('status' => '2');
        $transaksi = $this->Laporan_model->excel2($status);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Achmad Ardian')
            ->setLastModifiedBy('Achmad Ardian')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D1', 'LAPORAN PENGEMBALIAN BUKU')
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'ID Transaksi')
            ->setCellValue('C3', 'Tanggal Pinjam')
            ->setCellValue('D3', 'Tanggal Kembali')
            ->setCellValue('E3', 'NIS')
            ->setCellValue('F3', 'Nama Siswa')
            ->setCellValue('G3', 'Nama Buku');

        $i = 4;
        $no = 1;
        foreach ($transaksi as $trs) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++)
                ->setCellValue('B' . $i, $trs->id_transaksi)
                ->setCellValue('C' . $i, $trs->tanggal_pinjam)
                ->setCellValue('D' . $i, $trs->tanggal_kembali)
                ->setCellValue('E' . $i, $trs->nis)
                ->setCellValue('F' . $i, $trs->nama_siswa)
                ->setCellValue('G' . $i, $trs->nama_buku);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel ' . date('d-m-Y H'));

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pengembalian.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function peminjamanChart()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $d = $this->Laporan_model->chart1()->result();
        $data['data'] = json_encode($d);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan/chart', $data);
        $this->load->view('templates/footer');
    }

    public function pengembalianChart()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $d = $this->Laporan_model->chart2()->result();
        $data['data'] = json_encode($d);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan/chart2', $data);
        $this->load->view('templates/footer');
    }
}

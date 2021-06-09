<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {redirect('login','refresh');}//user harus login
        //load model
        $this->load->model('Model_absensi');
    }

    public function index() {
        $data['judul'] = 'Report Absensi';
        $data['user'] = $this->Model_absensi->get_all('tb_user')->result();
        $this->template->display('report_absen', $data);
    }

    public function user() {
        $email=$this->session->userdata('email');
        $dataUser=$this->Model_absensi->get_where('tb_user',array('email'=>$email))->row();
        $data['judul'] = 'Report Absensi';
        $data['id_user'] = $dataUser->id_user;
        $this->template->display('report_user', $data);
    }

    public function izin() {
        $data['judul'] = 'Report Izin';
        $data['user'] = $this->Model_absensi->get_all('tb_user')->result();
        $this->template->display('report_izin', $data);
    }

    public function xlsabsen() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Tipe Absensi');
        $sheet->setCellValue('D1', 'Hari');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'Waktu');
        $sheet->setCellValue('G1', 'Absen');
        $sheet->setCellValue('H1', 'Ket');
        $no = 0;
        $x = 2;

        $data=$this->Model_absensi->lapAbsenRange($_GET['awal'],$_GET['akhir'],$_GET['id_user'])->result();

        foreach($data as $row) {
            $no++;
            if($row->waktu<=$row->default_waktu) {
                $ket='Tepat';
            } else {
                $ket='Terlambat';
            }
            $sheet->setCellValue('A'.$x, $no);
            $sheet->setCellValue('B'.$x, $row->nama);
            $sheet->setCellValue('C'.$x, $row->tipe_absen);
            $sheet->setCellValue('D'.$x, $row->hari);
            $sheet->setCellValue('E'.$x, $row->tanggal);
            $sheet->setCellValue('F'.$x, $row->waktu);
            $sheet->setCellValue('G'.$x, $row->status);
            $sheet->setCellValue('H'.$x, $ket);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'lap-absensi-'.date('Y-m-d');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function xlsizin() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Alasan');
        $no = 0;
        $x = 2;
        
        $data=$this->Model_absensi->lapIzinRange($_GET['awal'],$_GET['akhir'],$_GET['id_user'])->result();

        foreach($data as $row) {
            $no++;
            $sheet->setCellValue('A'.$x, $no);
            $sheet->setCellValue('B'.$x, $row->nama);
            $sheet->setCellValue('C'.$x, $row->tanggal);
            $sheet->setCellValue('D'.$x, $row->alasan);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'lap-izin-'.date('Y-m-d');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}
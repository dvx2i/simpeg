<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TrPangkat extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tr_pangkat';     // file view
    var $redirect = 'konversi/TrPangkat';     // redirect to here
    var $modul = 'Konversi TR PANGKAT';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi', 'ref_pangkat_golongan', 'm_pegawai_pangkat', 'ref_kenaikan_pangkat'));
    }

    public function index() {
        $data['konversi'] = '';
        $this->loadView($this->view, $data);
    }

    public function detail($id) {
        $data['result'] = $this->m_konversi->get_row($id);
        $this->loadView($this->view, $data);
    }

    private function set_data() {
        $data['kolom'] = $this->input->post('post_name');
        return $data;
    }

    public function add() {
        //extrac post here    
        $this->load->library('PHPExcel');
        $this->load->model('m_konversi');
        $this->load->model('m_pegawai');
        $file_data = $_FILES['userfile'];
        $file_path = $file_data['tmp_name'];
        $inputFileName = $file_path;
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

        $row = 0;
        $summary = '';

        foreach ($allDataInSheet as $value) {
            $error = '';
            $success = '';
            if ($row > 0) {
                if (!empty($value['A'])) {
                    $data['pegawaipangkat_pegawai_nip'] = $value['A'];
                    $data['pegawaipangkat_pangkat_id'] = $value['B'];
                    $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $data['pegawaipangkat_pangkat_id']))->row();
                    $data['pegawaipangkat_pangkat_nama'] = $pangkat->pangkat_golongan_pangkat;
                    $data['pegawaipangkat_pangkat_golru'] = $pangkat->pangkat_golongan_nama;
                    $data['pegawaipangkat_kenaikan_id'] = $value['C'];
                    $kenaikan = $this->ref_kenaikan_pangkat->get_where(array('kenaikan_pangkat_kode'=>$data['pegawaipangkat_kenaikan_id']))->row();
                    $data['pegawaipangkat_kenaikan_nama'] = $kenaikan->kenaikan_pangkat_nama;
                    $data['pegawaipangkat_tmt'] = tanggal_mysql($value['D'], '/');
                    $data['pegawaipangkat_sk_date'] = tanggal_mysql($value['E'], '/');
                    $data['pegawaipangkat_sk_no'] = $value['F'];
                    $data['pegawaipangkat_sk_pejabat'] = $value['G'];
                    $data['pegawaipangkat_angka_kredit'] = $value['H'];
                    $data['pegawaipangkat_masa_kerja_tahun'] = $value['I'];
                    $data['pegawaipangkat_masa_kerja_bulan'] = $value['J'];
                    $data['pegawaipangkat_gaji_pokok'] = $value['K'];
//                $data['pegawaipangkat_unit_kerja_id'] = $value['N'];
//                $data['pegawaipangkat_unit_kerja_nama'] = $value['O'];
//                $data['pegawaipangkat_jenis_jabatan_id'] = $value['P'];
//                $data['pegawaipangkat_jenis_jabatan_nama'] = $value['Q'];
//                $data['pegawaipangkat_jabatan_id'] = $value['P'];
//                $data['pegawaipangkat_jabatan_nama'] = $value['P'];
//                $data['pegawaipangkat_eselon_id'] = $value['P'];
//                $data['pegawaipangkat_eselon_nama'] = $value['P'];

                    $insert = $this->m_pegawai_pangkat->insert($data);
                    if ($insert) {
                        $summary .= "NIP. " . $data['pegawaipangkat_pegawai_nip'] . " Konversi Data PANGKAT Berhasil" . "<br/>";
                    } else {
                        $summary .= "NIP. " . $data['pegawaipangkat_pegawai_nip'] . " Konversi Data PANGKAT GAGAL" . "<br/>";
                    }
                }
            }
            $row++;
        }
        $hasil['konversi'] = $summary;
//        $this->session->set_flashdata('konversi', $summary);
        $this->loadView($this->view, $hasil);
    }

    public function update() {
        //extrac post here and post primary key is id
        $id = $this->input->post('id');
        $data = $this->set_data();

        $update = $this->m_konversi->update($data, $id);
        if ($update) {
            $this->session->set_flashdata('message', alert_show(array('success', "Edit " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Edit " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function delete($id) {
        $delete = $this->m_konversi->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show(array('success', "Delete " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Delete " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function excel() {
        $data['result'] = $this->m_konversi->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

}

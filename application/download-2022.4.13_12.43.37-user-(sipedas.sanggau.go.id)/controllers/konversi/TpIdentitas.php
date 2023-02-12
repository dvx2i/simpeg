<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpIdentitas extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_identitas';     // file view
    var $redirect = 'konversi/TpIdentitas';     // redirect to here
    var $modul = 'Koncersi TP CPNS';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi'));
    }

    public function index() {
        $data['konversi'] = '';
        $this->loadView($this->view,$data);
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

                $id = $value['A'];
                $data['pegawai_gelar_depan'] = $value['B'];
                $data['pegawai_nama'] = $value['C'];
                $data['pegawai_gelar_belakang'] = $value['D'];
                $data['pegawai_tempat_lahir'] = $value['E'];
                $data['pegawai_tgl_lahir'] = tanggal_mysql($value['G'],'/');
                $data['pegawai_jenkel_id'] = $value['H'];
                $data['pegawai_agama_id'] = $value['I'];
                $data['pegawai_status_kepegawaian_id'] = $value['J'];
                $data['pegawai_statusperkawinan_id'] = $value['M'];
                $data['pegawai_golongandarah_id'] = $value['O'];
                $data['pegawai_alamat'] = $value['P'];
                $data['pegawai_rt'] = $value['Q'];
                $data['pegawai_rw'] = $value['R'];
                $data['pegawai_kodepos'] = $value['S'];
                $data['pegawai_telpon'] = $value['T'];
                $data['pegawai_propinsi_id'] = $value['U'];
                $data['pegawai_kabupaten_id'] = $value['V'];
                $data['pegawai_kecamatan_id'] = $value['W'];
                $data['pegawai_kelurahan_id'] = $value['X'];
                $data['pegawai_no_karpeg'] = $value['Y'];
                $data['pegawai_no_askes'] = $value['Z'];
                $data['pegawai_no_taspen'] = $value['AA'];
                $data['pegawai_no_karis'] = $value['AB'];
                $data['pegawai_no_npwp'] = $value['AC'];

                $update = $this->m_pegawai->update($data, $id);
                if ($update) {
                    $summary .= "NIP. " . $id . " Konversi Data IDENTITAS Berhasil" . "<br/>";
                } else {
                    $summary .= "NIP. " . $id . " Konversi Data IDENTITAS GAGAL" . "<br/>";
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

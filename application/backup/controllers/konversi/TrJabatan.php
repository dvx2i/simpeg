<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TrJabatan extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tr_jabatan';     // file view
    var $redirect = 'konversi/TrJabatan';     // redirect to here
    var $modul = 'Konversi TR JABATAN';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi', 'm_pegawai_jabatan', 'ref_kenaikan_jabatan'));
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
                    $data['pegawaijabatan_pegawai_nip'] = $value['A'];
                    $data['pegawaijabatan_jenisjabatan_id'] = $value['B'];
                    $data['pegawaijabatan_pejabat'] = $value['C'];
                    $data['pegawaijabatan_sk_no'] = $value['D'];
                    $data['pegawaijabatan_sk_tanggal'] = tanggal_mysql($value['E'], '/');
                    $data['pegawaijabatan_eselon_id'] = $value['F'];
                    $data['pegawaijabatan_tmt'] = tanggal_mysql($value['G'], '/');
                    $data['pegawaijabatan_jabatan_nama'] = $value['H'];
                    $data['pegawaijabatan_unit_kerja_nama'] = $value['I'];
                    $data['pegawaijabatan_jenis_guru'] = $value['J'];                    

                    $insert = $this->m_pegawai_jabatan->insert_ignore($data);
                    if ($insert) {
                        $summary .= "NIP. " . $data['pegawaijabatan_pegawai_nip'] . " Konversi Data JABATAN Berhasil" . "<br/>";
                    } else {
                        $summary .= "NIP. " . $data['pegawaijabatan_pegawai_nip'] . " Konversi Data JABATAN GAGAL" . "<br/>";
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

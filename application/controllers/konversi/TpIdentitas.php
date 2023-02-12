<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpIdentitas extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_identitas';     // file view
    var $redirect = 'konversi/TpIdentitas';     // redirect to here
    var $modul = 'Koncersi TP CPNS';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi','ref_agama','ref_status_kepegawaian','ref_status_perkawinan','ref_golongan_darah','ref_propinsi','ref_kabupaten','ref_kecamatan','ref_kelurahan'));
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

        $rows = 0;
        $summary = '';

        foreach ($allDataInSheet as $value) {
            $error = '';
            $success = '';
            if ($rows > 0) {

                $id = $value['A'];
                $data['pegawai_nip'] = $id;
                $data['pegawai_gelar_depan'] = $value['B'];
                $data['pegawai_nama'] = $value['C'];
                $data['pegawai_gelar_belakang'] = $value['D'];
                $data['pegawai_tempat_lahir'] = $value['E'];
                $data['pegawai_tgl_lahir'] = tanggal_mysql($value['F'],'-');

                if(trim($value['G']) == '2'){
                    $jk_id = '2';
                    $jk_nama = 'PEREMPUAN';
                }else{
                    $jk_id = '1';
                    $jk_nama = 'LAKI-LAKI';
                }
                $data['pegawai_jenkel_id'] = $jk_id;
                $data['pegawai_jenkel_nama'] = $jk_nama;

                if(!empty($value['H'])){
                    $agama = $this->ref_agama->get_where(array('agama_id' => $value['H']))->row();
                    $data['pegawai_agama_id'] = $agama->agama_id;
                    $data['pegawai_agama_nama'] = $agama->agama_nama;
                }
                
                if(!empty($value['I'])){
                    $kpeg = $this->ref_status_kepegawaian->get_row($value['I']);
                    $data['pegawai_status_kepegawaian_id'] = $kpeg->statuskepegawaian_id;
                    $data['pegawai_status_kepegawaian_nama'] = $kpeg->statuskepegawaian_nama;
                }
                
                if(!empty($value['L'])){
                    $row = $this->ref_status_perkawinan->get_row($value['L']);
                    $data['pegawai_statusperkawinan_id'] = $row->status_perkawinan_id;
                    $data['pegawai_statusperkawinan_nama'] = $row->status_perkawinan_nama;
                }
                
                if(!empty($value['N'])){
                    $row = $this->ref_golongan_darah->get_row($value['N']);
                    $data['pegawai_golongandarah_id'] = $row->golongandarah_id;
                    $data['pegawai_golongandarah_nama'] = $row->golongandarah_nama;
                }

                $data['pegawai_alamat'] = $value['O'];
                $data['pegawai_rt'] = $value['P'];
                $data['pegawai_rw'] = $value['Q'];
                $data['pegawai_kodepos'] = $value['R'];
                $data['pegawai_telpon'] = $value['S'];
                $data['pegawai_hp'] = $value['S'];
                $data['pegawai_email'] = $value['T'];
                
                if(!empty($value['U'])){
                    $row = $this->ref_propinsi->get_row($value['U']);
                    $data['pegawai_propinsi_id'] = $row->propinsi_id;
                    $data['pegawai_propinsi_nama'] = $row->propinsi_nama;
                }
                if(!empty($value['V'])){
                    $row = $this->ref_kabupaten->get_row($value['V']);
                    $data['pegawai_kabupaten_id'] = $row->kabupaten_id;
                    $data['pegawai_kabupaten_nama'] = $row->kabupaten_nama;
                }
                if(!empty($value['W'])){
                    $row = $this->ref_kecamatan->get_row($value['W']);
                    $data['pegawai_kecamatan_id'] = $row->kecamatan_id;
                    $data['pegawai_kecamatan_nama'] = $row->kecamatan_nama;
                }
                if(!empty($value['X'])){
                    $row = $this->ref_kelurahan->get_row($value['X']);
                    $data['pegawai_kelurahan_id'] = $row->kelurahan_id;
                    $data['pegawai_kelurahan_nama'] = $row->kelurahan_nama;
                }
                
                $data['pegawai_no_karpeg'] = $value['Y'];
                $data['pegawai_no_askes'] = $value['Z'];
                $data['pegawai_no_taspen'] = $value['AA'];
                $data['pegawai_no_karis'] = $value['AB'];
                $data['pegawai_no_npwp'] = $value['AC'];
                $data['pegawai_no_kk'] = $value['AD'];
                $data['pegawai_no_ktp'] = $value['AE'];
                
                $exist = $this->m_pegawai->get_where(array('pegawai_nip' => $data['pegawai_nip']));
                
                if($exist->num_rows() > 0){
                    $konversi = $this->m_pegawai->update($data, $data['pegawai_nip']);
                }
                else{
                    $konversi = $this->m_pegawai->insert($data);
                }
	// die($this->db->last_query());
                if ($konversi) {
                    $summary .= "NIP. " . $id . " Konversi Data IDENTITAS Berhasil" . "<br/>";
                } else {
                    $summary .= "NIP. " . $id . " Konversi Data IDENTITAS GAGAL" . "<br/>";
                }
            }
            $rows++;
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

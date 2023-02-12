<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpCpns extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_cpns';     // file view
    var $redirect = 'konversi/TpCpns';     // redirect to here
    var $modul = 'Koncersi TP CPNS';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi','ref_pangkat_golongan'));
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
                $data['pegawai_cpns_pejabat'] = $value['B'];
                $data['pegawai_cpns_sk_no'] = $value['C'];
                $data['pegawai_cpns_sk_date'] = !empty($value['D']) ? tanggal_mysql($value['D'],'-') : NULL;
                $data['pegawai_cpns_tmt'] = !empty($value['E']) ? tanggal_mysql($value['E'],'-') : NULL;
                // $data['pegawai_cpns_pangkat_id'] = $value['F'];
                if(!empty($value['F'])){
                    $golru = str_replace(" ", "", trim($value['F']));
                    $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama' => $golru))->row();
                	if(!empty($pangkat)){
                    $data['pegawai_cpns_pangkat_id'] = $pangkat->pangkat_golongan_id;
                	}
                }
                $data['pegawai_pns_pejabat'] = $value['G'];
                $data['pegawai_pns_sk_no'] = $value['H'];
                $data['pegawai_pns_sk_date'] = !empty($value['I']) ? tanggal_mysql($value['I'],'-') : NULL;
                $data['pegawai_pns_tmt'] = !empty($value['J']) ? tanggal_mysql($value['J'],'-') : NULL;
                // $data['pegawai_pns_pangkat_id'] = $value['Q'];
                if(!empty($value['K'])){
                    $golru = str_replace(" ", "", trim($value['K']));
                    $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama' => $golru))->row();
                if(!empty($pangkat)){
                    $data['pegawai_pns_pangkat_id'] = $pangkat->pangkat_golongan_id;
                }
                }
            
                // $data['pegawai_pns_sumpah_id'] = $value['L'];
                $update = $this->m_pegawai->update($data, $id);
            // die($this->db->last_query());
                if($update){
                    $summary .= "NIP. ".$id." Konversi Data CPNS Berhasil"."<br/>";
                }else{
                    $summary .= "NIP. ".$id." Konversi Data CPNS GAGAL"."<br/>";
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

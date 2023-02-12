<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpKgbPangkat extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_kgb_pangkat';     // file view
    var $redirect = 'konversi/TpKgbPangkat';     // redirect to here
    var $modul = 'Koncersi TP KGB PANGKAT';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi','ref_pangkat_golongan', 'm_pegawai_pangkat'));
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

        $rows = 0;
        $summary = '';

        foreach ($allDataInSheet as $value) {
            $error = '';
            $success = '';
            if ($rows > 0) {

                $id = $value['A'];
                $data['pegawai_kgb_terakhir_pejabat'] = $value['B'];
                $data['pegawai_kgb_terakhir_sk_no'] = $value['C'];
                $data['pegawai_kgb_terakhir_sk_tanggal'] = !empty($value['D']) ? tanggal_mysql($value['D'], '-') : NULL;
                $data['pegawai_kgb_terakhir_tmt'] = !empty($value['E']) ? tanggal_mysql($value['E'], '-') : NULL;
                if(!empty($value['F'])){
                    $data['pegawai_gaji'] = $value['F'];
                }
                $data['pegawai_pangkat_terakhir_pejabat'] = $value['G'];
                $data['pegawai_pangkat_terakhir_sk'] = $value['H'];
                $data['pegawai_pangkat_terakhir_sk_tgl'] = !empty($value['I']) ? tanggal_mysql($value['I'], '-') : NULL;
                $data['pegawai_pangkat_terakhir_tmt'] = !empty($value['J']) ? tanggal_mysql($value['J'], '-') : NULL;
                if(!empty($value['K'])){
                    $golru = str_replace(" ", "", trim($value['K']));
                    $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama' => $golru))->row();
                	if(!empty($pangkat)) {
                    $data['pegawai_pangkat_terakhir_golru'] = $golru;
                    $data['pegawai_pangkat_terakhir_id'] = $pangkat->pangkat_golongan_id;
                    $data['pegawai_pangkat_terakhir_nama'] = $pangkat->pangkat_golongan_pangkat;
                    }
                }
                if(!empty($value['L'])){
                    $data['pegawai_pangkat_terakhir_tahun'] = $value['L'];
                }
                if(!empty($value['M'])){
                    $data['pegawai_pangkat_terakhir_bulan'] = $value['M'];
                }
                if(!empty($value['N'])){
                    $data['pegawai_angka_kredit'] = $value['N'];
                }

                $update = $this->m_pegawai->update($data, $id);
                if ($update) {
                	$this->add_or_update_riwayat($data, $id);
                    $summary .= "NIP. " . $id . " Konversi Data KGB PANGKAT Berhasil" . "<br/>";
                } else {
                    $summary .= "NIP. " . $id . " Konversi Data KGB PANGKAT GAGAL" . "<br/>";
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

	private function add_or_update_riwayat($pegawai, $nip){
    	$data['pegawaipangkat_pegawai_nip'] = $nip;
        $data['pegawaipangkat_pangkat_id'] = !empty($pegawai['pegawai_pangkat_terakhir_id']) ? $pegawai['pegawai_pangkat_terakhir_id'] : NULL;
        $data['pegawaipangkat_pangkat_nama'] = !empty($pegawai['pegawai_pangkat_terakhir_nama']) ? $pegawai['pegawai_pangkat_terakhir_nama'] : NULL;
        $data['pegawaipangkat_pangkat_golru'] = !empty($pegawai['pegawai_pangkat_terakhir_golru']) ? $pegawai['pegawai_pangkat_terakhir_golru'] : NULL;
        $data['pegawaipangkat_kenaikan_id'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->input->post('pegawaipangkat_kenaikan_pangkat_id') : 0;
        // $data['pegawaipangkat_kenaikan_nama'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->ref_kenaikan_pangkat->get_row($data['pegawaipangkat_kenaikan_id'])->kenaikan_pangkat_nama : '';
        $data['pegawaipangkat_tmt'] = !empty($pegawai['pegawai_pangkat_terakhir_tmt']) ? $pegawai['pegawai_pangkat_terakhir_tmt'] : NULL;
        $data['pegawaipangkat_sk_date'] = !empty($pegawai['pegawai_pangkat_terakhir_sk_tgl']) ? $pegawai['pegawai_pangkat_terakhir_sk_tgl'] : NULL;
        $data['pegawaipangkat_sk_no'] = !empty($pegawai['pegawai_pangkat_terakhir_sk']) ? $pegawai['pegawai_pangkat_terakhir_sk'] : NULL;
        $data['pegawaipangkat_sk_pejabat'] = !empty($pegawai['pegawai_pangkat_terakhir_pejabat']) ? $pegawai['pegawai_pangkat_terakhir_pejabat'] : NULL;
        $data['pegawaipangkat_angka_kredit'] = !empty($pegawai['pegawai_angka_kredit']) ? $pegawai['pegawai_angka_kredit'] : 0;
        $data['pegawaipangkat_masa_kerja_tahun'] = !empty($pegawai['pegawai_pangkat_terakhir_tahun']) ? $pegawai['pegawai_pangkat_terakhir_tahun'] : 0;
        $data['pegawaipangkat_masa_kerja_bulan'] = !empty($pegawai['pegawai_pangkat_terakhir_bulan']) ? $pegawai['pegawai_pangkat_terakhir_bulan'] : 0;
        $data['pegawaipangkat_gaji_pokok'] = !empty($pegawai['pegawai_gaji']) ? $pegawai['pegawai_gaji'] : NULL;
        // $data['pegawaipangkat_unit_kerja_id'] = $this->input->post('pegawaipangkat_unit_kerja_id');
        // $data['pegawaipangkat_unit_kerja_nama'] = !empty($this->input->post('pegawaipangkat_unit_kerja_id')) ? $this->ref_unit->get_row($data['pegawaipangkat_unit_kerja_id'])->unit_nama : '';
        
        
    	$exist = $this->m_pegawai_pangkat->get_where(array('pegawaipangkat_pangkat_id' => $data['pegawaipangkat_pangkat_id'], 'pegawaipangkat_pegawai_nip' => $data['pegawaipangkat_pegawai_nip']));
    
    	if($exist->num_rows() > 0){
        	$pegawaipangkat = $exist->row();
        	// die($pegawaipangkat->pegawaipangkat_id);
        	$update = $this->m_pegawai_pangkat->update($data, $pegawaipangkat->pegawaipangkat_id); 
        }else{
        	$update = $this->m_pegawai_pangkat->insert($data);
        // die($this->db->last_query());
        }
    }

}

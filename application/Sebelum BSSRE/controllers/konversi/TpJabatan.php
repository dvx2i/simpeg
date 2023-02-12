<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpJabatan extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_jabatan';     // file view
    var $redirect = 'konversi/TpJabatan';     // redirect to here
    var $modul = 'Koncersi TP JABATAN';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi','ref_eselon','ref_jabatan_kedudukan','m_pegawai_jabatan'));
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
                $data['pegawai_jabatan_sk_nomor'] = $value['B'];
                $data['pegawai_jabatan_sk_tanggal'] = !empty($value['C']) ? tanggal_mysql($value['C'], '-') : NULL;
                $data['pegawai_jenisjabatan_kode'] = $value['D'];
                $data['pegawai_eselon_id'] = !empty($value['E']) ? $value['E'] : NULL;
                if(!empty($value['E'])){
                    $row = $this->ref_eselon->get_row($value['E']);
                	if(!empty($row)) {
                		$data['pegawai_eselon_id'] = $row->eselon_kode;
                    	$data['pegawai_eselon_nama'] = $row->eselon_nama;
                	}
                }
                $data['pegawai_jabatan_tmt'] = !empty($value['F']) ? tanggal_mysql($value['F'], '-') : '1000-01-01';
                $data['pegawai_jabatan_id'] = !empty($value['G']) ? $value['G'] : NULL;
                $data['pegawai_jabatan_nama'] = $value['H'];
                $data['pegawai_unit_id'] = !empty($value['I']) ? $value['I'] : NULL;
                $data['pegawai_unit_nama'] = $value['J'];
                $update = $this->m_pegawai->update($data, $id);
                if ($update) {
                	$this->add_or_update_riwayat($data, $id);
                    $summary .= "NIP. " . $id . " Konversi Data JABATAN Berhasil" . "<br/>";
                } else {
                    $summary .= "NIP. " . $id . " Konversi Data JABATAN GAGAL" . "<br/>";
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
		$data['pegawaijabatan_pegawai_nip'] = $nip;
        $data['pegawaijabatan_unit_kerja_id'] = !empty($pegawai['pegawai_unit_id']) ? $pegawai['pegawai_unit_id'] : 0;
        $data['pegawaijabatan_unit_kerja_nama'] = $pegawai['pegawai_unit_nama'];
        // $data['pegawaijabatan_sub_unit_id'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->input->post('pegawaijabatan_sub_unit_id') : 0;
        // $data['pegawaijabatan_sub_unit_nama'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->ref_unit->get_row($data['pegawaijabatan_sub_unit_id'])->unit_nama : '';
        $data['pegawaijabatan_jenisjabatan_id'] = $pegawai['pegawai_jenisjabatan_kode'];
        $data['pegawaijabatan_jenisjabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($pegawai['pegawai_jenisjabatan_kode'])->jeniskedudukan_nama;
        $data['pegawaijabatan_jabatan_id'] = !empty($pegawai['pegawai_jabatan_id']) ? $pegawai['pegawai_jabatan_id'] : 0;
        $data['pegawaijabatan_jabatan_id_baru'] = ($data['pegawaijabatan_jenisjabatan_id'] == '4') ? $pegawai['pegawai_jabatan_id'] : 0;
        // $data['pegawaijabatan_kelas_id'] = !empty($this->input->post('pegawaijabatan_kelas_id')) ? $this->input->post('pegawaijabatan_kelas_id') : 0;
        // $data['pegawaijabatan_kelas_nama'] = !empty($this->input->post('pegawaijabatan_kelas_id')) ? $this->ref_kelas_jabatan->get_row($data['pegawaijabatan_kelas_id'])->kelas_nama : '';
        
        if (!empty($data['pegawai_eselon_id'])) {
            $data['pegawaijabatan_eselon_id'] = $pegawai['pegawai_eselon_id'];
            $data['pegawaijabatan_eselon_nama'] = $pegawai['pegawai_eselon_id'];
            //set bagan baru
        	// $this->update_bagan($data['pegawaijabatan_pegawai_nip'],$data['pegawaijabatan_jenisjabatan_id'],$data['pegawaijabatan_jabatan_id']);
       } else if ($data['pegawaijabatan_jenisjabatan_id'] == '2') {
        	// $jabatan_lama = $this->ref_jabatan_fungsional->get_row($pegawai->pegawai_jabatan_id);
        	// $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaijabatan_jabatan_id']);
        	// $this->update_bagan($data['pegawaijabatan_pegawai_nip'],$data['pegawaijabatan_jenisjabatan_id'],$data['pegawaijabatan_jabatan_id']);
        } else if ($data['pegawaijabatan_jenisjabatan_id'] == '4') {
        	// $jabatan_lama = $this->ref_jabatan_baru->get_row($pegawai->pegawai_jabatan_id);
        	// $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaijabatan_jabatan_id']);
        	// $this->update_bagan($data['pegawaijabatan_pegawai_nip'],$data['pegawaijabatan_jenisjabatan_id'],$data['pegawaijabatan_jabatan_id']);
        }

        $data['pegawaijabatan_jabatan_nama'] = $pegawai['pegawai_jabatan_nama'];
        $data['pegawaijabatan_tmt'] = $pegawai['pegawai_jabatan_tmt'];
        $data['pegawaijabatan_sk_no'] = $pegawai['pegawai_jabatan_sk_nomor'];
        $data['pegawaijabatan_sk_tanggal'] = $pegawai['pegawai_jabatan_sk_tanggal'];
        // $data['pegawaijabatan_pejabat'] = $this->input->post('pegawaijabatan_pejabat');
        // $data['pegawaijabatan_tgl_pelantikan'] = y_m_d($this->input->post('pegawaijabatan_sk_tanggal'));
        $data['pegawaijabatan_pangkat_id'] = 0;
        // $data['pegawaijabatan_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaijabatan_pangkat_id'])->pangkat_golongan_text;
        // $data['pegawaijabatan_kenaikan_id'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->input->post('pegawaijabatan_kenaikan_id') : 0;
        // $data['pegawaijabatan_kenaikan_nama'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->ref_kenaikan_jabatan->get_row($data['pegawaijabatan_kenaikan_id'])->kenaikan_jabatan_nama : null;
        $data['pegawaijabatan_tahun'] = 0;
        $data['pegawaijabatan_bulan'] = 0;
        // $data['pegawaijabatan_gaji'] = !empty($this->input->post('pegawaijabatan_gaji')) ? $this->input->post('pegawaijabatan_gaji') : 0;
        // $data['pegawaijabatan_angka_kredit'] = !empty($this->input->post('pegawaijabatan_angka_kredit')) ? $this->input->post('pegawaijabatan_angka_kredit') : 0;
		$exist = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_jabatan_id' => $data['pegawaijabatan_jabatan_id'], 'pegawaijabatan_pegawai_nip' => $data['pegawaijabatan_pegawai_nip']));
    
    	if($exist->num_rows() > 0){
        	$pegawaijabatan = $exist->row();
        	// die($pegawaijabatan->pegawaijabatan_id);
        	$update = $this->m_pegawai_jabatan->update($data, $pegawaijabatan->pegawaijabatan_id); 
        }else{
        	$insert = $this->m_pegawai_jabatan->insert($data);    
        // die($this->db->last_query());
        }
    }


}

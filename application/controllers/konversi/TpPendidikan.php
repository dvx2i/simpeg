<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TpPendidikan extends MY_Controller {

    //variable
    var $view = 'konversi/konversi_tp_pendidikan';     // file view
    var $redirect = 'konversi/TpPendidikan';     // redirect to here
    var $modul = 'Koncersi TP PENDIDIKAN';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_konversi','ref_pendidikan_tingkat', 'm_pegawai_pendidikan'));
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
                if(!empty($value['B'])){
                    $row = $this->ref_pendidikan_tingkat->get_where(array('pendidikan_tingkat_kode' => $value['B']))->row();
                if(!empty($row)){
                    $data['pegawai_pendidikan_terakhir_tingkat_id'] = $value['B'];
                    $data['pegawai_pendidikan_terakhir_tingkat'] = $row->pendidikan_tingkat_nama;
                }
                }
                $data['pegawai_pendidikan_terakhir_jurusan'] = $value['C'];
                $data['pegawai_pendidikan_terakhir_id'] = !empty($value['D']) ? $value['D'] : 0;
                $data['pegawai_pendidikan_terakhir_nama'] = $value['E'];
                $data['pegawai_pendidikan_terakhir_rumpun'] = $value['F'];
                $data['pegawai_pendidikan_terakhir_no_ijazah'] = $value['G'];
                $data['pegawai_pendidikan_terakhir_tgl_ijazah'] = !empty($value['H']) ? tanggal_mysql($value['H'], '-') : NULL;

                $update = $this->m_pegawai->update($data, $id);
                if ($update) {
                	$this->add_or_update_riwayat($data, $id);
                    $summary .= "NIP. " . $id . " Konversi Data PENDIDIKAN Berhasil" . "<br/>";
                } else {
                    $summary .= "NIP. " . $id . " Konversi Data PENDIDIKAN GAGAL" . "<br/>";
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
    	$data['pegawaipendidikan_pegawai_nip'] = $nip;
    // print_r($data['pegawaipendidikan_pegawai_nip']); die;
        $data['pegawaipendidikan_pendidikan_tingkat_id'] = !empty($pegawai['pegawai_pendidikan_terakhir_tingkat_id']) ? $pegawai['pegawai_pendidikan_terakhir_tingkat_id'] : NULL;
        $data['pegawaipendidikan_pendidikan_nama'] = !empty($pegawai['pegawai_pendidikan_terakhir_nama']) ? $pegawai['pegawai_pendidikan_terakhir_nama'] : NULL;
        $data['pegawaipendidikan_pendidikan_tingkat_nama'] = !empty($pegawai['pegawai_pendidikan_terakhir_tingkat']) ? $pegawai['pegawai_pendidikan_terakhir_tingkat'] : NULL;
        // $data['pegawaipendidikan_jurusan_id'] = !empty($pegawai['pegawai_pendidikan_terakhir_jurusan_id']) ? $pegawai['pegawai_pendidikan_terakhir_jurusan_id'] : NULL;
        $data['pegawaipendidikan_jurusan_nama'] = !empty($pegawai['pegawai_pendidikan_terakhir_jurusan']) ? $pegawai['pegawai_pendidikan_terakhir_jurusan'] : NULL;
        $data['pegawaipendidikan_rumpun_nama'] = !empty($pegawai['pegawai_pendidikan_terakhir_rumpun']) ? $pegawai['pegawai_pendidikan_terakhir_rumpun'] : NULL;
        // if (!empty($this->input->post('pegawaipendidikan_rumpun_id'))) {
        //     $data['pegawaipendidikan_rumpun_nama'] = $this->ref_pendidikan->get_row($data['pegawaipendidikan_rumpun_id'])->pendidikan_nama;
        // }
        $data['pegawaipendidikan_nomor_ijazah'] = !empty($pegawai['pegawai_pendidikan_terakhir_no_ijazah']) ? $pegawai['pegawai_pendidikan_terakhir_no_ijazah'] : NULL;
        $data['pegawaipendidikan_tanggal_ijazah'] = !empty($pegawai['pegawai_pendidikan_terakhir_tgl_ijazah']) ? $pegawai['pegawai_pendidikan_terakhir_tgl_ijazah'] : NULL;
        // $data['pegawaipendidikan_nama_pimpinan'] = $this->input->post('pegawaipendidikan_nama_pimpinan');
        // $data['pegawaipendidikan_nilai'] = $this->input->post('pegawaipendidikan_nilai');
        // $data['pegawaipendidikan_jenis'] = $this->input->post('pegawaipendidikan_jenis');
        // $data['pegawaipendidikan_pengangkatan_cpns'] = $this->input->post('pegawaipendidikan_pengangkatan_cpns') == '1' ? '1' : '0';

    
    	$exist = $this->m_pegawai_pendidikan->get_where(array('pegawaipendidikan_pendidikan_tingkat_id' => $data['pegawaipendidikan_pendidikan_tingkat_id'], 'pegawaipendidikan_pegawai_nip' => $data['pegawaipendidikan_pegawai_nip']));
    
    	if($exist->num_rows() > 0){
        	$pegawaipendidikan = $exist->row();
        	// die($pegawaipangkat->pegawaipangkat_id);
        	$update = $this->m_pegawai_pendidikan->update($data, $pegawaipendidikan->pegawaipendidikan_id); 
        }else{
        	 $insert = $this->m_pegawai_pendidikan->insert($data);
        // die($this->db->last_query());
        }
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KolektifPangkat
 *
 * @author Zanuar
 */
class KolektifPangkat extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_pangkat','ref_jabatan_fungsional','ref_jabatan_struktural','ref_pangkat_golongan','m_pegawai','m_kolektif_pangkat', 'ref_pejabat', 'ref_kenaikan_pangkat', 'ref_jabatan_kedudukan'));
    }

    function index() {
        $data['result'] = $this->m_kolektif_pangkat->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['kenaikan_pangkat'] = $this->ref_kenaikan_pangkat->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['format_excel'] = base_url('assets/docs/format_kolektif_kenaikan_pangkat.xlsx');
        $this->loadView('pegawai/kolektif_pangkat', $data);
    }

    function add() {
        $data['kolektif_pangkat_no_sk'] = $this->input->post('kolektif_pangkat_no_sk');
        $data['kolektif_pangkat_tgl_sk'] = $this->input->post('kolektif_pangkat_tgl_sk');
        $data['kolektif_pangkat_pejabat'] = $this->input->post('kolektif_pangkat_pejabat');
        $data['kolektif_pangkat_tmt'] = $this->input->post('kolektif_pangkat_tmt');
        $data['kolektif_pangkat_kenaikan_id'] = $this->input->post('kolektif_pangkat_kenaikan_id');
        $data['kolektif_pangkat_kenaikan_nama'] = $this->ref_kenaikan_pangkat->get_row($data['kolektif_pangkat_kenaikan_id'])->kenaikan_pangkat_nama;
        $data['kolektif_pangkat_jabatan_jenis_id'] = $this->input->post('kolektif_pangkat_jabatan_jenis_id');
        $data['kolektif_pangkat_jabatan_jenis_nama'] = $this->ref_jabatan_kedudukan->get_row($this->input->post('kolektif_pangkat_jabatan_jenis_id'))->jeniskedudukan_nama;
        $insert = $this->m_kolektif_pangkat->insert($data);
        if ($insert) {
            $data['kolektif_pangkat_id'] = $this->db->insert_id();
            $this->insert_from_excel($data);
        }
    }

    public function insert_from_excel($kolektif) {
        
        $this->load->library('PHPExcel');
        $file_data = $_FILES['userfile'];
        $file_path = $file_data['tmp_name'];
        $inputFileName = $file_path;
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
        $row = 0;
        $message = '';
        foreach ($allDataInSheet as $value) {
            
            if($row > 0){
               
            
            $pegawai = $this->m_pegawai->get_row($value['A']);
            $data['pegawaipangkat_pegawai_nip'] = $value['A'];
            $pangkat = $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_nama'=>$value['B']))->row();
            print_r($value['B']);
            $data['pegawaipangkat_pangkat_id'] = $pangkat->pangkat_golongan_id;
            $data['pegawaipangkat_pangkat_nama'] = $this->ref_pangkat_golongan->get_row($data['pegawaipangkat_pangkat_id'])->pangkat_golongan_pangkat;
            $data['pegawaipangkat_pangkat_golru'] = $value['B'];
            $data['pegawaipangkat_kenaikan_id'] = $kolektif['kolektif_pangkat_kenaikan_id'];
            $data['pegawaipangkat_kenaikan_nama'] = $kolektif['kolektif_pangkat_kenaikan_nama'];
            $data['pegawaipangkat_tmt'] = $kolektif['kolektif_pangkat_tmt'];
            $data['pegawaipangkat_sk_date'] = $kolektif['kolektif_pangkat_tgl_sk'];
            $data['pegawaipangkat_sk_no'] = $kolektif['kolektif_pangkat_no_sk'];
            $data['pegawaipangkat_sk_pejabat'] = $kolektif['kolektif_pangkat_pejabat'];
            $data['pegawaipangkat_angka_kredit'] = $value['C'];
            $data['pegawaipangkat_masa_kerja_tahun'] = $value['D'];
            $data['pegawaipangkat_masa_kerja_bulan'] = $value['E'];
            $data['pegawaipangkat_gaji_pokok'] = $value['F'];
            $data['pegawaipangkat_unit_kerja_id'] = $pegawai->pegawai_unit_id;
            $data['pegawaipangkat_unit_kerja_nama'] = $pegawai->pegawai_unit_nama;
            $data['pegawaipangkat_jenis_jabatan_id'] = $kolektif['kolektif_pangkat_jabatan_jenis_id'];
            $data['pegawaipangkat_jenis_jabatan_nama'] = $kolektif['kolektif_pangkat_jabatan_jenis_nama'];
            $data['pegawaipangkat_jabatan_nama'] = $pegawai->pegawai_jabatan_nama;
            $data['pegawaipangkat_keterangan'] = $value['G'];
            $data['pegawaipangkat_kolektif_id'] = $kolektif['kolektif_pangkat_id'];            
            $data['pegawaipangkat_jabatan_id'] = $pegawai->pegawai_jabatan_id;
            $insert = $this->m_pegawai_pangkat->insert($data);
            if($insert){
                $this->m_pegawai_pangkat->update_pangkat_terakhir($data['pegawaipangkat_pegawai_nip']);
                $message .= '[SUKSES] '.$data['pegawaipangkat_pegawai_nip'].' => '.$data['pegawaipangkat_pangkat_golru'].'<br>';
            }else{
                $message .= '<font color="red"> [GAGAL] '.$data['pegawaipangkat_pegawai_nip'].' </font><br>';
            }
            }
            $row++;
        }
        $this->session->set_flashdata('upload', alert_show('success', $message));
        redirect(site_url('pegawai/KolektifPangkat'));
    }

}

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
class KolektifJabatan extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_kolektif_jabatan', 'm_pegawai_jabatan', 'ref_eselon', 'ref_kenaikan_jabatan', 'ref_kondisi_sumpah', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'm_pegawai', 'ref_unit', 'ref_pejabat'));
    }

    function index() {
        $data['result'] = $this->m_kolektif_jabatan->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['jenis_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['kenaikan_jabatan'] = $this->ref_kenaikan_jabatan->get_all();
        $data['format_excel'] = base_url('assets/docs/format_kolektif_mutasi_jabatan.xlsx');
        $this->loadView('pegawai/kolektif_jabatan', $data);
    }

    function add() {
        $data['kolektif_jabatan_sk_no'] = $this->input->post('kolektif_jabatan_sk_no');
        $data['kolektif_jabatan_sk_tanggal'] = $this->input->post('kolektif_jabatan_sk_tanggal');
        $data['kolektif_jabatan_pejabat'] = $this->input->post('kolektif_jabatan_pejabat');
        $data['kolektif_jabatan_tmt'] = $this->input->post('kolektif_jabatan_tmt');
        $data['kolektif_jabatan_pelantikan_tanggal'] = $this->input->post('kolektif_jabatan_pelantikan_tanggal');
        $data['kolektif_jabatan_kenaikan_id'] = $this->input->post('kolektif_jabatan_kenaikan_id');
        $data['kolektif_jabatan_kenaikan_nama'] = $this->ref_kenaikan_jabatan->get_row($data['kolektif_jabatan_kenaikan_id'])->kenaikan_jabatan_nama;
        $data['kolektif_jabatan_jenis_id'] = $this->input->post('kolektif_jabatan_jenis_id');
        $data['kolektif_jabatan_jenis_nama'] = $this->ref_jabatan_kedudukan->get_row($this->input->post('kolektif_jabatan_jenis_id'))->jeniskedudukan_nama;
        $insert = $this->m_kolektif_jabatan->insert($data);
        if ($insert) {
            $data['kolektif_jabatan_id'] = $this->db->insert_id();
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

            if ($row > 0) {
                $pegawai = $this->m_pegawai->get_row($value['A']);
                $data['pegawaijabatan_pegawai_nip'] = $value['A'];
//                $data['pegawaijabatan_unit_kerja_id'] = $pegawai->pegawai_unit_id;
                $data['pegawaijabatan_unit_kerja_nama'] = $value['G'];
                $data['pegawaijabatan_jenisjabatan_id'] = $kolektif['kolektif_jabatan_jenis_id'];
                $data['pegawaijabatan_jenisjabatan_nama'] = $kolektif['kolektif_jabatan_jenis_nama'];
//                $data['pegawaijabatan_jabatan_id'] = $this->input->post('pegawaijabatan_jabatan_id');
//                if ($data['pegawaijabatan_jenisjabatan_id'] == '11') {
//                    $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaijabatan_jabatan_id']);
//                    $data['pegawaijabatan_eselon_id'] = $jabatan->jabatan_eselon_kode;
//                    $data['pegawaijabatan_eselon_nama'] = $jabatan->jabatan_eselon_nama;
//                } else if ($data['pegawaijabatan_jenisjabatan_id'] == '12') {
//                    $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaijabatan_jabatan_id']);
//                }
                $data['pegawaijabatan_jabatan_nama'] = $value['B'];
                $data['pegawaijabatan_tmt'] = $kolektif['kolektif_jabatan_tmt'];
                $data['pegawaijabatan_sk_no'] = $kolektif['kolektif_jabatan_sk_no'];
                $data['pegawaijabatan_sk_tanggal'] = $kolektif['kolektif_jabatan_sk_tanggal'];
                $data['pegawaijabatan_pejabat'] = $kolektif['kolektif_jabatan_pejabat'];
                $data['pegawaijabatan_tgl_pelantikan'] = $kolektif['kolektif_jabatan_pelantikan_tanggal'];
                $data['pegawaijabatan_pangkat_id'] = $pegawai->pegawai_pangkat_terakhir_id;
                $data['pegawaijabatan_pangkat_text'] = $pegawai->pegawai_pangkat_terakhir_golru . ' '.$pegawai->pegawai_pangkat_terakhir_nama;
                $data['pegawaijabatan_kenaikan_id'] = $kolektif['kolektif_jabatan_kenaikan_id'];
                $data['pegawaijabatan_kenaikan_nama'] = $kolektif['kolektif_jabatan_kenaikan_nama'];
                $data['pegawaijabatan_tahun'] = $value['D'];
                $data['pegawaijabatan_bulan'] = $value['E'];
                $data['pegawaijabatan_gaji'] = $value['F'];
                $data['pegawaijabatan_angka_kredit'] = $value['C'];
                $data['pegawaijabatan_keterangan'] = $value['H'];
                $data['pegawaijabatan_kolektif_id'] = $kolektif['kolektif_jabatan_id'];

                $insert = $this->m_pegawai_jabatan->insert($data);
                if (!empty($insert)) {
                    $message .= '[SUKSES] ' . $data['pegawaijabatan_pegawai_nip'] . ' => ' . $data['pegawaijabatan_jabatan_nama'] . '<br>';
                    $this->m_pegawai_jabatan->update_jabatan_terakhir($data['pegawaijabatan_pegawai_nip']);
                } else {
                    $message .= '<font color="red"> [GAGAL] ' . $data['pegawaijabatan_pegawai_nip'] . ' </font><br>';
                }
                
            }
            $row++;
        }
        $this->session->set_flashdata('upload', alert_show('success', $message));
        redirect(site_url('pegawai/KolektifJabatan'));
    }

}

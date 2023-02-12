<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarNominatifPegawai
 *
 * @author Zanuar
 */
class DaftarNominatifPegawai extends MY_Controller {

    //put your code here


    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_eselon', 'ref_jabatan_kedudukan', 'ref_pendidikan_tingkat', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_pangkat_golongan'));
    }

    function index() {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';

        //REFERENSI
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id'=>NULL,'unit_kode <> '=>'0100000'));
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['jabatan_kedudukan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['eselon'] = $this->ref_eselon->get_all();

        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawai_jenkel_id'))) {
            $where['pegawai_jenkel_id'] = $this->input->post('pegawai_jenkel_id');
        }
        if (!empty($this->input->post('pegawai_pangkat_terakhir_id'))) {
            $where['pegawai_pangkat_terakhir_id'] = $this->input->post('pegawai_pangkat_terakhir_id');
        }
        if (!empty($this->input->post('pegawai_pendidikan_terakhir_tingkat'))) {
            $where['pegawai_pendidikan_terakhir_tingkat'] = $this->input->post('pegawai_pendidikan_terakhir_tingkat');
        }
        if (!empty($this->input->post('pegawai_jenisjabatan_kode'))) {
            $where['pegawai_jenisjabatan_kode'] = $this->input->post('pegawai_jenisjabatan_kode');
        }
        if (!empty($this->input->post('pegawai_eselon_id'))) {
            $where['pegawai_eselon_id'] = $this->input->post('pegawai_eselon_id');
        }

        $data['result'] = null;
        if (!empty($this->input->post())) {
            $data['result'] = $this->m_pegawai->get_where($where);
        }

        $data['where'] = $where;

        $this->loadView('laporan/daftar_nominatif_pegawai', $data);
    }

    function excel() {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawai_jenkel_id'))) {
            $where['pegawai_jenkel_id'] = $this->input->post('pegawai_jenkel_id');
        }
        if (!empty($this->input->post('pegawai_pangkat_terakhir_id'))) {
            $where['pegawai_pangkat_terakhir_id'] = $this->input->post('pegawai_pangkat_terakhir_id');
        }
        if (!empty($this->input->post('pegawai_pendidikan_terakhir_tingkat'))) {
            $where['pegawai_pendidikan_terakhir_tingkat'] = $this->input->post('pegawai_pendidikan_terakhir_tingkat');
        }
        if (!empty($this->input->post('pegawai_jenisjabatan_kode'))) {
            $where['pegawai_jenisjabatan_kode'] = $this->input->post('pegawai_jenisjabatan_kode');
        }
        if (!empty($this->input->post('pegawai_eselon_id'))) {
            $where['pegawai_eselon_id'] = $this->input->post('pegawai_eselon_id');
        }

        $data['result'] = $this->m_pegawai->get_where($this->input->post());
        
        $this->load->view('laporan/daftar_nominatif_pegawai_excel', $data);
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pegawai
 *
 * @author Zanuar
 */
class PegawaiPns extends MY_Controller {

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_pejabat', 'ref_kondisi_sumpah', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
    	
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index() {
        
    }

    function view($nip) {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['jabatan_fungsional'] = $this->ref_jabatan_fungsional->get_all();
        $data['kondisi_sumpah'] = $this->ref_kondisi_sumpah->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $this->loadView('pegawai/pegawai_pns', $data);
    }

    function update() {
        $id = $this->input->post('nip');
        $data['pegawai_pns_date'] = y_m_d($this->input->post('pegawai_pns_date'));
        $data['pegawai_pns_pejabat'] = $this->input->post('pegawai_pns_pejabat');
        $data['pegawai_pns_sk_no'] = $this->input->post('pegawai_pns_sk_no');
        $data['pegawai_pns_sk_date'] = y_m_d($this->input->post('pegawai_pns_sk_date'));
        $data['pegawai_pns_pangkat_id'] = !empty($this->input->post('pegawai_pns_pangkat_id')) ? $this->input->post('pegawai_pns_pangkat_id') : 0;
        $data['pegawai_pns_tmt'] = y_m_d($this->input->post('pegawai_pns_tmt'));
        $data['pegawai_pns_sumpah_id'] = !empty($this->input->post('pegawai_pns_sumpah_id')) ? $this->input->post('pegawai_pns_sumpah_id') : 1;
        $update = $this->m_pegawai->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiPns/view/' . $id);
    }

}

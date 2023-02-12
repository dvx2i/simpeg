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
class PegawaiPensiun extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_pejabat', 'ref_kondisi_sumpah', 'ref_jenis_pensiun', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan','m_bagan_struktur'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index()
    {
    }

    function view($nip)
    {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['jabatan_fungsional'] = $this->ref_jabatan_fungsional->get_all();
        $data['kondisi_sumpah'] = $this->ref_kondisi_sumpah->get_all();
        $data['jenis_pensiun'] = $this->ref_jenis_pensiun->get_all();
        $this->loadView('pegawai/pegawai_pensiun', $data);
    }

    function update()
    {
        $id = $this->input->post('nip');
        $data['pegawai_jenis_pensiun_id'] = $this->input->post('pegawai_jenis_pensiun_id');
        $data['pegawai_jenis_pensiun_nama'] = !empty($this->input->post('pegawai_jenis_pensiun_id')) ? $this->ref_jenis_pensiun->get_row($data['pegawai_jenis_pensiun_id'])->jenis_pensiun_nama : NULL;
        $data['pegawai_pensiun_sk_no'] = $this->input->post('pegawai_pensiun_sk_no');
        $data['pegawai_pensiun_pejabat'] = $this->input->post('pegawai_pensiun_pejabat');
        $data['pegawai_pensiun_tanggal'] = y_m_d($this->input->post('pegawai_pensiun_tanggal'));
        $data['pegawai_pensiun_tmt'] = y_m_d($this->input->post('pegawai_pensiun_tmt'));
        $data['pegawai_status'] = 0;
        if (empty($data['pegawai_pensiun_tanggal'])) {
            $data['pegawai_pensiun_tanggal'] = $this->input->post('pegawai_pensiun_tmt');
        }

        $update = $this->m_pegawai->update($data, $id);
        if (!empty($update)) {
        	$this->update_bagan($id);
            $this->session->set_flashdata('message', alert_show('success', "Pensiun Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Pensiun Pegawai Gagal"));
        }
        redirect('pegawai/Pensiun/');
    }


	function update_bagan($nip)
    {
    	
        $data['bagan_pegawai_nip'] = '';

        $update = $this->m_bagan_struktur->update_custom($data, $nip, 'bagan_pegawai_nip');
    }
}

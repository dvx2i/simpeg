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
class PegawaiCpns extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_pejabat', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin','ref_pendidikan_tingkat', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
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
        // echo d_m_y($data['pegawai']->pegawai_cpns_date);
        // die;
        $data['unit'] = $this->ref_unit->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['golongan_darah'] = $this->ref_golongan_darah->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['jabatan_fungsional'] = $this->ref_jabatan_fungsional->get_all();
        $data['jabatan_struktural'] = $this->ref_jabatan_struktural->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $this->loadView('pegawai/pegawai_cpns', $data);
    }

    function update()
    {
        $id = $this->input->post('nip');
        $data['pegawai_cpns_nota'] = $this->input->post('pegawai_cpns_nota');
        $data['pegawai_cpns_date'] = y_m_d($this->input->post('pegawai_cpns_date'));
        $data['pegawai_cpns_pejabat'] = $this->input->post('pegawai_cpns_pejabat');
        $data['pegawai_cpns_sk_no'] = $this->input->post('pegawai_cpns_sk_no');
        $data['pegawai_cpns_sk_date'] = y_m_d($this->input->post('pegawai_cpns_sk_date'));
        $data['pegawai_cpns_pangkat_id'] = !empty($this->input->post('pegawai_cpns_pangkat_id')) ? $this->input->post('pegawai_cpns_pangkat_id') : 0;
        $data['pegawai_cpns_tmt'] = y_m_d($this->input->post('pegawai_cpns_tmt'));
        $data['pegawai_cpns_tenaga_honor_tmt'] = y_m_d($this->input->post('pegawai_cpns_tenaga_honor_tmt'));
        $data['pegawai_cpns_pendidikan_tingkat'] = $this->input->post('pegawai_cpns_pendidikan_tingkat');
        $data['pegawai_cpns_tmt_tugas'] = y_m_d($this->input->post('pegawai_cpns_tmt_tugas'));
        $data['pegawai_cpns_masa_kerja_tahun'] = !empty($this->input->post('pegawai_cpns_masa_kerja_tahun')) ? $this->input->post('pegawai_cpns_masa_kerja_tahun') : 0;
        $data['pegawai_cpns_masa_kerja_bulan'] = !empty($this->input->post('pegawai_cpns_masa_kerja_bulan')) ? $this->input->post('pegawai_cpns_masa_kerja_bulan') : 0;
        $data['pegawai_cpns_lat_jabatan'] = $this->input->post('pegawai_cpns_lat_jabatan');
        $data['pegawai_cpns_lat_jabatan_tahun'] = !empty($this->input->post('pegawai_cpns_lat_jabatan_tahun')) ? $this->input->post('pegawai_cpns_lat_jabatan_tahun') : 0;
        $data['pegawai_cpns_jenis_pengadaan'] = !empty($this->input->post('pegawai_cpns_jenis_pengadaan')) ? $this->input->post('pegawai_cpns_jenis_pengadaan') : NULL;
        // print_r($data);
        // die;
        $update = $this->m_pegawai->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiCpns/view/' . $id);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatHukuman
 *
 * @author Zanuar
 */
class PegawaiDisiplin extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_pejabat', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_baru', 'ref_jabatan_struktural', 'm_pegawai', 'm_pegawai_disiplin', 'ref_jenis_hukuman', 'ref_unit', 'ref_jabatan_kedudukan'));
    	
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
        $data['result'] = $this->m_pegawai_disiplin->get_where(array('pegawaidisiplin_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['jenis_hukuman'] = $this->ref_jenis_hukuman->get_all();
        $data['unit'] = $this->ref_unit->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        if ($data['pegawai']->pegawai_jenisjabatan_kode == '1') {
            $data['jabatan'] = $this->ref_jabatan_struktural->get_all();
        } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '2') {
            $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
        } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '4') {
            $data['jabatan'] = $this->ref_jabatan_baru->get_all();
        }
        $this->loadView('pegawai/pegawai_riwayat_disiplin', $data);
    }

    function add()
    {
        $data['pegawaidisiplin_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaidisiplin_jenishukuman_id'] = !empty($this->input->post('pegawaidisiplin_jenishukuman_id')) ? $this->input->post('pegawaidisiplin_jenishukuman_id') : 0;
        $data['pegawaidisiplin_jenishukuman_nama'] = !empty($this->input->post('pegawaidisiplin_jenishukuman_id')) ? $this->ref_jenis_hukuman->get_row($data['pegawaidisiplin_jenishukuman_id'])->jenis_hukuman_nama : '';
        $data['pegawaidisiplin_no_sk'] = $this->input->post('pegawaidisiplin_no_sk');
        $data['pegawaidisiplin_tanggal'] = y_m_d($this->input->post('pegawaidisiplin_tanggal'));
        $data['pegawaidisiplin_pejabat'] = !empty($this->input->post('pegawaidisiplin_pejabat')) ? $this->input->post('pegawaidisiplin_pejabat') : 0;
        $data['pegawaidisiplin_mulai'] = y_m_d($this->input->post('pegawaidisiplin_mulai'));
        $data['pegawaidisiplin_selesai'] = y_m_d($this->input->post('pegawaidisiplin_selesai'));
        $data['pegawaidisiplin_keterangan'] = $this->input->post('pegawaidisiplin_keterangan');
        $data['pegawai_jenis_jabatan_id'] = !empty($this->input->post('pegawai_jenis_jabatan_id')) ? $this->input->post('pegawai_jenis_jabatan_id') : 0;
        $data['pegawai_jenis_jabatan_nama'] = !empty($this->input->post('pegawai_jenis_jabatan_id')) ?  $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenis_jabatan_id'])->jeniskedudukan_nama : '';
        $data['pegawai_pangkat_id'] = !empty($this->input->post('pegawai_pangkat_id')) ? $this->input->post('pegawai_pangkat_id') : 0;
        $data['pegawai_pangkat_nama'] = !empty($this->input->post('pegawai_pangkat_id')) ? $this->ref_pangkat_golongan->get_row($data['pegawai_pangkat_id'])->pangkat_golongan_text : '';
        $data['pegawai_unit_id'] = !empty($this->input->post('pegawai_unit_id')) ? $this->input->post('pegawai_unit_id') : 0;
        $data['pegawai_unit_nama'] = !empty($this->input->post('pegawai_unit_id')) ? $this->ref_unit->get_row($data['pegawai_unit_id'])->unit_nama : '';
        $data['pegawai_jabatan_id'] = !empty($this->input->post('pegawai_jabatan_id')) ? $this->input->post('pegawai_jabatan_id') : 0;
        if ($data['pegawai_jenis_jabatan_id'] == '1') {
            $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawai_jabatan_id']);
        } else if ($data['pegawai_jenis_jabatan_id'] == '2') {
            $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawai_jabatan_id']);
        } else if ($data['pegawai_jenis_jabatan_id'] == '4') {
            $jabatan = $this->ref_jabatan_baru->get_row($data['pegawai_jabatan_id']);
        }
        $data['pegawai_jabatan_nama'] = !empty($this->input->post('pegawai_jabatan_id')) ? $jabatan->jabatan_nama : '';

        $insert = $this->m_pegawai_disiplin->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Hukuman Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Hukuman Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiDisiplin/view/' . $data['pegawaidisiplin_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaidisiplin_id');
        $nip = $this->input->post('nip');
        $data['pegawaidisiplin_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaidisiplin_jenishukuman_id'] = !empty($this->input->post('pegawaidisiplin_jenishukuman_id')) ? $this->input->post('pegawaidisiplin_jenishukuman_id') : 0;
        $data['pegawaidisiplin_jenishukuman_nama'] = !empty($this->input->post('pegawaidisiplin_jenishukuman_id')) ? $this->ref_jenis_hukuman->get_row($data['pegawaidisiplin_jenishukuman_id'])->jenis_hukuman_nama : '';
        $data['pegawaidisiplin_no_sk'] = $this->input->post('pegawaidisiplin_no_sk');
        $data['pegawaidisiplin_tanggal'] = y_m_d($this->input->post('pegawaidisiplin_tanggal'));
        $data['pegawaidisiplin_pejabat'] = !empty($this->input->post('pegawaidisiplin_pejabat')) ? $this->input->post('pegawaidisiplin_pejabat') : 0;
        $data['pegawaidisiplin_mulai'] = y_m_d($this->input->post('pegawaidisiplin_mulai'));
        $data['pegawaidisiplin_selesai'] = y_m_d($this->input->post('pegawaidisiplin_selesai'));
        $data['pegawaidisiplin_keterangan'] = $this->input->post('pegawaidisiplin_keterangan');
        $data['pegawai_jenis_jabatan_id'] = !empty($this->input->post('pegawai_jenis_jabatan_id')) ? $this->input->post('pegawai_jenis_jabatan_id') : 0;
        $data['pegawai_jenis_jabatan_nama'] = !empty($this->input->post('pegawai_jenis_jabatan_id')) ?  $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenis_jabatan_id'])->jeniskedudukan_nama : '';
        $data['pegawai_pangkat_id'] = !empty($this->input->post('pegawai_pangkat_id')) ? $this->input->post('pegawai_pangkat_id') : 0;
        $data['pegawai_pangkat_nama'] = !empty($this->input->post('pegawai_pangkat_id')) ? $this->ref_pangkat_golongan->get_row($data['pegawai_pangkat_id'])->pangkat_golongan_text : '';
        $data['pegawai_unit_id'] = !empty($this->input->post('pegawai_unit_id')) ? $this->input->post('pegawai_unit_id') : 0;
        $data['pegawai_unit_nama'] = !empty($this->input->post('pegawai_unit_id')) ? $this->ref_unit->get_row($data['pegawai_unit_id'])->unit_nama : '';
        $data['pegawai_jabatan_id'] = !empty($this->input->post('pegawai_jabatan_id')) ? $this->input->post('pegawai_jabatan_id') : 0;
        if ($data['pegawai_jenis_jabatan_id'] == '1') {
            $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawai_jabatan_id']);
        } else if ($data['pegawai_jenis_jabatan_id'] == '2') {
            $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawai_jabatan_id']);
        } else if ($data['pegawai_jenis_jabatan_id'] == '4') {
            $jabatan = $this->ref_jabatan_baru->get_row($data['pegawai_jabatan_id']);
        }
        $data['pegawai_jabatan_nama'] = !empty($this->input->post('pegawai_jabatan_id')) ? $jabatan->jabatan_nama : '';
        // print_r($id);
        // die;

        $insert = $this->m_pegawai_disiplin->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Hukuman Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Hukuman Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiDisiplin/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_disiplin->get_row($id)->pegawaidisiplin_pegawai_nip;
        $delete = $this->m_pegawai_disiplin->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Hukuman Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Hukuman Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiDisiplin/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

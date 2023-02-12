<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatDiklatTeknis
 *
 * @author Zanuar
 */
class PegawaiRiwayatDiklatTeknis extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_diklat_teknis', 'm_pegawai', 'm_pegawai_diklat'));
    }

    function index()
    {
    }

    function view($nip)
    {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'TEKNIS', 'diklat_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['diklat_teknis'] = $this->ref_diklat_teknis->get_all();
        if ($this->cek_admin_opd($data['pegawai'])) {
            $this->loadView('pegawai/pegawai_riwayat_diklat_teknis', $data);
        } else {
            redirect('pegawai/Pegawai');
        }
    }

    function add()
    {
        $data['diklat_pegawai_nip'] = $this->input->post('nip');
        $data['diklat_jenis'] = 'TEKNIS';
        $data['diklat_kode'] = !empty($this->input->post('diklat_kode')) ? $this->input->post('diklat_kode') : 0;
        // $data['diklat_nama'] = $this->ref_diklat_fungsional->get_row($data['diklat_kode'])->diklat_fungsional_nama;
        $data['diklat_nama'] = $this->input->post('diklat_nama');
        $data['diklat_tempat'] = $this->input->post('diklat_tempat');
        $data['diklat_penyelenggara'] = $this->input->post('diklat_penyelenggara');
        $data['diklat_angkatan'] = $this->input->post('diklat_angkatan');
        $data['diklat_tanggal_mulai'] = y_m_d($this->input->post('diklat_tanggal_mulai'));
        $data['diklat_tanggal_selesai'] = y_m_d($this->input->post('diklat_tanggal_selesai'));
        $data['diklat_jam'] = !empty($this->input->post('diklat_jam')) ? $this->input->post('diklat_jam') : 0;
        $data['diklat_hari'] = !empty($this->input->post('diklat_hari')) ? $this->input->post('diklat_hari') : 0;
        $data['diklat_bulan'] = !empty($this->input->post('diklat_bulan')) ? $this->input->post('diklat_bulan') : 0;
        $data['diklat_sttpl_no'] = $this->input->post('diklat_sttpl_no');
        $data['diklat_sttpl_tanggal'] = y_m_d($this->input->post('diklat_sttpl_tanggal'));
        $data['diklat_keterangan'] = $this->input->post('diklat_keterangan');
        $data['diklat_tahun'] =  !empty($this->input->post('diklat_tahun')) ? $this->input->post('diklat_tahun') : 0;

        $insert = $this->m_pegawai_diklat->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Diklat Teknis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Diklat Teknis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatDiklatTeknis/view/' . $data['diklat_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('diklat_id');
        $nip = $this->input->post('nip');
        $data['diklat_jenis'] = 'TEKNIS';
        $data['diklat_kode'] = !empty($this->input->post('diklat_kode')) ? $this->input->post('diklat_kode') : 0;
        // $data['diklat_nama'] = $this->ref_diklat_fungsional->get_row($data['diklat_kode'])->diklat_fungsional_nama;
        $data['diklat_nama'] = $this->input->post('diklat_nama');
        $data['diklat_tempat'] = $this->input->post('diklat_tempat');
        $data['diklat_penyelenggara'] = $this->input->post('diklat_penyelenggara');
        $data['diklat_angkatan'] = $this->input->post('diklat_angkatan');
        $data['diklat_tanggal_mulai'] = y_m_d($this->input->post('diklat_tanggal_mulai'));
        $data['diklat_tanggal_selesai'] = y_m_d($this->input->post('diklat_tanggal_selesai'));
        $data['diklat_jam'] = !empty($this->input->post('diklat_jam')) ? $this->input->post('diklat_jam') : 0;
        $data['diklat_hari'] = !empty($this->input->post('diklat_hari')) ? $this->input->post('diklat_hari') : 0;
        $data['diklat_bulan'] = !empty($this->input->post('diklat_bulan')) ? $this->input->post('diklat_bulan') : 0;
        $data['diklat_sttpl_no'] = $this->input->post('diklat_sttpl_no');
        $data['diklat_sttpl_tanggal'] = y_m_d($this->input->post('diklat_sttpl_tanggal'));
        $data['diklat_keterangan'] = $this->input->post('diklat_keterangan');
        $data['diklat_tahun'] =  !empty($this->input->post('diklat_tahun')) ? $this->input->post('diklat_tahun') : 0;

        $insert = $this->m_pegawai_diklat->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Diklat Teknis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Diklat Teknis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatDiklatTeknis/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_diklat->get_row($id)->diklat_pegawai_nip;
        $delete = $this->m_pegawai_diklat->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Diklat Teknis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Diklat Teknis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatDiklatTeknis/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatKunjungan
 *
 * @author Zanuar
 */
class PegawaiKunjungan extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_kunjungan', 'ref_jenis_kunjungan', 'ref_pejabat'));
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
        $data['result'] = $this->m_pegawai_kunjungan->get_where(array('pegawaitugas_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['jenis_kunjungan'] = $this->ref_jenis_kunjungan->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $this->loadView('pegawai/pegawai_riwayat_kunjungan', $data);
    }

    function add()
    {
        $data['pegawaitugas_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaitugas_tujuan'] = $this->input->post('pegawaitugas_tujuan');
        $data['pegawaitugas_jenispenugasan_id'] = $this->input->post('pegawaitugas_jenispenugasan_id');
        $data['pegawaitugas_jenispenugasan_nama'] = $this->ref_jenis_kunjungan->get_row($data['pegawaitugas_jenispenugasan_id'])->jenis_kunjungan_nama;
        $data['pegawaitugas_keterangan'] = $this->input->post('pegawaitugas_keterangan');
        $data['pegawaitugas_pejabat'] = $this->input->post('pegawaitugas_pejabat');
        $data['pegawaitugas_nomor'] = $this->input->post('pegawaitugas_nomor');
        $data['pegawaitugas_tgl'] = y_m_d($this->input->post('pegawaitugas_tgl'));
        $data['pegawaitugas_mulai'] = y_m_d($this->input->post('pegawaitugas_mulai'));
        $data['pegawaitugas_akhir'] = y_m_d($this->input->post('pegawaitugas_akhir'));
        $data['pegawaitugas_bulan'] = $this->input->post('pegawaitugas_bulan');
        $data['pegawaitugas_hari'] = $this->input->post('pegawaitugas_hari');
        $data['pegawaitugas_peran'] = $this->input->post('pegawaitugas_peran');

        $insert = $this->m_pegawai_kunjungan->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Kunjungan Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Kunjungan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKunjungan/view/' . $data['pegawaitugas_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaitugas_id');
        $nip = $this->input->post('nip');
        $data['pegawaitugas_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaitugas_tujuan'] = $this->input->post('pegawaitugas_tujuan');
        $data['pegawaitugas_jenispenugasan_id'] = $this->input->post('pegawaitugas_jenispenugasan_id');
        $data['pegawaitugas_jenispenugasan_nama'] = $this->ref_jenis_kunjungan->get_row($data['pegawaitugas_jenispenugasan_id'])->jenis_kunjungan_nama;
        $data['pegawaitugas_keterangan'] = $this->input->post('pegawaitugas_keterangan');
        $data['pegawaitugas_pejabat'] = $this->input->post('pegawaitugas_pejabat');
        $data['pegawaitugas_nomor'] = $this->input->post('pegawaitugas_nomor');
        $data['pegawaitugas_tgl'] = y_m_d($this->input->post('pegawaitugas_tgl'));
        $data['pegawaitugas_mulai'] = y_m_d($this->input->post('pegawaitugas_mulai'));
        $data['pegawaitugas_akhir'] = y_m_d($this->input->post('pegawaitugas_akhir'));
        $data['pegawaitugas_bulan'] = $this->input->post('pegawaitugas_bulan');
        $data['pegawaitugas_hari'] = $this->input->post('pegawaitugas_hari');
        $data['pegawaitugas_peran'] = $this->input->post('pegawaitugas_peran');

        $insert = $this->m_pegawai_kunjungan->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Kunjungan Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Kunjungan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKunjungan/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_kunjungan->get_row($id)->pegawaitugas_pegawai_nip;
        $delete = $this->m_pegawai_kunjungan->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Kunjungan Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Kunjungan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKunjungan/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

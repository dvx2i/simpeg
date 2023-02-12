<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatOrganisasi
 *
 * @author Zanuar
 */
class PegawaiOrganisasi extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_organisasi', 'ref_jenis_organisasi'));
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
        $data['result'] = $this->m_pegawai_organisasi->get_where(array('pegawaiorg_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['jenis_organisasi'] = $this->ref_jenis_organisasi->get_all();
        $this->loadView('pegawai/pegawai_riwayat_organisasi', $data);
    }

    function add()
    {
        $data['pegawaiorg_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaiorg_jenisorganisasi_id'] = $this->input->post('pegawaiorg_jenisorganisasi_id');
        $data['pegawaiorg_jenisorganisasi_nama'] = $this->ref_jenis_organisasi->get_row($data['pegawaiorg_jenisorganisasi_id'])->jenis_organisasi_nama;
        $data['pegawaiorg_organisasi'] = $this->input->post('pegawaiorg_organisasi');
        $data['pegawaiorg_jabatan'] = $this->input->post('pegawaiorg_jabatan');
        $data['pegawaiorg_mulai'] = y_m_d($this->input->post('pegawaiorg_mulai'));
        $data['pegawaiorg_selesai'] = y_m_d($this->input->post('pegawaiorg_selesai'));
        $data['pegawaiorg_alamat'] = $this->input->post('pegawaiorg_alamat');
        $data['pegawaiorg_no_anggota'] = $this->input->post('pegawaiorg_no_anggota');
        $data['pegawaiorg_tgl_masuk'] = $this->input->post('pegawaiorg_tgl_masuk');

        $insert = $this->m_pegawai_organisasi->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Organisasi Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Organisasi Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiOrganisasi/view/' . $data['pegawaiorg_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaiorg_id');
        $nip = $this->input->post('nip');
        $data['pegawaiorg_jenisorganisasi_id'] = $this->input->post('pegawaiorg_jenisorganisasi_id');
        $data['pegawaiorg_jenisorganisasi_nama'] = $this->ref_jenis_organisasi->get_row($data['pegawaiorg_jenisorganisasi_id'])->jenis_organisasi_nama;
        $data['pegawaiorg_organisasi'] = $this->input->post('pegawaiorg_organisasi');
        $data['pegawaiorg_jabatan'] = $this->input->post('pegawaiorg_jabatan');
        $data['pegawaiorg_mulai'] = y_m_d($this->input->post('pegawaiorg_mulai'));
        $data['pegawaiorg_selesai'] = y_m_d($this->input->post('pegawaiorg_selesai'));
        $data['pegawaiorg_alamat'] = $this->input->post('pegawaiorg_alamat');
        $data['pegawaiorg_no_anggota'] = $this->input->post('pegawaiorg_no_anggota');
        $data['pegawaiorg_tgl_masuk'] = $this->input->post('pegawaiorg_tgl_masuk');

        $insert = $this->m_pegawai_organisasi->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Organisasi Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Organisasi Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiOrganisasi/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_organisasi->get_row($id)->pegawaiorg_pegawai_nip;
        $delete = $this->m_pegawai_organisasi->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Organisasi Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Organisasi Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiOrganisasi/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

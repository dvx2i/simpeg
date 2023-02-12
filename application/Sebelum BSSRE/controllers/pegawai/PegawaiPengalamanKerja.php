<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatPengalaman Kerja
 *
 * @author Zanuar
 */
class PegawaiPengalamanKerja extends MY_Controller {

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_pengalaman_kerja'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index() {
        
    }

    function view($nip) {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_pengalaman_kerja->get_where(array('pegawaikerja_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $this->loadView('pegawai/pegawai_riwayat_pengalaman_kerja', $data);
    }

    function add() {
        $data['pegawaikerja_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaikerja_nama'] = $this->input->post('pegawaikerja_nama');
        $data['pegawaikerja_jabatan'] = $this->input->post('pegawaikerja_jabatan');
        $data['pegawaikerja_tahun'] = $this->input->post('pegawaikerja_tahun');
        $data['pegawaikerja_bulan'] = $this->input->post('pegawaikerja_bulan');

        $insert = $this->m_pegawai_pengalaman_kerja->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Pengalaman Kerja Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Pengalaman Kerja Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiPengalamanKerja/view/' . $data['pegawaikerja_pegawai_nip'] . '#riwayat');
    }

    function update() {
        $id = $this->input->post('pegawaikerja_id');
        $nip = $this->input->post('nip');
        $data['pegawaikerja_nama'] = $this->input->post('pegawaikerja_nama');
        $data['pegawaikerja_jabatan'] = $this->input->post('pegawaikerja_jabatan');
        $data['pegawaikerja_tahun'] = $this->input->post('pegawaikerja_tahun');
        $data['pegawaikerja_bulan'] = $this->input->post('pegawaikerja_bulan');

        $insert = $this->m_pegawai_pengalaman_kerja->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Pengalaman Kerja Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Pengalaman Kerja Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiPengalamanKerja/view/' . $nip . '#riwayat');
    }

    function delete($id) {
        $nip = $this->m_pegawai_pengalaman_kerja->get_row($id)->pegawaikerja_pegawai_nip;
        $delete = $this->m_pegawai_pengalaman_kerja->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Pengalaman Kerja Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Pengalaman Kerja Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiPengalamanKerja/view/' . $nip . '#riwayat');
        echo $nip;
    }

}

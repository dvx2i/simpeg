<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiKaryaTulis
 *
 * @author Zanuar
 */
class PegawaiKaryaTulis extends MY_Controller {

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_karya_tulis'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index() {
        
    }

    function view($nip) {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_karya_tulis->get_where(array('pegawaikaryatulis_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $this->loadView('pegawai/pegawai_riwayat_karya_tulis', $data);
    }

    function add() {
        $data['pegawaikaryatulis_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaikaryatulis_judul'] = $this->input->post('pegawaikaryatulis_judul');
        $data['pegawaikaryatulis_tahun'] = $this->input->post('pegawaikaryatulis_tahun');
        $data['pegawaikaryatulis_keterangan'] = $this->input->post('pegawaikaryatulis_keterangan');

        $insert = $this->m_pegawai_karya_tulis->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Karya Tulis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Karya Tulis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKaryaTulis/view/' . $data['pegawaikaryatulis_pegawai_nip'] . '#riwayat');
    }

    function update() {
        $id = $this->input->post('pegawaikaryatulis_id');
        $nip = $this->input->post('nip');
        $data['pegawaikaryatulis_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaikaryatulis_judul'] = $this->input->post('pegawaikaryatulis_judul');
        $data['pegawaikaryatulis_tahun'] = $this->input->post('pegawaikaryatulis_tahun');
        $data['pegawaikaryatulis_keterangan'] = $this->input->post('pegawaikaryatulis_keterangan');

        $insert = $this->m_pegawai_karya_tulis->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Karya Tulis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Karya Tulis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKaryaTulis/view/' . $nip . '#riwayat');
    }

    function delete($id) {
        $nip = $this->m_pegawai_karya_tulis->get_row($id)->pegawaikaryatulis_pegawai_nip;
        $delete = $this->m_pegawai_karya_tulis->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Karya Tulis Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Karya Tulis Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKaryaTulis/view/' . $nip . '#riwayat');
        echo $nip;
    }

}

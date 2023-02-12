<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatTandaJasa
 *
 * @author Zanuar
 */
class PegawaiTandaJasa extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_tanda_jasa'));
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
        $data['result'] = $this->m_pegawai_tanda_jasa->get_where(array('pegawaijasa_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $this->loadView('pegawai/pegawai_riwayat_tanda_jasa', $data);
    }

    function add()
    {
        $data['pegawaijasa_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaijasa_tahun'] = $this->input->post('pegawaijasa_tahun');
        $data['pegawaijasa_nama'] = $this->input->post('pegawaijasa_nama');
        $data['pegawaijasa_asal'] = $this->input->post('pegawaijasa_asal');
        $data['pegawaijasa_nomor'] = $this->input->post('pegawaijasa_nomor');
        $data['pegawaijasa_tanggal'] = y_m_d($this->input->post('pegawaijasa_tanggal'));

        $insert = $this->m_pegawai_tanda_jasa->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Tanda Jasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Tanda Jasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTandaJasa/view/' . $data['pegawaijasa_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaijasa_id');
        $nip = $this->input->post('nip');
        $data['pegawaijasa_tahun'] = $this->input->post('pegawaijasa_tahun');
        $data['pegawaijasa_nama'] = $this->input->post('pegawaijasa_nama');
        $data['pegawaijasa_asal'] = $this->input->post('pegawaijasa_asal');
        $data['pegawaijasa_nomor'] = $this->input->post('pegawaijasa_nomor');
        $data['pegawaijasa_tanggal'] = y_m_d($this->input->post('pegawaijasa_tanggal'));

        $insert = $this->m_pegawai_tanda_jasa->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Tanda Jasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Tanda Jasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTandaJasa/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_tanda_jasa->get_row($id)->pegawaijasa_pegawai_nip;
        $delete = $this->m_pegawai_tanda_jasa->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Tanda Jasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Tanda Jasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTandaJasa/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

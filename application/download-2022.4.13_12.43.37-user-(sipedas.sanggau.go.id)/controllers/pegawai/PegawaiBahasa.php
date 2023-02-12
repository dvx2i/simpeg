<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatBahasa
 *
 * @author Zanuar
 */
class PegawaiBahasa extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_bahasa', 'ref_kemampuan_bicara'));
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
        $data['kemampuan_bicara'] = $this->ref_kemampuan_bicara->get_all();
        $data['result'] = $this->m_pegawai_bahasa->get_where(array('pegawaibahasa_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $this->loadView('pegawai/pegawai_bahasa', $data);
    }

    function add()
    {
        $data['pegawaibahasa_pegawai_nip'] = $this->input->post('nip');
        // $data['pegawaibahasa_bahasa_id'] = $this->input->post('pegawaibahasa_bahasa_id');
        $data['pegawaibahasa_bahasa_nama'] = $this->ref_kemampuan_bicara->get_row($this->input->post('pegawaibahasa_bahasa_id'))->kemampuanbicara_nama;
        $data['pegawaibahasa_status'] = $this->input->post('pegawaibahasa_status');

        $insert = $this->m_pegawai_bahasa->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Bahasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Bahasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiBahasa/view/' . $data['pegawaibahasa_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaibahasa_id');
        $nip = $this->input->post('nip');
        $data['pegawaibahasa_pegawai_nip'] = $this->input->post('nip');
        // $data['pegawaibahasa_bahasa_id'] = $this->input->post('pegawaibahasa_bahasa_id');
        $data['pegawaibahasa_bahasa_nama'] = $this->ref_kemampuan_bicara->get_row($this->input->post('pegawaibahasa_bahasa_id'))->kemampuanbicara_nama;
        $data['pegawaibahasa_status'] = $this->input->post('pegawaibahasa_status');

        $insert = $this->m_pegawai_bahasa->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Bahasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Bahasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiBahasa/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_bahasa->get_row($id)->pegawaibahasa_pegawai_nip;
        $delete = $this->m_pegawai_bahasa->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Bahasa Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Bahasa Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiBahasa/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

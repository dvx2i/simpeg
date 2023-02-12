<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Zanuar
 */
class StatusPegawai extends MY_Controller {

    var $page = "referensi/status_pegawai";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_status_pegawai');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_status_pegawai->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['status_pegawai_nama'] = $this->input->post('nama');
        $update = $this->ref_status_pegawai->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect('referensi/StatusPegawai');
    }

    public function add() {
        $data['status_pegawai_nama'] = $this->input->post('nama');
        $simpan = $this->ref_status_pegawai->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect('referensi/StatusPegawai');
    }

    public function delete($id) {
        $simpan = $this->ref_status_pegawai->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect('referensi/StatusPegawai');
    }

}

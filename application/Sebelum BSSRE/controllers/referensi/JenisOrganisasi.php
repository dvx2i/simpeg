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
class JenisOrganisasi extends MY_Controller {

    var $page = "referensi/JenisOrganisasi";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_jenis_organisasi');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_jenis_organisasi->get_all();
        $this->loadView('referensi/jenis_organisasi', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['jenis_organisasi_nama'] = $this->input->post('nama');
        $update = $this->ref_jenis_organisasi->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['jenis_organisasi_nama'] = $this->input->post('nama');
        $simpan = $this->ref_jenis_organisasi->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_jenis_organisasi->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

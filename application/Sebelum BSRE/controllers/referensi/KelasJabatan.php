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
class KelasJabatan extends MY_Controller {

    var $page = "referensi/kelas_jabatan";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_kelas_jabatan');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_kelas_jabatan->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['kelas_nama'] = $this->input->post('nama');
        $update = $this->ref_kelas_jabatan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect('referensi/KelasJabatan');
    }

    public function add() {
        $data['kelas_nama'] = $this->input->post('nama');
        $simpan = $this->ref_kelas_jabatan->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect('referensi/KelasJabatan');
    }

    public function delete($id) {
        $simpan = $this->ref_kelas_jabatan->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect('referensi/KelasJabatan');
    }

}

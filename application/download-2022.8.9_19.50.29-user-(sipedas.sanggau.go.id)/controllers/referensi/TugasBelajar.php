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
class TugasBelajar extends MY_Controller {

    var $page = "referensi/TugasBelajar";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_tugas_belajar');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_tugas_belajar->get_all();
        $this->loadView('referensi/tugas_belajar', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['tugas_belajar_nama'] = $this->input->post('nama');
        $update = $this->ref_tugas_belajar->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['tugas_belajar_nama'] = $this->input->post('nama');
        $simpan = $this->ref_tugas_belajar->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_tugas_belajar->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

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
class Agama extends MY_Controller {

    var $page = "referensi/agama";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_agama');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_agama->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['agama_nama'] = $this->input->post('nama');
        $update = $this->ref_agama->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            alert_set('danger', "Update Gagal");
        }
        redirect($this->page);
    }

    public function add() {
        $data['agama_nama'] = $this->input->post('nama');
        $simpan = $this->ref_agama->insert($data);
        if (!empty($simpan)) {
            alert_set('success', "Tambah Berhasil");
        } else {
            alert_set('danger', "Tambah Gagal");
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_agama->delete($id);
        if (!empty($simpan)) {
            alert_set('success', "Hapus Berhasil");
        } else {
            alert_set('danger', "Hapus Gagal");
        }
        redirect($this->page);
    }

}

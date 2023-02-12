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
class KemampuanBicara extends MY_Controller {

    var $page = "referensi/kemampuan_bicara";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_kemampuan_bicara');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_kemampuan_bicara->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['kemampuan_bicara_nama'] = $this->input->post('nama');
        $update = $this->ref_kemampuan_bicara->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['kemampuan_bicara_nama'] = $this->input->post('nama');
        $simpan = $this->ref_kemampuan_bicara->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_kemampuan_bicara->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

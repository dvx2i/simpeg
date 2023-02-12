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
class TingkatHukuman extends MY_Controller {

    var $page = "referensi/TingkatHukuman";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_tingkat_hukuman');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_tingkat_hukuman->get_all();
        $this->loadView('referensi/tingkat_hukuman', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['tingkat_hukuman_nama'] = $this->input->post('nama');
        $update = $this->ref_tingkat_hukuman->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['tingkat_hukuman_nama'] = $this->input->post('nama');
        $simpan = $this->ref_tingkat_hukuman->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_tingkat_hukuman->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

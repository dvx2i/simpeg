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
class Kabupaten extends MY_Controller {

    var $page = "referensi/Kabupaten";

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_kabupaten','ref_propinsi'));
    }

    //put your code here

    public function index($propinsi_id=NULL) {
        $data['propinsi_id'] = $propinsi_id;
        $data['propinsi'] = $this->ref_propinsi->get_all();
        $data['result'] = $this->ref_kabupaten->get_where(array('kabupaten_propinsi_id' => $propinsi_id));
        $this->loadView('referensi/kabupaten', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['kabupaten_nama'] = $this->input->post('nama');
        $update = $this->ref_kabupaten->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['kabupaten_propinsi_id'] = $this->input->post('propinsi');
        $data['kabupaten_nama'] = $this->input->post('nama');
        $simpan = $this->ref_kabupaten->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_kabupaten->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

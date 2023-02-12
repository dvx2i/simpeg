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
class Kecamatan extends MY_Controller {

    var $page = "referensi/Kecamatan";

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_kabupaten','ref_propinsi'));
        $this->load->model('ref_kecamatan');
    }

    //put your code here

    public function index($propinsi_id=NULL,$kabupaten_id=NULL) {
        $data['propinsi_id'] = $propinsi_id;
        $data['propinsi'] = $this->ref_propinsi->get_all();
        $data['kabupaten_id'] = $kabupaten_id;
        $data['kabupaten'] = $this->ref_kabupaten->get_where(array('kabupaten_propinsi_id' => $propinsi_id));
        $data['result'] = $this->ref_kecamatan->get_where(array('kecamatan_kabupaten_id' => $kabupaten_id));
        $this->loadView('referensi/kecamatan', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['kecamatan_nama'] = $this->input->post('nama');
        $update = $this->ref_kecamatan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['kecamatan_kabupaten_id'] = $this->input->post('kabupaten');
        $data['kecamatan_nama'] = $this->input->post('nama');
        $simpan = $this->ref_kecamatan->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_kecamatan->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

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
class Kelurahan extends MY_Controller {

    var $page = "referensi/Kelurahan";

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_kelurahan','ref_kecamatan','ref_kabupaten','ref_propinsi'));
    }

    //put your code here

    public function index($propinsi_id=NULL,$kabupaten_id=NULL,$kecamatan_id=NULL) {
        $data['propinsi_id'] = $propinsi_id;
        $data['propinsi'] = $this->ref_propinsi->get_all();
        $data['kabupaten_id'] = $kabupaten_id;
        $data['kabupaten'] = $this->ref_kabupaten->get_where(array('kabupaten_propinsi_id' => $propinsi_id));
        $data['kecamatan_id'] = $kecamatan_id;
        $data['kecamatan'] = $this->ref_kecamatan->get_where(array('kecamatan_kabupaten_id' => $kabupaten_id));
        $data['result'] = $this->ref_kelurahan->get_where(array('kelurahan_kecamatan_id' => $kecamatan_id));
        $this->loadView('referensi/kelurahan', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['kelurahan_nama'] = $this->input->post('nama');
        $update = $this->ref_kelurahan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['kelurahan_nama'] = $this->input->post('nama');
        $simpan = $this->ref_kelurahan->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_kelurahan->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

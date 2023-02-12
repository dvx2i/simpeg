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
class JabatanStruktural extends MY_Controller {

    var $page = "referensi/JabatanStruktural";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_jabatan_struktural');
        $this->load->model(array('ref_unit','ref_eselon'));
    }

    //put your code here

    public function index() {
        $data['unit'] = $this->ref_unit->get_unit();
        $data['eselon'] = $this->ref_eselon->get_all();
        $data['result'] = $this->ref_jabatan_struktural->get_all();
        $this->loadView('referensi/jabatan_struktural', $data);
    }

    public function update() {
        
        $id = $this->input->post('jabatan_id');
        $data['jabatan_nama'] = $this->input->post('jabatan_nama');
        $data['jabatan_kode'] = '0000';
        $data['jabatan_eselon_kode'] = !empty($this->input->post('jabatan_eselon_kode')) ? $this->input->post('jabatan_eselon_kode') : 0;
        $data['jabatan_eselon_nama'] = !empty($this->input->post('jabatan_eselon_kode')) ? $this->ref_eselon->get_row($this->input->post('jabatan_eselon_kode'))->eselon_nama : '';
        $data['jabatan_unit_kode'] = !empty($this->input->post('jabatan_unit_kode')) ? $this->input->post('jabatan_unit_kode') : 0;
        $data['jabatan_unit_nama'] = !empty($this->input->post('jabatan_unit_kode')) ? $this->ref_unit->get_row($this->input->post('jabatan_unit_kode'))->unit_nama : '';
    // print_r($data); die;
        $update = $this->ref_jabatan_struktural->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $data['jabatan_nama'] = $this->input->post('jabatan_nama');
        $data['jabatan_kode'] = '0000';
        $data['jabatan_eselon_kode'] = !empty($this->input->post('jabatan_eselon_kode')) ? $this->input->post('jabatan_eselon_kode') : 0;
        $data['jabatan_eselon_nama'] = !empty($this->input->post('jabatan_eselon_kode')) ? $this->ref_eselon->get_row($this->input->post('jabatan_eselon_kode'))->eselon_nama : '';
        $data['jabatan_unit_kode'] = !empty($this->input->post('jabatan_unit_kode')) ? $this->input->post('jabatan_unit_kode') : 0;
        $data['jabatan_unit_nama'] = !empty($this->input->post('jabatan_unit_kode')) ? $this->ref_unit->get_row($this->input->post('jabatan_unit_kode'))->unit_nama : '';
        
        
        $simpan = $this->ref_jabatan_struktural->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_jabatan_struktural->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

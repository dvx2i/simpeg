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
class Eselon extends MY_Controller {

    var $page = "referensi/eselon";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_eselon');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_eselon->get_all();
        $this->load->model(array('ref_pangkat_golongan'));
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $this->load->model('ref_pangkat_golongan');
        $id = $this->input->post('kode');
        $data['eselon_nama'] = $this->input->post('nama');
        $data['eselon_pangkat_golongan_awal'] = $this->input->post('eselon_pangkat_golongan_awal');
        $data['eselon_pangkat_golongan_awal_nama'] = $this->ref_pangkat_golongan->get_data('pangkat_golongan_kode',$data['eselon_pangkat_golongan_awal'],'pangkat_golongan_nama');
        $data['eselon_pangkat_golongan_akhir'] = $this->input->post('eselon_pangkat_golongan_akhir');
        $data['eselon_pangkat_golongan_akhir_nama'] = $this->ref_pangkat_golongan->get_data('pangkat_golongan_kode',$data['eselon_pangkat_golongan_akhir'],'pangkat_golongan_nama');
        $data['eselon_tunjangan'] = $this->input->post('eselon_tunjangan');
        $data['eselon_usia_pensiun'] = $this->input->post('eselon_usia_pensiun');
        $update = $this->ref_eselon->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add() {
        $this->load->model('ref_pangkat_golongan');
        $data['eselon_kode'] = $this->input->post('kode');
        $data['eselon_nama'] = $this->input->post('nama');
        $data['eselon_pangkat_golongan_awal'] = $this->input->post('eselon_pangkat_golongan_awal');
        $data['eselon_pangkat_golongan_awal_nama'] = $this->ref_pangkat_golongan->get_data('pangkat_golongan_kode',$data['eselon_pangkat_golongan_awal'],'pangkat_golongan_nama');
        $data['eselon_pangkat_golongan_akhir'] = $this->input->post('eselon_pangkat_golongan_akhir');
        $data['eselon_pangkat_golongan_akhir_nama'] = $this->ref_pangkat_golongan->get_data('pangkat_golongan_kode',$data['eselon_pangkat_golongan_akhir'],'pangkat_golongan_nama');
        $data['eselon_tunjangan'] = $this->input->post('eselon_tunjangan');
        $data['eselon_usia_pensiun'] = $this->input->post('eselon_usia_pensiun');
        $simpan = $this->ref_eselon->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->ref_eselon->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }

}

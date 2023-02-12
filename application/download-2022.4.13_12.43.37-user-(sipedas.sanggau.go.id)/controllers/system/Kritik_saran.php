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
class Kritik_saran extends MY_Controller {

    var $page = "system/kritik_saran";

    public function __construct() {
        parent::__construct();
        $this->load->model('sys_kritik_saran');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->sys_kritik_saran->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['agama_nama'] = $this->input->post('nama');
        $update = $this->sys_kritik_saran->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            alert_set('danger', "Update Gagal");
        }
        redirect($this->page);
    }

    public function add() {
        $data['agama_nama'] = $this->input->post('nama');
        $simpan = $this->sys_kritik_saran->insert($data);
        if (!empty($simpan)) {
            alert_set('success', "Tambah Berhasil");
        } else {
            alert_set('danger', "Tambah Gagal");
        }
        redirect($this->page);
    }

    public function delete($id) {
        $simpan = $this->sys_kritik_saran->delete($id);
        if (!empty($simpan)) {
            alert_set('success', "Hapus Berhasil");
        } else {
            alert_set('danger', "Hapus Gagal");
        }
        redirect($this->page);
    }

}

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
class Unit extends MY_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('ref_unit');
        $this->ref_unit->_set_table('ref_unit');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_unit->get_unit();
        $data['unit_induk'] = $this->ref_unit->get_where(array('unit_induk' => '1'));
        $this->loadView('referensi/unit', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['unit_nama'] = $this->input->post('nama');
        $data['unit_parent_id'] = !empty($this->input->post('unit_parent_id')) ? $this->input->post('unit_parent_id') : NULL;
        $data['unit_perda_no'] = $this->input->post('unit_perda_no');
        $data['unit_perda_tanggal'] = y_m_d($this->input->post('unit_perda_tanggal'));
        $data['unit_perda_dari'] = $this->input->post('unit_perda_dari');
        $data['unit_kpok'] = !empty($this->input->post('unit_kpok')) ? $this->input->post('unit_kpok') : $data['unit_parent_id'];
        $data['unit_eselon'] = !empty($this->input->post('unit_eselon')) ? $this->input->post('unit_eselon') : 99;
        $data['unit_is_unit_kerja'] = $this->input->post('unit_is_unit_kerja');
        $update = $this->ref_unit->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect('referensi/Unit');
    }

    public function add() {
        $data['unit_nama'] = $this->input->post('nama');
        $data['unit_parent_id'] = !empty($this->input->post('unit_parent_id')) ? $this->input->post('unit_parent_id') : NULL;
        $data['unit_perda_no'] = $this->input->post('unit_perda_no');
        $data['unit_perda_tanggal'] = y_m_d($this->input->post('unit_perda_tanggal'));
        $data['unit_perda_dari'] = $this->input->post('unit_perda_dari');
        $data['unit_kpok'] = !empty($this->input->post('unit_kpok')) ? $this->input->post('unit_kpok') : $data['unit_parent_id'];
        $data['unit_eselon'] = !empty($this->input->post('unit_eselon')) ? $this->input->post('unit_eselon') : 99;
        $data['unit_induk'] = '';
        $data['unit_is_unit_kerja'] =  $this->input->post('unit_is_unit_kerja');
        $data['create_by'] = $this->session->userdata('user_id');
        $data['create_at'] = date('Y-m-d h:i:s');
        $simpan = $this->ref_unit->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect('referensi/Unit');
    }

    public function delete($id) {
        $simpan = $this->ref_unit->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect('referensi/Unit');
    }

}

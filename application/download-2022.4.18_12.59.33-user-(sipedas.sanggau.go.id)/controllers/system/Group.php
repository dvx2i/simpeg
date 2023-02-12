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
class Group extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('sys_group','ref_unit','sys_group_detail','m_system'));
    }

    //put your code here

    public function index() {
        $data['group'] = $this->sys_group->get_all();
        $data['unit'] = $this->ref_unit->get_all();
        $this->loadView('system/group', $data);
    }
    
    public function detail($id_group) {
        $data['group'] = $this->sys_group->get_row($id_group);
        $data['menu'] = $this->db->query("select * from v_menu");
        $data['unit'] = $this->ref_unit->get_all();
        $data['group_detail'] = $this->db->query("SELECT GROUP_CONCAT(GroupDetailMenuActionId) AS aksi FROM sys_group_detail WHERE GroupDetailGroupId = '".$data['group']->GroupId."'")->row()->aksi;
        $data['detail'] = explode(",", $data['group_detail']);
        $this->loadView('system/group_detail', $data);
    }

    public function update() {
        $id_group = $this->input->post('id');
        $data['GroupName'] = $this->input->post('nama');
        $data['GroupDescription'] = $this->input->post('deskripsi');
		//print_r($data);exit;
        $update = $this->sys_group->update($data,$id_group);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Group Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Group Gagal"));
        }
        redirect('system/Group');
    }

    public function update_save($id_group) {
        $data['GroupIsAdmin'] = $this->input->post('admin');
        $data['GroupName'] = $this->input->post('nama');
        $data['GroupDescription'] = $this->input->post('deskripsi');
        $data['GroupUnitId'] = $this->input->post('unit');
        $update = $this->sys_group->update($data,$id_group);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Group Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Group Gagal"));
        }
        redirect('system/Group');
    }
    public function save($id_group) {
        $aksi = $this->input->post('aksi');
        $this->db->query("DELETE FROM sys_group_detail WHERE GroupDetailGroupId = '$id_group' ");
        foreach ($aksi as $value) {
            $data['GroupDetailGroupId'] = $id_group;
            $data['GroupDetailMenuActionId'] = $value;
            $this->sys_group_detail->insert($data);
        }
        $this->session->set_flashdata('message', alert_show('success', "Update Hak Akses Berhasil"));
        redirect('system/Group');
    }
    
    public function add2() {
        
        $data['unit'] = $this->ref_unit->get_all();
        
        $this->loadView('system/group_add', $data);
    }
    
    public function add() {
        $data['GroupIsAdmin'] = $this->input->post('admin');
        $data['GroupName'] = $this->input->post('nama');
        $data['GroupDescription'] = $this->input->post('deskripsi');
        $data['GroupUnitId'] = $this->input->post('unit');
        $simpan = $this->m_system->groupInsert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Group Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Group Gagal"));
        }
        redirect('system/Group');
    }

    public function delete($id_group) {
        $simpan = $this->sys_group->delete($id_group);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Group Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Group Gagal"));
        }
        redirect('system/Group');
    }

}

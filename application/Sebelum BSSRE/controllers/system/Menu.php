<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Zanuar
 */
class Menu extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model(array('sys_menu','ref_unit'));
    }
    //put your code here
    public function index() {
        $data['result'] = $this->sys_menu->get_where(array('MenuIsShow' => '1'));
        $this->loadView('system/menu', $data);
    }
    
    public function add() {
        $data['MenuName'] = $this->input->post('nama'); 
        $data['MenuParentId'] = $this->input->post('parent');
        $data['MenuModule'] = $this->input->post('modul');
        $insert = $this->sys_menu->insert($data);        
        if (!blank($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Menu Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Menu Gagal"));
        }
        redirect('system/Menu');
    }
    public function update() {
        $data['MenuName'] = $this->input->post('nama'); 
        $data['MenuParentId'] = $this->input->post('parent');
        $data['MenuModule'] = $this->input->post('modul');
        $insert = $this->sys_menu->update($data, $this->input->post('id'));        
        if (!blank($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Menu Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Menu Gagal"));
        }
        redirect('system/Menu');
    }
    
    public function delete($id_menu) {
        $delete = $this->sys_menu->delete($id_menu);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Menu Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Menu Gagal"));
        }
        redirect('system/Menu');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Zanuar
 */
class Profil extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_user'));
    }
    function index() {
        $this->loadView('akun/profil');
    }
    function update() {
        $id = $this->input->post('kode'); 
	$data['user_nama_lengkap'] = $this->input->post('nama_lengkap'); 
//	$data['user_name'] = $this->input->post('username'); 
        if(!empty($this->input->post('password'))){
            $data['user_password'] = sha1($this->input->post('password'));
        }	
        $update = $this->m_user->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect('user/Profil');
    }
}

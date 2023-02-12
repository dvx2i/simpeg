<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Akun
 *
 * @author Zanuar
 */
class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_system'));
    }

    //put your code here
    public function index() {
        $this->loadView('progress');
//        $data['user'] = $this->m_system->getUserById($this->session->userdata('id'));
//        $data['group'] = $this->m_system->getGroupByIdUser($this->session->userdata('id'));
//        $data['unit'] = $this->m_system->getUnitById($data['user']->UserUnitId);
//        $this->loadView('system/profil', $data);
    }

    public function upload_photo() {
        $config['upload_path'] = 'assets/photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            //$error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', alert_show('danger', $this->upload->display_errors() . $config['upload_path']));
            redirect(site_url('system/Profile'));
        } else {
            $datom = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
            $image = $datom['upload_data']['file_name']; //set file name ke variable image
//                        $data = array('upload_data' => $this->upload->data());
            $data['UserFoto'] = $image;
            $this->m_system->userUpdate($this->session->userdata('id'), $data);
            redirect(site_url('system/Profile'));
        }
    }

    public function update_password() {
        $passlama = $this->input->post('passlama');
        $passbaru = $this->input->post('passbaru');
        
        if (md5($passlama) == $this->session->userdata('pass')) {

//            }
//            if(!empty($q=$this->m_system->getUserByUsernamePassword($this->session->userdata('username'),$passlama)->username)){
            $data['UserPassword'] = sha1($passbaru);
            if ($this->m_system->userUpdate($this->session->userdata('id'), $data)) {
                $a = $this->m_system->getUserByUsernamePassword($this->session->userdata('username'), $passlama);
                    
                if ($a->num_rows() > 0) {
                    $login = $a->row();
                    $newdata = array(
                        'username' => $login->UserName,
                        'id' => $login->UserId,
                        'nama' => $login->UserRealName,
                        'pass' => $login->UserPassword,
                        'group' => $login->UserGroupGroupId,
                        'unit' => $login->UserUnitId,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($newdata);
//                
                }
                $this->session->set_flashdata('message', alert_show('success', 'Password berhasil diperbaharui'));
            } else {
                $this->session->set_flashdata('message', alert_show('danger', 'gagal mengubah password'));
            }
        } else {
            $this->session->set_flashdata('message', alert_show('danger', 'Password lama yang anda isikan tidak benar' . $passlama ));
        }
        redirect(site_url('system/Profile'));
    }

    public function update() {
        $data['UserRealName'] = $this->input->post('real_name');
        $this->session->set_userdata('nama', $data['UserRealName']);
        if ($this->m_system->userUpdate($this->session->userdata('id'), $data)) {
            $this->session->set_flashdata('message', alert_show('success', 'Data berhasil diperbaharui'));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', 'gagal mengubah data'));
        }
        redirect(site_url('system/Profile'));
    }

}

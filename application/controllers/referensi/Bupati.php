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
class Bupati extends MY_Controller {

    var $page = "referensi/bupati";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_bupati');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_bupati->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['bupati_nama'] = $this->input->post('bupati_nama');
        $data['bupati_no_ktp'] = $this->input->post('bupati_no_ktp');
        $data['bupati_no_hp'] = $this->input->post('bupati_no_hp');
        if ($_FILES['bupati_image']["name"] != NULL) {
            $data['bupati_image'] = $this->upload('bupati_image');
        }
        $data['wabupati_nama'] = $this->input->post('wabupati_nama');
        $data['wabupati_no_ktp'] = $this->input->post('wabupati_no_ktp');
        $data['wabupati_no_hp'] = $this->input->post('wabupati_no_hp');
        if ($_FILES['wabupati_image']["name"] != NULL) {
            $data['wabupati_image'] = $this->upload('wabupati_image');
        }
        $update = $this->ref_bupati->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            alert_set('danger', "Update Gagal");
        }
        redirect('referensi/Bupati');
    }

    private function upload($file)
    {
        $dir = "assets/images";
        $config['upload_path']    = $dir;
        $config['allowed_types']  = 'jpg|jpeg|png|pdf';
        $config['overwrite']      = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['max_size']     = 2084;
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $filename = basename($file, '.' . $ext);
        // $config['encrypt_name'] = TRUE;
        // die($config['file_name']);

        // print_r($_FILES["contoh"]["name"]); die;
        $config['file_name'] = $_FILES[$file]["name"];

        if ($_FILES[$file]["name"] != NULL) {
            $this->load->library('upload');

            $this->upload->initialize($config);

            $fieldname = $file;

            if ($this->upload->do_upload($fieldname)) {

                $upload = array();
                $upload = $this->upload->data();

                return $upload['file_name'];

            } else {
                alert_set('danger', "Upload File Gagal");
                redirect('referensi/Bupati');
            }
        }else {
            return NULL;
        }
    }

}

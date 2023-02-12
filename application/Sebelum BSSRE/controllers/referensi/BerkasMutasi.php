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
class BerkasMutasi extends MY_Controller {

    var $page = "referensi/berkas_mutasi";

    public function __construct() {
        parent::__construct();
        $this->load->model('ref_berkas_mutasi');
    }

    //put your code here

    public function index() {
        $data['result'] = $this->ref_berkas_mutasi->get_all();
        $this->loadView($this->page, $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data['berkas_nama'] = $this->input->post('nama');
        $data['berkas_jenis_mutasi_id'] = $this->input->post('jenis_mutasi');
        $data['berkas_urut'] = $this->input->post('urut');
        $data['berkas_contoh'] = $this->upload($data['berkas_nama']);
        $update = $this->ref_berkas_mutasi->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            alert_set('danger', "Update Gagal");
        }
        redirect('referensi/BerkasMutasi');
    }

    public function add() {
        $data['berkas_nama'] = $this->input->post('nama');
        $data['berkas_urut'] = $this->input->post('urut');
        $data['berkas_jenis_mutasi_id'] = $this->input->post('jenis_mutasi');
        $data['berkas_contoh'] = $this->upload($data['berkas_nama']);
        $simpan = $this->ref_berkas_mutasi->insert($data);
        if (!empty($simpan)) {
            alert_set('success', "Tambah Berhasil");
        } else {
            alert_set('danger', "Tambah Gagal");
        }
        redirect('referensi/BerkasMutasi');
    }

    public function delete($id) {
        $simpan = $this->ref_berkas_mutasi->delete($id);
        if (!empty($simpan)) {
            alert_set('success', "Hapus Berhasil");
        } else {
            alert_set('danger', "Hapus Gagal");
        }
        redirect('referensi/BerkasMutasi');
    }

    private function upload($jenis)
    {
        $dir = "assets/files";
        $config['upload_path']    = $dir;
        $config['allowed_types']  = 'jpg|jpeg|png|pdf';
        $config['overwrite']      = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['max_size']     = 2084;
        $jenis = str_replace(' ', '_', $jenis);
        // $config['encrypt_name'] = TRUE;
        // die($config['file_name']);

        // print_r($_FILES["contoh"]["name"]); die;
        $config['file_name'] = $jenis.'_' . date('H_i_s');

        if ($_FILES["contoh"]["name"] != NULL) {
            $this->load->library('upload');

            $this->upload->initialize($config);

            $fieldname = "contoh";

            if ($this->upload->do_upload($fieldname)) {

                $upload = array();
                $upload = $this->upload->data();

                return $upload['file_name'];

            } else {
                alert_set('danger', "Upload File Gagal");
                redirect('referensi/BerkasMutasi');
            }
        }else {
            return NULL;
        }
    }

}

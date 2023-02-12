<?php

defined('BASEPATH') or exit('No direct script access allowed');
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
class Pangkat extends MY_Controller
{

    var $page = "referensi/Pangkat";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ref_pangkat_golongan');
    }

    //put your code here

    public function index()
    {
        $data['result'] = $this->ref_pangkat_golongan->get_pangkat_golongan();
        $this->loadView('referensi/pangkat_golongan', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data['pangkat_golongan_nama'] = $this->input->post('nama');
        $data['pangkat_golongan_pangkat'] = $this->input->post('pangkat');
        $update = $this->ref_pangkat_golongan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add()
    {
        $data['pangkat_golongan_nama'] = $this->input->post('nama');
        $data['pangkat_golongan_pangkat'] = $this->input->post('pangkat');
        $data['pangkat_golongan_jenis'] = '1';
        $data['pangkat_golongan_kode'] = '0';
        $data['pangkat_golongan_golongan'] = ' ';
        $data['pangkat_golongan_ruang'] = ' ';
        $data['pangkat_golongan_text'] = $data['pangkat_golongan_pangkat'] . '(' . $data['pangkat_golongan_nama'] . ')';
        $simpan = $this->ref_pangkat_golongan->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id)
    {
        $simpan = $this->ref_pangkat_golongan->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }
}

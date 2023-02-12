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
class Pendidikan extends MY_Controller
{

    var $page = "referensi/Pendidikan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ref_pendidikan');
        $this->load->model(array('ref_pangkat_golongan', 'ref_pendidikan_tingkat'));
    }

    //put your code here

    public function index()
    {
        $data['result'] = $this->ref_pendidikan->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $this->loadView('referensi/pendidikan', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data['pendidikan_nama'] = $this->input->post('pendidikan_nama');
        $data['pendidikan_tingkat_id'] = $this->input->post('pendidikan_tingkat_id');
        $data['pendidikan_kode'] = '00000';
        $data['pendidikan_golru_awal'] = $this->input->post('pendidikan_golru_awal');
        $data['pendidikan_golru_akhir'] = $this->input->post('pendidikan_golru_akhir');
        $data['pendidikan_status'] = '1';
        $data['update_user_id'] = $this->session->userdata('user_id');
        $data['update_time'] = date('Y-m-d h:i:s');
        $update = $this->ref_pendidikan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->page);
    }

    public function add()
    {
        $data['pendidikan_nama'] = $this->input->post('pendidikan_nama');
        $data['pendidikan_tingkat_id'] = $this->input->post('pendidikan_tingkat_id');
        $data['pendidikan_kode'] = '00000';
        $data['pendidikan_golru_awal'] = $this->input->post('pendidikan_golru_awal');
        $data['pendidikan_golru_akhir'] = $this->input->post('pendidikan_golru_akhir');
        $data['pendidikan_status'] = '1';
        $data['insert_user_id'] = $this->session->userdata('user_id');
        $data['insert_time'] = date('Y-m-d h:i:s');
        $simpan = $this->ref_pendidikan->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->page);
    }

    public function delete($id)
    {
        $simpan = $this->ref_pendidikan->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->page);
    }
}

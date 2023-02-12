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
class Gaji extends MY_Controller
{

    var $page = "referensi/gaji";
    var $redirect = "referensi/Gaji";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ref_gaji');
        $this->load->model(array('ref_pangkat_golongan', 'ref_pendidikan_tingkat'));
    }

    //put your code here

    public function index()
    {
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['result'] = $this->ref_gaji->get_gaji();
        $this->loadView($this->page, $data);
    }

    public function update()
    {
        $id = $this->input->post('gaji_id');
        $data['gaji_golru_kode'] = !empty($this->input->post('gaji_golru_kode')) ? $this->input->post('gaji_golru_kode') : 0;
        $data['gaji_pangkat_nama'] = !empty($this->input->post('gaji_golru_kode')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('gaji_golru_kode')))->row()->pangkat_golongan_nama : '';
        $data['gaji_masa_kerja'] = !empty($this->input->post('gaji_masa_kerja')) ? $this->input->post('gaji_masa_kerja') : 0;
        $data['gaji_jumlah'] = !empty($this->input->post('gaji_jumlah')) ? $this->input->post('gaji_jumlah') : 0;
        $data['gaji_terbilang'] = !empty($this->input->post('gaji_jumlah')) ? terbilang($this->input->post('gaji_jumlah')) : '';
        $data['gaji_status'] = 1;
        $data['update_user_id'] = $this->session->userdata('login')['user_id'];
        // print_r($data);
        // die;
        $update = $this->ref_gaji->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->redirect);
    }

    public function add()
    {
        $data['gaji_golru_kode'] = !empty($this->input->post('gaji_golru_kode')) ? $this->input->post('gaji_golru_kode') : 0;
        $data['gaji_pangkat_nama'] = !empty($this->input->post('gaji_golru_kode')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('gaji_golru_kode')))->row()->pangkat_golongan_nama : '';
        $data['gaji_masa_kerja'] = !empty($this->input->post('gaji_masa_kerja')) ? $this->input->post('gaji_masa_kerja') : 0;
        $data['gaji_jumlah'] = !empty($this->input->post('gaji_jumlah')) ? $this->input->post('gaji_jumlah') : 0;
        $data['gaji_terbilang'] = !empty($this->input->post('gaji_jumlah')) ? terbilang($this->input->post('gaji_jumlah')) : '';
        $data['gaji_status'] = 1;
        $data['insert_user_id'] = $this->session->userdata('login')['user_id'];

        $simpan = $this->ref_gaji->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->redirect);
    }

    public function delete($id)
    {
        $simpan = $this->ref_gaji->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->redirect);
    }
}

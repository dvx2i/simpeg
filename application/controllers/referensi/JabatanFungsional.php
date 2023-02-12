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
class JabatanFungsional extends MY_Controller
{

    var $page = "referensi/jabatan_fungsional";
    var $redirect = "referensi/JabatanFungsional";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ref_jabatan_fungsional');
        $this->load->model(array('ref_pangkat_golongan', 'ref_pendidikan_tingkat'));
    }

    //put your code here

    public function index($tes = null)
    {
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        // $data['result'] = $this->ref_jabatan_fungsional->get_jabatan('4');
        $data['result'] = $this->ref_jabatan_fungsional->get_jabatan_all();
    	// if($tes != null) {
    	// print_r($this->ref_jabatan_fungsional->get_jabatan_all()); die;
    	// }
        $this->loadView($this->page, $data);
    }

    public function update()
    {
        $id = $this->input->post('jabatan_id');
        $data['jabatan_nama'] = $this->input->post('jabatan_nama');
        $data['jabatan_kode'] = '0000';
        $data['jabatan_golru_awal'] = !empty($this->input->post('jabatan_golru_awal')) ? $this->input->post('jabatan_golru_awal') : 0;
        $data['jabatan_golru_awal_nama'] = !empty($this->input->post('jabatan_golru_awal')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('jabatan_golru_awal')))->row()->pangkat_golongan_nama : '';
        $data['jabatan_golru_akhir'] = !empty($this->input->post('jabatan_golru_akhir')) ? $this->input->post('jabatan_golru_akhir') : '';
        $data['jabatan_golru_akhir_nama'] = !empty($this->input->post('jabatan_golru_akhir')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('jabatan_golru_akhir')))->row()->pangkat_golongan_nama : '';
        $data['jabatan_usia_pensiun'] = !empty($this->input->post('jabatan_usia_pensiun')) ? $this->input->post('jabatan_usia_pensiun') : 0;
        $data['jabatan_pendidikan_kode'] = !empty($this->input->post('jabatan_pendidikan_kode')) ? $this->input->post('jabatan_pendidikan_kode') : 0;
        $data['jabatan_pendidikan_nama'] = !empty($this->input->post('jabatan_pendidikan_kode')) ? $this->ref_pendidikan_tingkat->get_where(array('pendidikan_tingkat_kode' => $this->input->post('jabatan_pendidikan_kode')))->row()->pendidikan_tingkat_nama : '';
        $data['jabatan_tunjangan'] = !empty($this->input->post('jabatan_tunjangan')) ? $this->input->post('jabatan_tunjangan') : 0;
        $data['jabatan_angka_kredit'] = !empty($this->input->post('jabatan_angka_kredit')) ? $this->input->post('jabatan_angka_kredit') : 0;
        // print_r($data);
        // die;
        $update = $this->ref_jabatan_fungsional->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
        }
        redirect($this->redirect);
    }

    public function add()
    {
        $data['jabatan_nama'] = $this->input->post('jabatan_nama');
        $data['jabatan_kode'] = '0000';
        $data['jabatan_golru_awal'] = !empty($this->input->post('jabatan_golru_awal')) ? $this->input->post('jabatan_golru_awal') : 0;
        $data['jabatan_golru_awal_nama'] = !empty($this->input->post('jabatan_golru_awal')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('jabatan_golru_awal')))->row()->pangkat_golongan_nama : '';
        $data['jabatan_golru_akhir'] = !empty($this->input->post('jabatan_golru_akhir')) ? $this->input->post('jabatan_golru_akhir') : '';
        $data['jabatan_golru_akhir_nama'] = !empty($this->input->post('jabatan_golru_akhir')) ? $this->ref_pangkat_golongan->get_where(array('pangkat_golongan_kode' => $this->input->post('jabatan_golru_akhir')))->row()->pangkat_golongan_nama : '';
        $data['jabatan_usia_pensiun'] = !empty($this->input->post('jabatan_usia_pensiun')) ? $this->input->post('jabatan_usia_pensiun') : 0;
        $data['jabatan_pendidikan_kode'] = !empty($this->input->post('jabatan_pendidikan_kode')) ? $this->input->post('jabatan_pendidikan_kode') : 0;
        $data['jabatan_pendidikan_nama'] = !empty($this->input->post('jabatan_pendidikan_kode')) ? $this->ref_pendidikan_tingkat->get_where(array('pendidikan_tingkat_kode' => $this->input->post('jabatan_pendidikan_kode')))->row()->pendidikan_tingkat_nama : '';
        $data['jabatan_tunjangan'] = !empty($this->input->post('jabatan_tunjangan')) ? $this->input->post('jabatan_tunjangan') : 0;
        $data['jabatan_angka_kredit'] = !empty($this->input->post('jabatan_angka_kredit')) ? $this->input->post('jabatan_angka_kredit') : 0;
        $simpan = $this->ref_jabatan_fungsional->insert($data);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Gagal"));
        }
        redirect($this->redirect);
    }

    public function delete($id)
    {
        $simpan = $this->ref_jabatan_fungsional->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Gagal"));
        }
        redirect($this->redirect);
    }
}

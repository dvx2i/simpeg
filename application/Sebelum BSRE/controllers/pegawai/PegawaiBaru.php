<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiBaru
 *
 * @author Zanuar
 */
class PegawaiBaru extends MY_Controller{
    var $page = "pegawai/PegawaiBaru";
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_jabatan_fungsional','ref_unit','ref_jenis_kelamin','ref_golongan_darah','ref_agama'
            ,'ref_status_perkawinan','ref_propinsi','ref_jabatan_struktural','ref_jabatan_kedudukan'
            ,'ref_status_kepegawaian','ref_status_pegawai','ref_pangkat_golongan','ref_kondisi_sumpah'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }
    
    function index() {
        $data['unit'] = $this->ref_unit->get_all();
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['golongan_darah'] = $this->ref_golongan_darah->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['propinsi'] = $this->ref_propinsi->get_all();
//        $data['jabatan_struktural'] = $this->ref_jabatan->get_all();
        $data['jabatan_kedudukan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['pegawai_status'] = $this->ref_status_pegawai->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['kondisi_sumpah'] = $this->ref_kondisi_sumpah->get_all();
        $this->loadView('pegawai/pegawai_add', $data);
    }
}

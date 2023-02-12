<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarKepangkatan
 *
 * @author Zanuar
 */
class DaftarJabatan extends MY_Controller {

    //put your code here
    

    public function __construct() {
        parent::__construct();
        $this->load->model(array(    'm_pegawai' ,'m_laporan'   ));
    }

    function index() {
        $data['result'] = $this->m_laporan->get_daftar_jabatan();
        $this->loadView('laporan/daftar_jabatan', $data);
    }
    
    function excel() {
        $data['result'] = $this->m_laporan->get_daftar_jabatan();
        $this->load->view('laporan/daftar_jabatan_excel', $data);
        
    }
}

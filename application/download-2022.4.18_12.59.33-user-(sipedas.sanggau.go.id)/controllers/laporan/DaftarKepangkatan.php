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
class DaftarKepangkatan extends MY_Controller {

    //put your code here
    

    public function __construct() {
        parent::__construct();
        $this->load->model(array(    'm_pegawai'    ));
    }

    function index() {
        $this->m_pegawai->_set_table('v_pangkat_jenkel');
        $data['result'] = $this->m_pegawai->get_all();
        $this->loadView('laporan/daftar_kepangkatan', $data);
    }
    
    function excel() {
        $this->m_pegawai->_set_table('v_pangkat_jenkel');
        $data['result'] = $this->m_pegawai->get_all();
        $this->load->view('laporan/daftar_kepangkatan_excel', $data);
        
    }
}

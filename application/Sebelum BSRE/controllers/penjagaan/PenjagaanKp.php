<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Zanuar
 */
class PenjagaanKp extends MY_Controller {

    //put your code here
    

    public function __construct() {
        parent::__construct();
        $this->load->model(array(    'm_pegawai' ,'m_laporan'   ));
    }

    function index() {
        $data['result'] = $this->m_laporan->get_penjagaan_kenaikan_pangkat();
        $this->loadView('penjagaan/penjagaan_kenaikan_pangkat', $data);
    }
    
    function excel() {
        
        
    }
}

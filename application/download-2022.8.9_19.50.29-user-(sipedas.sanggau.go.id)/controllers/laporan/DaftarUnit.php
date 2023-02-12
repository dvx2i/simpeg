<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaftarUnit
 *
 * @author Zanuar
 */
class DaftarUnit extends MY_Controller {

    //put your code here
    

    public function __construct() {
        parent::__construct();
        $this->load->model(array(    'm_pegawai'  ,'ref_status_kepegawaian'  ));
    }

    function index() {
        $this->m_pegawai->_set_table('v_pegawai_unit');
        $data['result'] = $this->m_pegawai->get_all();
        $this->loadView('laporan/daftar_unit', $data);
    }
    
    function excel($status_pegawai = NULL) {
        $this->m_pegawai->_set_table('v_pegawai_unit');
        $data['result'] = $this->m_pegawai->get_all();
//        $this->loadView('laporan/daftar_unit', $data);
        
//        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
//        $data['filter_id'] = '';
//        $data['filter_nama'] = 'SEMUA';
//        $data['result'] = null;
//        if(!empty($status_pegawai)){
//            
//            $data['filter_id'] = $status_pegawai;
//            $data['filter_nama'] = $this->ref_status_kepegawaian->get_row($status_pegawai)->statuskepegawaian_nama;
//            $where['status'] = $data['filter_nama'];
//            $this->m_pegawai->set_table('v_pegawai');
//            $data['result'] = $this->m_pegawai->get_where($where);
//        }else{
//            $data['result'] = $this->m_pegawai->get_all();
//        }
        
        $this->load->view('laporan/daftar_unit_excel', $data);
    }
}

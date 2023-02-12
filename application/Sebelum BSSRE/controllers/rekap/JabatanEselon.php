<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RekapPns
 *
 * @author Zanuar
 */
class JabatanEselon extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_rekap'));
    }

    function index() {
        $data['list_tahun'] = $this->m_pegawai_rekap->get_tahun();
        if (!empty($this->input->post('tahun'))) {
            $data['tahun'] = $this->input->post('tahun');
            $data['bulan'] = $this->input->post('bulan');
            $data['list_bulan'] = $this->m_pegawai_rekap->get_bulan($data['tahun']);
        } else {
            $data['tahun'] = $data['list_tahun']->row()->tahun;
            $data['list_bulan'] = $this->m_pegawai_rekap->get_bulan($data['tahun']);
            $data['bulan'] = $data['list_bulan']->row()->bulan;
        }
        $data['result'] = $this->m_pegawai_rekap->rekap_jabatan_eselon($data['tahun'], $data['bulan']);
        $this->loadView('rekap/rekap_jabatan_eselon', $data);
    }

    function view() {
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = $this->input->post('bulan');
        $data['list_tahun'] = $this->m_pegawai_rekap->get_tahun();
        $data['list_bulan'] = $this->m_pegawai_rekap->get_bulan($data['tahun']);
        $data['result'] = $this->m_pegawai_rekap->rekap_golongan_status_pegawai_jenis_kelamin($data['tahun'], $data['bulan']);
        $this->loadView('rekap/rekap_golongan', $data);
    }

    function excel($tahun, $bulan) {
        
    }

}

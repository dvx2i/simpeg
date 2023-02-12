<?php

defined('BASEPATH') or exit('No direct script access allowed');
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
class DaftarNominatifPegawaiPensiun extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_laporan', 'm_pegawai_rekap', 'ref_jenis_pensiun'));
    }

    function index()
    {
        if (!empty($this->input->post('tahun'))) {
            $data['tahun'] = $this->input->post('tahun');
            $data['bulan'] = $this->input->post('bulan');
            $data['jenis'] = $this->input->post('jenis');
        } else {
            $data['tahun'] = date('Y');
            $data['bulan'] = date('m');
            $data['jenis'] = '';
        }

        $data['list_tahun'] = $this->m_laporan->get_tahun_pensiun();
        $data['list_bulan'] = $this->m_pegawai_rekap->get_bulan($data['tahun']);
        $data['list_pensiun'] = $this->ref_jenis_pensiun->get_all();
        $data['result'] = $this->m_laporan->daftar_nominatif_pensiun($data['tahun'], $data['bulan'],$data['jenis']);
        $this->loadView('laporan/daftar_nominatif_pegawai_pensiun', $data);
    }
}

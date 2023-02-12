<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiklatPim
 *
 * @author Zanuar
 */
class DiklatPim extends MY_Controller
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_eselon', 'ref_jabatan_kedudukan', 'm_laporan', 'ref_pendidikan_tingkat', 'ref_diklat_struktural', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_pangkat_golongan'));
    }

    function index()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';

        //REFERENSI
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id' => NULL, 'unit_kode <> ' => '0100000'));
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['jabatan_kedudukan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['eselon'] = $this->ref_eselon->get_all();
        $data['diklat_kode'] = $this->ref_diklat_struktural->get_diklat_kode();

        //POST
        if (!empty($this->input->post('diklat_struktural_kode'))) {
            $where['diklat_struktural_kode'] = $this->input->post('diklat_struktural_kode');
        }
        if (!empty($this->input->post('tahun'))) {
            $where['tahun'] = $this->input->post('tahun');
        }
        $data['tahun'] = $this->input->post('tahun');

        $data['result'] = null;
        if (!empty($this->input->post())) {
            $data['result'] = $this->m_laporan->get_pegawai_diklat_pim($where);
        }

        $data['where'] = $where;

        $this->loadView('laporan/diklat_pim', $data);
    }

    function excel()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';
        //POST
        
        //POST
        if (!empty($this->input->post('diklat_struktural_kode'))) {
            $where['diklat_struktural_kode'] = $this->input->post('diklat_struktural_kode');
        }
        if (!empty($this->input->post('tahun'))) {
            $where['tahun'] = $this->input->post('tahun');
        }

        $data['result'] = $this->m_laporan->get_pegawai_diklat_pim($where);

        $this->load->view('laporan/diklat_pim_excel', $data);
    }
}

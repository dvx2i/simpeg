<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Satyalancana
 *
 * @author Zanuar
 */
class SatyaLancana extends MY_Controller
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_eselon', 'ref_jabatan_kedudukan', 'm_laporan', 'ref_pendidikan_tingkat', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_pangkat_golongan'));
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

        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawaijasa_tahun'))) {
            $where['pegawaijasa_tahun'] = $this->input->post('pegawaijasa_tahun');
        }

        $data['result'] = null;
        if (!empty($this->input->post())) {
            $data['result'] = $this->m_laporan->get_pegawai_satya_lancana($where);
        }

        $data['where'] = $where;

        $this->loadView('laporan/satya_lancana', $data);
    }

    function excel()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';
        //POST
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawaijasa_tahun'))) {
            $where['pegawaijasa_tahun'] = $this->input->post('pegawaijasa_tahun');
        }

        $data['result'] = $this->m_laporan->get_pegawai_satya_lancana($where);

        $this->load->view('laporan/satya_lancana_excel', $data);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuti
 *
 * @author Zanuar
 */
class Cuti extends MY_Controller
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_eselon', 'ref_jabatan_kedudukan', 'm_laporan', 'ref_pendidikan_tingkat', 'ref_status_kepegawaian', 'm_pegawai', 'm_pegawai_cuti', 'ref_unit', 'ref_jenis_kelamin', 'ref_pangkat_golongan', 'ref_jenis_cuti'));
    }

    function index()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';

        //REFERENSI
        $data['jenis_cuti'] = $this->ref_jenis_cuti->get_all();
        $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id' => NULL, 'unit_kode <> ' => '0100000'));

        //POST
        // print_r($_POST);
        // die;
        $where['pegawaicuti_tahun'] = date('Y');
        $where['pegawai_unit_id'] = '';
        $where['pegawaicuti_jeniscuti_id'] = '';
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawaicuti_tahun'))) {
            $where['pegawaicuti_tahun'] = $this->input->post('pegawaicuti_tahun');
        }
        if (!empty($this->input->post('pegawaicuti_jeniscuti_id'))) {
            $where['pegawaicuti_jeniscuti_id'] = $this->input->post('pegawaicuti_jeniscuti_id');
        }

        $data['result'] = null;
        if (!empty($this->input->post())) {
            $data['result'] = $this->m_laporan->get_pegawai_cuti($where);
        }
        // print_r(($data['result']));
        // die;

        $data['where'] = $where;

        $this->loadView('laporan/cuti', $data);
    }

    function excel()
    {
        $where['pegawai_status_kepegawaian_nama'] = 'PNS';
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawaicuti_tahun'))) {
            $where['pegawaicuti_tahun'] = $this->input->post('pegawaicuti_tahun');
        }
        $data['result'] = $this->m_laporan->get_pegawai_cuti($where);

        $this->load->view('laporan/cuti_excel', $data);
    }
}

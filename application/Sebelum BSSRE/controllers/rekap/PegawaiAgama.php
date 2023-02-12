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
class PegawaiAgama extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_rekap_agama'));
    }

    function index()
    {
        $tahun = $this->m_pegawai_rekap_agama->get_tahun()->result_array();
        $data['tahun'] = $tahun[0]['tahun'];
        $bulan = $this->m_pegawai_rekap_agama->get_bulan($data['tahun'])->result_array();
        $data['bulan'] = $bulan[0]['bulan'];
        $data['unit']  = '';
        $data['jenis']  = '1'; //perbandingan as default
        $data['periode']  = 'bulan';
        $data['tahun2']  = '';
        $data['bulan2']  = '';
        $data['agama']  = '';
        $data = $this->m_pegawai_rekap_agama->data($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['agama']);
        $this->loadView('rekap/pegawai_agama', $data);
    }

    function view()
    {
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = $this->input->post('bulan');
        $data['unit']  = $this->input->post('unit');
        $data['jenis']  = $this->input->post('jenis_rekap');
        $data['periode']  = $this->input->post('periode');
        $data['tahun2']  = $this->input->post('tahun2');
        $data['bulan2']  = $this->input->post('bulan2');
        $data['agama']  = $this->input->post('agama');
        $data = $this->m_pegawai_rekap_agama->data($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['agama']);
        $this->loadView('rekap/pegawai_agama', $data);
    }

    function update()
    {
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $data = $this->m_pegawai_rekap_agama->update_now($data['tahun'], $data['bulan']);
        $this->session->set_flashdata('message', alert_show('success', "Rekap data pegawai terakhir sudah diperbaharui " . tgl_indo(date('Y-m-d'))));
        redirect(site_url('rekap/RekapPns'));
    }

    function excel()
    {
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = $this->input->post('bulan');
        $data['unit']  = $this->input->post('unit');
        $data['jenis']  = $this->input->post('jenis_rekap');
        $data['periode']  = $this->input->post('periode');
        $data['tahun2']  = $this->input->post('tahun2');
        $data['bulan2']  = $this->input->post('bulan2');
        $data['agama']  = $this->input->post('agama');
        $data = $this->m_pegawai_rekap_agama->data($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['agama']);
        $data['result'] = $data['rekap_agama'];

        $this->load->view('rekap/rekap_excel', $data);
    }

    function data($tahun, $bulan)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['list_tahun'] = $this->m_pegawai_rekap_agama->get_tahun();
        $data['list_bulan'] = $this->m_pegawai_rekap_agama->get_bulan($data['tahun']);
        $data['rekap_golru'] = $this->m_pegawai_rekap_agama->get_rekap_golru();
        $data['rekap_agama'] = $this->m_pegawai_rekap_agama_agama->get_rekap_agama_perbandingan();
        $data['rekap_kelamin'] = $this->m_pegawai_rekap_agama->get_rekap_kelamin();
        $data['rekap_eselon'] = $this->m_pegawai_rekap_agama->get_rekap_eselon();
        $data['rekap_pendidikan'] = $this->m_pegawai_rekap_agama->get_rekap_pendidikan();
        $data['rekap_jabatan'] = $this->m_pegawai_rekap_agama->get_rekap_jabatan();
        $data['data_agama'] = $this->extract($data['rekap_agama'], 'agama');
        $data['data_golru'] = $this->extract($data['rekap_golru'], 'golru');
        $data['data_kelamin'] = $this->extract($data['rekap_kelamin'], 'jenis_kelamin');
        $data['data_eselon'] = $this->extract($data['rekap_eselon'], 'eselon');
        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        $data['data_jabatan'] = $this->extract($data['rekap_jabatan'], 'jenis_jabatan');
        return $data;
    }

    function extract($data, $key)
    {
        $array_key = array();
        $array_val = array();
        $max = 0;
        foreach ($data->result_array() as $value) {
            array_push($array_key, $value[$key]);
            array_push($array_val, $value['jumlah']);
            if ($value['jumlah'] > $max) {
                $max = $value['jumlah'];
            }
        }
        return array($array_key, $array_val, $max);
    }
}

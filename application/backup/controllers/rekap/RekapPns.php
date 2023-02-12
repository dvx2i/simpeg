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
class RekapPns extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_rekap'));
    }

    function index() {
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $data = $this->m_pegawai_rekap->data($data['tahun'], $data['bulan']);
        $this->loadView('rekap/rekap_view', $data);
    }

    function view() {
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = $this->input->post('bulan');
        $data = $this->m_pegawai_rekap->data($data['tahun'], $data['bulan']);
        $this->loadView('rekap/rekap_view', $data);
    }
    
    function update() {
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $data = $this->m_pegawai_rekap->update_now($data['tahun'], $data['bulan']);
    	$this->m_pegawai_rekap->update_rekap_agama();
    	$this->m_pegawai_rekap->update_rekap_eselon();
    	$this->m_pegawai_rekap->update_rekap_golru();
    	$this->m_pegawai_rekap->update_rekap_jabatan();
    	$this->m_pegawai_rekap->update_rekap_jk();
    	$this->m_pegawai_rekap->update_rekap_pendidikan();
        $this->session->set_flashdata('message', alert_show('success', "Rekap data pegawai terakhir sudah diperbaharui ". tgl_indo(date('Y-m-d'))));
        redirect(site_url('rekap/RekapPns'));
    }

    function excel($id, $tahun, $bulan) {
        $data = $this->m_pegawai_rekap->data($tahun, $bulan);
        switch ($id) {
            case 'agama':
                $data['result'] = $data['rekap_agama'];
                break;
            case 'golru':
                $data['result'] = $data['rekap_golru'];
                break;
            case 'kelamin':
                $data['result'] = $data['rekap_kelamin'];
                break;
            case 'eselon':
                $data['result'] = $data['rekap_eselon'];
                break;
            case 'pendidikan':
                $data['result'] = $data['rekap_pendidikan'];
                break;
            case 'jabatan':
                $data['result'] = $data['rekap_jabatan'];
                break;

            default:
                break;
        }

        $this->load->view('rekap/rekap_excel', $data);
    }

    function data($tahun, $bulan) {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['list_tahun'] = $this->m_pegawai_rekap->get_tahun();
        $data['list_bulan'] = $this->m_pegawai_rekap->get_bulan($data['tahun']);
        $data['rekap_golru'] = $this->m_pegawai_rekap->get_rekap_golru();
        $data['rekap_agama'] = $this->m_pegawai_rekap->get_rekap_agama();
        $data['rekap_kelamin'] = $this->m_pegawai_rekap->get_rekap_kelamin();
        $data['rekap_eselon'] = $this->m_pegawai_rekap->get_rekap_eselon();
        $data['rekap_pendidikan'] = $this->m_pegawai_rekap->get_rekap_pendidikan();
        $data['rekap_jabatan'] = $this->m_pegawai_rekap->get_rekap_jabatan();
        $data['data_agama'] = $this->extract($data['rekap_agama'], 'agama');
        $data['data_golru'] = $this->extract($data['rekap_golru'], 'golru');
        $data['data_kelamin'] = $this->extract($data['rekap_kelamin'], 'jenis_kelamin');
        $data['data_eselon'] = $this->extract($data['rekap_eselon'], 'eselon');
        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        $data['data_jabatan'] = $this->extract($data['rekap_jabatan'], 'jenis_jabatan');
        return $data;
    }

    function extract($data, $key) {
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

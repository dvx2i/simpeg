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
class CpnsPegawaiGolru extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_rekap_golru'));
    }

    function index()
    {
        $tahun = $this->m_pegawai_rekap_golru->get_tahun()->result_array();
        $data['tahun'] = $tahun[0]['tahun'];
        $bulan = $this->m_pegawai_rekap_golru->get_bulan($data['tahun'])->result_array();
        $data['bulan'] = $bulan[0]['bulan'];
        $data['unit']  = '';
        $data['jenis']  = '1'; //perbandingan as default
        $data['periode']  = 'bulan';
        $data['tahun2']  = '';
        $data['bulan2']  = '';
        $data['golru']  = '';
        $data = $this->m_pegawai_rekap_golru->data_cpns($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['golru']);
        $this->loadView('rekap/cpns_pegawai_golru', $data);
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
        $data['golru']  = $this->input->post('golru');
        $data = $this->m_pegawai_rekap_golru->data_cpns($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['golru']);
        $this->loadView('rekap/cpns_pegawai_golru', $data);
    }

    function update()
    {
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $data = $this->m_pegawai_rekap_golru->update_now($data['tahun'], $data['bulan']);
        $this->session->set_flashdata('message', alert_show('success', "Rekap data pegawai terakhir sudah diperbaharui " . tgl_indo(date('Y-m-d'))));
        redirect(site_url('rekap/RekapPns'));
    }

    function excel($id, $tahun, $bulan)
    {
        $data = $this->m_pegawai_rekap_golru->data($tahun, $bulan);
        switch ($id) {
            case 'golru':
                $data['result'] = $data['rekap_golru'];
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
}

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
class PegawaiJk extends CI_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_rekap_jk'));
    }

    function index()
    {
        $tahun = $this->m_pegawai_rekap_jk->get_tahun()->result_array();
        $data['tahun'] = $tahun[0]['tahun'];
        $bulan = $this->m_pegawai_rekap_jk->get_bulan($data['tahun'])->result_array();
        $data['bulan'] = $bulan[0]['bulan'];
        $data['unit']  = '';
        $data['jenis']  = '1'; //perbandingan as default
        $data['periode']  = 'bulan';
        $data['tahun2']  = '';
        $data['bulan2']  = '';
        $data['jk']  = '';
        $data = $this->m_pegawai_rekap_jk->data($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['jk']);
        $data["content"] = $this->load->view('publik/pegawai_jk', $data, TRUE);
        $this->load->view('publik/template', $data);
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
        $data['jk']  = $this->input->post('jk');
        $data = $this->m_pegawai_rekap_jk->data($data['tahun'], $data['bulan'], $data['unit'], $data['jenis'], $data['periode'], $data['tahun2'], $data['bulan2'], $data['jk']);
        $data["content"] = $this->load->view('publik/pegawai_jk', $data, TRUE);
        $this->load->view('publik/template', $data);
    }

    function excel($id, $tahun, $bulan)
    {
        $data = $this->m_pegawai_rekap_jk->data($tahun, $bulan);
        switch ($id) {
            case 'jk':
                $data['result'] = $data['rekap_jk'];
                break;
            case 'jk':
                $data['result'] = $data['rekap_jk'];
                break;
            case 'kelamin':
                $data['result'] = $data['rekap_kelamin'];
                break;
            case 'jk':
                $data['result'] = $data['rekap_jk'];
                break;
            case 'jk':
                $data['result'] = $data['rekap_jk'];
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

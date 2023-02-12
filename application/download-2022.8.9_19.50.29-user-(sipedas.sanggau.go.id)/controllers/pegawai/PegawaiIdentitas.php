<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pegawai
 *
 * @author Zanuar
 */
class PegawaiIdentitas extends MY_Controller
{
    //put your code here
    var $page = 'pegawai/Pegawai';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
    }

    function index()
    {
    }

    function view($nip)
    {
        $this->load->model(array('ref_propinsi', 'ref_kabupaten', 'ref_kecamatan', 'ref_kelurahan'));
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['unit'] = $this->ref_unit->get_unit_parent();
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['golongan_darah'] = $this->ref_golongan_darah->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['status_kepegawaian'] = $this->ref_status_kepegawaian->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['jabatan_fungsional'] = $this->ref_jabatan_fungsional->get_all();
        $data['jabatan_struktural'] = $this->ref_jabatan_struktural->get_all();
        $data['propinsi'] = $this->ref_propinsi->get_all();

        //alamat
        if (!empty($data['pegawai']->pegawai_propinsi_id)) {
            $data['kabupaten'] = $this->ref_kabupaten->get_where(array('kabupaten_propinsi_id' => $data['pegawai']->pegawai_propinsi_id));
        }
        if (!empty($data['pegawai']->pegawai_kabupaten_id)) {
            $data['kecamatan'] = $this->ref_kecamatan->get_where(array('kecamatan_kabupaten_id' => $data['pegawai']->pegawai_kabupaten_id));
        }
        if (!empty($data['pegawai']->pegawai_kecamatan_id)) {
            $data['kelurahan'] = $this->ref_kelurahan->get_where(array('kelurahan_kecamatan_id' => $data['pegawai']->pegawai_kecamatan_id));
        }
        if ($this->cek_admin_opd($data['pegawai'])) {
            $this->loadView('pegawai/pegawai_identitas', $data);
        } else {
            redirect('pegawai/Pegawai');
        }
    }
}

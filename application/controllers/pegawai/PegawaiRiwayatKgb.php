<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatKgb
 *
 * @author Zanuar
 */
class PegawaiRiwayatKgb extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_kgb', 'ref_kenaikan_pangkat', 'ref_pejabat', 'ref_pangkat_golongan', 'ref_jabatan_fungsional','ref_jabatan_baru', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
    	
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index()
    {
    }

    function view($nip)
    {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_kgb->get_kgb_terakhir($nip);
        $data['unit'] = $this->ref_unit->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['golongan_darah'] = $this->ref_golongan_darah->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['jenis_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['kenaikan_pangkat'] = $this->ref_kenaikan_pangkat->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        if ($data['pegawai']->pegawai_jenisjabatan_kode == '1') {
            $data['jabatan'] = $this->ref_jabatan_struktural->get_all();
        } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '2') {
            $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
        }else if ($data['pegawai']->pegawai_jenisjabatan_kode == '4') {
            $data['jabatan'] = $this->ref_jabatan_baru->get_all();
        }else {
            $data['jabatan'] = '';
        }
        $this->loadView('pegawai/pegawai_riwayat_kgb', $data);
    }

    function add()
    {
        // print_r($_POST);
        // die;
        $data['pegawaikgb_pegawai_nip'] = $this->input->post('nip');
        // $data['pegawaikgb_unit_kerja_id'] = $this->input->post('pegawaikgb_unit_kerja_id');
        // $data['pegawaikgb_unit_kerja_nama'] = $this->ref_unit->get_row($data['pegawaikgb_unit_kerja_id'])->unit_nama;
        // $data['pegawaikgb_jenis_jabatan_id'] = $this->input->post('pegawaikgb_jenis_jabatan_id');
        // $data['pegawaikgb_jenis_jabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawaikgb_jenis_jabatan_id'])->jeniskedudukan_nama;
        // $data['pegawaikgb_jabatan_id'] = $this->input->post('pegawaikgb_jabatan_id');
        // if ($data['pegawaikgb_jenis_jabatan_id'] == '1') {
        //     $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaikgb_jabatan_id']);
        // } else if ($data['pegawaikgb_jenis_jabatan_id'] == '2') {
        //     $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaikgb_jabatan_id']);
        // } else if ($data['pegawaikgb_jenis_jabatan_id'] == '4') {
        //     $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaikgb_jabatan_id']);
        // }
        // $data['pegawaikgb_jabatan_nama'] = $jabatan->jabatan_nama;
        $data['pegawaikgb_tmt'] = y_m_d($this->input->post('pegawaikgb_tmt'));
        $data['pegawaikgb_sk_no'] = $this->input->post('pegawaikgb_sk_no');
        $data['pegawaikgb_sk_tanggal'] = y_m_d($this->input->post('pegawaikgb_sk_tanggal'));
        $data['pegawaikgb_pangkat_id'] = $this->input->post('pegawaikgb_pangkat_id');
        $data['pegawaikgb_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaikgb_pangkat_id'])->pangkat_golongan_text;
        $data['pegawaikgb_masa_kerja_tahun'] = $this->input->post('pegawaikgb_masa_kerja_tahun');
        $data['pegawaikgb_masa_kerja_bulan'] = $this->input->post('pegawaikgb_masa_kerja_bulan');
        $data['pegawaikgb_gaji'] = !empty($this->input->post('pegawaikgb_gaji')) ? $this->input->post('pegawaikgb_gaji') : 0;
        $data['status_proses'] = '4';
        // print_r($data);
        // die;

        $insert = $this->m_pegawai_kgb->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Jabatan Pegawai Berhasil"));
            $this->update_kgb_terakhir($data['pegawaikgb_pegawai_nip']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Jabatan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatKgb/view/' . $data['pegawaikgb_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaikgb_id');
        $data['pegawaikgb_pegawai_nip'] = $this->input->post('nip');
        // $data['pegawaikgb_unit_kerja_id'] = $this->input->post('pegawaikgb_unit_kerja_id');
        // $data['pegawaikgb_unit_kerja_nama'] = $this->ref_unit->get_row($data['pegawaikgb_unit_kerja_id'])->unit_nama;
        // $data['pegawaikgb_jenis_jabatan_id'] = $this->input->post('pegawaikgb_jenis_jabatan_id');
        // $data['pegawaikgb_jenis_jabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawaikgb_jenis_jabatan_id'])->jeniskedudukan_nama;
        // $data['pegawaikgb_jabatan_id'] = $this->input->post('pegawaikgb_jabatan_id');
        // if ($data['pegawaikgb_jenis_jabatan_id'] == '1') {
        //     $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaikgb_jabatan_id']);
        // } else if ($data['pegawaikgb_jenis_jabatan_id'] == '2') {
        //     $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaikgb_jabatan_id']);
        // } else if ($data['pegawaikgb_jenis_jabatan_id'] == '4') {
        //     $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaikgb_jabatan_id']);
        // }
        // $data['pegawaikgb_jabatan_nama'] = $jabatan->jabatan_nama;
        $data['pegawaikgb_tmt'] = y_m_d($this->input->post('pegawaikgb_tmt'));
        $data['pegawaikgb_sk_no'] = $this->input->post('pegawaikgb_sk_no');
        $data['pegawaikgb_sk_tanggal'] = y_m_d($this->input->post('pegawaikgb_sk_tanggal'));
        $data['pegawaikgb_pangkat_id'] = $this->input->post('pegawaikgb_pangkat_id');
        $data['pegawaikgb_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaikgb_pangkat_id'])->pangkat_golongan_text;
        $data['pegawaikgb_masa_kerja_tahun'] = $this->input->post('pegawaikgb_masa_kerja_tahun');
        $data['pegawaikgb_masa_kerja_bulan'] = $this->input->post('pegawaikgb_masa_kerja_bulan');
        $data['pegawaikgb_gaji'] = !empty($this->input->post('pegawaikgb_gaji')) ? $this->input->post('pegawaikgb_gaji') : 0;

        $update = $this->m_pegawai_kgb->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat KGB Pegawai Berhasil"));
            $this->update_kgb_terakhir($data['pegawaikgb_pegawai_nip']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat KGB Pegawai Gagal"));
        }
        //        print_r($data);
        redirect('pegawai/PegawaiRiwayatKgb/view/' . $data['pegawaikgb_pegawai_nip'] . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_kgb->get_row($id)->pegawaikgb_pegawai_nip;
        $delete = $this->m_pegawai_kgb->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat KGB Pegawai Berhasil"));
            $this->update_kgb_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat KGB Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatKgb/view/' . $nip . '#riwayat');
        echo $nip;
    }

    private function update_kgb_terakhir($nip)
    {
        $pangkat_terakhir = $this->m_pegawai_kgb->get_kgb_terakhir($nip);
        $data['pegawai_kenaikan_gaji_berikutnya'] = date('Y-m-d', strtotime('+2 years', strtotime($pangkat_terakhir->pegawaikgb_tmt)));
        $data['pegawai_gaji'] = $pangkat_terakhir->pegawaikgb_gaji;
        $this->m_pegawai->update($data, $nip);
    }
}

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
class PegawaiCuti extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_cuti', 'm_pegawai_cuti', 'ref_eselon', 'ref_pejabat', 'ref_kenaikan_pangkat', 'ref_kondisi_sumpah', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan', 'ref_jenis_cuti'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index()
    {
        if (!empty($this->input->post('nip'))) {
            $nip = $this->input->post('nip');
            $pegawai = $this->m_pegawai->get_pegawai_aktif($nip);
            // print_r($pegawai);
            // die;
            if (!empty($pegawai)) {
                $data['pegawai'] = $this->m_pegawai->get_row($nip);
                $data['result'] = $this->m_pegawai_cuti->get_cuti_by_nip(array('pegawaicuti_pegawai_nip' => $nip));
                $data['pejabat'] = $this->ref_pejabat->get_all();
                $data['jenis_cuti'] = $this->ref_jenis_cuti->get_all();
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "NIP " . $nip . " Tidak ditemukan / Pegawai Telah Pensiun"));
                redirect(site_url('pegawai/PegawaiCuti'));
            }
        }
        $data['pegawai_all'] = $this->m_pegawai->get_all();

        $this->loadView('pegawai/pegawai_cuti', $data);
    }

    function view($nip, $tes=null)
    {
        // $nip = $this->input->post('nip');
        // $pegawai = $this->m_pegawai->get_pegawai_aktif($nip);
        // print_r($pegawai);
        // die;
        // if (!empty($pegawai)) {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_cuti->get_cuti_by_nip(array('pegawai_nip' => $nip));
    if($tes != null) {
    $data['result']->result_array(); die($this->db->last_query());
    }
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['jenis_cuti'] = $this->ref_jenis_cuti->get_all();
        // } else {
        //     $this->session->set_flashdata('message', alert_show('danger', "NIP " . $nip . " Tidak ditemukan / Pegawai Telah Pensiun"));
        //     redirect(site_url('pegawai/PegawaiCuti'));
        // }
        $this->loadView('pegawai/pegawai_cuti', $data);
    }

    function add()
    {
        $data['pegawaicuti_pegawai_nip'] = $this->input->post('pegawaicuti_pegawai_nip');
        $data['pegawaicuti_jeniscuti_id'] = $this->input->post('pegawaicuti_jeniscuti_id');
        $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('pegawaicuti_lama_cuti_mulai'));
        $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('pegawaicuti_lama_cuti_selesai'));
        $data['pegawaicuti_sk_tanggal'] = y_m_d($this->input->post('pegawaicuti_sk_tanggal'));
        $data['pegawaicuti_sk_no'] = $this->input->post('pegawaicuti_sk_no');
        $data['pegawaicuti_pejabat'] = $this->input->post('pegawaicuti_pejabat');
        $data['pegawaicuti_diambil'] = 0;
        $data['pegawaicuti_sisa'] = 0;
        $data['insert_user_id'] = $this->session->userdata('login')['user_id'];

        // print_r($data);
        // die;


        $update = $this->m_pegawai_cuti->insert($data);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Cuti Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Cuti Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiCuti/view/' . $data['pegawaicuti_pegawai_nip'] . '#riwayat');
        // redirect(site_url('pegawai/PegawaiCuti'));
    }

    function update()
    {
        $id = $this->input->post('pegawaicuti_id');
        $data['pegawaicuti_pegawai_nip'] = $this->input->post('pegawaicuti_pegawai_nip');
        $data['pegawaicuti_jeniscuti_id'] = $this->input->post('pegawaicuti_jeniscuti_id');
        $data['pegawaicuti_lama_cuti_mulai'] = y_m_d($this->input->post('pegawaicuti_lama_cuti_mulai'));
        $data['pegawaicuti_lama_cuti_selesai'] = y_m_d($this->input->post('pegawaicuti_lama_cuti_selesai'));
        $data['pegawaicuti_sk_tanggal'] = y_m_d($this->input->post('pegawaicuti_sk_tanggal'));
        $data['pegawaicuti_sk_no'] = $this->input->post('pegawaicuti_sk_no');
        $data['pegawaicuti_pejabat'] = $this->input->post('pegawaicuti_pejabat');
        $data['pegawaicuti_diambil'] = 0;
        $data['pegawaicuti_sisa'] = 0;
        $data['update_user_id'] = $this->session->userdata('login')['user_id'];


        $update = $this->m_pegawai_cuti->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Cuti Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Cuti Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiCuti/view/' . $data['pegawaicuti_pegawai_nip'] . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_cuti->get_row($id)->pegawaicuti_pegawai_nip;
        $delete = $this->m_pegawai_cuti->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Cuti Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Cuti Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiCuti/view/' . $nip . '#riwayat');
    }

    function update_pangkat_terakhir($nip)
    {
        $pangkat_terakhir = $this->m_pegawai_cuti->get_pangkat_terakhir($nip);
        $data1['pegawai_pangkat_terakhir_id'] = $pangkat_terakhir->pegawaipangkat_pangkat_id;
        $data1['pegawai_pangkat_terakhir_nama'] = $pangkat_terakhir->pegawaipangkat_pangkat_nama;
        $data1['pegawai_pangkat_terakhir_golru'] = $pangkat_terakhir->pegawaipangkat_pangkat_golru;
        $data1['pegawai_pangkat_terakhir_tmt'] = $pangkat_terakhir->pegawaipangkat_tmt;
        $data1['pegawai_pangkat_terakhir_sk'] = $pangkat_terakhir->pegawaipangkat_sk_no;
        $data1['pegawai_pangkat_terakhir_pejabat'] = $pangkat_terakhir->pegawaipangkat_sk_pejabat;
        $data1['pegawai_pangkat_terakhir_tahun'] = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun;
        $data1['pegawai_pangkat_terakhir_bulan'] = $pangkat_terakhir->pegawaipangkat_masa_kerja_bulan;
        $data1['pegawai_pangkat_terakhir_sk_tgl'] = $pangkat_terakhir->pegawaipangkat_sk_date;
        $data1['pegawai_kenaikan_pangkat_berikutnya'] = date('Y-m-d', strtotime('+4 years', strtotime($pangkat_terakhir->pegawaipangkat_sk_date)));
        $this->m_pegawai->update($data1, $nip);
    }
}

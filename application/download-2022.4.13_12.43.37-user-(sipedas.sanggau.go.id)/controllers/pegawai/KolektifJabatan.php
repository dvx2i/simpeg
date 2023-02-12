<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatJabatan
 *
 * @author Zanuar
 */
class KolektifJabatan extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_jabatan', 'ref_eselon', 'ref_kenaikan_jabatan', 'ref_kondisi_sumpah', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'm_pegawai', 'ref_unit', 'ref_pejabat'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index()
    {
        if (!empty($this->input->post('nip'))) {
            $nip = $this->input->post('nip');
            $pegawai = $this->m_pegawai->get_row($nip);
            if (!empty($pegawai)) {
                $data['lama'] = $this->m_pegawai_jabatan->get_jabatan_terakhir($nip);
                $data['pegawai'] = $this->m_pegawai->get_row($nip);
                $data['result'] = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_pegawai_nip' => $nip));
                $data['unit'] = $this->ref_unit->get_all();
                $data['eselon'] = $this->ref_eselon->get_all();
                $data['pejabat'] = $this->ref_pejabat->get_all();
                $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
                $data['jenis_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
                $data['kenaikan_jabatan'] = $this->ref_kenaikan_jabatan->get_all();
                $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
                if ($data['pegawai']->pegawai_jenisjabatan_kode == '11') {
                    $data['jabatan'] = $this->ref_jabatan_struktural->get_all();
                } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '12') {
                    $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
                }
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "NIP " . $nip . " Tidak ditemukan"));
                redirect(site_url('pegawai/KolektifJabatan'));
            }
        }
        $data['pegawai_all'] = $this->m_pegawai->get_all();
        $this->loadView('pegawai/kolektif_jabatan', $data);
    }

    function view($nip)
    {
        if (!empty($this->input->post('nip'))) {
            $nip = $this->input->post('nip');
            $pegawai = $this->m_pegawai->get_row($nip);
            if (!empty($pegawai)) {
                $data['pegawai'] = $this->m_pegawai->get_row($nip);
                $data['result'] = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_pegawai_nip' => $nip));
                $data['unit'] = $this->ref_unit->get_all();
                $data['eselon'] = $this->ref_eselon->get_all();
                $data['pejabat'] = $this->ref_pejabat->get_all();
                $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
                $data['jenis_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
                $data['kenaikan_jabatan'] = $this->ref_kenaikan_jabatan->get_all();
                $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
                if ($data['pegawai']->pegawai_jenisjabatan_kode == '11') {
                    $data['jabatan'] = $this->ref_jabatan_struktural->get_all();
                } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '12') {
                    $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
                }
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "NIP " . $nip . " Tidak ditemukan"));
                redirect(site_url('pegawai/KolektifJabatan'));
            }
        }
        $data['pegawai_all'] = $this->m_pegawai->get_all();
        $this->loadView('pegawai/kolektif_jabatan', $data);
    }

    function add()
    {
        $data['pegawaijabatan_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaijabatan_unit_kerja_id'] = !empty($this->input->post('pegawaijabatan_unit_kerja_id')) ? $this->input->post('pegawaijabatan_unit_kerja_id') : 0;
        $data['pegawaijabatan_unit_kerja_nama'] = !empty($this->input->post('pegawaijabatan_unit_kerja_id')) ? $this->ref_unit->get_row($data['pegawaijabatan_unit_kerja_id'])->unit_nama : '';
        $data['pegawaijabatan_sub_unit_id'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->input->post('pegawaijabatan_sub_unit_id') : 0;
        $data['pegawaijabatan_sub_unit_nama'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->ref_unit->get_row($data['pegawaijabatan_sub_unit_id'])->unit_nama : '';
        $data['pegawaijabatan_jenisjabatan_id'] = !empty($this->input->post('pegawaijabatan_jenisjabatan_id')) ? $this->input->post('pegawaijabatan_jenisjabatan_id') : 0;
        $data['pegawaijabatan_jenisjabatan_nama'] = !empty($this->input->post('pegawaijabatan_jenisjabatan_id')) ? $this->ref_jabatan_kedudukan->get_row($data['pegawaijabatan_jenisjabatan_id'])->jeniskedudukan_nama : '';
        $data['pegawaijabatan_jabatan_id'] = !empty($this->input->post('pegawaijabatan_jabatan_id')) ? $this->input->post('pegawaijabatan_jabatan_id') : 0;
        $data['pegawaijabatan_jabatan_id_baru'] = $this->input->post('pegawaijabatan_jabatan_id_baru');
        if ($data['pegawaijabatan_jenisjabatan_id'] == '1') {
            $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaijabatan_jabatan_id']);
            $data['pegawaijabatan_eselon_id'] = $jabatan->jabatan_eselon_kode;
            $data['pegawaijabatan_eselon_nama'] = $jabatan->jabatan_eselon_nama;
        } else if ($data['pegawaijabatan_jenisjabatan_id'] == '2') {
            $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaijabatan_jabatan_id']);
        } else if ($data['pegawaijabatan_jenisjabatan_id'] == '4') {
            $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaijabatan_jabatan_id']);
        }
        $data['pegawaijabatan_jabatan_nama'] = !empty($data['pegawaijabatan_jabatan_id']) ? $jabatan->jabatan_nama : $this->input->post('pegawai_jabatan_nama');
        $data['pegawaijabatan_tmt'] = y_m_d($this->input->post('pegawaijabatan_tmt'));
        $data['pegawaijabatan_sk_no'] = $this->input->post('pegawaijabatan_sk_no');
        $data['pegawaijabatan_sk_tanggal'] = y_m_d($this->input->post('pegawaijabatan_sk_tanggal'));
        $data['pegawaijabatan_pejabat'] = $this->input->post('pegawaijabatan_pejabat');
        $data['pegawaijabatan_tgl_pelantikan'] = y_m_d($this->input->post('pegawaijabatan_sk_tanggal'));
        $data['pegawaijabatan_pangkat_id'] = 0;
        // $data['pegawaijabatan_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaijabatan_pangkat_id'])->pangkat_golongan_text;
        $data['pegawaijabatan_kenaikan_id'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->input->post('pegawaijabatan_kenaikan_id') : 0;
        $data['pegawaijabatan_kenaikan_nama'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->ref_kenaikan_jabatan->get_row($data['pegawaijabatan_kenaikan_id'])->kenaikan_jabatan_nama : null;
        $data['pegawaijabatan_tahun'] = 0;
        $data['pegawaijabatan_bulan'] = 0;
        $data['pegawaijabatan_gaji'] = !empty($this->input->post('pegawaijabatan_gaji')) ? $this->input->post('pegawaijabatan_gaji') : 0;
        $data['pegawaijabatan_angka_kredit'] = !empty($this->input->post('pegawaijabatan_angka_kredit')) ? $this->input->post('pegawaijabatan_angka_kredit') : 0;


        $data['pegawaijabatan_prov_kab_kota'] = $this->input->post('pegawaijabatan_prov_kab_kota');
        $data['pegawaijabatan_jenis_pindah'] = $this->input->post('pegawaijabatan_jenis_pindah');
        // print_r($data);
        // die;

        $insert = $this->m_pegawai_jabatan->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Jabatan Pegawai Berhasil"));
            $this->update_jabatan_terakhir($data['pegawaijabatan_pegawai_nip'], $data['pegawaijabatan_kenaikan_id']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Jabatan Pegawai Gagal"));
        }
    	
    
        if ($data['pegawaijabatan_kenaikan_id'] == '23') {
        	redirect('pegawai/Pensiun');
        }else{
        redirect('pegawai/PegawaiRiwayatJabatan/view/' . $data['pegawaijabatan_pegawai_nip'] . '#riwayat');
        }
    }

    function update()
    {
        $id = $this->input->post('pegawaijabatan_id');
        $data['pegawaijabatan_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaijabatan_unit_kerja_id'] = !empty($this->input->post('pegawaijabatan_unit_kerja_id')) ? $this->input->post('pegawaijabatan_unit_kerja_id') : 0;
        $data['pegawaijabatan_unit_kerja_nama'] = !empty($this->input->post('pegawaijabatan_unit_kerja_id')) ? $this->ref_unit->get_row($data['pegawaijabatan_unit_kerja_id'])->unit_nama : '';
        $data['pegawaijabatan_sub_unit_id'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->input->post('pegawaijabatan_sub_unit_id') : 0;
        $data['pegawaijabatan_sub_unit_nama'] = !empty($this->input->post('pegawaijabatan_sub_unit_id')) ? $this->ref_unit->get_row($data['pegawaijabatan_sub_unit_id'])->unit_nama : '';
        $data['pegawaijabatan_jenisjabatan_id'] = !empty($this->input->post('pegawaijabatan_jenisjabatan_id')) ? $this->input->post('pegawaijabatan_jenisjabatan_id') : 0;
        $data['pegawaijabatan_jenisjabatan_nama'] = !empty($this->input->post('pegawaijabatan_jenisjabatan_id')) ? $this->ref_jabatan_kedudukan->get_row($data['pegawaijabatan_jenisjabatan_id'])->jeniskedudukan_nama : '';
        $data['pegawaijabatan_jabatan_id'] = !empty($this->input->post('pegawaijabatan_jabatan_id')) ? $this->input->post('pegawaijabatan_jabatan_id') : 0;
        $data['pegawaijabatan_jabatan_id_baru'] = $this->input->post('pegawaijabatan_jabatan_id_baru');
        if ($data['pegawaijabatan_jenisjabatan_id'] == '1') {
            $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaijabatan_jabatan_id']);
            $data['pegawaijabatan_eselon_id'] = $jabatan->jabatan_eselon_kode;
            $data['pegawaijabatan_eselon_nama'] = $jabatan->jabatan_eselon_nama;
        } else if ($data['pegawaijabatan_jenisjabatan_id'] == '2') {
            $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaijabatan_jabatan_id']);
        } else if ($data['pegawaijabatan_jenisjabatan_id'] == '4') {
            $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaijabatan_jabatan_id']);
        }
        $data['pegawaijabatan_jabatan_nama'] = !empty($data['pegawaijabatan_jabatan_id']) ? $jabatan->jabatan_nama : $this->input->post('pegawai_jabatan_nama');
        $data['pegawaijabatan_tmt'] = y_m_d($this->input->post('pegawaijabatan_tmt'));
        $data['pegawaijabatan_sk_no'] = $this->input->post('pegawaijabatan_sk_no');
        $data['pegawaijabatan_sk_tanggal'] = y_m_d($this->input->post('pegawaijabatan_sk_tanggal'));
        $data['pegawaijabatan_pejabat'] = $this->input->post('pegawaijabatan_pejabat');
        $data['pegawaijabatan_tgl_pelantikan'] = y_m_d($this->input->post('pegawaijabatan_sk_tanggal'));
        $data['pegawaijabatan_pangkat_id'] = 0;
        // $data['pegawaijabatan_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaijabatan_pangkat_id'])->pangkat_golongan_text;
        $data['pegawaijabatan_kenaikan_id'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->input->post('pegawaijabatan_kenaikan_id') : 0;
        $data['pegawaijabatan_kenaikan_nama'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->ref_kenaikan_jabatan->get_row($data['pegawaijabatan_kenaikan_id'])->kenaikan_jabatan_nama : null;
        $data['pegawaijabatan_tahun'] = 0;
        $data['pegawaijabatan_bulan'] = 0;
        $data['pegawaijabatan_gaji'] = !empty($this->input->post('pegawaijabatan_gaji')) ? $this->input->post('pegawaijabatan_gaji') : 0;
        $data['pegawaijabatan_angka_kredit'] = !empty($this->input->post('pegawaijabatan_angka_kredit')) ? $this->input->post('pegawaijabatan_angka_kredit') : 0;
        

        $data['pegawaijabatan_prov_kab_kota'] = $this->input->post('pegawaijabatan_prov_kab_kota');
        $data['pegawaijabatan_jenis_pindah'] = $this->input->post('pegawaijabatan_jenis_pindah');

        $update = $this->m_pegawai_jabatan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Jabatan Pegawai Berhasil"));
            $this->update_jabatan_terakhir($data['pegawaijabatan_pegawai_nip'], $data['pegawaijabatan_kenaikan_id']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Jabatan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatJabatan/view/' . $data['pegawaijabatan_pegawai_nip'] . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_jabatan->get_row($id)->pegawaijabatan_pegawai_nip;
        $delete = $this->m_pegawai_jabatan->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Jabatan Pegawai Berhasil"));
            $this->update_jabatan_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Jabatan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatJabatan/view/' . $nip . '#riwayat');
        echo $nip;
    }

    private function update_jabatan_terakhir($nip, $pegawaijabatan_kenaikan_id)
    {
        $pangkat_terakhir = $this->m_pegawai_jabatan->get_jabatan_terakhir($nip);
        $data['pegawai_jenisjabatan_kode'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_id;
        $data['pegawai_jenisjabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_nama;
        $data['pegawai_jabatan_id'] = $pangkat_terakhir->pegawaijabatan_jabatan_id;
        $data['pegawai_jabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jabatan_nama;
        $data['pegawai_jabatan_tmt'] = $pangkat_terakhir->pegawaijabatan_tmt;
        $data['pegawai_jabatan_sk_nomor'] = $pangkat_terakhir->pegawaijabatan_sk_no;
        $data['pegawai_jabatan_sk_tanggal'] = $pangkat_terakhir->pegawaijabatan_sk_tanggal;
        if ($pegawaijabatan_kenaikan_id == '23') {
            $data['pegawai_status'] = 0;
            $data['pegawai_jenis_pensiun_nama'] = 'Pindah Instansi Kerja';
            $data['pegawai_jabatan_jenis_pindah'] = $pangkat_terakhir->pegawaijabatan_jenis_pindah;
            $data['pegawai_jabatan_prov_kab_kota'] = $pangkat_terakhir->pegawaijabatan_prov_kab_kota;
        }
        $this->m_pegawai->update($data, $nip);
    }
}

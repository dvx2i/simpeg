<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiTugasBelajar
 *
 * @author Zanuar
 */
class PegawaiTugasBelajar extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_jabatan', 'm_pegawai_tugas_belajar', 'ref_pejabat', 'ref_pendidikan', 'ref_pendanaan', 'ref_pendidikan_tingkat', 'ref_pendidikan', 'ref_jurusan'));
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
        $data['result'] = $this->m_pegawai_tugas_belajar->get_where(array('tugasbelajar_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['pendidikan'] = $this->ref_pendidikan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['jurusan'] = $this->ref_jurusan->get_all();
        $data['pendanaan'] = $this->ref_pendanaan->get_all();
        // print_r($data['result']);
        // die;
        $this->loadView('pegawai/pegawai_tugas_belajar', $data);
    }

    function add()
    {
        $data['tugasbelajar_pegawai_nip'] = $this->input->post('nip');
        $data['tugasbelajar_no_sk'] = $this->input->post('tugasbelajar_no_sk');
        $data['tugasbelajar_tanggal_sk'] = y_m_d($this->input->post('tugasbelajar_tanggal_sk'));
        $data['tugasbelajar_mulai'] = y_m_d($this->input->post('tugasbelajar_mulai'));
        $data['tugasbelajar_selesai'] = y_m_d($this->input->post('tugasbelajar_selesai'));
        $data['tugasbelajar_pendanaan_id'] = !empty($this->input->post('tugasbelajar_pendanaan_id')) ? $this->input->post('tugasbelajar_pendanaan_id') : 0;
        $data['tugasbelajar_pendanaan_nama'] = !empty($this->input->post('tugasbelajar_pendanaan_id')) ? $this->ref_pendanaan->get_row($data['tugasbelajar_pendanaan_id'])->pendanaan_nama : '';
        $data['tugasbelajar_pendidikan_id'] = !empty($this->input->post('tugasbelajar_pendidikan_id')) ? $this->input->post('tugasbelajar_pendidikan_id') : 0;
        $data['tugasbelajar_pendidikan_nama'] = !empty($this->input->post('tugasbelajar_pendidikan_id')) ? $this->ref_pendidikan->get_row($data['tugasbelajar_pendidikan_id'])->pendidikan_nama : '';
        $data['tugasbelajar_jurusan_id'] = !empty($this->input->post('tugasbelajar_jurusan_id')) ? $this->input->post('tugasbelajar_jurusan_id') : 0;
        $data['tugasbelajar_jurusan_nama'] = !empty($this->input->post('tugasbelajar_jurusan_id')) ? $this->ref_jurusan->get_row($data['tugasbelajar_jurusan_id'])->jurusan_nama : '';
        $data['tugasbelajar_pendidikan_tingkat_id'] = !empty($this->input->post('tugasbelajar_pendidikan_tingkat_id')) ? $this->input->post('tugasbelajar_pendidikan_tingkat_id') : 0;
        $data['tugasbelajar_pendidikan_tingkat_nama'] = !empty($this->input->post('tugasbelajar_pendidikan_tingkat_id')) ? $this->ref_pendidikan_tingkat->get_by_id($data['tugasbelajar_pendidikan_tingkat_id'])->pendidikan_tingkat_nama : '';
        $data['tugasbelajar_nama_pendidikan'] = $this->input->post('tugasbelajar_nama_pendidikan');
        $data['tugasbelajar_keterangan'] = $this->input->post('tugasbelajar_keterangan');
        $data['tugasbelajar_jenis'] = $this->input->post('tugasbelajar_jenis');
        $data['tugasbelajar_tahun'] = $this->input->post('tugasbelajar_tahun');
        $data['tugasbelajar_nilai'] = !empty($this->input->post('tugasbelajar_nilai')) ? $this->input->post('tugasbelajar_nilai') : 0;
        $data['tugasbelajar_pejabat'] = !empty($this->input->post('tugasbelajar_pejabat')) ? $this->input->post('tugasbelajar_pejabat') : 0;

        $insert = $this->m_pegawai_tugas_belajar->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Tugas Belajar Pegawai Berhasil"));
            $this->update_pegawai($data['tugasbelajar_pegawai_nip']);
        	$this->update_jabatan_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Tugas Belajar Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTugasBelajar/view/' . $data['tugasbelajar_pegawai_nip'] . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('tugasbelajar_id');
        $nip = $this->input->post('nip');
        $data['tugasbelajar_pegawai_nip'] = $this->input->post('nip');
        $data['tugasbelajar_no_sk'] = $this->input->post('tugasbelajar_no_sk');
        $data['tugasbelajar_tanggal_sk'] = y_m_d($this->input->post('tugasbelajar_tanggal_sk'));
        $data['tugasbelajar_mulai'] = y_m_d($this->input->post('tugasbelajar_mulai'));
        $data['tugasbelajar_selesai'] = y_m_d($this->input->post('tugasbelajar_selesai'));
        $data['tugasbelajar_pendanaan_id'] = !empty($this->input->post('tugasbelajar_pendanaan_id')) ? $this->input->post('tugasbelajar_pendanaan_id') : 0;
        $data['tugasbelajar_pendanaan_nama'] = !empty($this->input->post('tugasbelajar_pendanaan_id')) ? $this->ref_pendanaan->get_row($data['tugasbelajar_pendanaan_id'])->pendanaan_nama : '';
        $data['tugasbelajar_pendidikan_id'] = !empty($this->input->post('tugasbelajar_pendidikan_id')) ? $this->input->post('tugasbelajar_pendidikan_id') : 0;
        $data['tugasbelajar_pendidikan_nama'] = !empty($this->input->post('tugasbelajar_pendidikan_id')) ? $this->ref_pendidikan->get_row($data['tugasbelajar_pendidikan_id'])->pendidikan_nama : '';
        $data['tugasbelajar_jurusan_id'] = !empty($this->input->post('tugasbelajar_jurusan_id')) ? $this->input->post('tugasbelajar_jurusan_id') : 0;
        $data['tugasbelajar_jurusan_nama'] = !empty($this->input->post('tugasbelajar_jurusan_id')) ? $this->ref_jurusan->get_row($data['tugasbelajar_jurusan_id'])->jurusan_nama : '';
        $data['tugasbelajar_pendidikan_tingkat_id'] = !empty($this->input->post('tugasbelajar_pendidikan_tingkat_id')) ? $this->input->post('tugasbelajar_pendidikan_tingkat_id') : 0;
        $data['tugasbelajar_pendidikan_tingkat_nama'] = !empty($this->input->post('tugasbelajar_pendidikan_tingkat_id')) ? $this->ref_pendidikan_tingkat->get_by_id($data['tugasbelajar_pendidikan_tingkat_id'])->pendidikan_tingkat_nama : '';
        $data['tugasbelajar_nama_pendidikan'] = $this->input->post('tugasbelajar_nama_pendidikan');
        $data['tugasbelajar_keterangan'] = $this->input->post('tugasbelajar_keterangan');
        $data['tugasbelajar_jenis'] = $this->input->post('tugasbelajar_jenis');
        $data['tugasbelajar_tahun'] = $this->input->post('tugasbelajar_tahun');
        $data['tugasbelajar_nilai'] = !empty($this->input->post('tugasbelajar_nilai')) ? $this->input->post('tugasbelajar_nilai') : 0;
        $data['tugasbelajar_pejabat'] = !empty($this->input->post('tugasbelajar_pejabat')) ? $this->input->post('tugasbelajar_pejabat') : 0;

        $insert = $this->m_pegawai_tugas_belajar->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Tugas Belajar Pegawai Berhasil"));
            // $this->update_pegawai($data['tugasbelajar_pegawai_nip']);
        	$this->update_jabatan_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Tugas Belajar Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTugasBelajar/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_tugas_belajar->get_row($id)->tugasbelajar_pegawai_nip;
        $delete = $this->m_pegawai_tugas_belajar->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Tugas Belajar Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Tugas Belajar Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiTugasBelajar/view/' . $nip . '#riwayat');
        echo $nip;
    }

    private function update_pegawai($nip)
    {
        $data['pegawaijabatan_pegawai_nip'] = $nip;
        $data['pegawaijabatan_unit_kerja_id'] = '458';
        $data['pegawaijabatan_unit_kerja_nama'] = 'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA';
        $data['pegawaijabatan_eselon_id'] = '99';
        $data['pegawaijabatan_eselon_nama'] = '---';
        $data['pegawaijabatan_jenisjabatan_id'] = '4';
        $data['pegawaijabatan_jenisjabatan_nama'] = 'FUNGSIONAL UMUM';
    $data['pegawaijabatan_jabatan_id_baru'] = 0;
        $data['pegawaijabatan_jabatan_id'] = !empty($this->input->post('pegawaijabatan_jabatan_id')) ? $this->input->post('pegawaijabatan_jabatan_id') : 0;
        $data['pegawaijabatan_jabatan_nama'] = 'TUGAS BELAJAR';
        $data['pegawaijabatan_tmt'] = y_m_d($this->input->post('tugasbelajar_mulai'));
        $data['pegawaijabatan_sk_no'] = $this->input->post('tugasbelajar_no_sk');
        $data['pegawaijabatan_sk_tanggal'] =  y_m_d($this->input->post('tugasbelajar_tanggal_sk'));
        $data['pegawaijabatan_pejabat'] = $this->input->post('tugasbelajar_pejabat');
        $data['pegawaijabatan_tgl_pelantikan'] = y_m_d($this->input->post('tugasbelajar_mulai'));
        $data['pegawaijabatan_pangkat_id'] = 0;
        // $data['pegawaijabatan_pangkat_text'] = $this->ref_pangkat_golongan->get_row($data['pegawaijabatan_pangkat_id'])->pangkat_golongan_text;
        $data['pegawaijabatan_kenaikan_id'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->input->post('pegawaijabatan_kenaikan_id') : 0;
        $data['pegawaijabatan_kenaikan_nama'] = !empty($this->input->post('pegawaijabatan_kenaikan_id')) ? $this->ref_kenaikan_jabatan->get_row($data['pegawaijabatan_kenaikan_id'])->kenaikan_jabatan_nama : null;
        $data['pegawaijabatan_tahun'] = 0;
        $data['pegawaijabatan_bulan'] = 0;
        $data['pegawaijabatan_gaji'] = 0;
        $data['pegawaijabatan_angka_kredit'] = 0;


        $insert = $this->m_pegawai_jabatan->insert($data);
        // if (!empty($insert)) {
            // $this->update_jabatan_terakhir($nip);
        // }
    }

    private function update_jabatan_terakhir($nip)
    {
        $pangkat_terakhir = $this->m_pegawai_jabatan->get_jabatan_terakhir($nip);
        $data['pegawai_jenisjabatan_kode'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_id;
        $data['pegawai_jenisjabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_nama;
        $data['pegawai_jabatan_id'] = $pangkat_terakhir->pegawaijabatan_jabatan_id;
        $data['pegawai_jabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jabatan_nama;
        $data['pegawai_jabatan_tmt'] = $pangkat_terakhir->pegawaijabatan_tmt;
        $data['pegawai_unit_nama'] = $pangkat_terakhir->pegawaijabatan_unit_kerja_nama;
        $data['pegawai_unit_id'] = $pangkat_terakhir->pegawaijabatan_unit_kerja_id;
        $data['pegawai_eselon_nama'] = $pangkat_terakhir->pegawaijabatan_eselon_nama;
        $data['pegawai_eselon_id'] = $pangkat_terakhir->pegawaijabatan_eselon_id;
        $data['pegawai_jabatan_sk_nomor'] = $pangkat_terakhir->pegawaijabatan_sk_no;
        $data['pegawai_jabatan_sk_tanggal'] = $pangkat_terakhir->pegawaijabatan_sk_tanggal;
        // $data['pegawai_pendidikan_terakhir_tingkat_id'] = !empty($this->input->post('tugasbelajar_pendidikan_id')) ? $this->input->post('tugasbelajar_pendidikan_id') : 0;
        // $data['pegawai_pendidikan_terakhir_tingkat'] = !empty($this->input->post('tugasbelajar_pendidikan_tingkat_id')) ? $this->ref_pendidikan_tingkat->get_by_id($data['tugasbelajar_pendidikan_tingkat_id'])->pendidikan_tingkat_nama : '';
        $this->m_pegawai->update($data, $nip);
    }
}

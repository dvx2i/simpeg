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
class PegawaiRiwayatPendidikan extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_pendidikan', 'ref_pendidikan', 'ref_pendidikan_tingkat', 'ref_jurusan', 'm_pegawai'));
    }

    function index()
    {
    }

    function view($nip)
    {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_pendidikan->get_riwayat_pendidikan(array('pegawaipendidikan_pegawai_nip' => $nip));
        $data['pendidikan'] = $this->ref_pendidikan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['jurusan'] = $this->ref_jurusan->get_all();
        if (!empty($data['pegawai'])) {
            $this->loadView('pegawai/pegawai_riwayat_pendidikan', $data);
        } else {
            $this->loadView('error_nip');
        }
    }

    function add()
    {
        $nip = $this->input->post('nip');
        $data['pegawaipendidikan_pegawai_nip'] = $this->input->post('nip');
    // print_r($data['pegawaipendidikan_pegawai_nip']); die;
        $data['pegawaipendidikan_pendidikan_tingkat_id'] = $this->input->post('pegawaipendidikan_pendidikan_tingkat_id');
        $data['pegawaipendidikan_pendidikan_nama'] = $this->input->post('pegawaipendidikan_pendidikan_nama');
        $data['pegawaipendidikan_pendidikan_tingkat_nama'] = $this->ref_pendidikan_tingkat->get_row($data['pegawaipendidikan_pendidikan_tingkat_id'])->pendidikan_tingkat_nama;
        $data['pegawaipendidikan_jurusan_id'] = $this->input->post('pegawaipendidikan_jurusan_id');
        $data['pegawaipendidikan_jurusan_nama'] = $this->ref_jurusan->get_row($data['pegawaipendidikan_jurusan_id'])->jurusan_nama;
        $data['pegawaipendidikan_rumpun_id'] = !empty($this->input->post('pegawaipendidikan_rumpun_id')) ? $this->input->post('pegawaipendidikan_rumpun_id') : 0;
        if (!empty($this->input->post('pegawaipendidikan_rumpun_id'))) {
            $data['pegawaipendidikan_rumpun_nama'] = $this->ref_pendidikan->get_row($data['pegawaipendidikan_rumpun_id'])->pendidikan_nama;
        }
        $data['pegawaipendidikan_nomor_ijazah'] = $this->input->post('pegawaipendidikan_nomor_ijazah');
        $data['pegawaipendidikan_tanggal_ijazah'] = y_m_d($this->input->post('pegawaipendidikan_tanggal_ijazah'));
        $data['pegawaipendidikan_nama_pimpinan'] = $this->input->post('pegawaipendidikan_nama_pimpinan');
        $data['pegawaipendidikan_nilai'] = $this->input->post('pegawaipendidikan_nilai');
        $data['pegawaipendidikan_jenis'] = $this->input->post('pegawaipendidikan_jenis');
        $data['pegawaipendidikan_pengangkatan_cpns'] = $this->input->post('pegawaipendidikan_pengangkatan_cpns') == '1' ? '1' : '0';

        $insert = $this->m_pegawai_pendidikan->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Pendidikan Pegawai Berhasil"));
            $this->update_pendidikan_terakhir($data['pegawaipendidikan_pegawai_nip']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Pendidikan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatPendidikan/view/' . $nip . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaipendidikan_id');
        $nip = $this->input->post('nip');
        $data['pegawaipendidikan_pendidikan_tingkat_id'] = $this->input->post('pegawaipendidikan_pendidikan_tingkat_id');
        $data['pegawaipendidikan_pendidikan_nama'] = $this->input->post('pegawaipendidikan_pendidikan_nama');
        $data['pegawaipendidikan_pendidikan_tingkat_nama'] = $this->ref_pendidikan_tingkat->get_row($data['pegawaipendidikan_pendidikan_tingkat_id'])->pendidikan_tingkat_nama;
        //        $data['pegawaipendidikan_jurusan_id'] = $this->input->post('pegawaipendidikan_jurusan_id');
        //        $data['pegawaipendidikan_jurusan_nama'] = $this->ref_jurusan->get_row($data['pegawaipendidikan_jurusan_id'])->jurusan_nama;
        $data['pegawaipendidikan_rumpun_id'] = !empty($this->input->post('pegawaipendidikan_rumpun_id')) ? $this->input->post('pegawaipendidikan_rumpun_id') : 0;
        if (!empty($this->input->post('pegawaipendidikan_rumpun_id'))) {
            $data['pegawaipendidikan_rumpun_nama'] = $this->ref_pendidikan->get_row($data['pegawaipendidikan_rumpun_id'])->pendidikan_nama;
        }
        $data['pegawaipendidikan_nomor_ijazah'] = $this->input->post('pegawaipendidikan_nomor_ijazah');
        $data['pegawaipendidikan_tanggal_ijazah'] = y_m_d($this->input->post('pegawaipendidikan_tanggal_ijazah'));
        $data['pegawaipendidikan_nama_pimpinan'] = $this->input->post('pegawaipendidikan_nama_pimpinan');
        $data['pegawaipendidikan_nilai'] = $this->input->post('pegawaipendidikan_nilai');
        $data['pegawaipendidikan_jenis'] = $this->input->post('pegawaipendidikan_jenis');
        $data['pegawaipendidikan_pengangkatan_cpns'] = $this->input->post('pegawaipendidikan_pengangkatan_cpns') == '1' ? '1' : '0';

        $update = $this->m_pegawai_pendidikan->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Pendidikan Pegawai Berhasil"));
            $this->update_pendidikan_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Pendidikan Pegawai Gagal"));
        }
        //        print_r($data);
        redirect('pegawai/PegawaiRiwayatPendidikan/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_pendidikan->get_row($id)->pegawaipendidikan_pegawai_nip;
        $delete = $this->m_pegawai_pendidikan->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Pendidikan Pegawai Berhasil"));
            $this->update_pendidikan_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Pendidikan Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatPendidikan/view/' . $nip . '#riwayat');
        echo $nip;
    }

    public function update_pendidikan_terakhir($nip)
    {
        $pendidikan_terakhir = $this->m_pegawai_pendidikan->get_pendidikan_terakhir($nip);
        $data['pegawai_gelar_depan'] = $this->input->post('gelar_depan');
        $data['pegawai_gelar_belakang'] = $this->input->post('gelar_belakang');
        $data['pegawai_pendidikan_terakhir_id'] = $pendidikan_terakhir->pegawaipendidikan_id;
        $data['pegawai_pendidikan_terakhir_nama'] = $pendidikan_terakhir->pegawaipendidikan_pendidikan_nama;
        $data['pegawai_pendidikan_terakhir_jurusan'] = $pendidikan_terakhir->pegawaipendidikan_jurusan_nama;
        $data['pegawai_pendidikan_terakhir_rumpun'] = $pendidikan_terakhir->pegawaipendidikan_rumpun_nama;
        $data['pegawai_pendidikan_terakhir_no_ijazah'] = $pendidikan_terakhir->pegawaipendidikan_nomor_ijazah;
        $data['pegawai_pendidikan_terakhir_tgl_ijazah'] = $pendidikan_terakhir->pegawaipendidikan_tanggal_ijazah;
        $data['pegawai_pendidikan_terakhir_pejabat'] = $pendidikan_terakhir->pegawaipendidikan_nama_pimpinan;
        $data['pegawai_pendidikan_terakhir_tingkat_id'] = $pendidikan_terakhir->pegawaipendidikan_pendidikan_tingkat_id;
        $data['pegawai_pendidikan_terakhir_tingkat'] = $pendidikan_terakhir->pegawaipendidikan_pendidikan_tingkat_nama;
        $data['pegawai_pendidikan_terakhir_cpns'] = $pendidikan_terakhir->pegawaipendidikan_pengangkatan_cpns;
        $this->m_pegawai->update($data, $nip);
    }
}

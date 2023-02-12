<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiRiwayatKeluarga
 *
 * @author Zanuar
 */
class PegawaiKeluarga extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_pegawai_keluarga', 'ref_status_keluarga', 'ref_status_tunjangan', 'ref_pekerjaan', 'ref_jenis_kelamin', 'ref_status_perkawinan', 'ref_pendidikan_tingkat'));
    }

    function index()
    {
    }

    function view($nip)
    {
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        $data['result'] = $this->m_pegawai_keluarga->get_where(array('pegawaikeluarga_pegawai_nip' => $data['pegawai']->pegawai_nip));
        $data['status_keluarga'] = $this->ref_status_keluarga->get_all();
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['status_tunjangan'] = $this->ref_status_tunjangan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['pekerjaan'] = $this->ref_pekerjaan->get_all();

        if ($this->cek_admin_opd($data['pegawai'])) {
            $this->loadView('pegawai/pegawai_keluarga', $data);
        } else {
            redirect('pegawai/Pegawai');
        }
    }

    function add()
    {
        $nip = $this->input->post('nip');
        $data['pegawaikeluarga_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaikeluarga_nama'] = $this->input->post('pegawaikeluarga_nama');
        $data['pegawaikeluarga_status_keluarga_id'] = !empty($this->input->post('pegawaikeluarga_status_keluarga_id')) ? $this->input->post('pegawaikeluarga_status_keluarga_id') : 0;
        $data['pegawaikeluarga_status_keluarga_nama'] = !empty($this->input->post('pegawaikeluarga_status_keluarga_id')) ? $this->ref_status_keluarga->get_row($data['pegawaikeluarga_status_keluarga_id'])->statuskeluarga_nama : '';
        $data['pegawaikeluarga_tempat_lahir'] = $this->input->post('pegawaikeluarga_tempat_lahir');
        $data['pegawaikeluarga_tanggal_lahir'] =  y_m_d($this->input->post('pegawaikeluarga_tanggal_lahir'));
        $data['pegawaikeluarga_status_perkawinan_id'] = !empty($this->input->post('pegawaikeluarga_status_perkawinan_id')) ? $this->input->post('pegawaikeluarga_status_perkawinan_id') : 0;
        $data['pegawaikeluarga_status_perkawinan_nama'] = !empty($this->input->post('pegawaikeluarga_status_perkawinan_id')) ? $this->ref_status_perkawinan->get_row($data['pegawaikeluarga_status_perkawinan_id'])->status_perkawinan_nama : '';
        $data['pegawaikeluarga_tanggal_menikah'] = y_m_d($this->input->post('pegawaikeluarga_tanggal_menikah'));
        $data['pegawaikeluarga_pekerjaan_id'] = !empty($this->input->post('pegawaikeluarga_pekerjaan')) ? $this->input->post('pegawaikeluarga_pekerjaan') : 0;
        $data['pegawaikeluarga_pekerjaan'] = !empty($this->input->post('pegawaikeluarga_pekerjaan')) ? $this->ref_pekerjaan->get_row($data['pegawaikeluarga_pekerjaan_id'])->pekerjaan_nama : '';
        $data['pegawaikeluarga_status_tunjangan_id'] = !empty($this->input->post('pegawaikeluarga_status_tunjangan')) ? $this->input->post('pegawaikeluarga_status_tunjangan') : 0;
        $data['pegawaikeluarga_status_tunjangan'] = !empty($this->input->post('pegawaikeluarga_status_tunjangan')) ? $this->ref_status_tunjangan->get_row($data['pegawaikeluarga_status_tunjangan_id'])->status_tunjangan_nama : '';
        $data['pegawaikeluarga_jenkel_id'] = !empty($this->input->post('pegawaikeluarga_jenkel_id')) ? $this->input->post('pegawaikeluarga_jenkel_id') : 0;
        $data['pegawaikeluarga_jenkel_nama'] = !empty($this->input->post('pegawaikeluarga_jenkel_id')) ? $this->ref_jenis_kelamin->get_row($data['pegawaikeluarga_jenkel_id'])->jenkel_nama : '';
        $data['pegawaikeluarga_pendidikan_id'] = !empty($this->input->post('pegawaikeluarga_pendidikan_id')) ? $this->input->post('pegawaikeluarga_pendidikan_id') : 0;
        $data['pegawaikeluarga_pendidikan_nama'] = !empty($this->input->post('pegawaikeluarga_pendidikan_id')) ? $this->ref_pendidikan_tingkat->get_row($data['pegawaikeluarga_pendidikan_id'])->pendidikan_tingkat_nama : '';
        $data['pegawaikeluarga_nip_nrp'] = $this->input->post('pegawaikeluarga_nip_nrp');
        $data['pegawaikeluarga_keterangan'] = $this->input->post('pegawaikeluarga_keterangan');
        $data['pegawaikeluarga_alamat'] = $this->input->post('pegawaikeluarga_alamat');
        $data['pegawaikeluarga_urut'] = !empty($this->input->post('pegawaikeluarga_urut')) ? $this->input->post('pegawaikeluarga_urut') : 0;

        $insert = $this->m_pegawai_keluarga->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Keluarga Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Keluarga Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKeluarga/view/' . $nip . '#riwayat');
    }

    function update()
    {
        $id = $this->input->post('pegawaikeluarga_id');
        $nip = $this->input->post('nip');
        $data['pegawaikeluarga_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaikeluarga_nama'] = $this->input->post('pegawaikeluarga_nama');
        $data['pegawaikeluarga_status_keluarga_id'] = !empty($this->input->post('pegawaikeluarga_status_keluarga_id')) ? $this->input->post('pegawaikeluarga_status_keluarga_id') : 0;
        $data['pegawaikeluarga_status_keluarga_nama'] = !empty($this->input->post('pegawaikeluarga_status_keluarga_id')) ? $this->ref_status_keluarga->get_row($data['pegawaikeluarga_status_keluarga_id'])->statuskeluarga_nama : '';
        $data['pegawaikeluarga_tempat_lahir'] = $this->input->post('pegawaikeluarga_tempat_lahir');
        $data['pegawaikeluarga_tanggal_lahir'] =  y_m_d($this->input->post('pegawaikeluarga_tanggal_lahir'));
        $data['pegawaikeluarga_status_perkawinan_id'] = !empty($this->input->post('pegawaikeluarga_status_perkawinan_id')) ? $this->input->post('pegawaikeluarga_status_perkawinan_id') : 0;
        $data['pegawaikeluarga_status_perkawinan_nama'] = !empty($this->input->post('pegawaikeluarga_status_perkawinan_id')) ? $this->ref_status_perkawinan->get_row($data['pegawaikeluarga_status_perkawinan_id'])->status_perkawinan_nama : '';
        $data['pegawaikeluarga_tanggal_menikah'] = y_m_d($this->input->post('pegawaikeluarga_tanggal_menikah'));
        $data['pegawaikeluarga_pekerjaan_id'] = !empty($this->input->post('pegawaikeluarga_pekerjaan')) ? $this->input->post('pegawaikeluarga_pekerjaan') : 0;
        $data['pegawaikeluarga_pekerjaan'] = !empty($this->input->post('pegawaikeluarga_pekerjaan')) ? $this->ref_pekerjaan->get_row($data['pegawaikeluarga_pekerjaan_id'])->pekerjaan_nama : '';
        $data['pegawaikeluarga_status_tunjangan_id'] = !empty($this->input->post('pegawaikeluarga_status_tunjangan')) ? $this->input->post('pegawaikeluarga_status_tunjangan') : 0;
        $data['pegawaikeluarga_status_tunjangan'] = !empty($this->input->post('pegawaikeluarga_status_tunjangan')) ? $this->ref_status_tunjangan->get_row($data['pegawaikeluarga_status_tunjangan_id'])->status_tunjangan_nama : '';
        $data['pegawaikeluarga_jenkel_id'] = !empty($this->input->post('pegawaikeluarga_jenkel_id')) ? $this->input->post('pegawaikeluarga_jenkel_id') : 0;
        $data['pegawaikeluarga_jenkel_nama'] = !empty($this->input->post('pegawaikeluarga_jenkel_id')) ? $this->ref_jenis_kelamin->get_row($data['pegawaikeluarga_jenkel_id'])->jenkel_nama : '';
        $data['pegawaikeluarga_pendidikan_id'] = !empty($this->input->post('pegawaikeluarga_pendidikan_id')) ? $this->input->post('pegawaikeluarga_pendidikan_id') : 0;
        $data['pegawaikeluarga_pendidikan_nama'] = !empty($this->input->post('pegawaikeluarga_pendidikan_id')) ? $this->ref_pendidikan_tingkat->get_row($data['pegawaikeluarga_pendidikan_id'])->pendidikan_tingkat_nama : '';
        $data['pegawaikeluarga_nip_nrp'] = $this->input->post('pegawaikeluarga_nip_nrp');
        $data['pegawaikeluarga_keterangan'] = $this->input->post('pegawaikeluarga_keterangan');
        $data['pegawaikeluarga_alamat'] = $this->input->post('pegawaikeluarga_alamat');
        $data['pegawaikeluarga_urut'] = !empty($this->input->post('pegawaikeluarga_urut')) ? $this->input->post('pegawaikeluarga_urut') : 0;


        $insert = $this->m_pegawai_keluarga->update($data, $id);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Keluarga Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Keluarga Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKeluarga/view/' . $nip . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_keluarga->get_row($id)->pegawaikeluarga_pegawai_nip;
        $delete = $this->m_pegawai_keluarga->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Keluarga Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Keluarga Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiKeluarga/view/' . $nip . '#riwayat');
        echo $nip;
    }
}

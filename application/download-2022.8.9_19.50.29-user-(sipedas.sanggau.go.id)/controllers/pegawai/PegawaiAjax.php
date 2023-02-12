<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiAjax
 *
 * @author Zanuar
 */
class PegawaiAjax extends CI_Controller
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }
    public function getPegawaiByNip()
    {
        $this->load->model('m_pegawai');
        $nip = $this->input->post('nip');
        $output = $this->m_pegawai->get_where(array('pegawai_nip' => $nip));
        jsonResponse($output->result(), 1);
    }
    public function getRowPegawaiByNip()
    {
        $this->load->model('m_pegawai');
        $nip = $this->input->post('nip');
        $output = $this->m_pegawai->get_where(array('pegawai_nip' => $nip));
        jsonResponse($output->row(), 1);
    }
    public function getPegawaiPangkatById()
    {
        $this->load->model('m_pegawai_pangkat');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pangkat->get_row($id);
        jsonResponse($output, 1);
    }
    public function getPegawaiJabatanById()
    {
        $this->load->model('m_pegawai_jabatan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_jabatan->get_row($id);
        jsonResponse($output, 1);
    }

    public function getPegawaiKgbById()
    {
        $this->load->model('m_pegawai_kgb');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kgb->get_row($id);
        jsonResponse($output, 1);
    }

    public function getPegawaiPendidikanById()
    {
        $this->load->model('m_pegawai_pendidikan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pendidikan->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiDiklatById()
    {
        $this->load->model('m_pegawai_diklat');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_diklat->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiById()
    {
        $this->load->model('m_pegawai_cuti');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiOnlineById()
    {
        $this->load->model('m_pegawai_cuti_online');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti_online->get_by_id($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiOnlineBerkasById()
    {
        $this->load->model('m_pegawai_cuti_online');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti_online->getBerkasByPermohonan($id);
        jsonResponse($output, 1);
    }

    function getPegawaiTandaJasaById()
    {
        $this->load->model('m_pegawai_tanda_jasa');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_tanda_jasa->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKunjunganById()
    {
        $this->load->model('m_pegawai_kunjungan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kunjungan->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiOrganisasiById()
    {
        $this->load->model('m_pegawai_organisasi');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_organisasi->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiPengalamanKerjaById()
    {
        $this->load->model('m_pegawai_pengalaman_kerja');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pengalaman_kerja->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiBahasaById()
    {
        $this->load->model('m_pegawai_bahasa');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_bahasa->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiTugasBelajarById()
    {
        $this->load->model('m_pegawai_tugas_belajar');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_tugas_belajar->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiDisiplinById()
    {
        $this->load->model('m_pegawai_disiplin');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_disiplin->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKaryaTulisById()
    {
        $this->load->model('m_pegawai_karya_tulis');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_karya_tulis->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKeluargaById()
    {
        $this->load->model('m_pegawai_keluarga');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_keluarga->get_row($id);
        jsonResponse($output, 1);
    }

    function getSkKgb()
    {
        $this->load->model('m_pegawai_kgb_bpkad');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kgb_bpkad->get_sk($id);
        jsonResponse($output, 1);
    }

    function getSkPangkat()
    {
        $this->load->model('m_pegawai_pangkat_bpkad');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pangkat_bpkad->get_sk($id);
        jsonResponse($output, 1);
    }
}

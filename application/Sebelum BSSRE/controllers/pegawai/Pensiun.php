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
class Pensiun extends MY_Controller {

    //put your code here
    var $page = 'pegawai/Pensiun';

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
        if (!$this->cek_admin()) {
            redirect('pegawai/Pegawai');
        }
    }

    function index() {
        $data['result'] = $this->m_pegawai->get_pegawai_pensiun();
        $this->loadView('pegawai/pensiun', $data);
    }
    
    function delete($nip) {
//        $nip = $this->input->post('nip');
        $data['pegawai_status'] = 1;
        $update = $this->m_pegawai->update($data,$nip);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update Pensiun Pegawai Berhasil "));
        }
        redirect('pegawai/Pegawai/');
    }

    function add() {
        $this->load->model(array('ref_propinsi', 'ref_kabupaten', 'ref_kecamatan', 'ref_kelurahan'));
        $data['pegawai_nip'] = $this->input->post('nip');
        $data['pegawai_nama'] = $this->input->post('nama');
        $data['pegawai_gelar_depan'] = $this->input->post('gelar_depan');
        $data['pegawai_gelar_belakang'] = $this->input->post('gelar_belakang');
        $data['pegawai_propinsi_id'] = $this->input->post('propinsi');
        $data['pegawai_propinsi_nama'] = $this->input->post($this->ref_propinsi->get_row($data['pegawai_propinsi_id'])->propinsi_nama);
        $data['pegawai_kabupaten_id'] = $this->input->post('kabupaten');
        $data['pegawai_kabupaten_nama'] = $this->input->post($this->ref_kabupaten->get_row($data['pegawai_kabupaten_id'])->kabupaten_nama);
        $data['pegawai_kecamatan_id'] = $this->input->post('kecamatan');
        $data['pegawai_kecamatan_nama'] = $this->input->post($this->ref_kecamatan->get_row($data['pegawai_kecamatan_id'])->kecamatan_nama);
        $data['pegawai_kelurahan_id'] = $this->input->post('kelurahan');
        $data['pegawai_kelurahan_nama'] = $this->input->post($this->ref_kelurahan->get_row($data['pegawai_kelurahan_id'])->kelurahan_nama);
        $data['pegawai_unit_id'] = $this->input->post('unit');
        $data['pegawai_unit_nama'] = $this->input->post($this->ref_unit->get_row($data['pegawai_unit_id'])->unit_nama);
        $data['pegawai_nip_lama'] = $this->input->post('nip_lama');
        $data['pegawai_tempat_lahir'] = $this->input->post('tempat_lahir');
        $data['pegawai_tgl_lahir'] = $this->input->post('tgl_lahir');
        $data['pegawai_jenkel_id'] = $this->input->post('jenis_kelamin');
        $data['pegawai_jenkel_nama'] = 'PEREMPUAN';
        if($data['pegawai_jenkel_id']==1){
            $data['pegawai_jenkel_nama'] = 'LAKI-LAKI';
        }
        $data['pegawai_golongandarah_id'] = $this->input->post('golongan_darah');
        $data['pegawai_agama_id'] = $this->input->post('agama');
        $data['pegawai_agama_nama'] = $this->input->post($this->ref_agama->get_row($data['pegawai_agama_id'])->agama_nama);
        $data['pegawai_statusperkawinan_id'] = $this->input->post('kawin');
        $data['pegawai_statusperkawinan_nama'] = $this->input->post($this->ref_status_perkawinan->get_row($data['pegawai_statusperkawinan_id'])->status_perkawinan_nama);
        $data['pegawai_alamat'] = $this->input->post('jalan');
        $data['pegawai_rw'] = $this->input->post('rw');
        $data['pegawai_rt'] = $this->input->post('rt');
        $data['pegawai_telpon'] = $this->input->post('telp');
        $data['pegawai_kodepos'] = $this->input->post('kode_pos');
        $data['pegawai_hp'] = $this->input->post('hp');
        $data['pegawai_email'] = $this->input->post('email');
        $data['pegawai_status_kepegawaian_id'] = $this->input->post('status_pegawai');
        $data['pegawai_status_kepegawaian_nama'] = $this->ref_status_kepegawaian->get_row($data['pegawai_status_kepegawaian_id'])->statuskepegawaian_nama;
        $data['pegawai_no_karpeg'] = $this->input->post('karpeg');
        $data['pegawai_no_askes'] = $this->input->post('askes');
        $data['pegawai_no_taspen'] = $this->input->post('taspen');
        $data['pegawai_no_karis'] = $this->input->post('karis_karsu');
        $data['pegawai_no_npwp'] = $this->input->post('npwp');
        $data['pegawai_no_kk'] = $this->input->post('kk');
        $data['pegawai_no_ktp'] = $this->input->post('ktp');
        $data['pegawai_jenisjabatan_kode'] = $this->input->post('jenis_jabatan');
        $data['pegawai_jenisjabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenisjabatan_kode'])->jeniskedudukan_nama;
//        $data['pegawai_foto_kpe'] = $this->input->post('');
        $upload = $this->upload_file($data['pegawai_nip']);
        if($upload){
        $data['pegawai_foto_kpe'] = $this->upload->data()['file_name'];
        }
        $insert = $this->m_pegawai->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Pegawai Berhasil"));
        }
        redirect('pegawai/PegawaiIdentitas/view/'.$data['pegawai_nip']);
    }

    function update() {
        $this->load->model(array('ref_propinsi', 'ref_kabupaten', 'ref_kecamatan', 'ref_kelurahan'));
        $nip = $this->input->post('nip');
        $data['pegawai_nama'] = $this->input->post('nama');
        $data['pegawai_gelar_depan'] = $this->input->post('gelar_depan');
        $data['pegawai_gelar_belakang'] = $this->input->post('gelar_belakang');
        $data['pegawai_propinsi_id'] = $this->input->post('propinsi');
        $data['pegawai_propinsi_nama'] = $this->ref_propinsi->get_row($data['pegawai_propinsi_id'])->propinsi_nama;
        $data['pegawai_kabupaten_id'] = $this->input->post('kabupaten');
        $data['pegawai_kabupaten_nama'] = ($this->ref_kabupaten->get_row($data['pegawai_kabupaten_id'])->kabupaten_nama);
        $data['pegawai_kecamatan_id'] = $this->input->post('kecamatan');
        $data['pegawai_kecamatan_nama'] = ($this->ref_kecamatan->get_row($data['pegawai_kecamatan_id'])->kecamatan_nama);
        $data['pegawai_kelurahan_id'] = $this->input->post('kelurahan');
        $data['pegawai_kelurahan_nama'] = ($this->ref_kelurahan->get_row($data['pegawai_kelurahan_id'])->kelurahan_nama);
        $data['pegawai_unit_id'] = $this->input->post('unit');
        $data['pegawai_unit_nama'] = ($this->ref_unit->get_row($data['pegawai_unit_id'])->unit_nama);
        $data['pegawai_nip_lama'] = $this->input->post('nip_lama');
        $data['pegawai_tempat_lahir'] = $this->input->post('tempat_lahir');
        $data['pegawai_tgl_lahir'] = $this->input->post('tgl_lahir');
        $data['pegawai_jenkel_id'] = $this->input->post('jenis_kelamin');
        $data['pegawai_jenkel_nama'] = 'PEREMPUAN';
        if($data['pegawai_jenkel_id']==1){
            $data['pegawai_jenkel_nama'] = 'LAKI-LAKI';
        }
        $data['pegawai_golongandarah_id'] = $this->input->post('golongan_darah');
        $data['pegawai_agama_id'] = $this->input->post('agama');
        $data['pegawai_agama_nama'] = ($this->ref_agama->get_row($data['pegawai_agama_id'])->agama_nama);
        $data['pegawai_statusperkawinan_id'] = $this->input->post('kawin');
        $data['pegawai_statusperkawinan_nama'] = ($this->ref_status_perkawinan->get_row($data['pegawai_statusperkawinan_id'])->status_perkawinan_nama);
        $data['pegawai_alamat'] = $this->input->post('jalan');
        $data['pegawai_rw'] = $this->input->post('rw');
        $data['pegawai_rt'] = $this->input->post('rt');
        $data['pegawai_telpon'] = $this->input->post('telp');
        $data['pegawai_kodepos'] = $this->input->post('kode_pos');
        $data['pegawai_hp'] = $this->input->post('hp');
        $data['pegawai_email'] = $this->input->post('email');
        $data['pegawai_status_kepegawaian_id'] = $this->input->post('status_pegawai');
        $data['pegawai_status_kepegawaian_nama'] = $this->ref_status_kepegawaian->get_row($data['pegawai_status_kepegawaian_id'])->statuskepegawaian_nama;
        $data['pegawai_no_karpeg'] = $this->input->post('karpeg');
        $data['pegawai_no_askes'] = $this->input->post('askes');
        $data['pegawai_no_taspen'] = $this->input->post('taspen');
        $data['pegawai_no_karis'] = $this->input->post('karis_karsu');
        $data['pegawai_no_npwp'] = $this->input->post('npwp');
        $data['pegawai_no_kk'] = $this->input->post('kk');
        $data['pegawai_no_ktp'] = $this->input->post('ktp');
        $data['pegawai_jenisjabatan_kode'] = $this->input->post('jenis_jabatan');
        $data['pegawai_jenisjabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenisjabatan_kode'])->jeniskedudukan_nama;
        $upload = $this->upload_file($nip);
        if($upload){
        $data['pegawai_foto_kpe'] = $this->upload->data()['file_name'];
        }
        $update = $this->m_pegawai->update($data,$nip);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update identitas Pegawai Berhasil ".$this->upload->display_errors()));
        }
        redirect('pegawai/PegawaiIdentitas/view/'.$nip);
    }
    
    public function detail($nip) {
        $data['pilihan_tampil'] = 'detail';
        $data['pegawai'] = $this->m_pegawai->get_row($nip);
        if (blank($data['pegawai'])) {
            $this->loadView('errors/php/error_404', $data);
        } else {
            $this->load->model(array('m_pegawai_pangkat','m_pegawai_jabatan','m_pegawai_kgb','m_pegawai_pendidikan','m_pegawai_diklat','m_pegawai_tanda_jasa','m_pegawai_kunjungan','m_pegawai_organisasi','m_pegawai_pengalaman_kerja','m_pegawai_bahasa','m_pegawai_tugas_belajar','m_pegawai_disiplin','m_pegawai_karya_tulis','m_pegawai_keluarga','m_pegawai_kunjungan'));
            $data['pegawai_pangkat'] = $this->m_pegawai_pangkat->get_where(array('pegawaipangkat_pegawai_nip' => $nip));
            $data['pegawai_jabatan'] = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_pegawai_nip' => $nip));
            $data['pegawai_pendidikan'] = $this->m_pegawai_pendidikan->get_where(array('pegawaipendidikan_pegawai_nip' => $nip));
            $data['pegawai_diklat_penjenjangan'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'STRUKTURAL','diklat_pegawai_nip' => $nip));
            $data['pegawai_diklat_fungsional'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'FUNGSIONAL','diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_teknis'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'TEKNIS','diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_penataran'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'PENATARAN','diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_seminar'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'SEMINAR','diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_kursus'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'KURSUS','diklat_pegawai_nip' => $nip));
            $data['riwayat_penghargaan'] = $this->m_pegawai_tanda_jasa->get_where(array('pegawaijasa_pegawai_nip' => $nip));
            $data['riwayat_penugasan'] = $this->m_pegawai_kunjungan->get_where(array('pegawaitugas_pegawai_nip' => $nip));
            $data['riwayat_organisasi'] = $this->m_pegawai_organisasi->get_where(array('pegawaiorg_pegawai_nip' => $nip));
            $data['riwayat_pengalaman_kerja'] = $this->m_pegawai_pengalaman_kerja->get_where(array('pegawaikerja_pegawai_nip' => $nip));
            $data['riwayat_penguasaan_bahasa'] = $this->m_pegawai_bahasa->get_where(array('pegawaibahasa_pegawai_nip' => $nip));
            $data['riwayat_tugas_belajar'] = $this->m_pegawai_tugas_belajar->get_where(array('tugasbelajar_pegawai_nip' => $nip));
            $data['riwayat_hukuman'] = $this->m_pegawai_disiplin->get_where(array('pegawaidisiplin_pegawai_nip' => $nip));
            $data['keluarga'] = $this->m_pegawai_keluarga->get_where(array('pegawaikeluarga_pegawai_nip' => $nip));
            $data['kgb_terakhir'] = $this->m_pegawai_kgb->get_kgb_terakhir($nip)->row();
            $data['jabatan_terakhir'] = $this->m_pegawai_jabatan->get_jabatan_terakhir($nip);
            $data['pendidikan_terakhir'] = $this->m_pegawai_pendidikan->get_pendidikan_terakhir($nip);
            $data['diklat_terakhir'] = $this->m_pegawai_diklat->get_diklat_struktural_terakhir($nip)->row();
            $this->loadView('pegawai/pegawai_detail', $data);
        }
    }
    
    public function upload_file($filename) {
        if (!empty($_FILES['userfile']['name'])) {
            $config['upload_path'] = 'assets/images';
            $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG';
            $config['overwrite'] = true;
            $config['create_thumb'] = false;
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                echo 'error 1 ' . $this->upload->display_errors();
                return false;
            } else {
                return true;
            }
        } else {
            echo 'ksosong';
            return false;
        }
    }

}

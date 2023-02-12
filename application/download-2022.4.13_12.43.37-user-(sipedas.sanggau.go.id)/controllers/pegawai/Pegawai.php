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
class Pegawai extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_jabatan_fungsional', 'ref_agama', 'ref_eselon', 'ref_jabatan_struktural', 'ref_pendidikan_tingkat', 'ref_pangkat_golongan', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
    }

    function index()
    {
        $data['result'] = '';
        $data['jenis_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['unit'] = $this->ref_unit->get_unit();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_all();
        $data['pendidikan_tingkat'] = $this->ref_pendidikan_tingkat->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['eselon'] = $this->ref_eselon->get_all();
        $this->loadView('pegawai/pegawai', $data);
    }

    function add()
    {
        $this->load->model(array('ref_propinsi', 'ref_kabupaten', 'ref_kecamatan', 'ref_kelurahan'));
        $data['pegawai_nip'] = $this->input->post('nip');
        $data['pegawai_nama'] = $this->input->post('nama');
        $data['pegawai_gelar_depan'] = $this->input->post('gelar_depan');
        $data['pegawai_gelar_belakang'] = $this->input->post('gelar_belakang');
        $data['pegawai_propinsi_id'] = !empty($this->input->post('propinsi')) ? $this->input->post('propinsi') : 0;
        $data['pegawai_propinsi_nama'] = !empty($this->input->post('propinsi')) ? $this->ref_propinsi->get_row($data['pegawai_propinsi_id'])->propinsi_nama : '';
        $data['pegawai_kabupaten_id'] = !empty($this->input->post('kabupaten')) ? $this->input->post('kabupaten') : 0;
        $data['pegawai_kabupaten_nama'] = !empty($this->input->post('kabupaten')) ? $this->ref_kabupaten->get_row($data['pegawai_kabupaten_id'])->kabupaten_nama : '';
        $data['pegawai_kecamatan_id'] = !empty($this->input->post('kecamatan')) ? $this->input->post('kecamatan') : 0;
        $data['pegawai_kecamatan_nama'] = !empty($this->input->post('kecamatan')) ? $this->ref_kecamatan->get_row($data['pegawai_kecamatan_id'])->kecamatan_nama : '';
        $data['pegawai_kelurahan_id'] = !empty($this->input->post('kelurahan')) ? $this->input->post('kelurahan') : 0;
        $data['pegawai_kelurahan_nama'] = !empty($this->input->post('kelurahan')) ? $this->ref_kelurahan->get_row($data['pegawai_kelurahan_id'])->kelurahan_nama : '';
        $data['pegawai_unit_id'] = 0;
        $data['pegawai_unit_nama'] = '';
        $data['pegawai_nip_lama'] = $this->input->post('nip_lama');
        $data['pegawai_tempat_lahir'] = $this->input->post('tempat_lahir');
        $data['pegawai_tgl_lahir'] = y_m_d($this->input->post('tgl_lahir'));
        $data['pegawai_jenkel_id'] = !empty($this->input->post('jenis_kelamin')) ? $this->input->post('jenis_kelamin') : 0;
        $data['pegawai_jenkel_nama'] = 'PEREMPUAN';
        if ($data['pegawai_jenkel_id'] == 1) {
            $data['pegawai_jenkel_nama'] = 'LAKI-LAKI';
        }
        $data['pegawai_golongandarah_id'] = !empty($this->input->post('golongan_darah')) ? $this->input->post('golongan_darah') : 0;
        $data['pegawai_agama_id'] = !empty($this->input->post('agama')) ? $this->input->post('agama') : 0;
        $data['pegawai_agama_nama'] = !empty($this->input->post('agama')) ? $this->ref_agama->get_row($data['pegawai_agama_id'])->agama_nama : '';
        $data['pegawai_statusperkawinan_id'] = !empty($this->input->post('kawin')) ? $this->input->post('kawin') : 0;
        $data['pegawai_statusperkawinan_nama'] = !empty($this->input->post('kawin')) ? $this->ref_status_perkawinan->get_row($data['pegawai_statusperkawinan_id'])->status_perkawinan_nama : '';
        $data['pegawai_alamat'] = $this->input->post('jalan');
        $data['pegawai_rw'] = $this->input->post('rw');
        $data['pegawai_rt'] = $this->input->post('rt');
        $data['pegawai_telpon'] = $this->input->post('telp');
        $data['pegawai_kodepos'] = $this->input->post('kode_pos');
        $data['pegawai_hp'] = $this->input->post('hp');
        $data['pegawai_email'] = $this->input->post('email');
        $data['pegawai_status_kepegawaian_id'] = !empty($this->input->post('status_pegawai')) ? $this->input->post('status_pegawai') : 0;
        $data['pegawai_status_kepegawaian_nama'] = !empty($this->input->post('status_pegawai')) ? $this->ref_status_kepegawaian->get_row($data['pegawai_status_kepegawaian_id'])->statuskepegawaian_nama : '';
        $data['pegawai_no_karpeg'] = $this->input->post('karpeg');
        $data['pegawai_no_askes'] = $this->input->post('askes');
        $data['pegawai_no_taspen'] = $this->input->post('taspen');
        $data['pegawai_no_karis'] = $this->input->post('karis_karsu');
        $data['pegawai_no_npwp'] = $this->input->post('npwp');
        $data['pegawai_no_kk'] = $this->input->post('kk');
        $data['pegawai_no_ktp'] = $this->input->post('ktp');
        $data['pegawai_jenisjabatan_kode'] = !empty($this->input->post('jenis_jabatan')) ? $this->input->post('jenis_jabatan') : 99;
        $data['pegawai_jenisjabatan_nama'] = !empty($this->input->post('jenis_jabatan')) ? $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenisjabatan_kode'])->jeniskedudukan_nama : '';
        //        $data['pegawai_foto_kpe'] = $this->input->post('');
        $data['pegawai_masuk_sanggau'] = $this->input->post('pegawai_masuk_sanggau') == '1' ? '1' : '0';
        $upload = $this->upload_file($data['pegawai_nip']);
        if ($upload) {
            $data['pegawai_foto_kpe'] = $this->upload->data()['file_name'];
        }
        $insert = $this->m_pegawai->insert($data);
        if (!empty($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah Pegawai Berhasil"));
        }
        redirect('pegawai/PegawaiIdentitas/view/' . $data['pegawai_nip']);
    }

    function update()
    {
        $this->load->model(array('ref_propinsi', 'ref_kabupaten', 'ref_kecamatan', 'ref_kelurahan', 'm_pegawai_pangkat', 'm_pegawai_jabatan', 'm_pegawai_kgb', 'm_pegawai_pendidikan', 'm_pegawai_diklat', 'm_pegawai_tanda_jasa', 'm_pegawai_kunjungan', 'm_pegawai_organisasi', 'm_pegawai_pengalaman_kerja', 'm_pegawai_bahasa', 'm_pegawai_tugas_belajar', 'm_pegawai_disiplin', 'm_pegawai_karya_tulis', 'm_pegawai_keluarga'));
        $nip = $this->input->post('nip');
        $nip_update = $this->input->post('nip_update');
        $this->db->trans_begin();

        if ($this->session->userdata('login')['group_id'] == '1' && $nip != $nip_update) {
            $data['pegawai_nip'] = $nip_update;
            // echo $nip_update;
            // die;
        }
        // echo $nip;
        // die;
        $data['pegawai_nama'] = $this->input->post('nama');
        $data['pegawai_gelar_depan'] = $this->input->post('gelar_depan');
        $data['pegawai_gelar_belakang'] = $this->input->post('gelar_belakang');
        $data['pegawai_propinsi_id'] = !empty($this->input->post('propinsi')) ? $this->input->post('propinsi') : 0;
        $data['pegawai_propinsi_nama'] = !empty($this->input->post('propinsi')) ? $this->ref_propinsi->get_row($data['pegawai_propinsi_id'])->propinsi_nama : '';
        $data['pegawai_kabupaten_id'] = !empty($this->input->post('kabupaten')) ? $this->input->post('kabupaten') : 0;
        $data['pegawai_kabupaten_nama'] = !empty($this->input->post('kabupaten')) ? $this->ref_kabupaten->get_row($data['pegawai_kabupaten_id'])->kabupaten_nama : '';
        $data['pegawai_kecamatan_id'] = !empty($this->input->post('kecamatan')) ? $this->input->post('kecamatan') : 0;
        $data['pegawai_kecamatan_nama'] = !empty($this->input->post('kecamatan')) ? $this->ref_kecamatan->get_row($data['pegawai_kecamatan_id'])->kecamatan_nama : '';
        $data['pegawai_kelurahan_id'] = !empty($this->input->post('kelurahan')) ? $this->input->post('kelurahan') : 0;
        $data['pegawai_kelurahan_nama'] = !empty($this->input->post('kelurahan')) ? $this->ref_kelurahan->get_row($data['pegawai_kelurahan_id'])->kelurahan_nama : '';
        $data['pegawai_nip_lama'] = $this->input->post('nip_lama');
        $data['pegawai_tempat_lahir'] = $this->input->post('tempat_lahir');
        $data['pegawai_tgl_lahir'] = y_m_d($this->input->post('tgl_lahir'));
        $data['pegawai_jenkel_id'] = !empty($this->input->post('jenis_kelamin')) ? $this->input->post('jenis_kelamin') : 0;
        $data['pegawai_jenkel_nama'] = 'PEREMPUAN';
        if ($data['pegawai_jenkel_id'] == 1) {
            $data['pegawai_jenkel_nama'] = 'LAKI-LAKI';
        }
        $data['pegawai_golongandarah_id'] = !empty($this->input->post('golongan_darah')) ? $this->input->post('golongan_darah') : 0;
        $data['pegawai_agama_id'] = !empty($this->input->post('agama')) ? $this->input->post('agama') : 0;
        $data['pegawai_agama_nama'] = !empty($this->input->post('agama')) ? $this->ref_agama->get_row($data['pegawai_agama_id'])->agama_nama : '';
        $data['pegawai_statusperkawinan_id'] = !empty($this->input->post('kawin')) ? $this->input->post('kawin') : 0;
        $data['pegawai_statusperkawinan_nama'] = !empty($this->input->post('kawin')) ? $this->ref_status_perkawinan->get_row($data['pegawai_statusperkawinan_id'])->status_perkawinan_nama : '';
        $data['pegawai_alamat'] = $this->input->post('jalan');
        $data['pegawai_rw'] = $this->input->post('rw');
        $data['pegawai_rt'] = $this->input->post('rt');
        $data['pegawai_telpon'] = $this->input->post('telp');
        $data['pegawai_kodepos'] = $this->input->post('kode_pos');
        $data['pegawai_hp'] = $this->input->post('hp');
        $data['pegawai_email'] = $this->input->post('email');
        $data['pegawai_status_kepegawaian_id'] = !empty($this->input->post('status_pegawai')) ? $this->input->post('status_pegawai') : 0;
        $data['pegawai_status_kepegawaian_nama'] = !empty($this->input->post('status_pegawai')) ? $this->ref_status_kepegawaian->get_row($data['pegawai_status_kepegawaian_id'])->statuskepegawaian_nama : '';
        $data['pegawai_no_karpeg'] = $this->input->post('karpeg');
        $data['pegawai_no_askes'] = $this->input->post('askes');
        $data['pegawai_no_taspen'] = $this->input->post('taspen');
        $data['pegawai_no_karis'] = $this->input->post('karis_karsu');
        $data['pegawai_no_npwp'] = $this->input->post('npwp');
        $data['pegawai_no_kk'] = $this->input->post('kk');
        $data['pegawai_no_ktp'] = $this->input->post('ktp');
        $data['pegawai_jenisjabatan_kode'] = !empty($this->input->post('jenis_jabatan')) ? $this->input->post('jenis_jabatan') : 99;
        $data['pegawai_jenisjabatan_nama'] = !empty($this->input->post('jenis_jabatan')) ? $this->ref_jabatan_kedudukan->get_row($data['pegawai_jenisjabatan_kode'])->jeniskedudukan_nama : '';
        $data['pegawai_masuk_sanggau'] = $this->input->post('pegawai_masuk_sanggau') == '1' ? '1' : '0';

        $upload = $this->upload_file($nip);
        $upload_base64 = $this->upload_file_base64($nip);
        if ($upload) {
            $data['pegawai_foto_kpe'] = $this->upload->data()['file_name'];
        }
        if ($upload_base64) {
            $data['pegawai_foto_kpe'] = $nip . '.PNG';
        }
        // print_r($data); die;

        $update = $this->m_pegawai->update($data, $nip);
        // echo $this->db->last_query();
        // die;

        if ($this->session->userdata('login')['group_id'] == '1' && $nip != $nip_update) {

            $data_nip1['pegawaipangkat_pegawai_nip'] = $nip_update;
            $this->m_pegawai_pangkat->update_custom($data_nip1, $nip, 'pegawaipangkat_pegawai_nip');
            // echo $this->db->last_query();
            // die;

            $data_nip2['pegawaijabatan_pegawai_nip'] = $nip_update;
            $this->m_pegawai_jabatan->update_custom($data_nip2, $nip, 'pegawaijabatan_pegawai_nip');

            $data_nip3['pegawaikgb_pegawai_nip'] = $nip_update;
            $this->m_pegawai_kgb->update_custom($data_nip3, $nip, 'pegawaikgb_pegawai_nip');

            $data_nip4['pegawaipendidikan_pegawai_nip'] = $nip_update;
            $this->m_pegawai_pendidikan->update_custom($data_nip4, $nip, 'pegawaipendidikan_pegawai_nip');

            $data_nip5['diklat_pegawai_nip'] = $nip_update;
            $this->m_pegawai_diklat->update_custom($data_nip5, $nip, 'diklat_pegawai_nip');

            $data_nip6['pegawaijasa_pegawai_nip'] = $nip_update;
            $this->m_pegawai_tanda_jasa->update_custom($data_nip6, $nip, 'pegawaijasa_pegawai_nip');

            $data_nip7['pegawaitugas_pegawai_nip'] = $nip_update;
            $this->m_pegawai_kunjungan->update_custom($data_nip7, $nip, 'pegawaitugas_pegawai_nip');

            $data_nip8['pegawaiorg_pegawai_nip'] = $nip_update;
            $this->m_pegawai_organisasi->update_custom($data_nip8, $nip, 'pegawaiorg_pegawai_nip');

            $data_nip9['pegawaikerja_pegawai_nip'] = $nip_update;
            $this->m_pegawai_pengalaman_kerja->update_custom($data_nip9, $nip, 'pegawaikerja_pegawai_nip');

            $data_nip10['pegawaibahasa_pegawai_nip'] = $nip_update;
            $this->m_pegawai_bahasa->update_custom($data_nip10, $nip, 'pegawaibahasa_pegawai_nip');

            $data_nip11['tugasbelajar_pegawai_nip'] = $nip_update;
            $this->m_pegawai_tugas_belajar->update_custom($data_nip11, $nip, 'tugasbelajar_pegawai_nip');

            $data_nip12['pegawaidisiplin_pegawai_nip'] = $nip_update;
            $this->m_pegawai_disiplin->update_custom($data_nip12, $nip, 'pegawaidisiplin_pegawai_nip');

            $data_nip13['pegawaikaryatulis_pegawai_nip'] = $nip_update;
            $this->m_pegawai_karya_tulis->update_custom($data_nip13, $nip, 'pegawaikaryatulis_pegawai_nip');

            $data_nip14['pegawaikeluarga_pegawai_nip'] = $nip_update;
            $this->m_pegawai_keluarga->update_custom($data_nip14, $nip, 'pegawaikeluarga_pegawai_nip');
        }

        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update identitas Pegawai Berhasil " . $this->upload->display_errors()));
            $this->db->trans_commit();
            redirect('pegawai/PegawaiIdentitas/view/' . $nip_update);
        } else {
            $this->db->trans_rollback();
            redirect('pegawai/PegawaiIdentitas/view/' . $nip);
        }
    }

    public function detail($nip)
    {
        $data['pilihan_tampil'] = 'detail';
        $data['pegawai'] = $this->m_pegawai->get_pegawai_detail($nip);
        if (blank($data['pegawai'])) {
            $this->loadView('errors/php/error_404', $data);
        } else {
            $this->load->model(array('m_pegawai_pangkat', 'm_pegawai_jabatan', 'm_pegawai_kgb', 'm_pegawai_pendidikan', 'm_pegawai_diklat', 'm_pegawai_tanda_jasa', 'm_pegawai_kunjungan', 'm_pegawai_organisasi', 'm_pegawai_pengalaman_kerja', 'm_pegawai_bahasa', 'm_pegawai_tugas_belajar', 'm_pegawai_disiplin', 'm_pegawai_karya_tulis', 'm_pegawai_keluarga', 'm_pegawai_kunjungan'));
            $data['pegawai_pangkat'] = $this->m_pegawai_pangkat->get_where(array('pegawaipangkat_pegawai_nip' => $nip));
            $data['pegawai_jabatan'] = $this->m_pegawai_jabatan->get_where(array('pegawaijabatan_pegawai_nip' => $nip));
            $data['pegawai_pendidikan'] = $this->m_pegawai_pendidikan->get_where(array('pegawaipendidikan_pegawai_nip' => $nip));
            $data['pegawai_diklat_penjenjangan'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'STRUKTURAL', 'diklat_pegawai_nip' => $nip));
            $data['pegawai_diklat_fungsional'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'FUNGSIONAL', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_teknis'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'TEKNIS', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_penataran'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'PENATARAN', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_seminar'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'SEMINAR', 'diklat_pegawai_nip' => $nip));
            $data['riwayat_diklat_kursus'] = $this->m_pegawai_diklat->get_where(array('diklat_jenis' => 'KURSUS', 'diklat_pegawai_nip' => $nip));
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

    public function upload_file($filename)
    {
        if (!empty($_FILES['userfile']['name'])) {
            $config['upload_path'] = 'assets/images';
            $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG';
            $config['overwrite'] = true;
            $config['create_thumb'] = false;
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                //echo 'error 1 ' . $this->upload->display_errors();
                return false;
            } else {
                return true;
            }
        } else {
            //echo 'ksosong';
            return false;
        }
    }

    public function upload_file_base64($filename)
    {
        if (!empty($_POST['userfile_webcam'])) {
            $img = $_POST['userfile_webcam'];
            $img = str_replace('[removed]', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file =  'assets/images/' . $filename . '.PNG';
            // echo $_POST['userfile_webcam']; die;
            file_put_contents($file, $data);
            // echo $_POST['userfile_webcam']; die;
            return true;
        } else {
            return false;
        }
    }


    private function column_admin($id)
    {
        $col_admin = '';
        $url_string = str_replace('/table', '', uri_string());
        $url_current = str_replace('/table', '', current_url());


        if (array_key_exists($url_string . '/update', $this->myakses)) {
            $col_admin .= '<a href="' . site_url('pegawai/PegawaiIdentitas/view/' . $id) . '" class="btn btn-warning btn-xs" type="button"  ><i class="fa fa-edit"></i> Edit</a> ';
        }
        if (array_key_exists($url_string . '/detail', $this->myakses)) {
            $col_admin .= '<a href="' . $url_current . '/detail/' . $id . '" class="btn btn-primary btn-xs" type="button"><i class="fa fa-tasks"></i> Detail</a> ';
        }
        if (array_key_exists($url_string . '/delete', $this->myakses)) {
            $col_admin .= '<a href="' . $url_current . '/delete/' . $id . '" class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash"></i> Non-aktif</a> ';
        }
        return $col_admin;
    }

    function table()
    {
        $list = $this->m_pegawai->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->pegawai_nip;
            $row[] = $value->pegawai_nama . ' ' . $value->pegawai_gelar_belakang;
            $row[] = $value->pangkat_golongan_pangkat . '<br/> ( ' . $value->pegawai_pangkat_terakhir_golru . ' )';
            $row[] = $value->pegawai_jabatan_nama;
            $row[] = $value->pegawai_eselon_nama;
            $row[] = $value->pegawai_unit_nama;
            $row[] = $value->pegawai_pendidikan_terakhir_tingkat;
            $row[] = $value->pegawai_alamat . ' RT. ' . $value->pegawai_rt . '/RW. ' . $value->pegawai_rw . ' ' . $value->pegawai_kecamatan_nama;
            $row[] = $value->pegawai_telpon;
            $row[] = $value->pegawai_email;
            $row[] = $this->column_admin($value->pegawai_nip);

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->m_pegawai->count_all(),
            "recordsFiltered" => $this->m_pegawai->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        exit();
    }

    public function delete($id)
    {
        $data = array(
            'pegawai_status' => 99
        );
        $update = $this->m_pegawai->update($data, $id);
        if (!empty($update)) {
            $this->session->set_flashdata('message', alert_show(
                'success',
                "Hapus Berhasil"
            ));
        } else {
            $this->session->set_flashdata('message', alert_show(
                'danger',
                "Hapus Gagal"
            ));
        }
        redirect($this->page);
    }

    public function cetak($format = null)
    {
        if ($format == 'pdf') {
            // $this->toPdf();
        } else if ($format == 'excel') {
            $this->toExcel();
        }
    }


    function toExcel($data = null)
    {
        $jumlah_field = 11;

        $alphabet = array();
        for ($na = 0; $na < $jumlah_field; $na++) {
            $alphabet[] = $this->generateAlphabet($na);
        }
        $last_alpabet = $alphabet[$jumlah_field - 1];


        $this->load->library("Excel/PHPExcel");

        // Create Objek phpExcel
        $objPHPExcel = new PHPExcel();

        $header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Verdana'
            )
        );
        $table_header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
            )

        );


        $link_style_array = array(
            'font' => array(
                'color' => array('rgb' => '0000FF'),
                'underline' => 'single',
            ),
        );

        $borderStyleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );


        $counter = 2;
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $counter . ':' . $last_alpabet . $counter);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':' . $last_alpabet . $counter)
            ->applyFromArray($header)
            ->getFont()->setSize(9);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $counter, 'DAFTAR PEGAWAI');


        $counter = 4;

        $first_row_header = $counter;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $counter, 'No.');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $counter, 'NIP');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $counter, 'Nama');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $counter, 'Pangkat / Golru');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $counter, 'Jabatan');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $counter, 'Eselon');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $counter, 'OPD / Unit Kerja');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $counter, 'Pendidikan');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $counter, 'Alamat');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $counter, 'Telepon');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $counter, 'Email');
        // if (in_array('instansi', $data['field_name']) )
        //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$counter, 'Unit Kerja');

        // $objPHPExcel->getActiveSheet()->mergeCells('A' . $counter . ':C' . $counter);

        $last_row_header = $counter;

        $objPHPExcel->getActiveSheet()->getStyle("A" . $first_row_header . ":K" . $last_row_header)
            ->applyFromArray($table_header)
            ->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle("A4:K4")
            ->getAlignment()->setWrapText(true);
        //end header

        // ===============================

        $ex = $objPHPExcel->setActiveSheetIndex(0);
        $counter = $counter+1;

        // $mutasi = $this->mutasi_model->get_all($data);


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        // foreach ($alphabet as $columnID) {
        //   $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        //     ->setAutoSize(true);
        // }

        // die(json_encode($data['mutasi']));
        $data['pegawai'] = $this->m_pegawai->get_pegawai_report();
        $counter_lokasi = 0;
        $urut = 1;
        foreach ($data['pegawai'] as $key => $value1) :
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $counter, $urut++);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $counter, ' ' . $value1['pegawai_nip']. ' ');
    		$objPHPExcel->getActiveSheet()
    		->getStyle('B' . $counter)->setQuotePrefix(true);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $counter, $value1['pegawai_nama'] . ' ' . $value1['pegawai_gelar_belakang']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $counter, $value1['pangkat_golongan_pangkat'] . ' ( ' . $value1['pegawai_pangkat_terakhir_golru'] . ' )');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $counter, $value1['pegawai_jabatan_nama']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $counter, $value1['pegawai_eselon_nama']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $counter, $value1['pegawai_unit_nama']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $counter, $value1['pegawai_pendidikan_terakhir_tingkat']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $counter, $value1['pegawai_alamat'] . ' RT. ' . $value1['pegawai_rt'] . '/RW. ' . $value1['pegawai_rw'] . ' ' . $value1['pegawai_kecamatan_nama']);

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $counter, $value1['pegawai_telpon']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $counter, $value1['pegawai_email']);
            $counter++;
        endforeach;


        $objPHPExcel->getActiveSheet()->getStyle($alphabet[0] . "4:" . $alphabet[$jumlah_field - 1] . $counter)
            ->applyFromArray($borderStyleArray);

            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        $objPHPExcel->getProperties()->setCreator("Pegawai")
            ->setLastModifiedBy("Pegawai")
            ->setTitle("Export Data Pegawai")
            ->setSubject("Export Pegawai To Excel")
            ->setDescription("Doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("PHPExcel");
        $objPHPExcel->getActiveSheet()->setTitle('Data Pegawai');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean(); // MENGHILANGKAN ERROR CANNOT OPEN
        header('Last-Modified:' . gmdate("D, d M Y H:i:s") . 'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Export Data Pegawai ' . date('Y-m-d') . '.xlsx"');

        $objWriter->save('php://output');
        die();
    }

    function generateAlphabet($na)
    {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }
}

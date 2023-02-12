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
class PegawaiRiwayatPangkat extends MY_Controller
{

    //put your code here
    var $page = 'pegawai/Pegawai';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_pangkat', 'ref_eselon', 'ref_pejabat', 'ref_kenaikan_pangkat', 'ref_kondisi_sumpah', 'ref_pangkat_golongan', 'ref_jabatan_fungsional', 'ref_jabatan_struktural', 'ref_jabatan_kedudukan', 'ref_status_kepegawaian', 'm_pegawai', 'ref_unit', 'ref_jenis_kelamin', 'ref_golongan_darah', 'ref_agama', 'ref_status_perkawinan'));
    	
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
        $data['result'] = $this->m_pegawai_pangkat->get_where(array('pegawaipangkat_pegawai_nip' => $nip));
        $data['unit'] = $this->ref_unit->get_all();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $data['jenis_kelamin'] = $this->ref_jenis_kelamin->get_all();
        $data['golongan_darah'] = $this->ref_golongan_darah->get_all();
        $data['agama'] = $this->ref_agama->get_all();
        $data['status_perkawinan'] = $this->ref_status_perkawinan->get_all();
        $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
        $data['kedudukan_jabatan'] = $this->ref_jabatan_kedudukan->get_all();
        $data['jabatan_fungsional'] = $this->ref_jabatan_fungsional->get_all();
        $data['kenaikan_pangkat'] = $this->ref_kenaikan_pangkat->get_all();
        $data['pangkat_golongan'] = $this->ref_pangkat_golongan->get_pangkat_golongan();
        if ($data['pegawai']->pegawai_jenisjabatan_kode == '11') {
            $data['jabatan'] = $this->ref_jabatan_struktural->get_all();
        } else if ($data['pegawai']->pegawai_jenisjabatan_kode == '12') {
            $data['jabatan'] = $this->ref_jabatan_fungsional->get_all();
        }
        $this->loadView('pegawai/pegawai_riwayat_pangkat', $data);
    }
    
    private function upload_sk($nip){
        // $kode_surat = $this->getKodeSurat();
        $dir = "assets/files";
        $config['upload_path']    = $dir;
        $config['allowed_types']  = 'jpg|jpeg|png|pdf';
        $config['overwrite']      = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['max_size']     = 2048;
        if ($_FILES["file"]["error"] == 0) {
            //stands for any kind of errors happen during the uploading

            $config['file_name'] = "SK_PANGKAT_" . $nip . '_' . date('His');

            $this->load->library('upload');

            $this->upload->initialize($config);

            $fieldname = "file";

            if ($this->upload->do_upload($fieldname)) {

                $upload = array();
                $upload = $this->upload->data();

                return $upload;

                
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Pangkat Pegawai Gagal, Upload SK Gagal"));
            }
        } else {
            $data_file = array();
            return $data_file;
        }
    }

    function add($return = NULL)
    {
        $data['pegawaipangkat_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaipangkat_pangkat_id'] = $this->input->post('pegawaipangkat_pangkat_id');
        $data['pegawaipangkat_pangkat_nama'] = $this->ref_pangkat_golongan->get_pangkat_by_id($data['pegawaipangkat_pangkat_id'])->pangkat_golongan_pangkat;
        $data['pegawaipangkat_pangkat_golru'] = $this->ref_pangkat_golongan->get_pangkat_by_id($data['pegawaipangkat_pangkat_id'])->pangkat_golongan_nama;
        $data['pegawaipangkat_kenaikan_id'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->input->post('pegawaipangkat_kenaikan_pangkat_id') : 0;
        $data['pegawaipangkat_kenaikan_nama'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->ref_kenaikan_pangkat->get_row($data['pegawaipangkat_kenaikan_id'])->kenaikan_pangkat_nama : '';
        $data['pegawaipangkat_tmt'] = y_m_d($this->input->post('pegawaipangkat_tmt'));
        $data['pegawaipangkat_sk_date'] = y_m_d($this->input->post('pegawaipangkat_sk_date'));
        $data['pegawaipangkat_sk_no'] = $this->input->post('pegawaipangkat_sk_no');
        $data['pegawaipangkat_sk_pejabat'] = $this->input->post('pegawaipangkat_sk_pejabat');
        $data['pegawaipangkat_angka_kredit'] = !empty($this->input->post('pegawaipangkat_angka_kredit')) ? $this->input->post('pegawaipangkat_angka_kredit') : 0;
        $data['pegawaipangkat_masa_kerja_tahun'] = !empty($this->input->post('pegawaipangkat_masa_kerja_tahun')) ? $this->input->post('pegawaipangkat_masa_kerja_tahun') : 0;
        $data['pegawaipangkat_masa_kerja_bulan'] = !empty($this->input->post('pegawaipangkat_masa_kerja_bulan')) ? $this->input->post('pegawaipangkat_masa_kerja_bulan') : 0;
        $data['pegawaipangkat_gaji_pokok'] = !empty($this->input->post('pegawaipangkat_gaji_pokok')) ? $this->input->post('pegawaipangkat_gaji_pokok') : 0;
        $data['pegawaipangkat_unit_kerja_id'] = $this->input->post('pegawaipangkat_unit_kerja_id');
        $data['pegawaipangkat_unit_kerja_nama'] = !empty($this->input->post('pegawaipangkat_unit_kerja_id')) ? $this->ref_unit->get_row($data['pegawaipangkat_unit_kerja_id'])->unit_nama : '';
        // $data['pegawaipangkat_jenis_jabatan_id'] = $this->input->post('pengawaipangkat_jenis_jabatan_id');
        // $data['pegawaipangkat_jenis_jabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawaipangkat_jenis_jabatan_id'])->jeniskedudukan_nama;
        // $data['pegawaipangkat_jabatan_id'] = $this->input->post('pegawaipangkat_jabatan_id');
        // if ($data['pegawaipangkat_jenis_jabatan_id'] == '1') {
        //     $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaipangkat_jabatan_id']);
        //     $data['pegawaipangkat_eselon_id'] = $jabatan->jabatan_eselon_kode;
        //     $data['pegawaipangkat_eselon_nama'] = $jabatan->jabatan_eselon_nama;
        // } else if ($data['pegawaipangkat_jenis_jabatan_id'] == '2') {
        //     $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaipangkat_jabatan_id']);
        // } else if ($data['pegawaipangkat_jenis_jabatan_id'] == '4') {
        //     $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaipangkat_jabatan_id']);
        // }
        // $data['pegawaipangkat_jabatan_nama'] = $jabatan->jabatan_nama;
        $sk =  $this->upload_sk($data['pegawaipangkat_pegawai_nip']);
        if(!empty($sk)){
            $data['proses_bpkad'] = '1';
        }
        // print_r($data);
        // die;
        $update = $this->m_pegawai_pangkat->insert_get_id($data);
        if (!empty($update)) {

            $id_insert = $update;
            if(!empty($sk)){
                $this->m_pegawai_pangkat->delete_file($id_insert); //delete file yg sdh ada
                $data_file = array(
                    'pangkatsk_pangkat_id' => $id_insert,
                    'pangkatsk_file' => $sk['file_name'],
                );
                $this->m_pegawai_pangkat->save_file($data_file);
            }

            $this->session->set_flashdata('message', alert_show('success', "Tambah Riwayat Pangkat Pegawai Berhasil"));
            $this->update_pangkat_terakhir($data['pegawaipangkat_pegawai_nip']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah Riwayat Pangkat Pegawai Gagal"));
        }
        if (!empty($return)) {
            redirect('pegawai/KolektifPangkat');
        } else {
            redirect('pegawai/PegawaiRiwayatPangkat/view/' . $data['pegawaipangkat_pegawai_nip'] . '#riwayat');
        }
    }

    function update()
    {
        $id = $this->input->post('pegawaipangkat_id');
        $data['pegawaipangkat_pegawai_nip'] = $this->input->post('nip');
        $data['pegawaipangkat_pangkat_id'] = $this->input->post('pegawaipangkat_pangkat_id');
        $data['pegawaipangkat_pangkat_nama'] = $this->ref_pangkat_golongan->get_pangkat_by_id($data['pegawaipangkat_pangkat_id'])->pangkat_golongan_pangkat;
        $data['pegawaipangkat_pangkat_golru'] = $this->ref_pangkat_golongan->get_pangkat_by_id($data['pegawaipangkat_pangkat_id'])->pangkat_golongan_nama;
        $data['pegawaipangkat_kenaikan_id'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->input->post('pegawaipangkat_kenaikan_pangkat_id') : 0;
        $data['pegawaipangkat_kenaikan_nama'] = !empty($this->input->post('pegawaipangkat_kenaikan_pangkat_id')) ? $this->ref_kenaikan_pangkat->get_row($data['pegawaipangkat_kenaikan_id'])->kenaikan_pangkat_nama : '';
        $data['pegawaipangkat_tmt'] = y_m_d($this->input->post('pegawaipangkat_tmt'));
        $data['pegawaipangkat_sk_date'] = y_m_d($this->input->post('pegawaipangkat_sk_date'));
        $data['pegawaipangkat_sk_no'] = $this->input->post('pegawaipangkat_sk_no');
        $data['pegawaipangkat_sk_pejabat'] = $this->input->post('pegawaipangkat_sk_pejabat');
        $data['pegawaipangkat_angka_kredit'] = !empty($this->input->post('pegawaipangkat_angka_kredit')) ? $this->input->post('pegawaipangkat_angka_kredit') : 0;
        $data['pegawaipangkat_masa_kerja_tahun'] = !empty($this->input->post('pegawaipangkat_masa_kerja_tahun')) ? $this->input->post('pegawaipangkat_masa_kerja_tahun') : 0;
        $data['pegawaipangkat_masa_kerja_bulan'] = !empty($this->input->post('pegawaipangkat_masa_kerja_bulan')) ? $this->input->post('pegawaipangkat_masa_kerja_bulan') : 0;
        $data['pegawaipangkat_gaji_pokok'] = !empty($this->input->post('pegawaipangkat_gaji_pokok')) ? $this->input->post('pegawaipangkat_gaji_pokok') : 0;
        $data['pegawaipangkat_unit_kerja_id'] = $this->input->post('pegawaipangkat_unit_kerja_id');
        $data['pegawaipangkat_unit_kerja_nama'] = !empty($this->input->post('pegawaipangkat_unit_kerja_id')) ? $this->ref_unit->get_row($data['pegawaipangkat_unit_kerja_id'])->unit_nama : '';
        // $data['pegawaipangkat_jenis_jabatan_id'] = !empty($this->input->post('pengawaipangkat_jenis_jabatan_id')) ? $this->input->post('pengawaipangkat_jenis_jabatan_id') : 0;
        // $data['pegawaipangkat_jenis_jabatan_nama'] = $this->ref_jabatan_kedudukan->get_row($data['pegawaipangkat_jenis_jabatan_id'])->jeniskedudukan_nama;
        // $data['pegawaipangkat_jabatan_id'] = !empty($this->input->post('pegawaipangkat_jabatan_id')) ? $this->input->post('pegawaipangkat_jabatan_id') : 0;
        // if ($data['pegawaipangkat_jenis_jabatan_id'] == '1') {
        //     $jabatan = $this->ref_jabatan_struktural->get_row($data['pegawaipangkat_jabatan_id']);
        //     $data['pegawaipangkat_eselon_id'] = $jabatan->jabatan_eselon_kode;
        //     $data['pegawaipangkat_eselon_nama'] = $jabatan->jabatan_eselon_nama;
        // } else if ($data['pegawaipangkat_jenis_jabatan_id'] == '2') {
        //     $jabatan = $this->ref_jabatan_fungsional->get_row($data['pegawaipangkat_jabatan_id']);
        // } else if ($data['pegawaipangkat_jenis_jabatan_id'] == '4') {
        //     $jabatan = $this->ref_jabatan_baru->get_row($data['pegawaipangkat_jabatan_id']);
        // }
        // $data['pegawaipangkat_jabatan_nama'] = $jabatan->jabatan_nama;
        $sk =  $this->upload_sk($data['pegawaipangkat_pegawai_nip']);
        if(!empty($sk)){
            $data['proses_bpkad'] = '1';
        }
        // print_r($data);
        // die;
        $update = $this->m_pegawai_pangkat->update($data, $id);
        if (!empty($update)) {

            $id_insert = $id;
            if(!empty($sk)){
                $this->m_pegawai_pangkat->delete_file($id_insert); //delete file yg sdh ada
                $data_file = array(
                    'pangkatsk_pangkat_id' => $id_insert,
                    'pangkatsk_file' => $sk['file_name'],
                );
                $this->m_pegawai_pangkat->save_file($data_file);
            			$text = "SK Kenaikan Pangkat Anda Telah Terbit. Terimakasih.";
            			$nomor  = '6282258611297';
                    	$file = $sk['file_name'];
                        $curl = curl_init();
                        $this->send_wa($curl, $nomor, $text);  
                        $this->send_media($curl, $nomor, $text,$file);  
                        curl_close($curl);
            }

            $this->session->set_flashdata('message', alert_show('success', "Update Riwayat Pangkat Pegawai Berhasil"));
            $this->update_pangkat_terakhir($data['pegawaipangkat_pegawai_nip']);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update Riwayat Pangkat Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatPangkat/view/' . $data['pegawaipangkat_pegawai_nip'] . '#riwayat');
    }

    function delete($id)
    {
        $nip = $this->m_pegawai_pangkat->get_row($id)->pegawaipangkat_pegawai_nip;
        $delete = $this->m_pegawai_pangkat->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus Riwayat Pangkat Pegawai Berhasil"));
            $this->update_pangkat_terakhir($nip);
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus Riwayat Pangkat Pegawai Gagal"));
        }
        redirect('pegawai/PegawaiRiwayatPangkat/view/' . $nip . '#riwayat');
    }

    function update_pangkat_terakhir($nip)
    {
        $pangkat_terakhir = $this->m_pegawai_pangkat->get_pangkat_terakhir($nip);
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

    public function send_wa($curl, $number, $message)
    {
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sipedas.sanggau.go.id/lib/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    				"number" : ' . $number . ',
    				"message": "' . $message . '"
			}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
    }
    

    public function send_media($curl, $number, $message, $file)
    {
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://sipedas.sanggau.go.id/lib/send-media',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "number" : '.$number.',
            "caption": "'.$message.'",
            "file": "'.$file.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

    }

}

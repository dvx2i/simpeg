<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Zanuar
 */
class DataPengajuan extends MY_Controller
{

    var $page = "mutasi/data_pengajuan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_pengajuan_mutasi');
        $this->load->model('m_pegawai');
        $this->load->model('ref_unit');
        $this->load->model('ref_berkas_mutasi');
        $this->load->model('ref_propinsi');
        $this->load->model('ref_kabupaten');
        $this->load->library('datatables');
    }

    //put your code here

    public function index()
    {
        $data['result'] = $this->m_data_pengajuan_mutasi->get_all();
        $this->loadView($this->page, $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_data_pengajuan_mutasi->json();
    }

    public function update($jenis = null)
    {
        if ($jenis != 'sk') {
            $id = $this->input->post('usulan_id');
            $data['usulan_status'] = '2';

            if ($jenis == 'reject') {
                $data['usulan_status'] = '3';
                $data['keterangan'] = $this->input->post('keterangan');
            }

            $update = $this->m_data_pengajuan_mutasi->update($data, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Disimpan"));
            } else {
                alert_set('danger', "Gagal Disimpan");
            }
            redirect('mutasi/DataPengajuan');
        } else {
            // $kode_surat = $this->getKodeSurat();
            $id = $this->input->post('id_mutasi');
            $dir = "assets/files";
            $config['upload_path']    = $dir;
            $config['allowed_types']  = 'jpg|jpeg|png|pdf';
            $config['overwrite']      = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $config['max_size']     = 2048;
            if ($_FILES["file"]["error"] == 0) {
                //stands for any kind of errors happen during the uploading

                $config['file_name'] = "SK_MUTASI_" . md5($id) . '_' . date('H_i_s');

                $this->load->library('upload');

                $this->upload->initialize($config);

                $fieldname = "file";

                if ($this->upload->do_upload($fieldname)) {

                    $upload = array();
                    $upload = $this->upload->data();


                    $this->m_data_pengajuan_mutasi->update_sk($id, $upload['file_name']);
                    $this->session->set_flashdata('message', alert_show('success', "Berhasil Disimpan"));
                    echo '{"success":true}';
                    
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Sorry, there was an error uploading your file.'));
                    exit;
                }
            } else {
                echo '{"success":false}';
            }
        }
    }

    public function add()
    {

        $session = $this->session->userdata('login');
        if ($this->input->post()) {

            $session = $this->session->userdata('login');
            $data['usulan_nip'] = $this->input->post('nip');
            $data['usulan_status'] = '1';
            $data['insert_user_id'] = $session['user_id'];
            $data['insert_time'] = date('Y-m-d h:i:s');
            $this->db->trans_start();
            $simpan_id = $this->m_data_pengajuan_mutasi->insert_row($data);
            if (!empty($simpan_id)) {
                $berkas = $this->ref_berkas_mutasi->get_all();

                // $fileExt = pathinfo($_FILES["berkas"]["name"], PATHINFO_EXTENSION);
                // die($fileExt);

                $dir = "assets/files";
                $config['upload_path']    = $dir;
                $config['allowed_types']  = 'jpg|jpeg|png|pdf';
                $config['overwrite']      = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $config['max_size']     = 2084;
                // $config['encrypt_name'] = TRUE;
                // die($config['file_name']);

                foreach ($berkas->result_array() as $item) {

                    $id = $item['berkas_id'];
                    // print_r($_FILES["berkas_" . $id]["name"]); die;
                    $config['file_name'] = md5($id) . '_' . date('H_i_s');

                    if ($_FILES["berkas_" . $id]["name"] != NULL) {
                        $this->load->library('upload');

                        $this->upload->initialize($config);

                        $fieldname = "berkas_" . $id;

                        if ($this->upload->do_upload($fieldname)) {

                            $upload = array();
                            $upload = $this->upload->data();

                            $data_file = array(
                                'usulan_id' => $simpan_id,
                                'url_file' => $upload['file_name'],
                                'berkas_id' => $id
                            );
                            $this->m_data_pengajuan_mutasi->save_file($data_file);
                        } else {
                            alert_set('danger', "Upload File Gagal");
                            redirect('mutasi/pengajuan/add');
                        }
                    }
                }
            }
            $this->db->trans_complete();

            if ($this->db->trans_status()) {
                alert_set('success', "Tambah Berhasil");
            } else {
                alert_set('danger', "Tambah Gagal");
            }
            redirect($this->page);
        } else {
            $session = $this->session->userdata('login');
            $data['pegawai'] = $this->m_pegawai->get_row($session['nip']);
            $data['unit'] = $this->ref_unit->get_unit_parent();
            $data['berkas'] = $this->ref_berkas_mutasi->get_all();
            $this->loadView('mutasi/pengajuan_form', $data);
        }
    }

    public function detail($id)
    {
        $row = $this->m_data_pengajuan_mutasi->get_by_id($id);
        if ($row) {
            $data = array(
                'usulan_id' => $row->usulan_id,
                'pegawai_nama' => $row->pegawai_nama,
                'pegawai_unit_nama' => $row->pegawai_unit_nama,
                'pegawai_nip' => $row->pegawai_nip,
                'pegawai_nip_lama' => $row->pegawai_nip_lama,
                'usulan_jenis' => $row->usulan_jenis,
                'usulan_propinsi' => $row->usulan_propinsi,
                'usulan_kabupaten' => $row->usulan_kabupaten,
                'usulan_unit_tujuan_id' => $row->usulan_unit_tujuan_id,
                'usulan_status' => $row->usulan_status
            );

            $data['berkas_mutasi'] = $this->m_data_pengajuan_mutasi->getBerkasByPermohonan($id);
            $data['berkas'] = $this->ref_berkas_mutasi->get_all();

            $datetime1 = date_create($row->pegawai_pns_tmt);
            $datetime2 = date_create(date('Y-m-d'));
           
            $interval = date_diff($datetime1, $datetime2);
            $data['masa_kerja'] = $interval->format('%y Tahun');
            // print_r($data['berkas']);
            // die;
            $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
            $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
            $data['unit'] = $this->ref_unit->get_unit_parent();

            $this->loadView('mutasi/data_pengajuan_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verifikasi'));
        }
    }

    public function delete($id)
    {
        $simpan = $this->m_data_pengajuan_mutasi->delete($id);
        if (!empty($simpan)) {
            alert_set('success', "Hapus Berhasil");
        } else {
            alert_set('danger', "Hapus Gagal");
        }
        redirect($this->page);
    }
}

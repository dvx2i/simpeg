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
class Pengajuan extends MY_Controller
{

    var $page = "mutasi/pengajuan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengajuan_mutasi');
        $this->load->model('m_pegawai');
        $this->load->model('ref_unit');
        $this->load->model('ref_propinsi');
        $this->load->model('ref_kabupaten');
        $this->load->model('ref_berkas_mutasi');
        $this->load->library('datatables');
    }

    //put your code here

    public function index()
    {
        $data['result'] = $this->m_pengajuan_mutasi->get_all();
        $this->loadView($this->page, $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_pengajuan_mutasi->json();
    }

    public function update($id)
    {
        $session = $this->session->userdata('login');
        $row = $this->m_pengajuan_mutasi->get_by_id($id, $session['nip']);
        if ($row) {
            if ($this->input->post()) {
                
                $this->db->trans_start();

                $session = $this->session->userdata('login');
                $data['usulan_nip'] = $this->input->post('nip');
                $data['usulan_status'] = '1';
                $data['update_user_id'] = $session['user_id'];
                $data['update_time'] = date('Y-m-d h:i:s');
                $data['usulan_jenis'] =  $this->input->post('jenis_mutasi');
            $data['usulan_propinsi'] = !empty($this->input->post('usulan_propinsi')) ? $this->input->post('usulan_propinsi') : NULL;
            $data['usulan_kabupaten'] = !empty($this->input->post('usulan_kabupaten')) ? $this->input->post('usulan_kabupaten') : NULL ;
            $data['usulan_unit_tujuan_id'] = !empty($this->input->post('usulan_unit_tujuan_id')) ? $this->input->post('usulan_unit_tujuan_id') : NULL;
                
                $update = $this->m_pengajuan_mutasi->update($data, $id);
                if (!empty($update)) {

                    $berkas = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));

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

                    $id_berkas = $item['berkas_id'];
                    // print_r($_FILES["berkas_" . $id]["name"]); die;
                    $config['file_name'] = md5($id) . '_' . date('H_i_s');

                    if ($_FILES["berkas_" . $id_berkas]["name"] != NULL) {
                        $this->load->library('upload');

                        $this->upload->initialize($config);

                        $fieldname = "berkas_" . $id_berkas;

                        if ($this->upload->do_upload($fieldname)) {

                            $this->m_pengajuan_mutasi->delete_file($id_berkas,$id); //delete file yg sdh ada

                            $upload = array();
                            $upload = $this->upload->data();

                            $data_file = array(
                                'usulan_id' => $id,
                                'url_file' => $upload['file_name'],
                                'berkas_id' => $id_berkas
                            );
                            $this->m_pengajuan_mutasi->save_file($data_file);
                        } else {
                            $this->session->set_flashdata('message', alert_show('danger', "Upload File Gagal"));
                            redirect('mutasi/pengajuan/add');
                        }
                    }
                }

                $this->db->trans_complete();
                    $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));
                } else {
                    $this->session->set_flashdata('message', alert_show('danger', "Update Gagal"));
                }
                
                redirect(site_url('mutasi/Pengajuan'));
            }else{
                $data = array(
                    'action' => site_url('mutasi/Pengajuan/update/'.$id),
                    'usulan_id' => $row->usulan_id,
                    'pegawai_nama' => $row->pegawai_nama,
                    'pegawai_unit_nama' => $row->pegawai_unit_nama,
                    'pegawai_nip' => $row->pegawai_nip,
                    'pegawai_nip_lama' => $row->pegawai_nip_lama,
                    'usulan_jenis' => $row->usulan_jenis,
                    'usulan_propinsi' => $row->usulan_propinsi,
                    'usulan_kabupaten' => $row->usulan_kabupaten,
                    'usulan_unit_tujuan_id' => $row->usulan_unit_tujuan_id,
                );
                $data['berkas_mutasi'] = $this->m_pengajuan_mutasi->getBerkasByPermohonan($id);
                $data['pegawai'] = $this->m_pegawai->get_row($session['nip']);
                $datetime1 = date_create($data['pegawai']->pegawai_cpns_tmt);
                $datetime2 = date_create(date('Y-m-d'));
               
                $interval = date_diff($datetime1, $datetime2);
                $data['masa_kerja'] = $interval->format('%y Tahun');
                $data['unit'] = $this->ref_unit->get_unit_parent();
                $data['berkas'] = $this->ref_berkas_mutasi->get_all();
                $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
                $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
                
            $this->loadView('mutasi/pengajuan_form', $data);
            }
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mutasi/Pengajuan'));
        }
    }

    public function add()
    {

        $session = $this->session->userdata('login');
        $masa_kerja = $this->m_pengajuan_mutasi->getMasaKerja($session['nip']);
        // die($masa_kerja);
        if ($masa_kerja < 5) {
            $this->session->set_flashdata('message', alert_show('danger', "Anda Belum Memenuhi Syarat Mutasi Sesuai Surat Edaran  <b>Bupati Sanggau No: 820/117/BKPSDM-C </b> <br>
            													- Mutasi Keluar Kabupaten Sanggau Minimal Masa Kerja <b>10 Tahun</b> <br>
                                                                - Mutasi dalam kabupaten Sanggau Minimal Masa Kerja <b>5 Tahun</b>"));
            redirect(site_url('mutasi/Pengajuan'));
        }

        if ($this->input->post()) {

            $session = $this->session->userdata('login');
            $data['usulan_nip'] = $this->input->post('nip');
            $data['usulan_status'] = '1';
            $data['usulan_jenis'] =  $this->input->post('jenis_mutasi');
            $data['usulan_status'] = '1';
            $data['usulan_propinsi'] = !empty($this->input->post('usulan_propinsi')) ? $this->input->post('usulan_propinsi') : NULL;
            $data['usulan_kabupaten'] = !empty($this->input->post('usulan_kabupaten')) ? $this->input->post('usulan_kabupaten') : NULL ;
            $data['usulan_unit_tujuan_id'] = !empty($this->input->post('usulan_unit_tujuan_id')) ? $this->input->post('usulan_unit_tujuan_id') : NULL;
            $data['insert_user_id'] = $session['user_id'];
            $data['insert_time'] = date('Y-m-d h:i:s');
            $this->db->trans_start();
            $simpan_id = $this->m_pengajuan_mutasi->insert_row($data);
            $data['no_permohonan'] = date('Y').'-'.str_pad($simpan_id, 7, '0', STR_PAD_LEFT);
            $data['nama_propinsi'] = $this->ref_propinsi->get_row($data['usulan_propinsi'])->propinsi_nama;
            $data['nama_kabupaten'] = $this->ref_kabupaten->get_row($data['usulan_kabupaten'])->kabupaten_nama;
            $data['nama_unit_tujuan'] = $this->ref_unit->get_row($data['usulan_unit_tujuan_id'])->unit_nama;
            $data['new'] = 'true';
            $data['tgl_surat'] = tgl_indo(date('Y-m-d'));
            $data['pegawai']    = $this->m_pegawai->get_row($data['usulan_nip']);

            if (!empty($simpan_id)) {
                $berkas = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));

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
                            $this->m_pengajuan_mutasi->save_file($data_file);
                        } else {
                            $this->session->set_flashdata('message', alert_show('danger', "Upload File Gagal"));
                            redirect('mutasi/Pengajuan/add');
                        }
                    }else{
                        $this->session->set_flashdata('message', alert_show('danger', "Berkas Tidak Lengkap"));
                        redirect('mutasi/Pengajuan/add');
                    }
                }
            }
            $this->db->trans_complete();

            if ($this->db->trans_status()) {
                
            $this->load->library('PdfGenerator');
            $html = $this->load->view('mutasi/pdf_bukti_usulan', $data, true);
            $filename= "Bukti-Usulan-Mutasi-".$data['no_permohonan']; 
            
            // $this->load->view('angka_kredit/cetak_by_id', $data);
            $this->pdfgenerator->generate_to_server($html, $filename, false, 'A4', 'portrait');;

                $this->session->set_flashdata('message', alert_show('success', "Pengajuan Usulan Mutasi Berhasil"));
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "Pengajuan Usulan Mutasi Gagal"));
            }
            redirect(site_url('mutasi/Pengajuan/detail/'.$simpan_id.'/new'));
        } else {
            $session = $this->session->userdata('login');
            $data = array(
                'action' => site_url('mutasi/Pengajuan/add'),
                'usulan_id' => set_value('usulan_id'),
                'usulan_jenis' => set_value('usulan_jenis'),
                'usulan_propinsi' => set_value('usulan_propinsi'),
                'usulan_propinsi' =>  set_value('usulan_propinsi'),
                'usulan_kabupaten' =>  set_value('usulan_kabupaten'),
                'usulan_unit_tujuan_id' =>  set_value('usulan_unit_tujuan_id'),
            );
            $data['action'] = site_url('mutasi/pengajuan/add');
            $data['pegawai'] = $this->m_pegawai->get_row($session['nip']);
            $data['unit'] = $this->ref_unit->get_unit_parent();
            $data['berkas'] = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));
            
            $datetime1 = date_create($data['pegawai']->pegawai_cpns_tmt);
            $datetime2 = date_create(date('Y-m-d'));
           
            $interval = date_diff($datetime1, $datetime2);
            $data['masa_kerja'] = $interval->format('%y Tahun');
            $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
            $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
            $this->loadView('mutasi/pengajuan_form', $data);
        }
    }

    public function detail($id, $status = NULL)
    {
        $session = $this->session->userdata('login');
        $row = $this->m_pengajuan_mutasi->get_by_id($id, $session['nip']);
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
                'usulan_status' => $row->usulan_status,
                'insert_time' => $row->insert_time
            );
            
            $data['new'] = 'false';
            if($status == 'new'){
                $data['new'] = 'true';
            }
            $data['pegawai']    = $this->m_pegawai->get_row($data['pegawai_nip']);
            $data['berkas_mutasi'] = $this->m_pengajuan_mutasi->getBerkasByPermohonan($id);
            $data['berkas'] = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));

            $datetime1 = date_create($row->pegawai_cpns_tmt);
            $datetime2 = date_create(date('Y-m-d'));
           
            $interval = date_diff($datetime1, $datetime2);
            $data['masa_kerja'] = $interval->format('%y Tahun');
            // print_r($data['berkas']);
            // die;
            $data['unit'] = $this->ref_unit->get_unit_parent();
            $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
            $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
            $data['bukti_usulan_file'] = base_url()."/assets/docs/Bukti-Usulan-Mutasi-".date('Y', strtotime($data['insert_time']))."-".str_pad($data['usulan_id'], 7, '0', STR_PAD_LEFT).".pdf";
            $this->loadView('mutasi/pengajuan_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mutasi/Pengajuan'));
        }
    }

    public function delete($id)
    {
        $simpan = $this->m_pengajuan_mutasi->delete($id);
        if (!empty($simpan)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
                $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
            redirect('mutasi/Pengajuan');
    }
}

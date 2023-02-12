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
class PegawaiPensiun extends MY_Controller
{

    //put your code here
    var $view = 'pensiun/pegawai_pensiun';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_unit', 'm_pegawai', 'm_pegawai_pensiun'));
        if (!$this->cek_admin()) {
            redirect('Home');
        }
    }

    function index()
    {
        $data['unit'] = $this->ref_unit->get_unit();
    	$data['newitem_pensiun'] = $this->m_pegawai_pensiun->get_where_custom('new_item', array('jenis'=>'pensiun'), 'notifikasi_atasan')->row();
        $this->loadView($this->view, $data);
    }

    public function json()
    {

        $filter = array(
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
        );

        $this->session->set_userdata('filterpensiun', $filter);
        echo $this->m_pegawai_pensiun->json();
    }

    public function add()
    {
        if (isset($_FILES['file'])) {

            header('Content-type:application/json;charset=utf-8');

            try {
                if (
                    !isset($_FILES['file']['error']) ||
                    is_array($_FILES['file']['error'])
                ) {
                    throw new RuntimeException('Invalid parameters.');
                }

                switch ($_FILES['file']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('Tidak ada file.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Ukuran File terlalu besar.');
                    default:
                        throw new RuntimeException('Unknown errors.');
                }

                $filepath = 'assets/docs/pensiun/' . $_FILES['file']['name'];
                
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $filename = basename($_FILES['file']['name'], '.' . $ext);
                $filename = strtoupper($filename);
                $nip      = substr($filename, 0, 18);
                $jenisname    = substr($filename, 19,2);
                $date     = date('Y-m-d');
                $kode = $this->input->post('time');
                $pegawai  = $this->m_pegawai->get_row($nip);
                
                if($jenisname == 'DP'){
                    $jenis = 'dpcp';
                    $jenis_id = 1;
                }elseif($jenisname == 'SK'){
                    $jenis = 'sk';
                    $jenis_id = 2;
                }

                if (empty($pegawai)) {
                    throw new RuntimeException('NIP Pegawai '. $nip.' tidak ditemukan');
                }
                
                

                $row = $this->m_pegawai_pensiun->get_where_custom('pegawaipensiun_id,pegawaipensiun_kode', array('pegawaipensiun_nip' => $nip, 'pegawaipensiun_tanggal_upload' => $date), 'pegawai_pensiun')->row();
                
                if(empty($row)){

                    $datainsert = array(
                        'pegawaipensiun_nip' => $nip,
                        'pegawaipensiun_status' => 1,
                        'pegawaipensiun_tanggal_upload' => $date,
                        'pegawaipensiun_kode' => $kode,
                        'created_by'     => $this->session->userdata('login')['user_id'],
                        'created_at'     => date('Y-m-d h:i:s')
                    );
                    
                    $insert = $this->m_pegawai_pensiun->insert_pensiun($datainsert);
                    $id = $insert;

                }else{

                    $id = $row->pegawaipensiun_id;
                    $kode = $row->pegawaipensiun_kode;

                }


                    $berkas_row = $this->m_pegawai_pensiun->get_where_custom('pensiunberkas_id', array('pensiunberkas_status' => '2', 'pensiunberkas_pensiun_id' => $id), 'pegawai_pensiun_berkas')->row();
                    
                    if(!empty($berkas_row)){
                        throw new RuntimeException('Berkas '.$jenis.' sudah ditandatangani.');
                    }

                    $datainsertberkas = array(
                        'pensiunberkas_pensiun_id' => $id,
                        'pensiunberkas_jenis' => $jenis_id,
                        'pensiunberkas_file'     => $_FILES['file']['name'],
                        'pensiunberkas_status'     => 1
                    );

                    $this->m_pegawai_pensiun->delete_berkas($id,$jenis_id);
                    $insertberkas = $this->m_pegawai_pensiun->insert_berkas($datainsertberkas);
                

                if($insertberkas){
                    if (!move_uploaded_file(
                        $_FILES['file']['tmp_name'],
                        $filepath
                    )) {
                        throw new RuntimeException('Upload gagal.');
                    }
                }
            
        			$this->session->set_userdata('newitempensiun', '1');
            	$this->m_pegawai_pensiun->update_custom_table(array('new_item' => 1), 'pensiun', 'jenis', 'notifikasi_atasan');

                // All good, send the response
                echo json_encode([
                    'status' => 'ok',
                    'message' => 'Upload berhasil.',
                    'path' => $filepath
                ]);
            } catch (RuntimeException $e) {
                // Something went wrong, send the err message as JSON
                http_response_code(400);

                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }else{
            $data = '';
            $this->loadView('pensiun/pegawai_pensiun_add', $data);
        }

    }
    
    public function delete($id)
    {
        $simpan = $this->m_pegawai_pensiun->delete($id);
        $this->m_pegawai_pensiun->delete_berkas_by_id($id);
        if (!empty($simpan)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
                $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
            redirect('pensiun/PegawaiPensiun');
    }
}

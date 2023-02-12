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
class PegawaiPangkat extends MY_Controller
{

    //put your code here
    var $view = 'pangkat/pegawai_pangkat';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ref_unit', 'm_pegawai', 'm_pegawai_pangkat'));
        if (!$this->cek_admin()) {
            redirect('Home');
        }
    }

    function index()
    {
        $data['unit'] = $this->ref_unit->get_unit();
    	$data['newitem_pangkat'] = $this->m_pegawai_pangkat->get_where_custom('new_item', array('jenis'=>'pangkat'), 'notifikasi_atasan')->row();
        $this->loadView($this->view, $data);
    }

    public function json()
    {

        $filter = array(
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
        );

        $this->session->set_userdata('filterpangkat', $filter);
        echo $this->m_pegawai_pangkat->json();
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

                $filepath = 'assets/docs/pangkat/' . $_FILES['file']['name'];
                
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $filename = basename($_FILES['file']['name'], '.' . $ext);
                $filename = strtoupper($filename);
                $nip      = substr($filename, 0, 18);
                $golongan    = substr($filename, 19,1);
                $date     = date('Y-m-d');
                $kode = $this->input->post('time');
                $pegawai  = $this->m_pegawai->get_row($nip);
                
                if($golongan != '2' && $golongan != '3' && $golongan != '1'){
                        throw new RuntimeException('Nama berkas tidak valid.');
                }

                if (empty($pegawai)) {
                    throw new RuntimeException('NIP Pegawai '. $nip.' tidak ditemukan');
                }
                

                $datainsert = array(
                    'pangkatsk_nip' => $nip,
                    'pangkatsk_golongan'     => $golongan,
                    'pangkatsk_tanggal_upload'     => $date,
                    'pangkatsk_status'     => 1,
                    'pangkatsk_file'     => $_FILES['file']['name'],
                    'created_at'     => date('Y-m-d h:i:s'),
                    'created_by'     => $this->session->userdata('login')['user_id'],
                );

                $insertberkas = $this->m_pegawai_pangkat->insert_berkas($datainsert);

                

                if($insertberkas){
                    if (!move_uploaded_file(
                        $_FILES['file']['tmp_name'],
                        $filepath
                    )) {
                        throw new RuntimeException('Upload gagal.');
                    }
                }
            
                $this->m_pegawai_pangkat->update_custom_table(array('new_item' => 1), 'pangkat', 'jenis', 'notifikasi_atasan');

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
            $this->loadView('pangkat/pegawai_pangkat_add', $data);
        }

    }
    
    public function delete($id)
    {
        $simpan = $this->m_pegawai_pangkat->delete_berkas($id);
        if (!empty($simpan)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
                $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
            redirect('pangkat/PegawaiPangkat');
    }
}

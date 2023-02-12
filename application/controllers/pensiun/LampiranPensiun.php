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
class LampiranPensiun extends MY_Controller
{

    //put your code here
    var $view = 'pensiun/lampiran_pensiun';

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
        echo $this->m_pegawai_pensiun->json_lampiran();
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
                $kode = $this->input->post('time');
                
                    $datainsertlampiran = array(
                        'pensiunlampiran_pensiun_kode' => $kode,
                        'pensiunlampiran_file'     => $_FILES['file']['name'],
                        'pensiunlampiran_status'     => 1
                    );

                    $insertberkas = $this->m_pegawai_pensiun->insert_lampiran($datainsertlampiran);

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
            $this->loadView('pensiun/lampiran_pensiun_add', $data);
        }

    }
    
    public function delete($id)
    {
        $simpan = $this->m_pegawai_pensiun->delete_lampiran($id);
        if (!empty($simpan)) {
                $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
                $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
            redirect('pensiun/LampiranPensiun');
    }
}

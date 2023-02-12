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
class PegawaiCuti extends MY_Controller
{

    var $page = "esign/pegawai_cuti";

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_home', 'm_pegawai', 'ref_jenis_cuti', 'ref_berkas_cuti', 'm_pegawai_cuti_online', 'm_pegawai_cuti_online_esign', 'm_pegawai_cuti', 'ref_unit', 'ref_status_permohonan_cuti'));
        $this->load->library('datatables');
    }

    //put your code here

    public function index()
    {
        $data['unit'] = $this->ref_unit->get_unit();
        $data['berkas'] = $this->ref_berkas_cuti->get_all();
        $data['status_permohonan'] = $this->ref_status_permohonan_cuti->get_all();
        $this->loadView($this->page, $data);
    }

    public function json()
    {

        $filter = array(
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
        );

        $this->session->set_userdata('filter', $filter);

        header('Content-Type: application/json');
        echo $this->m_pegawai_cuti_online_esign->json();
    }

    public function update($jenis = null)
    {
        $nos = $this->input->post('pegawaicuti_no_permohonan');
		$session = $this->session->userdata('login');

        if ($jenis == 'sign') {

            foreach ($nos as $key => $v) {
                $cuti = $this->m_pegawai_cuti_online_esign->get_where_custom('file_sk', array('pegawaicuti_no_permohonan' => $v), 'pegawai_cuti_online')->row();

                $no = $v;
                $nik = $session['nik'];
                $pdf = FCPATH . '/assets/docs/cuti/' . $cuti->file_sk;
                // $pass = '!Bsre1221*';
        		$pass = $this->input->post('passphrase');

                $ext = pathinfo($pdf, PATHINFO_EXTENSION);
                $filename = basename($pdf, '.' . $ext);
                $directoryName = realpath(dirname($pdf));
                // die($filename);
                $data = array(
                    'nik' => $nik,
                    'passphrase' => $pass,
                    'tampilan' => 'visible',
                    'image' => 'false',
                    // 'halaman' => 'PERTAMA',
                    // 'xAxis' => '43.63',
                    // 'yAxis' => '28.71',
                    'tag_koordinat' => '#',
                    'width' => '160',
                    'height' => '70',
                    'linkQR' => base_url(),
                    // 'text' => 'Dokumen ini ditandatangani secara elektronik'
                );

                $files = array(
                    'file' => $pdf,
                    'imageTTD' => FCPATH . '/assets/docs/spesimen/example.png'
                );

                $response = $this->esign('api/sign/pdf', 'POST', $data, $files);

                if (!$response) {
                    echo json_encode(array('success' => false, 'message' =>  $this->errorAPI));
                    exit;
                    break;
                } else {

                    $header = $this->headerAPI;

                    $file = $this->esign('api/sign/download/' . $header['id_dokumen'][0], 'GET');
                    $fp = fopen($directoryName . '/' . $filename . '_signed.pdf', 'wb');
                    fwrite($fp, $file);
                    fclose($fp);

                    $data_update['pegawaicuti_status_permohonan'] = '4';

                    $update = $this->m_pegawai_cuti_online_esign->update_by_no($data_update, $no);

                    if (empty($update)) {
                        echo json_encode(array('success' => false, 'message' => 'Dokumen gagal ditanda tangani'));
                        exit;
                        break;
                    }
                
                	
                $cuti = $this->m_pegawai_cuti_online->get_by_no($no);

                foreach ($cuti as $key) {
                    $data_insert['pegawaicuti_pegawai_nip'] = $key['pegawaicuti_pegawai_nip'];
                    $data_insert['pegawaicuti_jeniscuti_id'] = $key['pegawaicuti_jeniscuti_id'];
                    $data_insert['pegawaicuti_lama_cuti_mulai'] = $key['pegawaicuti_lama_cuti_mulai'];
                    $data_insert['pegawaicuti_lama_cuti_selesai'] = $key['pegawaicuti_lama_cuti_selesai'];
                    $data_insert['pegawaicuti_sk_no'] = $key['pegawaicuti_sk_no'];
                    $data_insert['pegawaicuti_sk_tanggal'] = $key['pegawaicuti_sk_tanggal'];
                    $data_insert['pegawaicuti_diambil'] = 0;
                   	$data_insert['pegawaicuti_sisa'] = 0;
                    $data_insert['update_user_id'] = $this->session->userdata('login')['user_id'];
                    $insert = $this->m_pegawai_cuti->insert($data_insert);
                }
                    $pegawai = $this->m_pegawai->get_row($data_insert['pegawaicuti_pegawai_nip']);
                    $nomor  = !empty ($pegawai->pegawai_hp) ? $pegawai->pegawai_hp : $pegawai->pegawai_telpon;
                	
                    $file = 'assets/docs/cuti/'.$filename . '_signed.pdf';
                    // $nomor = '6281328209998';
                    $text = "Selamat Surat Izin Cuti anda sudah terbit. Terima kasih.";
                        
            			if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
            			$curl = curl_init();
                		$this->send_wa($curl, no_hp($nomor), $text); 
            			$this->send_media($curl, no_hp($nomor), $text, $file);  
            			curl_close($curl);
            			}
                }
            }
            echo json_encode(array('success' => true, 'message' => 'Dokumen berhasil ditanda tangani'));
        } else {
            
            foreach ($nos as $key => $v) {
                $no = $v;
                $data['pegawaicuti_status_permohonan'] = '3';
                $data['pegawaicuti_keterangan_tolak'] = $this->input->post('keterangan');

                $text = "Surat Izin Cuti anda tidak dapat diproses, silakan lakukan pengecekan pada Aplikasi SIPEDAS untuk keterangan lainnya.";
                $nomor  = '6282258611297';
                $curl = curl_init();
                // $this->send_wa($curl, $nomor, $text);  
                curl_close($curl);

                $update = $this->m_pegawai_cuti_online_esign->update_by_no($data, $no);
            }
            echo json_encode(array('success' => true, 'message' => 'Dokumen berhasil dikembalikan'));
        }
    }

    public function detail($id)
    {
        $row = $this->m_pegawai_cuti_online_esign->get_by_id($id);
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

            $data['berkas_mutasi'] = $this->m_pegawai_cuti_online_esign->getBerkasByPermohonan($id);
            $data['berkas'] = $this->ref_berkas_mutasi->get_where(array('berkas_jenis_mutasi_id' => $data['usulan_jenis']));

            $datetime1 = date_create($row->pegawai_pns_tmt);
            $datetime2 = date_create(date('Y-m-d'));

            $interval = date_diff($datetime1, $datetime2);
            $data['masa_kerja'] = $interval->format('%y Tahun');
            // print_r($data['berkas']);
            // die;
            $data['provinsi'] = $this->ref_propinsi->get_all(); //get provinsi indo
            $data['kabupaten'] = $this->ref_kabupaten->get_all(); //get provinsi indo
            $data['unit'] = $this->ref_unit->get_unit_parent();

            $this->loadView('cuti/data_pengajuan_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('cuti/DataPengajuan');
        }
    }

    public function delete($id)
    {
        $simpan = $this->m_pegawai_cuti_online_esign->delete($id);
        if (!empty($simpan)) {
            $this->session->set_flashdata('message', alert_show('success', "Berhasil Terhapus"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Gagal Terhapus"));
        }
        redirect('cuti/DataPengajuan');
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
            CURLOPT_POSTFIELDS => '{
            "number" : ' . $number . ',
            "caption": "' . $message . '",
            "file": "' . $file . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
    }

}

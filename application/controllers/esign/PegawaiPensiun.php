<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiPensiun extends MY_Controller
{

    //variable
    var $view = 'esign/pegawai_pensiun';     // file view
    var $redirect = 'esign/PegawaPensiun';     // redirect to here
    var $modul = 'Berkas Pegawai Pensiun';        // this modul or class name

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_pensiun_esign', 'ref_pejabat', 'm_sistem'));
        $this->load->model('ref_unit');
        $this->load->model('ref_gaji');
    }

    public function index()
    {
        // echo phpinfo(); exit;
        //     $curl = curl_init();

        // 	curl_setopt_array($curl, array(
        //   		CURLOPT_URL => '172.31.0.38',
        //   		// CURLOPT_SSL_VERIFYPEER => FALSE,
        //   		// CURLOPT_SSL_VERIFYHOST => FALSE,
        //   		CURLOPT_RETURNTRANSFER => true,
        //   		CURLOPT_ENCODING => '',
        //   		CURLOPT_MAXREDIRS => 10,
        //   		CURLOPT_TIMEOUT => 0,
        //   		CURLOPT_FOLLOWLOCATION => true,
        //   		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   		CURLOPT_CUSTOMREQUEST => 'GET',
        //   		CURLOPT_HTTPHEADER => array(
        //     	'Cookie: JSESSIONID=634A225AEB19129407166C05ACD41165'
        //   	),
        // 	));

        // 	$response = curl_exec($curl);
        // 	// $err     = curl_errno( $curl );
        //     $errmsg  = curl_error( $curl );
        // 	curl_close($curl);
        // 	// echo $err;
        // 	// echo $errmsg;
        // 	echo $response;
        //     exit;

        $data['unit'] = $this->ref_unit->get_unit();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $this->loadView($this->view, $data);
    }

    public function json()
    {

        $filter = array(
            'bulan' => $this->input->post('bulan'),
            'tahun' => $this->input->post('tahun'),
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
            'cpns' => $this->input->post('cpns'),
        );

        $this->session->set_userdata('filter', $filter);

        echo $this->m_pegawai_pensiun_esign->json();
    }


    public function update($jenis = null)
    {
        //extrac post here and post primary key is id
        $session = $this->session->userdata('login');
        $pensiun_ids = $this->input->post('pensiun_id');
        // $nik = '0803202100007062';
        $nik = $session['nik'];
        $pass = $this->input->post('passphrase');
		// die($nik);
        if ($jenis == 'sign') {

        	if($session['group_id'] == '9'){
            
            
            // $lampiran = $this->m_pegawai_pensiun_esign->get_lampiran($pensiun_ids[0]);
            // $pdf = FCPATH . '/assets/docs/pensiun/' . $lampiran->pensiunlampiran_file; // DPCP
            //     // $pdf = '/C:/Users/User/Downloads/196302101985011002_DPCP.pdf'; // DPCP


            //     $ext = pathinfo($pdf, PATHINFO_EXTENSION);
            //     $filename = basename($pdf, '.' . $ext);
            //     $directoryName = realpath(dirname($pdf));
            //     // die($filename);
            //     $data = array(
            //         'nik' => $nik,
            //         'passphrase' => $pass,
            //         'tampilan' => 'visible',
            //         'image' => 'false',
            //         // 'page' => '2',
            //         // 'halaman' => 'PERTAMA',
            //         // 'xAxis' => '820',
            //         // 'yAxis' => '200',
            //         'tag_koordinat' => '#',
            //         'width' => '200',
            //         'height' => '50',
            //         // 'linkQR' => base_url('assets/docs/pensiun/' . $filename . '_signed.pdf'),
            //         'linkQR' => base_url(),
            //         // 'text' => 'Dokumen ini ditandatangani secara elektronik'
            //     );

            //     $files = array(
            //         'file' => $pdf,
            //         // 'imageTTD' => FCPATH.'/assets/docs/spesimen/example.png'
            //     );

            //     $response = $this->esign('api/sign/pdf', 'POST', $data, $files);

            //     if (!$response) {
                	
            //     	$log = array(
            //         	'log_id_user' => $session['user_id'],
            //         	'log_menu'    => 'pensiun',
            //         	'log_action_id' => $pensiun_ids[0],
            //         	'log_status'  => 'error',
            //         	'log_response'  => $this->errorAPI,
            //         	'ip_address'  => $this->input->ip_address(),
            //         	'user_agent'  => $this->input->user_agent(),
            //         	'created_at'  => date('Y-m-d h:i:s')
            //         );
                
            //     	$this->m_sistem->insert_log_esign($log);
                
            //         echo json_encode(array('success' => false, 'message' =>  $this->errorAPI));
            //         exit;
            //     } else {

            //         $header = $this->headerAPI;

            //         $file = $this->esign('api/sign/download/' . $header['id_dokumen'][0], 'GET');
            //         $fp = fopen($directoryName . '/' . $filename . '_signed.pdf', 'wb');
            //         fwrite($fp, $file);
            //         fclose($fp);

            //         $id = $lampiran->pensiunlampiran_pensiun_kode;
            //         $data = array('pensiunlampiran_status' => '2');
            //         $this->m_pegawai_pensiun_esign->update_lampiran($data, $id); // 
            //     }
            
            foreach ($pensiun_ids as $key => $v) {
                $pensiun = $this->m_pegawai_pensiun_esign->get_where_custom('pensiunberkas_file', array('pensiunberkas_pensiun_id' => $v,'pensiunberkas_jenis' => '1'), 'pegawai_pensiun_berkas')->row();

                $pdf = FCPATH . '/assets/docs/pensiun/' . $pensiun->pensiunberkas_file; // DPCP
                // $pdf = '/C:/Users/User/Downloads/196302101985011002_DPCP.pdf'; // DPCP


                $ext = pathinfo($pdf, PATHINFO_EXTENSION);
                $filename = basename($pdf, '.' . $ext);
                $directoryName = realpath(dirname($pdf));
                // die($filename);
                $data = array(
                    'nik' => $nik,
                    'passphrase' => $pass,
                    'tampilan' => 'visible',
                    'image' => 'false',
                    // 'page' => '1',
                    // 'halaman' => 'PERTAMA',
                    // 'xAxis' => '410',
                    // 'yAxis' => '220',
                    'tag_koordinat' => '#',
                    'width' => '200',
                    'height' => '50',
                    // 'linkQR' => base_url('assets/docs/pensiun/' . $filename . '_signed.pdf'),
                    'linkQR' => base_url(),
                    // 'text' => 'Dokumen ini ditandatangani secara elektronik'
                );

                $files = array(
                    'file' => $pdf,
                    // 'imageTTD' => FCPATH.'/assets/docs/spesimen/example.png'
                );

                $response = $this->esign('api/sign/pdf', 'POST', $data, $files);

                if (!$response) {
                	
                	$log = array(
                    	'log_id_user' => $session['user_id'],
                    	'log_menu'    => 'pensiun',
                    	'log_action_id' => $v,
                    	'log_status'  => 'error',
                    	'log_response'  => $this->errorAPI,
                    	'ip_address'  => $this->input->ip_address(),
                    	'user_agent'  => $this->input->user_agent(),
                    	'created_at'  => date('Y-m-d h:i:s')
                    );
                
                	$this->m_sistem->insert_log_esign($log);
                
                    echo json_encode(array('success' => false, 'message' =>  $this->errorAPI));
                    exit;
                    break;
                } else {

                    $header = $this->headerAPI;

                    $file = $this->esign('api/sign/download/' . $header['id_dokumen'][0], 'GET');
                    $fp = fopen($directoryName . '/' . $filename . '_signed.pdf', 'wb');
                    fwrite($fp, $file);
                    fclose($fp);

                    $id = $v;
                    $pegawai = $this->m_pegawai_pensiun_esign->get_row($id);
                    $data = array('pensiunberkas_status' => '2');
                    $this->m_pegawai_pensiun_esign->update_berkas($data, $id, '1'); // 1= dpcp


                    // $nomor  = !empty ($pegawai->pegawai_hp) ? $pegawai->pegawai_hp : $pegawai->pegawai_telpon;
                    $filename = 'assets/docs/pensiun/'.$filename . '_signed.pdf';
                    $nomor = '6281328209998';
                    $message = 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, berikut adalah Surat Keterangan Kenaikan Gaji Berkala Anda. Terimakasih.';
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        // $this->send_wa($curl, no_hp($nomor), $message); 
                        // $this->send_media($curl, no_hp($nomor), $message, $filename);  
                        curl_close($curl);
                    }
                }

            }
            }
        	if($session['group_id'] == '11'){
            foreach ($pensiun_ids as $key => $v) {
                $pensiun = $this->m_pegawai_pensiun_esign->get_where_custom('pensiunberkas_file', array('pensiunberkas_pensiun_id' => $v,'pensiunberkas_jenis' => '2'), 'pegawai_pensiun_berkas')->row();

                $pdf = FCPATH . '/assets/docs/pensiun/' . $pensiun->pensiunberkas_file; // SK
                // $pdf = '/C:/Users/User/Downloads/196302101985011002_DPCP.pdf'; 


                $ext = pathinfo($pdf, PATHINFO_EXTENSION);
                $filename = basename($pdf, '.' . $ext);
                $directoryName = realpath(dirname($pdf));
                // die($filename);
                $data = array(
                    'nik' => $nik,
                    'passphrase' => $pass,
                    'tampilan' => 'visible',
                    'image' => 'false',
                    // 'page' => '1',
                    // 'halaman' => 'PERTAMA',
                    // 'xAxis' => '820',
                    // 'yAxis' => '180',
                    'tag_koordinat' => '#',
                    'width' => '200',
                    'height' => '50',
                    // 'linkQR' => base_url('assets/docs/pensiun/' . $filename . '_signed.pdf'),
                    'linkQR' => base_url(),
                    // 'text' => 'Dokumen ini ditandatangani secara elektronik'
                );

                $files = array(
                    'file' => $pdf,
                    // 'imageTTD' => FCPATH.'/assets/docs/spesimen/example.png'
                );

                $response = $this->esign('api/sign/pdf', 'POST', $data, $files);

                if (!$response) {
                	
                	$log = array(
                    	'log_id_user' => $session['user_id'],
                    	'log_menu'    => 'pensiun',
                    	'log_action_id' => $v,
                    	'log_status'  => 'error',
                    	'log_response'  => $this->errorAPI,
                    	'ip_address'  => '',
                    	'user_agent'  => '',
                    	'created_at'  => date('Y-m-d h:i:s')
                    );
                
                	$this->m_sistem->insert_log_esign($log);
                
                    echo json_encode(array('success' => false, 'message' =>  $this->errorAPI));
                    exit;
                    break;
                } else {

                    $header = $this->headerAPI;

                    $file = $this->esign('api/sign/download/' . $header['id_dokumen'][0], 'GET');
                    $fp = fopen($directoryName . '/' . $filename . '_signed.pdf', 'wb');
                    fwrite($fp, $file);
                    fclose($fp);

                    $id = $v;
                    $pegawai = $this->m_pegawai_pensiun_esign->get_row($id);
                    $data = array('pensiunberkas_status' => '2');
                    $this->m_pegawai_pensiun_esign->update_berkas($data, $id, '2'); //  2= sk


                    // $nomor  = !empty ($pegawai->pegawai_hp) ? $pegawai->pegawai_hp : $pegawai->pegawai_telpon;
                    $filename = 'assets/docs/pensiun/'.$filename . '_signed.pdf';
                    $nomor = '6281328209998';
                    $message = 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, berikut adalah Surat Keterangan Kenaikan Gaji Berkala Anda. Terimakasih.';
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        // $this->send_wa($curl, no_hp($nomor), $message); 
                        // $this->send_media($curl, no_hp($nomor), $message, $filename);  
                        curl_close($curl);
                    }
                }

            }
            }
                echo json_encode(array('success' => true, 'message' => 'Dokumen berhasil ditanda tangani'));
        } else {

            
            foreach ($pensiun_ids as $key => $v) {
                $id = $v;
                $keterangan = $this->input->post('keterangan');
                $pegawai = $this->m_pegawai_pensiun_esign->get_row($id);
                // $data = array('pensiunberkas_status' => '3', 'pegawaikgb_keterangan' => $keterangan);
                $data = array('pensiunberkas_status' => '3');
                $this->m_pegawai_pensiun_esign->update_custom_table($data, $id, 'pensiunberkas_pensiun_id', 'pegawai_pensiun_berkas');
            }

            echo json_encode(array('success' => true, 'message' => 'Dokumen berhasil dikembalikan'));
        }
    }

    public function delete($id)
    {
        $delete = $this->m_konversi->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show('success',  "Delete " . $this->modul . " Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger',  "Delete " . $this->modul . " Gagal"));
        }
        redirect($this->redirect);
    }

    public function excel()
    {
        $data['result'] = $this->m_konversi->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

    public function cetak($pensiun_id)
    {

        $this->load->library('Word');

        $PHPWord = new PHPWord();
        $row = $this->m_pegawai_pensiun_esign->get_by_id($pensiun_id);

        if ($row->pegawai_status_kepegawaian_id == '1') { // jika cpns
            $kgb = $this->m_pegawai_pensiun_esign->get_data_cetak_cpns($pensiun_id, $row->pegawaikgb_pegawai_nip);
        } else {
            $kgb = $this->m_pegawai_pensiun_esign->get_data_cetak($pensiun_id, $row->pegawaikgb_pegawai_nip);
        }

        $data['golongan'] = $kgb->pegawai_pangkat_terakhir_golru;
        // die(substr($golongan, 0, 2));
        if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/') {
            $data['maks'] = 60;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_1&2.docx');
        } elseif (substr($data['golongan'], 0, 3) == 'III') {
            $data['maks'] = 58;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_3.docx');
        } elseif (substr($data['golongan'], 0, 2) == 'IV') {
            $data['maks'] = 58;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_4.docx');
        } else {
            $data['maks'] = 60;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_3.docx');
        }

        $data['nama'] = '';
        if (!empty($kgb->pegawai_gelar_depan)) {
            $data['nama'] .= $kgb->pegawai_gelar_depan . '. ';
        }
        $data['nama'] .= ucwords(strtoupper($kgb->pegawai_nama));
        if (!empty($kgb->pegawai_gelar_belakang)) {
            $data['nama'] .= ', ' . $kgb->pegawai_gelar_belakang;
        }

        $data['tgl'] = tgl_indo(date('Y-m-d'));
        $data['tgl_lahir'] = date('d-m-Y', strtotime($kgb->pegawai_tgl_lahir));
        $data['nip'] = $kgb->pegawai_nip;
        $data['pangkat'] = ucwords(strtolower($kgb->pegawai_pangkat_terakhir_nama));
        $data['jabatan'] = ucwords(strtolower($kgb->pegawai_jabatan_nama));
        $data['unit_kerja'] = ucwords(strtolower(htmlspecialchars($kgb->pegawai_unit_nama)));
        $data['gaji_old'] = ribuan($kgb->gaji_old);
        $data['tmt'] = tgl_indo($kgb->pegawaikgb_tmt);
        $data['tgl_sk_old'] = tgl_indo($kgb->tgl_sk_old);
        $data['no_sk_old'] = $kgb->no_sk_old;
        $data['no_sk'] = $kgb->pegawaikgb_sk_no;
        $data['tgl_sk'] = tgl_indo($kgb->pegawaikgb_sk_tanggal);
        $data['tmt_old'] = tgl_indo($kgb->tmt_old);
        $data['tmt_selanjutnya'] = tgl_indo(date('Y-m-d', strtotime($kgb->pegawaikgb_tmt . ' + 2 years')));
        $data['masa_kerja_tahun_old'] = ($kgb->masa_kerja_tahun_old);
        $data['masa_kerja_bulan_old'] = $kgb->masa_kerja_bulan_old;
        $data['masa_kerja_tahun'] = ($kgb->pegawaikgb_masa_kerja_tahun);
        $data['masa_kerja_bulan'] = $kgb->pegawaikgb_masa_kerja_bulan;
        $data['gaji_baru'] = ribuan($kgb->pegawaikgb_gaji);
        $data['terbilang'] = terbilang($kgb->pegawaikgb_gaji) . " Rupiah";

        $datetime1 = date_create(date('Y-m-d'));
        $datetime2 = date_create($kgb->pegawai_tgl_lahir);

        $interval = date_diff($datetime1, $datetime2);
        $umur     = $interval->format('%y');

        if (($data['maks'] - $umur) < 2) {
            $data['tmt_selanjutnya'] = 'Maksimal';
        }

        $document->setValue('tgl', '' . $data['tmt'] . '');
        $document->setValue('nama', '' . $data['nama'] . '');
        $document->setValue('tgl_lahir', '' . $data['tgl_lahir'] . '');
        $document->setValue('nip', '' . $data['nip'] . '');
        $document->setValue('pangkat', '' . $data['pangkat']  . '');
        $document->setValue('jabatan', '' . $data['jabatan']  . '');
        $document->setValue('unit_kerja', '' . $data['unit_kerja']  . '');
        $document->setValue('gaji_old', '' . $data['gaji_old'] . '');
        $document->setValue('tmt', '' . $data['tmt']  . '');
        $document->setValue('tmt_old', '' . $data['tmt_old']  . '');
        $document->setValue('tgl_sk', '' . $data['tgl_sk']  . '');
        $document->setValue('no_sk', '' . $data['no_sk']  . '');
        $document->setValue('tgl_sk_old', '' . $data['tgl_sk_old']  . '');
        $document->setValue('no_sk_old', '' . $data['no_sk_old']  . '');
        $document->setValue('tmt_selanjutnya', '' . $data['tmt_selanjutnya']  . '');
        $document->setValue('masa_kerja_tahun_old', '' . $data['masa_kerja_tahun_old']  . '');
        $document->setValue('masa_kerja_bulan_old', '' . $data['masa_kerja_bulan_old']  . '');
        $document->setValue('masa_kerja_tahun', '' . $data['masa_kerja_tahun']  . '');
        $document->setValue('masa_kerja_bulan', '' . $data['masa_kerja_bulan']  . '');
        $document->setValue('gaji_baru', '' . $data['gaji_baru']  . '');
        $document->setValue('terbilang', '' . $data['terbilang']  . '');
        $document->setValue('golongan', '' . $data['golongan']  . '');
        $file = 'assets/docs/kgb/PENETAPAN KENAIKAN GAJI BERKALA - ' . $data['nip'] . '.docx';

        // if($data['nip'] == '198409142017062001'){
        //     die(json_encode($data)); die;
        // }
        $document->save($file);

        redirect(base_url($file));

        // $filename='PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.'.docx'; //save our document as this file name

        // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        // header('Cache-Control: max-age=0'); //no cache

        // $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2003');
        // $objWriter->save('php://output');

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

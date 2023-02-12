<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiKgb extends MY_Controller {

    //variable
    var $view = 'pegawai/pegawai_kgb';     // file view
    var $redirect = 'pegawai/PegawaiKgb';     // redirect to here
    var $modul = 'Kenaikan Gaji Berkala';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_kgb', 'ref_pejabat'));
        $this->load->model('ref_unit');
        $this->load->model('ref_gaji');
    }

    public function index() {
        $data['unit'] = $this->ref_unit->get_unit();
        $data['pejabat'] = $this->ref_pejabat->get_all();
        $this->loadView($this->view,$data);
    }

    public function json()
    {
        
        $filter = array(
            'bulan' => $this->input->post('bulan'),
            'tahun' => $this->input->post('tahun'),
            'opd'   => $this->input->post('opd'),
            'proses'=> $this->input->post('proses'),
            'cpns'=> $this->input->post('cpns'),
        );
        
        $this->session->set_userdata('filter', $filter);

        if($filter['cpns'] == '1'){
            header('Content-Type: application/json');
            echo $this->m_pegawai_kgb->json_cpns();
        }else{
            header('Content-Type: application/json');
            echo $this->m_pegawai_kgb->json();
        }
    }

    private function upload_sk($filename){
        // $kode_surat = $this->getKodeSurat();
        $id = $this->input->post('id_kgb');
        $dir = "assets/files";
        $config['upload_path']    = $dir;
        $config['allowed_types']  = 'jpg|jpeg|png|pdf';
        $config['overwrite']      = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['max_size']     = 2048;
        if ($_FILES["file"]["error"] == 0) {
            //stands for any kind of errors happen during the uploading

            $config['file_name'] = $filename;

            $this->load->library('upload');

            $this->upload->initialize($config);

            $fieldname = "file";

            if ($this->upload->do_upload($fieldname)) {

                $upload = array();
                $upload = $this->upload->data();

                $this->m_pegawai_kgb->delete_file($id); //delete file yg sdh ada

                $upload = array();
                $upload = $this->upload->data();

                $data_file = array(
                    'kgbsk_kenaikan_gaji_id' => $id,
                    'kgbsk_file' => $upload['file_name'],
                );
                $this->m_pegawai_kgb->save_file($data_file);
                
            } else {
                echo json_encode(array('success' => false, 'message' => 'Sorry, there was an error uploading your file.'));
                exit;
            }
        } else {
            echo '{"success":false}';
        }
    }

    public function update($jenis = null) {
        //extrac post here and post primary key is id
        $session = $this->session->userdata('login');
        $nips = $this->input->post('nip');
        $pegawaikgb_sk_no = $this->input->post('pegawaikgb_sk_no');
        $pegawaikgb_sk_tanggal = y_m_d($this->input->post('pegawaikgb_sk_tanggal'));
        $pegawaikgb_pejabat = $this->input->post('pegawaikgb_pejabat');
        $cpns = $this->input->post('cpns');

        if($jenis == 'sk'){
            $id = $this->input->post('id_kgb');
            $pegawai = $this->m_pegawai_kgb->get_row($id);
            $nip = $pegawai->pegawaikgb_pegawai_nip;
            $data = array('proses_bpkad' => '1');
            $this->m_pegawai_kgb->update($data, $id);

            $filename = "SK_KGB_" . $nip . '_' . date('His');
            $this->upload_sk($filename);
            
            $nomor  = !empty ($pegawai->pegawai_hp) ? $pegawai->pegawai_hp : $pegawai->pegawai_telpon;
            $nomor = '6282258611297';
            $message= 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, berikut adalah Surat Keterangan Kenaikan Gaji Berkala Anda. Terimakasih.'; 
            // $message = "";
                    
            if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
            	$curl = curl_init();
                $this->send_wa($curl, no_hp($nomor), $message); 
            	$this->send_media($curl, no_hp($nomor), $message, $filename);  
            	curl_close($curl);
            }

            echo json_encode(array('success' => true, 'message' => 'Upload SK berhasil'));
            exit;
        } else {
            if(is_array($nips)){
                $array = implode("','",$nips);

                if($cpns != '1'){
                    $pegawai = $this->m_pegawai_kgb->get_pegawai_gaji($array);
                }else{
                    $pegawai = $this->m_pegawai_kgb->get_pegawai_gaji_cpns($array);
                }
                // die(json_encode($pegawai->result_array()));
                $curl = curl_init();
            
                foreach($pegawai->result() as $key) {
                
                $nip = $key->pegawai_nip;
                $pangkat = $key->pegawai_pangkat_terakhir_id;
                $pangkat_sebelum = $key->pegawaikgb_pangkat_id;
                $gol = $key->pangkat_golongan_text;
                $gaji= $key->gaji_jumlah;
                $masa_kerja_tahun = $key->gaji_masa_kerja;
                $masa_kerja_bulan = '0';
                $tmt = $key->pegawaikgb_tmt;
                
                $pangkat_terakhir = $this->m_pegawai_kgb->get_pangkat_terakhir($nip);
                
                if($pangkat_terakhir->pegawaipangkat_pangkat_id != $pangkat_sebelum ){ 
                    $pangkat = $pangkat_terakhir->pegawaipangkat_pangkat_id;
                    $gol = $pangkat_terakhir->pegawaipangkat_pangkat_nama.' ('.$pangkat_terakhir->pegawaipangkat_pangkat_golru.')';
                    $masa_kerja_tahun = $key->gaji_masa_kerja;
                
                    if($pangkat_sebelum == '4' && $pangkat_terakhir->pegawaipangkat_pangkat_id == '5') { // naik pangkat Id ke IIa
                        $masa_kerja_tahun = $key->gaji_masa_kerja - 6 + 2;
                    }
                
                    if($pangkat_sebelum == '8' && $pangkat_terakhir->pegawaipangkat_pangkat_id == '9') { // naik pangkat IId ke IIIa
                        $masa_kerja_tahun = $key->gaji_masa_kerja - 5 + 2;
                    }
                
                    $gaji_terakhir= $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
                    $gaji = $gaji_terakhir->gaji_jumlah;
                    $masa_kerja_bulan= '0';
                
                }
                
                    $update = $this->m_pegawai_kgb->proses_kgb($nip,$pangkat,$gol,$gaji,$masa_kerja_tahun,$masa_kerja_bulan,$session['user_id'],$tmt,$pegawaikgb_sk_no,$pegawaikgb_sk_tanggal,$pegawaikgb_pejabat);
                    $nomor  = $key->no_telp;
                    $message= 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, silahkan berkoordinasi dengan Kasubbag Kepegawaian OPD untuk pengambilan dokumen ke BKPSDM Kabupaten Sanggau. Terima kasih.'; 
                    
                    // if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
                    // 	$this->send_wa($curl, no_hp($nomor), $message);  
                    // }
                }
                curl_close($curl);
            }else{
                
                if($cpns != '1'){
                    $key = $this->m_pegawai_kgb->get_pegawai_gaji($nips)->row();
                }else{
                    $key = $this->m_pegawai_kgb->get_pegawai_gaji_cpns($nips)->row();
                }

                $nip = $key->pegawai_nip;
                $pangkat = $key->pegawai_pangkat_terakhir_id;
                $pangkat_sebelum = $key->pegawaikgb_pangkat_id;
                $gol = $key->pangkat_golongan_text;
                $gaji= $key->gaji_jumlah;
                $masa_kerja_tahun = $key->gaji_masa_kerja;
                $masa_kerja_bulan = '0';
                $tmt = $key->pegawaikgb_tmt;
                
                
                $pangkat_terakhir = $this->m_pegawai_kgb->get_pangkat_terakhir($nip);
                // print_r($pangkat_terakhir); die;
                if($pangkat_terakhir->pegawaipangkat_pangkat_id != $pangkat_sebelum){
                    $pangkat = $pangkat_terakhir->pegawaipangkat_pangkat_id;
                    $gol = $pangkat_terakhir->pegawaipangkat_pangkat_nama.' ('.$pangkat_terakhir->pegawaipangkat_pangkat_golru.')';
                    $masa_kerja_tahun = $key->gaji_masa_kerja;
                
                    if($pangkat_sebelum == '4' && $pangkat_terakhir->pegawaipangkat_pangkat_id == '5') { // naik pangkat Id ke IIa
                        $masa_kerja_tahun = $key->gaji_masa_kerja - 6;
                    }
                
                    if($pangkat_sebelum == '8' && $pangkat_terakhir->pegawaipangkat_pangkat_id == '9') { // naik pangkat IId ke IIIa
                        $masa_kerja_tahun = $key->gaji_masa_kerja - 5;
                    }
                
                    $gaji_terakhir= $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
                    $gaji = $gaji_terakhir->gaji_jumlah;
                    $masa_kerja_bulan= '0';
                }
                
                    $update = $this->m_pegawai_kgb->proses_kgb($nip,$pangkat,$gol,$gaji,$masa_kerja_tahun,$masa_kerja_bulan,$session['user_id'],$tmt,$pegawaikgb_sk_no,$pegawaikgb_sk_tanggal,$pegawaikgb_pejabat);
                    // $nomor  = $key->no_telp;
                    // $message= 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, silahkan berkoordinasi dengan Kasubbag Kepegawaian OPD untuk pengambilan dokumen ke BKPSDM Kabupaten Sanggau'; 
                    
                    // if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
                    // 	$curl = curl_init();
                    // 	$this->send_wa($curl, no_hp($nomor), $message);  
                    // 	curl_close($curl);
                    // }
            }

            $this->session->set_flashdata('message', alert_show('success', "Proses Kenaikan Gaji Berkala Berhasil"));
                
            redirect($this->redirect);
        }
    }

    public function delete($id) {
        $delete = $this->m_konversi->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show('success',  "Delete " . $this->modul . " Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger',  "Delete " . $this->modul . " Gagal"));
        }
        redirect($this->redirect);
    }

    public function excel() {
        $data['result'] = $this->m_konversi->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

    public function cetak($kgb_id) {

        $this->load->library('Word');

        $PHPWord = new PHPWord();
		$row = $this->m_pegawai_kgb->get_by_id($kgb_id);

        if($row->pegawai_status_kepegawaian_id == '1'){ // jika cpns
            $kgb = $this->m_pegawai_kgb->get_data_cetak_cpns($kgb_id, $row->pegawaikgb_pegawai_nip);
        } else {
            $kgb = $this->m_pegawai_kgb->get_data_cetak($kgb_id, $row->pegawaikgb_pegawai_nip); 
        }
        
        $data['golongan'] = $kgb->pegawai_pangkat_terakhir_golru;
		// die(substr($golongan, 0, 2));
   		if(substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 1, 2) == 'I/'){
        	$data['maks'] = 60;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_1&2.docx');
        }
   		elseif(substr($data['golongan'], 0, 3) == 'III'){
        	$data['maks'] = 58;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_3.docx');
        }
   		elseif(substr($data['golongan'], 0, 2) == 'IV'){
        	$data['maks'] = 58;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_4.docx');
        }else{
        	$data['maks'] = 60;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_3.docx');
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
        $data['tmt_selanjutnya'] = tgl_indo(date('Y-m-d', strtotime($kgb->pegawaikgb_tmt. ' + 2 years')));
        $data['masa_kerja_tahun_old'] = ($kgb->masa_kerja_tahun_old);
        $data['masa_kerja_bulan_old'] = $kgb->masa_kerja_bulan_old;
        $data['masa_kerja_tahun'] = ($kgb->pegawaikgb_masa_kerja_tahun);
        $data['masa_kerja_bulan'] = $kgb->pegawaikgb_masa_kerja_bulan;
        $data['gaji_baru'] = ribuan($kgb->pegawaikgb_gaji);
        $data['terbilang'] = terbilang($kgb->pegawaikgb_gaji)." Rupiah";
    
    $datetime1 = date_create(date('Y-m-d'));
    $datetime2 = date_create($kgb->pegawai_tgl_lahir);
   
    $interval = date_diff($datetime1, $datetime2);
    $umur     = $interval->format('%y');
   
    if(($data['maks'] - $umur) < 2){
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
        $file = 'assets/docs/PENETAPAN KENAIKAN GAJI BERKALA - '. $data['nip'] .'.docx';

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
  			CURLOPT_POSTFIELDS =>'{
    				"number" : '.$number.',
    				"message": "'.$message.'"
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

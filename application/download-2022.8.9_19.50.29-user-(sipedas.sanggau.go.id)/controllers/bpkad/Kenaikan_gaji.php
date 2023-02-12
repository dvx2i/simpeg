<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_gaji extends MY_Controller {

    //variable
    var $view = 'bpkad/kenaikan_gaji';     // file view
    var $redirect = 'bpkad/Kenaikan_gaji';     // redirect to here
    var $modul = 'Kenaikan Gaji Berkala';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_kgb_bpkad', 'ref_pejabat'));
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
            echo $this->m_pegawai_kgb_bpkad->json_cpns();
        }else{
            header('Content-Type: application/json');
            echo $this->m_pegawai_kgb_bpkad->json();
        }
    }

    private function upload_sk($nip){
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

            $config['file_name'] = "SK_KGB_" . $nip . '_' . date('His');

            $this->load->library('upload');

            $this->upload->initialize($config);

            $fieldname = "file";

            if ($this->upload->do_upload($fieldname)) {

                $upload = array();
                $upload = $this->upload->data();

                $this->m_pegawai_kgb_bpkad->delete_file($id); //delete file yg sdh ada

                $upload = array();
                $upload = $this->upload->data();

                $data_file = array(
                    'kgbsk_kenaikan_gaji_id' => $id,
                    'kgbsk_file' => $upload['file_name'],
                );
                $this->m_pegawai_kgb_bpkad->save_file($data_file);

                echo '{"success":true}';
                
            } else {
                echo json_encode(array('success' => false, 'message' => 'Sorry, there was an error uploading your file.'));
                exit;
            }
        } else {
            echo '{"success":false}';
        }
    }

    public
    function update($jenis = null)
    {
        //extrac post here and post primary key is id
        $list_id = $this->input->post('list_id');
        if (is_array($list_id)) {

            // die(json_encode($pegawai->result_array()));
            // $curl = curl_init();

            foreach ($list_id as $id) {

                $data = array(
                    'proses_bpkad' => '2'
                );

                $this->m_pegawai_kgb_bpkad->update($data, $id);
                // $nomor  = $key->no_telp;
                // $message = 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, silahkan berkoordinasi dengan Kasubbag Kepegawaian OPD untuk pengambilan dokumen ke BKPSDM Kabupaten Sanggau. Terima kasih.';

                // if(substr(trim($nomor), 0, 2)=='62' || substr(trim($nomor), 0, 2)=='08') {
                // 	$this->send_wa($curl, no_hp($nomor), $message);  
                // }
            }
            echo json_encode(array('success' => true, 'message' => 'Berhasil.'));
            exit;
            // curl_close($curl);

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
		$row = $this->m_pegawai_kgb_bpkad->get_by_id($kgb_id);

        if($row->pegawai_status_kepegawaian_id == '1'){ // jika cpns
            $kgb = $this->m_pegawai_kgb_bpkad->get_data_cetak_cpns($kgb_id, $row->pegawaikgb_pegawai_nip);
        } else {
            $kgb = $this->m_pegawai_kgb_bpkad->get_data_cetak($kgb_id, $row->pegawaikgb_pegawai_nip); 
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

}

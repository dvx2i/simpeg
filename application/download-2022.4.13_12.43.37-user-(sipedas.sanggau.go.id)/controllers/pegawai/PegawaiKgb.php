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

    public function update() {
        //extrac post here and post primary key is id
        $session = $this->session->userdata('login');
        $nips = $this->input->post('nip');
        $pegawaikgb_sk_no = $this->input->post('pegawaikgb_sk_no');
        $pegawaikgb_sk_tanggal = y_m_d($this->input->post('pegawaikgb_sk_tanggal'));
        $pegawaikgb_pejabat = $this->input->post('pegawaikgb_pejabat');
        $cpns = $this->input->post('cpns');

        if(is_array($nips)){
            $array = implode("','",$nips);

            if($cpns != '1'){
                $pegawai = $this->m_pegawai_kgb->get_pegawai_gaji($array);
            }else{
                $pegawai = $this->m_pegawai_kgb->get_pegawai_gaji_cpns($array);
            }
            // die(json_encode($pegawai->result_array()));
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
            
            if($pangkat_terakhir->pegawaipangkat_pangkat_id != $pangkat_sebelum){
            	$pangkat = $pangkat_terakhir->pegawaipangkat_pangkat_id;
            	$gol = $pangkat_terakhir->pegawaipangkat_pangkat_nama.' ('.$pangkat_terakhir->pegawaipangkat_pangkat_golru.')';
            	$masa_kerja_tahun = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun+2;
            	$gaji_terakhir= $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
            	$gaji = $gaji_terakhir->gaji_jumlah;
            	$masa_kerja_bulan= '0';
            }
            
                $update = $this->m_pegawai_kgb->proses_kgb($nip,$pangkat,$gol,$gaji,$masa_kerja_tahun,$masa_kerja_bulan,$session['user_id'],$tmt,$pegawaikgb_sk_no,$pegawaikgb_sk_tanggal,$pegawaikgb_pejabat);
            }
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
            	$masa_kerja_tahun = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun+2;
            	$gaji_terakhir= $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
            	$gaji = $gaji_terakhir->gaji_jumlah;
            	$masa_kerja_bulan= '0';
            }
            
                $update = $this->m_pegawai_kgb->proses_kgb($nip,$pangkat,$gol,$gaji,$masa_kerja_tahun,$masa_kerja_bulan,$session['user_id'],$tmt,$pegawaikgb_sk_no,$pegawaikgb_sk_tanggal,$pegawaikgb_pejabat);
          }

        $this->session->set_flashdata('message', alert_show('success', "Proses Kenaikan Gaji Berkala Berhasil"));
            
        redirect($this->redirect);
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
        
        $golongan = $kgb->pegawai_pangkat_terakhir_golru;
		// die(substr($golongan, 0, 2));
   		if(substr($golongan, 0, 3) == 'II/' || substr($golongan, 1, 2) == 'I/'){
        	$maks = 60;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_1&2.docx');
        }
   		elseif(substr($golongan, 0, 3) == 'III'){
        	$maks = 58;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_3.docx');
        }
   		elseif(substr($golongan, 0, 2) == 'IV'){
        	$maks = 58;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_4.docx');
        }else{
        	$maks = 60;
        	$document = $PHPWord->loadTemplate('assets/docs/gol_3.docx');
        }
    
    	$nama = '';
   		if (!empty($kgb->pegawai_gelar_depan)) {
        	$nama .= $kgb->pegawai_gelar_depan . '. ';
    	}
    	$nama .= ucwords(strtoupper($kgb->pegawai_nama));
    	if (!empty($kgb->pegawai_gelar_belakang)) {
        	$nama .= ', ' . $kgb->pegawai_gelar_belakang;
    	}
    
        $tgl = tgl_indo(date('Y-m-d'));
        $tgl_lahir = date('d-m-Y', strtotime($kgb->pegawai_tgl_lahir));
        $nip = $kgb->pegawai_nip;
        $pangkat = ucwords(strtolower($kgb->pegawai_pangkat_terakhir_nama));
        $jabatan = ucwords(strtolower($kgb->pegawai_jabatan_nama));
        $unit_kerja = ucwords(strtolower($kgb->pegawai_unit_nama));
        $gaji_old = ribuan($kgb->gaji_old);
        $tmt = tgl_indo($kgb->pegawaikgb_tmt);
        $tgl_sk_old = tgl_indo($kgb->tgl_sk_old);
        $no_sk_old = $kgb->no_sk_old;
        $no_sk = $kgb->pegawaikgb_sk_no;
        $tgl_sk = tgl_indo($kgb->pegawaikgb_sk_tanggal);
        $tmt_old = tgl_indo($kgb->tmt_old);
        $tmt_selanjutnya = tgl_indo(date('Y-m-d', strtotime($kgb->pegawaikgb_tmt. ' + 2 years')));
        $masa_kerja_tahun_old = ($kgb->masa_kerja_tahun_old);
        $masa_kerja_bulan_old = $kgb->masa_kerja_bulan_old;
        $masa_kerja_tahun = ($kgb->pegawaikgb_masa_kerja_tahun);
        $masa_kerja_bulan = $kgb->pegawaikgb_masa_kerja_bulan;
        $gaji_baru = ribuan($kgb->pegawaikgb_gaji);
        $terbilang = terbilang($kgb->pegawaikgb_gaji)." Rupiah";
    
    $datetime1 = date_create(date('Y-m-d'));
    $datetime2 = date_create($kgb->pegawai_tgl_lahir);
   
    $interval = date_diff($datetime1, $datetime2);
    $umur     = $interval->format('%y');
   
    if(($maks - $umur) < 2){
    	$tmt_selanjutnya = 'Maksimal';
    }

        $document->setValue('tgl', '' . $tmt . '');
        $document->setValue('nama', '' . $nama . '');
        $document->setValue('tgl_lahir', '' . $tgl_lahir . '');
        $document->setValue('nip', '' . $nip . '');
        $document->setValue('pangkat', '' . $pangkat . '');
        $document->setValue('jabatan', '' . $jabatan . '');
        $document->setValue('unit_kerja', '' . $unit_kerja . '');
        $document->setValue('gaji_old', '' . $gaji_old. '');
        $document->setValue('tmt', '' . $tmt . '');
        $document->setValue('tmt_old', '' . $tmt_old . '');
        $document->setValue('tgl_sk', '' . $tgl_sk . '');
        $document->setValue('no_sk', '' . $no_sk . '');
        $document->setValue('tgl_sk_old', '' . $tgl_sk_old . '');
        $document->setValue('no_sk_old', '' . $no_sk_old . '');
        $document->setValue('tmt_selanjutnya', '' . $tmt_selanjutnya . '');
        $document->setValue('masa_kerja_tahun_old', '' . $masa_kerja_tahun_old . '');
        $document->setValue('masa_kerja_bulan_old', '' . $masa_kerja_bulan_old . '');
        $document->setValue('masa_kerja_tahun', '' . $masa_kerja_tahun . '');
        $document->setValue('masa_kerja_bulan', '' . $masa_kerja_bulan . '');
        $document->setValue('gaji_baru', '' . $gaji_baru . '');
        $document->setValue('terbilang', '' . $terbilang . '');
        $document->setValue('golongan', '' . $golongan . '');
        $file = 'assets/docs/PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.'.docx';

        $document->save($file);

        redirect(base_url($file));

        // $filename='PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.'.docx'; //save our document as this file name

        // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        // header('Cache-Control: max-age=0'); //no cache
        
        // $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2003');
        // $objWriter->save('php://output');
        
    }

}

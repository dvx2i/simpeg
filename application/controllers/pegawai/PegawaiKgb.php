<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiKgb extends MY_Controller
{

    //variable
    var $view = 'pegawai/pegawai_kgb';     // file view
    var $redirect = 'pegawai/PegawaiKgb';     // redirect to here
    var $modul = 'Kenaikan Gaji Berkala';        // this modul or class name

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai_kgb', 'ref_pejabat'));
        $this->load->model('ref_unit');
        $this->load->model('ref_gaji');
    }

    public function index()
    {
        	// $this->session->set_userdata('newitemkgb', '1');
        $data['unit'] = $this->ref_unit->get_unit();
        $data['pejabat'] = $this->ref_pejabat->get_all();
    	$data['newitem_kgb'] = $this->m_pegawai_kgb->get_where_custom('new_item', array('jenis'=>'kgb'), 'notifikasi_atasan')->row();
        $this->loadView($this->view, $data);
    }

    public function json()
    {

        // $command = "export HOME=/tmp/ && /usr/bin/libreoffice --headless --convert-to pdf '/var/www/html/assets/docs/kgb/PENETAPAN-KENAIKAN-GAJI-BERKALA-198403192007011002-2022-09-23.docx' --outdir '/var/www/html/assets/docs'";
        // // $command = escapeshellcmd("start /wait soffice --headless --convert-to pdf C:\Xampp\htdocs\2021\simpeg\assets\docs\PENETAPAN-KENAIKAN-GAJI-BERKALA-196211201983022004-2022-09-22.docx --outdir C:\Xampp\htdocs\2021\simpeg\assets\docs");
        // // convert to pdf
        // shell_exec($command);
        $filter = array(
            'bulan' => $this->input->post('bulan'),
            'tahun' => $this->input->post('tahun'),
            'opd'   => $this->input->post('opd'),
            'proses' => $this->input->post('proses'),
            'cpns' => $this->input->post('cpns'),
        );

        $this->session->set_userdata('filterkgb', $filter);

        if ($filter['cpns'] == '1') {
            header('Content-Type: application/json');
            echo $this->m_pegawai_kgb->json_cpns();
        } else {
            header('Content-Type: application/json');
            echo $this->m_pegawai_kgb->json();
        }
    }

    private function upload_sk($filename)
    {
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

    public function update($jenis = null, $id = null)
    {
        //extrac post here and post primary key is id
        $session = $this->session->userdata('login');
        $nips = $this->input->post('nip');
        $cpns = $this->input->post('cpns');

        if ($jenis == 'sk') {
            if ($this->input->post('kgb_id')) {

                $data = array(
                    'kgbsk_pangkat'          => $this->input->post('pangkat'),
                    'kgbsk_jabatan'          => $this->input->post('jabatan'),
                    'kgbsk_gaji_lama'        => $this->input->post('gaji_lama'),
                    'kgbsk_nosk_lama'        => $this->input->post('nosk_lama'),
                    'kgbsk_tglsk_lama'       => $this->input->post('tgl_sk_old'),
                    'kgbsk_tmt_lama'         => $this->input->post('tmt_lama'),
                    'kgbsk_mk_tahun_lama'    => $this->input->post('tahun_lama'),
                    'kgbsk_mk_bulan_lama'    => $this->input->post('bulan_lama'),
                    'kgbsk_gaji_baru'        => $this->input->post('gaji_baru'),
                    'kgbsk_tmt_baru'         => $this->input->post('tmt_baru'),
                    'kgbsk_mk_tahun_baru'    => $this->input->post('tahun_baru'),
                    'kgbsk_mk_bulan_baru'    => $this->input->post('bulan_baru'),
                    'kgbsk_tembusan'    => $this->input->post('tembusan')
                );

                $this->m_pegawai_kgb->update_custom_table($data, $this->input->post('kgb_id'), 'kgbsk_kenaikan_gaji_id', 'pegawai_kenaikan_gaji_sk');

                $this->cetak($this->input->post('kgb_id'));

                $this->session->set_flashdata('message', alert_show('success', "Update Berhasil"));

                redirect($this->redirect);
            } else {

                $kgb_id = $id;
                $row = $this->m_pegawai_kgb->get_sk($kgb_id);
				
        		$data['unit'] = $this->ref_unit->get_unit();
                $data['kgb_id'] = $kgb_id;
                $data['golongan'] = $row->pegawai_pangkat_terakhir_golru;
                $data['tgl_lahir'] = $row->pegawai_tgl_lahir;
                $data['nama'] = $row->pegawai_nama;
                $data['nip'] = $row->pegawai_nip;
                $data['pangkat'] = ucwords(strtolower($row->kgbsk_pangkat));
                $data['jabatan'] = ucwords(strtolower($row->kgbsk_jabatan));
                $data['unit_kerja'] = $row->pegawai_unit_nama;
                $data['gaji_old'] = $row->kgbsk_gaji_lama;
                $data['tmt'] = $row->kgbsk_tmt_baru;
                $data['tgl_sk_old'] = $row->kgbsk_tglsk_lama;
                $data['no_sk_old'] = $row->kgbsk_nosk_lama;
                $data['no_sk'] = $row->kgbsk_nosk_baru;
                $data['tgl_sk'] = $row->kgbsk_tglsk_baru;
                $data['tmt_old'] = $row->kgbsk_tmt_lama;
                $data['tmt_selanjutnya'] = date('Y-m-d', strtotime($row->kgbsk_tmt_baru . ' + 2 years'));
                $data['masa_kerja_tahun_old'] = $row->kgbsk_mk_tahun_lama;
                $data['masa_kerja_bulan_old'] = $row->kgbsk_mk_bulan_lama;
                $data['masa_kerja_tahun'] = $row->kgbsk_mk_tahun_baru;
                $data['masa_kerja_bulan'] = $row->kgbsk_mk_bulan_baru;
                $data['gaji_baru'] = $row->kgbsk_gaji_baru;
                $data['kgbsk_tembusan'] = $row->kgbsk_tembusan;

                $this->loadView('pegawai/kgb_sk_form', $data);
            }

            // $id = $this->input->post('id_kgb');
            // $pegawai = $this->m_pegawai_kgb->get_row($id);
            // $nip = $pegawai->pegawaikgb_pegawai_nip;
            // $data = array('proses_bpkad' => '1');
            // $this->m_pegawai_kgb->update($data, $id);

            // $filename = "SK_KGB_" . $nip . '_' . date('His');
            // $this->upload_sk($filename);

            // $nomor  = !empty($pegawai->pegawai_hp) ? $pegawai->pegawai_hp : $pegawai->pegawai_telpon;
            // $nomor = '6282258611297';
            // $message = 'Selamat Kenaikan Gaji Berkala anda sudah diproses aplikasi SIPEDAS, berikut adalah Surat Keterangan Kenaikan Gaji Berkala Anda. Terimakasih.';
            // // $message = "";

            // if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
            //     $curl = curl_init();
            //     $this->send_wa($curl, no_hp($nomor), $message);
            //     $this->send_media($curl, no_hp($nomor), $message, $filename);
            //     curl_close($curl);
            // }

            // echo json_encode(array('success' => true, 'message' => 'Upload SK berhasil'));
            // exit;
        } else if ($jenis == 'proses') {

            if ($cpns != '1') {
                $key = $this->m_pegawai_kgb->get_pegawai_gaji($nips)->row();
            } else {
                $key = $this->m_pegawai_kgb->get_pegawai_gaji_cpns($nips)->row();
            }
        
        

            $nip = $key->pegawai_nip;
            $pangkat = $key->pegawai_pangkat_terakhir_id;
            $pangkat_sebelum = $key->pegawaikgb_pangkat_id;
            $gol = $key->pangkat_golongan_text;
            $golru_sebelum = $key->golru;
            $gaji = $key->gaji_jumlah;
            $masa_kerja_tahun = $key->gaji_masa_kerja;
            $masa_kerja_bulan = '0';
            $tmt = $key->pegawaikgb_tmt;


            $pangkat_terakhir = $this->m_pegawai_kgb->get_pangkat_terakhir($nip);
        	$golru = $pangkat_terakhir->pegawaipangkat_pangkat_golru;
        // if($nip == '196601011993081001'){
            // print_r($golru_sebelum. ' '. $golru); die;
        // }
        if(!empty($pangkat_terakhir)) {
            if ($pangkat_terakhir->pegawaipangkat_pangkat_id != $pangkat_sebelum ) {
                // && ($pangkat_sebelum == '4' || $pangkat_sebelum == '8')

                if (substr($golru_sebelum, 0, 2) == 'I/' && substr($golru, 0, 3) == 'II/') { // naik pangkat Id ke IIa
                	$pangkat = $pangkat_terakhir->pegawaipangkat_pangkat_id;
                	$gol = $pangkat_terakhir->pegawaipangkat_pangkat_nama . ' (' . $pangkat_terakhir->pegawaipangkat_pangkat_golru . ')';
                	$masa_kerja_tahun = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun + 2;
                    $masa_kerja_tahun = $key->gaji_masa_kerja - 6;
                
                $gaji_terakhir = $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
                $gaji = $gaji_terakhir->gaji_jumlah;
                $masa_kerja_bulan = '0';
                }

                if (substr($golru_sebelum, 0, 3) == 'II/' && substr($golru, 0, 3) == 'III') { // naik pangkat IId ke IIIa
                	$pangkat = $pangkat_terakhir->pegawaipangkat_pangkat_id;
                	$gol = $pangkat_terakhir->pegawaipangkat_pangkat_nama . ' (' . $pangkat_terakhir->pegawaipangkat_pangkat_golru . ')';
                	$masa_kerja_tahun = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun + 2;
                    $masa_kerja_tahun = $key->gaji_masa_kerja - 5;
                
                $gaji_terakhir = $this->ref_gaji->get_where(array('gaji_pangkat_nama' => $pangkat_terakhir->pegawaipangkat_pangkat_golru, 'gaji_masa_kerja' => $masa_kerja_tahun))->row();
                $gaji = $gaji_terakhir->gaji_jumlah;
                $masa_kerja_bulan = '0';
                }

            }
        }
        
            $sk = $this->get_no_sk($pangkat_terakhir->pegawaipangkat_pangkat_golru);
            $pegawaikgb_sk_no = $sk;
            $pegawaikgb_sk_tanggal = date('Y-m-d');
            $pegawaikgb_pejabat = 'BUPATI SANGGAU';
            $update = $this->m_pegawai_kgb->proses_kgb($nip, $pangkat, $gol, $gaji, $masa_kerja_tahun, $masa_kerja_bulan, $session['user_id'], $tmt, $pegawaikgb_sk_no, $pegawaikgb_sk_tanggal, $pegawaikgb_pejabat);

            $kgb_id = $update['pegawaikgb_id'];

            $this->generate_sk($kgb_id);
            $this->cetak($kgb_id);

            $this->session->set_flashdata('message', alert_show('success', "Proses Kenaikan Gaji Berkala Berhasil"));

            redirect($this->redirect);
        } else if ($jenis == 'verif') {

            $id = $this->input->post('id_kgb');
            $pegawaikgb_sk_no = $this->input->post('pegawaikgb_sk_no');
            $pegawaikgb_sk_tanggal = y_m_d($this->input->post('pegawaikgb_sk_tanggal'));
            $pegawaikgb_pejabat = $this->input->post('pegawaikgb_pejabat');

            $data = array('status_proses' => '2', 'pegawaikgb_sk_no' => $pegawaikgb_sk_no, 'pegawaikgb_sk_tanggal' => $pegawaikgb_sk_tanggal, 'pegawaikgb_keterangan' => '');
            $this->m_pegawai_kgb->update($data, $id);
        
                $data_sk = array(
                    'kgbsk_nosk_baru'        => $pegawaikgb_sk_no,
                    'kgbsk_tglsk_baru'       => $pegawaikgb_sk_tanggal,
                );

                $this->m_pegawai_kgb->update_custom_table($data_sk, $id, 'kgbsk_kenaikan_gaji_id', 'pegawai_kenaikan_gaji_sk');

                $this->cetak($id);

            $this->session->set_flashdata('message', alert_show('success', "Verifikasi Kenaikan Gaji Berkala Berhasil"));
        	$this->session->set_userdata('newitemkgb', '1');
            $this->m_pegawai_kgb->update_custom_table(array('new_item' => 1), 'kgb', 'jenis', 'notifikasi_atasan');

            redirect($this->redirect);
        }
    }

    public function excel()
    {
        $data['result'] = $this->m_konversi->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

    public function cetak($kgb_id)
    {
    
    
        $this->load->library('Word');

        $PHPWord = new PHPWord();
        $row = $this->m_pegawai_kgb->get_sk($kgb_id);


        $data['golongan'] = $row->pegawai_pangkat_terakhir_golru;
        // die(substr($golongan, 0, 2));
        if (substr($data['golongan'], 0, 3) == 'II/' || substr($data['golongan'], 0, 2) == 'I/') {
            $data['maks'] = 60;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_1&2.docx');
        } elseif (substr($data['golongan'], 0, 3) == 'III') {
            $data['maks'] = 58;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_3.docx');
        } else {
            $data['maks'] = 58;
            $document = $PHPWord->loadTemplate('assets/docs/kgb/gol_4.docx');
        } 
    
    	if(strpos(ucwords(strtolower($row->kgbsk_jabatan)), "Guru") !== false){
            $data['maks'] = 60;
        }
    	
		
        $data['nama'] = '';
        if (!empty($row->pegawai_gelar_depan)) {
            $data['nama'] .= $row->pegawai_gelar_depan . '. ';
        }
        $data['nama'] .= ucwords(strtoupper($row->pegawai_nama));
        if (!empty($row->pegawai_gelar_belakang)) {
            $data['nama'] .= ', ' . $row->pegawai_gelar_belakang;
        }

        $data['tgl'] = tgl_indo(date('Y-m-d'));
        $data['tgl_lahir'] = date('d-m-Y', strtotime($row->pegawai_tgl_lahir));
        $data['nip'] = $row->pegawai_nip;
        $data['pangkat'] = ucwords(strtolower($row->kgbsk_pangkat));
        $data['jabatan'] = ucwords(strtolower($row->kgbsk_jabatan));
        $data['unit_kerja'] = xucwords(strtolower($row->pegawai_unit_nama));
        $data['gaji_old'] = ribuan($row->kgbsk_gaji_lama);
        $data['tmt'] = tgl_indo($row->kgbsk_tmt_baru);
        $data['tgl_sk_old'] = tgl_indo($row->kgbsk_tglsk_lama);
        $data['no_sk_old'] = $row->kgbsk_nosk_lama;
        $data['no_sk'] = $row->kgbsk_nosk_baru;
        $data['tgl_sk'] = tgl_indo($row->kgbsk_tglsk_baru);
        $data['tmt_old'] = tgl_indo($row->kgbsk_tmt_lama);
        $data['tmt_selanjutnya'] = tgl_indo(date('Y-m-d', strtotime($row->kgbsk_tmt_baru . ' + 2 years')));
        $data['masa_kerja_tahun_old'] = $row->kgbsk_mk_tahun_lama;
        $data['masa_kerja_bulan_old'] = $row->kgbsk_mk_bulan_lama;
        $data['masa_kerja_tahun'] = $row->kgbsk_mk_tahun_baru;
        $data['masa_kerja_bulan'] = $row->kgbsk_mk_bulan_baru;
        $data['gaji_baru'] = ribuan($row->kgbsk_gaji_baru);
        $data['terbilang'] = terbilang($row->kgbsk_gaji_baru) . " Rupiah";
        $data['tembusan'] = str_replace("&", "dan", $row->kgbsk_tembusan);

        $datetime1 = date_create(date('Y-m-d'));
        $datetime2 = date_create($row->pegawai_tgl_lahir);

        $interval = date_diff($datetime1, $datetime2);
        $umur     = $interval->format('%y');

        if (($data['maks'] - $umur) <= 2) {
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
        $document->setValue('tembusan', '' . $data['tembusan']  . '');
        $file = 'assets/docs/kgb/PENETAPAN-KENAIKAN-GAJI-BERKALA-' . $data['nip'] . '-' . $row->kgbsk_tglsk_baru . '.docx';
        $filepath = FCPATH . '/assets/docs/kgb/PENETAPAN-KENAIKAN-GAJI-BERKALA-' . $data['nip'] . '-' . $row->kgbsk_tglsk_baru . '.docx';

        // if($data['nip'] == '198209212017062001'){
        //     die(json_encode($data)); die;
        // }
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $document->save($file);
        $command = "export HOME=/tmp/ && /usr/bin/libreoffice --headless --convert-to pdf '/var/www/html/$file' --outdir '/var/www/html/assets/docs/kgb'";
        // $command = escapeshellcmd("start /wait soffice --headless --convert-to pdf C:\Xampp\htdocs\2021\simpeg\assets\docs\kgb\PENETAPAN-KENAIKAN-GAJI-BERKALA-" . $data['nip'] . "-" . $row->kgbsk_tglsk_baru . ".docx --outdir C:\Xampp\htdocs\2021\simpeg\assets\docs\kgb");
        // convert to pdf
    // die($command);
        shell_exec($command);

        // redirect(base_url($file));

        // $filename='PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.'.docx'; //save our document as this file name

        // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        // header('Cache-Control: max-age=0'); //no cache

        // $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2003');
        // $objWriter->save('php://output');
    
		if (file_exists($filepath)) { // delete word 
		unlink($filepath);
		}

    }

    private function generate_sk($kgb_id)
    {
        $filter = $this->session->userdata('filterkgb');
        $row = $this->m_pegawai_kgb->get_by_id($kgb_id);

        $thncpns = $filter['tahun'] - 2;

        if ($thncpns == DATE('Y', strtotime($row->pegawai_cpns_tmt))) { // jika cpns
            $kgb = $this->m_pegawai_kgb->get_data_cetak_cpns($kgb_id, $row->pegawaikgb_pegawai_nip);
        } else {
            $kgb = $this->m_pegawai_kgb->get_data_cetak($kgb_id, $row->pegawaikgb_pegawai_nip);
        }
    
    	$tembusan = '';
    
    	if($kgb->unit_kpok == '04'){ 
        	$tembusan = 'Kepala Dinas Pendidikan dan Kebudayaan Kabupaten Sanggau';
        }elseif($kgb->unit_kpok == '05'){ 
        	$tembusan = 'Kepala Dinas Kesehatan Kabupaten Sanggau';
        }elseif($kgb->unit_kpok == '03'){ 
        	$tembusan = 'Inspektur Kabupaten Sanggau';
        }elseif($kgb->unit_kpok == '520'){
        	$tembusan = 'Direktur '.ucwords(strtolower($kgb->pegawai_unit_nama));
        }elseif($kgb->unit_kpok == '01'){
        	$tembusan = ucwords(strtolower($kgb->pegawai_unit_nama));
        }elseif(strpos($kgb->pegawai_unit_nama, 'KECAMATAN') !== false){
        	$temb = str_replace('KANTOR KECAMATAN', '', $kgb->pegawai_unit_nama);
        	$tembusan = 'Camat '.ucwords(strtolower($temb));
        }else{
        	$tembusan = 'Kepala '.ucwords(strtolower($kgb->pegawai_unit_nama));
        }

        $data = array(
            'kgbsk_kenaikan_gaji_id' => $kgb_id,
            'kgbsk_file'             => 'PENETAPAN-KENAIKAN-GAJI-BERKALA-' . $row->pegawaikgb_pegawai_nip . '-' . $kgb->pegawaikgb_sk_tanggal . '.pdf',
            'kgbsk_pangkat'          => $kgb->pangkat_golongan_pangkat,
            'kgbsk_jabatan'          => $kgb->pegawai_jabatan_nama,
            'kgbsk_gaji_lama'        => $kgb->gaji_old,
            'kgbsk_nosk_lama'        => $kgb->no_sk_old,
            'kgbsk_tglsk_lama'       => $kgb->tgl_sk_old,
            'kgbsk_tmt_lama'         => $kgb->tmt_old,
            'kgbsk_mk_tahun_lama'    => $kgb->masa_kerja_tahun_old,
            'kgbsk_mk_bulan_lama'    => $kgb->masa_kerja_bulan_old,
            'kgbsk_gaji_baru'        => $kgb->pegawaikgb_gaji,
            'kgbsk_nosk_baru'        => $kgb->pegawaikgb_sk_no,
            'kgbsk_tglsk_baru'       => $kgb->pegawaikgb_sk_tanggal,
            'kgbsk_tmt_baru'         => $kgb->pegawaikgb_tmt,
            'kgbsk_mk_tahun_baru'    => $kgb->masa_kerja_tahun,
            'kgbsk_mk_bulan_baru'    => $kgb->masa_kerja_bulan,
            'kgbsk_tembusan'    => $tembusan
        );

        $this->m_pegawai_kgb->insert_sk($data);
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

    private function get_no_sk($gol)
    {
        if (substr($gol, 0, 2) == 'I/') {
            $jenis = '822.1';
        } elseif (substr($gol, 0, 3) == 'II/') {
            $jenis = '822.2';
        } elseif (substr($gol, 0, 3) == 'III') {
            $jenis = '822.3';
        } elseif (substr($gol, 0, 2) == 'IV') {
            $jenis = '822.4';
        }

        $tahun = date('Y');
        $select = "count+1 as count,tahun";
        $where = array('tahun' => $tahun);
        // $where = '1=1';
        $count = $this->m_pegawai_kgb->get_where_custom($select, $where, 'count_sk_kgb')->row();

        if ($count->tahun == $tahun) {
            $data = array('count' => $count->count);
            $this->m_pegawai_kgb->update_custom_table($data, $tahun, 'tahun', 'count_sk_kgb');
            $no = $count->count;
            return $jenis . '/' . $no . '/BKPSDM-C';
        } else {
            $data = array('count' => 1, 'tahun' => $tahun);
            $this->m_pegawai_kgb->update_custom_table($data, $tahun, 'tahun', 'count_sk_kgb');
            return $jenis . '/1/BKPSDM-C';
        }
    }

    function delete($id)
    {
        $delete = $this->m_pegawai_kgb->delete($id);
        if (!empty($delete)) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus KGB Pegawai Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus KGB Pegawai Gagal"));
        }
        redirect($this->redirect);
    }
}

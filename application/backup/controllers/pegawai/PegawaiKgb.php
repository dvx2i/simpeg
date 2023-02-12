<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiKgb extends MY_Controller {

    //variable
    var $view = 'pegawai/pegawai_kgb';     // file view
    var $redirect = 'pegawai/PegawaiKgb';     // redirect to here
    var $modul = 'Kenaikan Gaji Berkala';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pegawai_kgb'));
        $this->load->model(array('ref_unit'));
    }

    public function index() {
        $data['unit'] = $this->ref_unit->get_unit();
        $this->loadView($this->view,$data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->m_pegawai_kgb->json();
    }

    public function update() {
        //extrac post here and post primary key is id
        $session = $this->session->userdata('login');
        $nips = $this->input->post('nip');
        $array = implode("','",$nips);
        $pegawai = $this->m_pegawai_kgb->get_pegawai_gaji($array);
        
        foreach($pegawai->result() as $key) {
            $update = $this->m_pegawai_kgb->proses_kgb($key->pegawai_nip,$key->pegawai_pangkat_terakhir_id,$key->pangkat_golongan_text,$key->gaji_jumlah,$key->gaji_masa_kerja,$session['user_id'],$key->pegawaikgb_tmt);
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

        $kgb = $this->m_pegawai_kgb->get_by_id($kgb_id);

        $document = $PHPWord->loadTemplate('template/berkala.docx');
        $tgl = tgl_indo(date('Y-m-d'));
        $nama =  ucwords(strtoupper($kgb->pegawai_nama));
        $tgl_lahir = tgl_indo($kgb->pegawai_tgl_lahir);
        $nip = $kgb->pegawai_nip;
        $pangkat = ucwords(strtoupper($kgb->pegawai_pangkat_terakhir_nama));
        $jabatan = ucwords(strtoupper($kgb->pegawai_jabatan_nama));
        $unit_kerja = ucwords(strtoupper($kgb->pegawai_unit_nama));
        $gaji_lama = ribuan($kgb->gaji_lama);
        $tmt = tgl_indo($kgb->pegawaikgb_tmt);
        $tmt_selanjutnya = tgl_indo(date('Y-m-d', strtotime($kgb->pegawaikgb_tmt. ' + 2 years')));
        $masa_kerja_tahun = $kgb->pegawaikgb_masa_kerja_tahun;
        $masa_kerja_bulan = $kgb->pegawaikgb_masa_kerja_bulan;
        $gaji_baru = ribuan($kgb->pegawaikgb_gaji);
        $terbilang = terbilang($kgb->pegawaikgb_gaji);
        $golongan = $kgb->pegawai_pangkat_terakhir_golru;

        $document->setValue('tgl', '' . $tgl . '');
        $document->setValue('nama', '' . $nama . '');
        $document->setValue('tgl_lahir', '' . $tgl_lahir . '');
        $document->setValue('nip', '' . $nip . '');
        $document->setValue('pangkat', '' . $pangkat . '');
        $document->setValue('jabatan', '' . $jabatan . '');
        $document->setValue('unit_kerja', '' . $unit_kerja . '');
        $document->setValue('gaji_lama', '' . $gaji_lama. '');
        $document->setValue('tmt', '' . $tmt . '');
        $document->setValue('tmt_selanjutnya', '' . $tmt_selanjutnya . '');
        $document->setValue('masa_kerja_tahun', '' . $masa_kerja_tahun . '');
        $document->setValue('masa_kerja_bulan', '' . $masa_kerja_bulan . '');
        $document->setValue('gaji_baru', '' . $gaji_baru . '');
        $document->setValue('terbilang', '' . $terbilang . '');
        $document->setValue('golongan', '' . $golongan . '');
        $file = 'assets/docs/PENETAPAN KENAIKAN GAJI BERKALA - '.$nip.' - '.date('Ymd').'.docx';

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

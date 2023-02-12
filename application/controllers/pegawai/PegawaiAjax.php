<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PegawaiAjax
 *
 * @author Zanuar
 */
class PegawaiAjax extends CI_Controller
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }
    public function getPegawaiByNip()
    {
        $this->load->model('m_pegawai');
        $nip = $this->input->post('nip');
        $output = $this->m_pegawai->get_where(array('pegawai_nip' => $nip));
        jsonResponse($output->result(), 1);
    }
    public function getRowPegawaiByNip()
    {
        $this->load->model('m_pegawai');
        $nip = $this->input->post('nip');
        $output = $this->m_pegawai->get_where(array('pegawai_nip' => $nip));
        jsonResponse($output->row(), 1);
    }
    public function getPegawaiPangkatById()
    {
        $this->load->model('m_pegawai_pangkat');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pangkat->get_row($id);
        jsonResponse($output, 1);
    }
    public function getPegawaiJabatanById()
    {
        $this->load->model('m_pegawai_jabatan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_jabatan->get_row($id);
        jsonResponse($output, 1);
    }

    public function getPegawaiKgbById()
    {
        $this->load->model('m_pegawai_kgb');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kgb->get_row($id);
        jsonResponse($output, 1);
    }

    public function getPegawaiPendidikanById()
    {
        $this->load->model('m_pegawai_pendidikan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pendidikan->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiDiklatById()
    {
        $this->load->model('m_pegawai_diklat');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_diklat->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiById()
    {
        $this->load->model('m_pegawai_cuti');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiOnlineById()
    {
        $this->load->model('m_pegawai_cuti_online');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti_online->get_by_id($id);
        jsonResponse($output, 1);
    }

    function getPegawaiCutiOnlineBerkasById()
    {
        $this->load->model('m_pegawai_cuti_online');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_cuti_online->getBerkasByPermohonan($id);
        jsonResponse($output, 1);
    }

    function getPegawaiTandaJasaById()
    {
        $this->load->model('m_pegawai_tanda_jasa');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_tanda_jasa->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKunjunganById()
    {
        $this->load->model('m_pegawai_kunjungan');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kunjungan->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiOrganisasiById()
    {
        $this->load->model('m_pegawai_organisasi');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_organisasi->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiPengalamanKerjaById()
    {
        $this->load->model('m_pegawai_pengalaman_kerja');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pengalaman_kerja->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiBahasaById()
    {
        $this->load->model('m_pegawai_bahasa');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_bahasa->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiTugasBelajarById()
    {
        $this->load->model('m_pegawai_tugas_belajar');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_tugas_belajar->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiDisiplinById()
    {
        $this->load->model('m_pegawai_disiplin');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_disiplin->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKaryaTulisById()
    {
        $this->load->model('m_pegawai_karya_tulis');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_karya_tulis->get_row($id);
        jsonResponse($output, 1);
    }

    function getPegawaiKeluargaById()
    {
        $this->load->model('m_pegawai_keluarga');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_keluarga->get_row($id);
        jsonResponse($output, 1);
    }

    function getSkKgb()
    {
        $this->load->model('m_pegawai_kgb_bpkad');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_kgb_bpkad->get_sk($id);
    	if(!empty($output)) $output[0]['kgbsk_file'] = str_replace(".pdf","_signed.pdf",$output[0]['kgbsk_file']);
        jsonResponse($output, 1);
    }

    function getSkPangkat()
    {
        $this->load->model('m_pegawai_pangkat_bpkad');
        $id = $this->input->post('id');
        $output = $this->m_pegawai_pangkat_bpkad->get_sk($id);
        jsonResponse($output, 1);
    }

	function notifTte()
    {
        $isAjax = $this->input->post('ajax');
        $menu = $this->input->post('menu');
    	if($isAjax == '1'){
        	$this->load->model('m_pegawai');
        	if($menu == 'kgb'){
        		$this->load->model('m_pegawai_kgb_esign');
            	$tte_gol12 = $this->m_pegawai_kgb_esign->get_kgb_gol_12();
            	$tte_gol3 = $this->m_pegawai_kgb_esign->get_kgb_gol_3();
            	$tte_gol4 = $this->m_pegawai_kgb_esign->get_kgb_gol_4();
            	
            	if($tte_gol12->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '427'), 'pegawai')->row(); // kabid bkpsdm
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $tte_gol12->jumlah.' SK Kenaikan Gaji Berkala Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                
                }
            	if($tte_gol3->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '415'), 'pegawai')->row(); // kaban bkpsdm
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $tte_gol3->jumlah.' SK Kenaikan Gaji Berkala Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	if($tte_gol4->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '1'), 'pegawai')->row();  //sekda
                	 
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $tte_gol4->jumlah.' SK Kenaikan Gaji Berkala Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	$this->m_pegawai->update_custom_table(array('new_item' => 0), 'kgb', 'jenis', 'notifikasi_atasan');
            } // end kgb
        	if($menu == 'cuti'){
        		$this->load->model('m_pegawai_cuti_online_esign');
            	$tte_gol12 = $this->m_pegawai_cuti_online_esign->get_cuti_gol_12();
            	$tte_gol3 = $this->m_pegawai_cuti_online_esign->get_cuti_gol_3();
            	$tte_gol4 = $this->m_pegawai_cuti_online_esign->get_cuti_gol_4();
            	
            	if($tte_gol12->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '419'), 'pegawai')->row(); // kabid pengelolaan asn
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $tte_gol12->jumlah.' Surat Izin Cuti Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                	
                
                }
            	if($tte_gol3->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '415'), 'pegawai')->row(); // kaban bkpsdm
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $tte_gol3->jumlah.' Surat Izin Cuti Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";
                
                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	if($tte_gol4->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '1'), 'pegawai')->row();  //sekda
                	
                    $nomor = $p->pegawai_hp;                	
                    // $nomor = '6281328209998';
                    $message = $tte_gol4->jumlah.' Surat Izin Cuti Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	$this->m_pegawai->update_custom_table(array('new_item' => 0), 'cuti', 'jenis', 'notifikasi_atasan');
            } // cuti
        	if($menu == 'pensiun'){
        		$this->load->model('m_pegawai_pensiun_esign');
            	$dpcp = $this->m_pegawai_pensiun_esign->get_count_dpcp();
            	$sk = $this->m_pegawai_pensiun_esign->get_count_sk();
            	
            	if($dpcp->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '415'), 'pegawai')->row(); // kaban bkpsdm
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $dpcp->jumlah.' Berkas Pensiun Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";
                
                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	if($sk->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '1'), 'pegawai')->row();  //sekda
                	
                    // $nomor = $p->pegawai_hp;                	
                    $nomor = '6281328209998';
                    $message = $sk->jumlah.' Berkas Pensiun Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	$this->m_pegawai->update_custom_table(array('new_item' => 0), 'pensiun', 'jenis', 'notifikasi_atasan');
            } // cuti
        	if($menu == 'pangkat'){
        		$this->load->model('m_pegawai_pangkat_esign');
            	$gol_12 = $this->m_pegawai_pangkat_esign->get_count_gol_12();
            	$gol_3 = $this->m_pegawai_pangkat_esign->get_count_gol_3();
            	
            	if($gol_12->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '415'), 'pegawai')->row(); // kaban bkpsdm
                	
                    $nomor = $p->pegawai_hp;        	
                    // $nomor = '6281328209998';
                    $message = $gol_12->jumlah.' SK Pangkat Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";
                
                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	if($gol_3->jumlah > 0){
                	$p = $this->m_pegawai->get_where_custom('pegawai_hp', array('pegawai_jabatan_id' => '1'), 'pegawai')->row();  //sekda
                	
                    $nomor = $p->pegawai_hp;                	
                    // $nomor = '6281328209998';
                    $message = $gol_3->jumlah.' SK Pangkat Perlu Ditandatangani. Login ke SIPEDAS '.site_url('Akun');
                    // $message = "";

                    if (substr(trim($nomor), 0, 2) == '62' || substr(trim($nomor), 0, 2) == '08') {
                        $curl = curl_init();
                        send_wa($curl, no_hp($nomor), $message); 
                        curl_close($curl);
                    }
                }
            	$this->m_pegawai->update_custom_table(array('new_item' => 0), 'pangkat', 'jenis', 'notifikasi_atasan');
            } // cuti
        	jsonResponse('ok', 1);
        }
    }
}

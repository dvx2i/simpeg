<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_kgb
 *
 * @author Zanuar
 */
class M_pegawai_kgb_esign extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_kenaikan_gaji');
        $this->_set_primary_key('pegawaikgb_id');
        parent::__construct();
    }
    
    
  
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pegawaikgb_id,pegawai_nip,pegawaikgb_tmt,MONTH(pegawaikgb_tmt) as bulan,YEAR(pegawaikgb_tmt) as tahun,MONTH(pegawaikgb_tmt) as bulan_next_2,YEAR(pegawaikgb_tmt) + 2 as tahun_next_2,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru,status_proses,kgbsk_file,pegawaikgb_keterangan', FALSE);
    $this->datatables->from('pegawai');
    $this->datatables->join('ref_pangkat_golongan', 'pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id','LEFT');
    $this->datatables->join('pegawai_kenaikan_gaji v', 'pegawai.pegawai_nip = v.pegawaikgb_pegawai_nip');
    $this->datatables->join('pegawai_kenaikan_gaji_sk', 'v.pegawaikgb_id = pegawai_kenaikan_gaji_sk.kgbsk_kenaikan_gaji_id');
    
    $this->datatables->where('pegawai_status', '1', FALSE);
    if ($this->input->post('status_kepegawaian') != 'all') {
        $this->datatables->where('pegawai_status_kepegawaian_id', $this->input->post('status_kepegawaian'));
    }
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }
	
  	
  	if($this->input->post('proses') != 'all'){
  	if($this->input->post('proses') == '4'){
    	$this->datatables->where('status_proses IN (4,5)', '', FALSE);
    }else{
    $this->datatables->where('status_proses',  $this->input->post('proses'));
    }
    }
  
    if ($this->input->post('bulan') != 'all') {
    	$this->datatables->where('MONTH(pegawaikgb_tmt)', $this->input->post('bulan'));
    }
    if ($this->input->post('tahun') != 'all') {
    $this->datatables->where('YEAR(pegawaikgb_tmt)', $this->input->post('tahun'));
    }
  	if($session['group_id'] == '8'){
  	$this->datatables->where('SUBSTRING(pangkat_golongan_nama, 1, 2) =', 'IV'); 
  	}elseif($session['group_id'] == '9'){
  	$this->datatables->where('SUBSTRING(pangkat_golongan_nama, 1, 3) =', 'III'); 
  	}elseif($session['group_id'] == '10'){
  	$this->datatables->where('(SUBSTRING(pangkat_golongan_nama, 1, 3) = "II/" ', NULL, FALSE); 
  	$this->datatables->or_where('SUBSTRING(pangkat_golongan_nama, 1, 2) = "I/" )', NULL, FALSE); 
  	}
    $this->datatables->add_column('aksi', '$1', 'ttd_kgb(pegawaikgb_id,kgbsk_file,status_proses)');
    $this->datatables->add_column('sk', '$1', 'sk_kgb(pegawaikgb_id,status_proses,kgbsk_file,pegawaikgb_keterangan)');
    $this->datatables->edit_column('pegawaikgb_tmt', '$1', 'date_time(pegawaikgb_tmt)');
    $this->db->order_by('pegawaikgb_id', 'DESC');
    return 
    $this->datatables->generate();
    die($this->db->last_query());
	
  }

    function get_by_id($kgb_id) {
    $query= "select a.*,b.pegawai_status_kepegawaian_id,b.pegawai_cpns_tmt,b.pegawai_hp,b.pegawai_telpon from pegawai_kenaikan_gaji a
            join pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip  where pegawaikgb_id = '$kgb_id' ";
    return $this->db->query($query)->row();
    }
	
    function get_kgb_gol_12() {
        $query= "select COUNT(*) as jumlah from pegawai_kenaikan_gaji a
                join pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip  where status_proses = '2' AND (SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 3) = 'II/' OR SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 2) = 'I/')";
        return $this->db->query($query)->row();
    }
	
    function get_kgb_gol_3() {
        $query= "select COUNT(*) as jumlah from pegawai_kenaikan_gaji a
                join pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip  where status_proses = '2' AND SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 3) = 'III'";
        return $this->db->query($query)->row();
    }

    function get_kgb_gol_4() {
        $query= "select COUNT(*) as jumlah from pegawai_kenaikan_gaji a
                join pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip  where status_proses = '2' AND SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 2) = 'IV'";
        return $this->db->query($query)->row();
    }

	function get_user_bpkad(){
    	$query= "SELECT COALESCE(pegawai_hp,pegawai_telpon) as pegawai_hp FROM pegawai a 
				JOIN sys_user b ON a.pegawai_nip = b.user_name
				JOIN sys_user_group c ON b.user_id = c.UserGroupUserId
				WHERE c.UserGroupGroupId = '7'";
        return $this->db->query($query)->result();
    }

}

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
class M_pegawai_pangkat_esign extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_pangkat_berkas');
        $this->_set_primary_key('pangkatsk_id');
        parent::__construct();
    }
    
    
  
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pangkatsk_id,pegawai_nip,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru,pangkatsk_status,pangkatsk_file', FALSE);
    $this->datatables->from('pegawai');
    $this->datatables->join('ref_pangkat_golongan', 'pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id','LEFT');
    $this->datatables->join('pegawai_pangkat_berkas v', 'pegawai.pegawai_nip = v.pangkatsk_nip');
    
    $this->datatables->where('pegawai_status', '1', FALSE);
    if ($this->input->post('status_kepegawaian') != 'all') {
        $this->datatables->where('pegawai_status_kepegawaian_id', $this->input->post('status_kepegawaian'));
    }
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }

    // $this->datatables->where('pangkatsk_status',  $this->input->post('proses'));
  
  	if($this->input->post('proses') != 'all'){
  	if($this->input->post('proses') == '1'){
    	$this->datatables->where('pangkatsk_status', $this->input->post('proses'));
    }else{
    	$this->datatables->where('pangkatsk_status IN (2,4)', '', FALSE);
    }
    }
  	if($session['group_id'] == '8'){
  	$this->datatables->where('pangkatsk_golongan', '3'); 
  	}elseif($session['group_id'] == '9'){
  	$this->datatables->where('(pangkatsk_golongan = "2" ', NULL, FALSE); 
  	$this->datatables->or_where('pangkatsk_golongan = "1" )', NULL, FALSE); 
  	}
    $this->datatables->add_column('aksi', '$1', 'ttd_kgb(pangkatsk_id,pangkatsk_file,pangkatsk_status)');
    $this->datatables->add_column('sk', '$1', 'sk_pangkat(pangkatsk_id,pangkatsk_status,pangkatsk_file,pangkatsk_keterangan)');
    $this->db->order_by('pangkatsk_id', 'DESC');
    return 
    $this->datatables->generate();
    die($this->db->last_query());
	
  }

    function get_by_id($id) {
    $query= "select a.*,b.pegawai_status_kepegawaian_id,b.pegawai_cpns_tmt,b.pegawai_hp,b.pegawai_telpon from pegawai_pangkat_berkas a
            join pegawai b ON a.pangkatsk_nip = b.pegawai_nip  where pangkatsk_id = '$id' ";
    return $this->db->query($query)->row();
    }
	
    function get_count_gol_12() {
        $query= "select COUNT(*) as jumlah from pegawai_pangkat_berkas a
                join pegawai b ON a.pangkatsk_nip = b.pegawai_nip  where pangkatsk_status = '1' AND (pangkatsk_golongan = '1' OR pangkatsk_golongan = '2')";
        return $this->db->query($query)->row();
    }
	
    function get_count_gol_3() {
        $query= "select COUNT(*) as jumlah from pegawai_pangkat_berkas a
                join pegawai b ON a.pangkatsk_nip = b.pegawai_nip  where pangkatsk_status = '1' AND pangkatsk_golongan = '3'";
        return $this->db->query($query)->row();
    }

    public function update_berkas($data, $id)
    {
        $this->db->where('pangkatsk_id', $id);
        return $this->db->update('pegawai_pangkat_berkas', $data);
    }

	function get_user_bpkad(){
    	$query= "SELECT COALESCE(pegawai_hp,pegawai_telpon) as pegawai_hp FROM pegawai a 
				JOIN sys_user b ON a.pegawai_nip = b.user_name
				JOIN sys_user_group c ON b.user_id = c.UserGroupUserId
				WHERE c.UserGroupGroupId = '7'";
        return $this->db->query($query)->result();
    }

}

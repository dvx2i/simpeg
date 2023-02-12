<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_pangkat_bpkad
 *
 * @author Zanuar
 */
class M_pegawai_pangkat_bpkad extends MY_Model{
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
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }

    $this->datatables->where('pangkatsk_status',  $this->input->post('proses'));
    $this->datatables->add_column('sk', '$1', 'sk_pangkat(pangkatsk_id,pangkatsk_status,pangkatsk_file,pangkatsk_keterangan)');
    $this->db->order_by('pangkatsk_id', 'DESC');
    return 
    $this->datatables->generate();
    die($this->db->last_query());
	
  }
    
  
  function get_sk($id)
  {
      $this->db->select('pangkatsk_file');
      $this->db->from('pegawai_pangkat_sk');
      $this->db->where('pangkatsk_pangkat_id', $id);
      return $this->db->get()->result_array();
  }
}

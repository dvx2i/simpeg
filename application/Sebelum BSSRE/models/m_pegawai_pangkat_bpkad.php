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
        $this->_set_table('pegawai_pangkat');
        $this->_set_primary_key('pegawaipangkat_id');
        parent::__construct();
    }
  
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pegawaipangkat_id,pegawai_nip,pegawaipangkat_tmt,CONCAT(pegawai_nama," ",pegawai_gelar_belakang) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru,proses_bpkad,pangkatsk_file', FALSE);
    $this->datatables->from('pegawai_pangkat v');
    $this->datatables->join('pegawai', 'pegawai.pegawai_nip = v.pegawaipangkat_pegawai_nip','LEFT');
    $this->datatables->join('ref_pangkat_golongan', 'v.pegawaipangkat_pangkat_id = ref_pangkat_golongan.pangkat_golongan_id','LEFT');
    $this->datatables->join('pegawai_pangkat_sk', 'v.pegawaipangkat_id = pegawai_pangkat_sk.pangkatsk_pangkat_id','LEFT');
    
    $this->datatables->where('pegawai_status', '1', FALSE);
    
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }

    $this->datatables->where('proses_bpkad', $this->input->post('proses'));
    // $this->datatables->where('MONTH(pegawaipangkat_tmt)', $this->input->post('bulan'));
    // $this->datatables->where('YEAR(pegawaipangkat_tmt)', $this->input->post('tahun'));
    $this->datatables->add_column('aksi', '$1', 'aksi_kenaikan_gaji(pegawaipangkat_id)');
    $this->datatables->edit_column('pegawaipangkat_tmt', '$1', 'date_time(pegawaipangkat_tmt)');
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

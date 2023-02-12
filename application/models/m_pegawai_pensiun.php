<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_pensiun
 *
 * @author Zanuar
 */
class M_pegawai_pensiun extends MY_Model
{
  //put your code here
  public function __construct()
  {
    $this->_set_table('pegawai_pensiun');
    $this->_set_primary_key('pegawaipensiun_id');
    parent::__construct();
  }



  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('a.*,pegawaipensiun_id,pegawaipensiun_nip,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,CONCAT(pangkat_golongan_pangkat,"<br/> (",pegawai_pangkat_terakhir_golru,")") AS pangkat,pegawai_jabatan_nama,pegawai_unit_nama,pegawai_eselon_nama,sk.pensiunberkas_file AS file_sk,sk.pensiunberkas_status AS status_sk', FALSE);
    // dpcp.pensiunberkas_file AS file_dpcp,dpcp.pensiunberkas_status AS status_dpcp,
    // lampiran.pensiunlampiran_file AS file_lampiran,lampiran.pensiunlampiran_status AS status_lampiran'
    
    $this->datatables->from('pegawai_pensiun a');
    $this->datatables->join('pegawai b', 'a.pegawaipensiun_nip = b.pegawai_nip');
    $this->datatables->join('ref_pangkat_golongan c', 'b.pegawai_pangkat_terakhir_id = c.pangkat_golongan_id');
    // $this->datatables->join('pegawai_pensiun_berkas dpcp', 'a.pegawaipensiun_id = dpcp.pensiunberkas_pensiun_id AND dpcp.pensiunberkas_jenis = "1"', "LEFT");
    $this->datatables->join('pegawai_pensiun_berkas sk', 'a.pegawaipensiun_id = sk.pensiunberkas_pensiun_id AND sk.pensiunberkas_jenis = "2"', "LEFT");
    // $this->datatables->join('pegawai_pensiun_lampiran lampiran', 'a.pegawaipensiun_kode = lampiran.pensiunlampiran_pensiun_kode', "LEFT");
    
  
  	if($this->input->post('proses') != 'all'){
    	$this->datatables->where('pegawaipensiun_status', $this->input->post('proses'));
    }
  	if($this->input->post('opd') != 'all'){
    	$this->datatables->where('b.pegawai_unit_id', $this->input->post('opd'));
    }
  	// $this->datatables->add_column('dpcp', '$1', 'berkasPensiun(file_dpcp,status_dpcp)');
    $this->datatables->add_column('sk', '$1', 'berkasPensiun(file_sk,status_sk)');
    // $this->datatables->add_column('lampiran', '$1', 'berkasPensiun(file_lampiran,status_lampiran)');
    $this->datatables->add_column('aksi', '$1', 'aksiPensiun(pegawaipensiun_id)');
    $this->db->order_by('pegawaipensiun_id', 'DESC');
    return
      $this->datatables->generate();
    die($this->db->last_query());
  }
  
  // datatables
  function json_lampiran()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pensiunlampiran_id,pensiunlampiran_file', FALSE);
    // dpcp.pensiunberkas_file AS file_dpcp,dpcp.pensiunberkas_status AS status_dpcp,
    // lampiran.pensiunlampiran_file AS file_lampiran,lampiran.pensiunlampiran_status AS status_lampiran'
    
    $this->datatables->from('pegawai_pensiun_lampiran a');
  
  	if($this->input->post('proses') != 'all'){
    	$this->datatables->where('pensiunlampiran_status', $this->input->post('proses'));
    }
  	// $this->datatables->add_column('dpcp', '$1', 'berkasPensiun(file_dpcp,status_dpcp)');
    // $this->datatables->add_column('sk', '$1', 'berkasPensiun(file_sk,status_sk)');
    $this->datatables->add_column('lampiran', '$1', 'berkasPensiun(pensiunlampiran_file,pensiunlampiran_status)');
    $this->datatables->add_column('aksi', '$1', 'aksiPensiun(pensiunlampiran_id)');
    $this->db->order_by('pensiunlampiran_id', 'DESC');
    return
      $this->datatables->generate();
    die($this->db->last_query());
  }

  function insert_pensiun($data)
  {
    $row = $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  function insert_berkas($data)
  {
    $row = $this->db->insert('pegawai_pensiun_berkas', $data);
    return $this->db->insert_id();
  }


  function delete_berkas($pensiun_id,$jenis)
  {
    $this->db->where('pensiunberkas_jenis', $jenis);
    $this->db->where('pensiunberkas_pensiun_id', $pensiun_id);
    $this->db->where('pensiunberkas_status', '1');
    $row = $this->db->delete('pegawai_pensiun_berkas');
    return $row;
  }
  
  function delete_berkas_by_id($pensiun_id,$jenis)
  {
    $this->db->where('pensiunberkas_pensiun_id', $pensiun_id);
    $row = $this->db->delete('pegawai_pensiun_berkas');
    return $row;
  }

  function insert_lampiran($data)
  {
    $row = $this->db->insert('pegawai_pensiun_lampiran', $data);
    return $this->db->insert_id();
  }


  function delete_lampiran($id)
  {
    $this->db->where('pensiunlampiran_id', $id);
    $row = $this->db->delete('pegawai_pensiun_lampiran');
    return $row;
  }
}

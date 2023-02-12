<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pengajuan_mutasi
 *
 * @author Zanuar
 */
class M_pengajuan_mutasi extends MY_Model {

    public function __construct() {
        $this->_set_table('pegawai_usulan_mutasi');
        $this->_set_primary_key('usulan_id');
        parent::__construct();
    }

    
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('CONCAT(YEAR(A.insert_time),"-",LPAD(usulan_id, 7, "0")) AS no,A.usulan_id,A.usulan_nip,A.usulan_status,B.pegawai_nama,A.insert_time,keterangan,CASE WHEN usulan_jenis = "1" THEN "Keluar Kabupaten/Kota" ELSE "Antar Instansi" END AS usulan_jenis,file_sk', FALSE);
    $this->datatables->from('pegawai_usulan_mutasi A');
    $this->datatables->join('pegawai B', 'A.usulan_nip = B.pegawai_nip','LEFT');
    $this->datatables->where('B.pegawai_nip', $session['username']);
    $this->datatables->edit_column('file_sk', '$1', 'get_sk_mutasi(file_sk,usulan_status,"publik",usulan_id,insert_time)');
    $this->datatables->edit_column('usulan_status', '$1', 'get_usulan_status(usulan_status)');
    $this->datatables->add_column('action', '$1', 'get_action_mutasi(usulan_id,usulan_status,"publik",insert_time)');
    return $this->datatables->generate();
	
  }
  
  function get_by_id($id,$nip)
  {
    $this->db->select('A.*, pegawai_nama,pegawai_nip,pegawai_nip_lama,pegawai_unit_nama,pegawai_pns_tmt,pegawai_cpns_tmt');
      $this->db->from('pegawai_usulan_mutasi A');
      $this->db->join('pegawai B', 'A.usulan_nip = B.pegawai_nip','LEFT');
      $this->db->where('usulan_id', $id);
      $this->db->where('pegawai_nip', $nip);
      return $this->db->get()->row();
  }
  
  function getBerkasByPermohonan($id)
  {
      $this->db->select('pegawai_usulan_mutasi_berkas.*, berkas_nama');
      $this->db->from('ref_berkas_mutasi');
      $this->db->join('pegawai_usulan_mutasi_berkas', 'ref_berkas_mutasi.berkas_id = pegawai_usulan_mutasi_berkas.berkas_id');
      $this->db->where('usulan_id', $id);
      return $this->db->get()->result_array();
  }

  // insert data
  function insert_row($data)
  {
    $this->db->insert('pegawai_usulan_mutasi', $data);
    return $this->db->insert_id();
  }
  
  function save_file($data)
  {
      return $this->db->insert('pegawai_usulan_mutasi_berkas', $data);
  }
  

  function delete_file($id_berkas,$id)
  {
      $this->db->where('berkas_id', $id_berkas);
      $this->db->where('usulan_id', $id);
     return $this->db->delete('pegawai_usulan_mutasi_berkas');
  }

  function getMasaKerja($nip)
  {
      $get = $this->db->query("SELECT TIMESTAMPDIFF(YEAR, DATE(a.`pegawai_cpns_tmt`),DATE(CURRENT_DATE())) AS masa_kerja
      FROM pegawai a
      WHERE pegawai_nip = '$nip'")->row();
  
  return $get->masa_kerja;
  }
}

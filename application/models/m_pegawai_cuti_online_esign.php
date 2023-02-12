<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_diklat
 *
 * @author Zanuar
 */
class M_pegawai_cuti_online_esign extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_cuti_online');
        $this->_set_primary_key('pegawaicuti_id');
        parent::__construct();
    }



    function get_cuti_by_nip($where)
    {
        $this->db->select('pegawai_nama,jenis_cuti_nama,pegawai_cuti_online.*,status_nama');
        $this->db->from('pegawai_cuti_online');
        $this->db->join('pegawai', 'pegawai_cuti_online.pegawaicuti_pegawai_nip = pegawai.pegawai_nip');
        $this->db->join('ref_jenis_cuti', 'pegawai_cuti_online.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->join('ref_status_permohonan_cuti', 'pegawai_cuti_online.pegawaicuti_status_permohonan = ref_status_permohonan_cuti.status_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    // datatables
    function json()
    {
      $session = $this->session->userdata('login');
      $this->load->helper('my_datatable');
      $this->datatables->select('pegawaicuti_id,pegawaicuti_pegawai_nip,pegawaicuti_no_permohonan,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,jenis_cuti_nama,pegawaicuti_status_permohonan,pegawaicuti_lama_cuti_mulai,pegawaicuti_lama_cuti_selesai,pegawaicuti_keterangan_tolak,file_sk,pegawaicuti_sk_no', FALSE);
      $this->datatables->from('pegawai_cuti_online A');
      $this->datatables->join('pegawai B', 'A.pegawaicuti_pegawai_nip = B.pegawai_nip');
      $this->datatables->join('ref_jenis_cuti C', 'A.pegawaicuti_jeniscuti_id = C.jenis_cuti_id');
    $this->datatables->join('ref_pangkat_golongan PG', 'B.pegawai_pangkat_terakhir_id = PG.pangkat_golongan_id','LEFT');

        if ($this->input->post('opd') != 'all') {
            $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
        }

            $this->datatables->where('pegawaicuti_status_permohonan', $this->input->post('proses'));
        

      $this->datatables->where('A.pegawaicuti_tahap', '1');
  	if($session['group_id'] == '8'){
  	// $this->datatables->where('SUBSTRING(pangkat_golongan_nama, 1, 2) =', 'IV'); 
  	$this->datatables->where('(SUBSTRING(pangkat_golongan_nama, 1, 2) = "IV" ', NULL, FALSE); 
  	$this->datatables->or_where('B.pegawai_jabatan_nama LIKE "KEPALA BIDANG%" )', NULL, FALSE); 
  	}elseif($session['group_id'] == '9'){
  	$this->datatables->where('SUBSTRING(pangkat_golongan_nama, 1, 3) =', 'III'); 
  	// $this->datatables->where('(SUBSTRING(pangkat_golongan_nama, 1, 3) = "III" ', NULL, FALSE); 
  	$this->datatables->where('B.pegawai_jabatan_nama NOT LIKE "KEPALA BIDANG%"', NULL, FALSE); 
  	}elseif($session['group_id'] == '12'){
  	$this->datatables->where('(SUBSTRING(pangkat_golongan_nama, 1, 3) = "II/" ', NULL, FALSE); 
  	$this->datatables->or_where('SUBSTRING(pangkat_golongan_nama, 1, 2) = "I/" )', NULL, FALSE); 
  	}
      $this->datatables->edit_column('file_sk', '$1', 'sk_cuti(pegawaicuti_id,file_sk,pegawaicuti_status_permohonan,"admin")');
    //   $this->datatables->edit_column('file_sk', '$1', 'get_sk_mutasi(file_sk,usulan_status,"admin",usulan_id,insert_time)');
      $this->datatables->edit_column('pegawaicuti_status_permohonan', '$1', 'status_permohonan_cuti(pegawaicuti_status_permohonan, pegawaicuti_keterangan_tolak)');
      $this->datatables->edit_column('pegawaicuti_lama_cuti_mulai', '$1', 'tgl(pegawaicuti_lama_cuti_mulai)');
      $this->datatables->edit_column('pegawaicuti_lama_cuti_selesai', '$1', 'tgl(pegawaicuti_lama_cuti_selesai)');
      $this->datatables->add_column('action', '$1', 'ttd_cuti(pegawaicuti_id,file_sk,pegawaicuti_no_permohonan,pegawaicuti_status_permohonan)');
      return $this->datatables->generate();
      
    }

    function get_no_permohonan()
    {
        $sql = "SELECT CONCAT(REPLACE(CURDATE(), '-', ''),LPAD(bfore+1,3,'0')) AS no  FROM (SELECT MAX(RIGHT(pegawaicuti_no_permohonan,3)) AS bfore FROM pegawai_cuti_online WHERE DATE(insert_time) = CURDATE()) b;";
       
        $result = $this->db->query($sql)->row();
        if(!empty($result->no)){
            return $result->no;
        }else{
            return date('Ymd').'001';
        }
    }
    
    function get_by_id($id)
    {
        $this->db->select('A.pegawaicuti_id,A.pegawaicuti_no_permohonan,A.pegawaicuti_pegawai_nip,A.pegawaicuti_jeniscuti_id,A.pegawaicuti_tahun,A.pegawaicuti_jumlah_hari,
        A.pegawaicuti_keterangan,A.pegawaicuti_status_permohonan,A.pegawaicuti_keterangan_tolak,A.pegawaicuti_bertahap,A.pegawaicuti_tahap,A.pegawaicuti_parent,A.file_sk,pegawai_nama,pegawai_unit_nama,pegawai_pangkat_terakhir_nama,pegawai_pangkat_terakhir_golru,pegawai_jabatan_nama,jenis_cuti_nama,A.pegawaicuti_lama_cuti_mulai,A.pegawaicuti_lama_cuti_selesai,B.pegawaicuti_lama_cuti_mulai as th2_mulai,B.pegawaicuti_lama_cuti_selesai as th2_selesai,B.pegawaicuti_jumlah_hari as th2_jumlah_hari,B.pegawaicuti_keterangan as th2_keterangan,status_nama,A.pegawaicuti_sk_no,A.pegawaicuti_sk_tanggal', FALSE);
        $this->db->from('pegawai_cuti_online A');
        $this->db->join('pegawai', 'A.pegawaicuti_pegawai_nip = pegawai.pegawai_nip');
        $this->db->join('pegawai_cuti_online B', 'A.pegawaicuti_id = B.pegawaicuti_parent', 'LEFT');
        $this->db->join('ref_jenis_cuti', 'A.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->join('ref_status_permohonan_cuti', 'A.pegawaicuti_status_permohonan = ref_status_permohonan_cuti.status_id');
        $this->db->where('A.pegawaicuti_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_by_no($id)
    {
        
        $this->db->select('A.pegawaicuti_id,A.pegawaicuti_no_permohonan,A.pegawaicuti_pegawai_nip,A.pegawaicuti_jeniscuti_id,A.pegawaicuti_tahun,A.pegawaicuti_jumlah_hari,
        A.pegawaicuti_keterangan,A.pegawaicuti_status_permohonan,A.pegawaicuti_keterangan_tolak,A.pegawaicuti_bertahap,A.pegawaicuti_tahap,A.pegawaicuti_parent,A.file_sk,pegawai_nama,pegawai_unit_nama,pegawai_pangkat_terakhir_nama,pegawai_pangkat_terakhir_golru,pegawai_jabatan_nama,jenis_cuti_nama,A.pegawaicuti_lama_cuti_mulai,A.pegawaicuti_lama_cuti_selesai,B.pegawaicuti_lama_cuti_mulai as th2_mulai,B.pegawaicuti_lama_cuti_selesai as th2_selesai,B.pegawaicuti_jumlah_hari as th2_jumlah_hari,B.pegawaicuti_keterangan as th2_keterangan,status_nama', FALSE);
        $this->db->from('pegawai_cuti_online A');
        $this->db->join('pegawai', 'A.pegawaicuti_pegawai_nip = pegawai.pegawai_nip');
        $this->db->join('pegawai_cuti_online B', 'A.pegawaicuti_id = B.pegawaicuti_parent', 'LEFT');
        $this->db->join('ref_jenis_cuti', 'A.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->join('ref_status_permohonan_cuti', 'A.pegawaicuti_status_permohonan = ref_status_permohonan_cuti.status_id');
        $this->db->where('A.pegawaicuti_no_permohonan', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_by_parent($id)
    {
        $this->db->select('pegawai_nama,pegawai_unit_nama,pegawai_pangkat_terakhir_nama,pegawai_pangkat_terakhir_golru,pegawai_jabatan_nama,jenis_cuti_nama,pegawai_cuti_online.*,status_nama');
        $this->db->from('pegawai_cuti_online');
        $this->db->join('pegawai', 'pegawai_cuti_online.pegawaicuti_pegawai_nip = pegawai.pegawai_nip');
        $this->db->join('ref_jenis_cuti', 'pegawai_cuti_online.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->join('ref_status_permohonan_cuti', 'pegawai_cuti_online.pegawaicuti_status_permohonan = ref_status_permohonan_cuti.status_id');
        $this->db->where('pegawaicuti_parent', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_cetak($id)
    {
        $this->db->select('A.*,P.*,jenis_cuti_nama,B.pegawaicuti_lama_cuti_mulai as th2_mulai,B.pegawaicuti_lama_cuti_selesai as th2_selesai,B.pegawaicuti_jumlah_hari as th2_jumlah_hari,B.pegawaicuti_keterangan as th2_keterangan,status_nama', FALSE);
        $this->db->from('pegawai_cuti_online A');
        $this->db->join('pegawai P', 'A.pegawaicuti_pegawai_nip = P.pegawai_nip');
        $this->db->join('pegawai_cuti_online B', 'A.pegawaicuti_id = B.pegawaicuti_parent', 'LEFT');
        $this->db->join('ref_jenis_cuti', 'A.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->join('ref_status_permohonan_cuti', 'A.pegawaicuti_status_permohonan = ref_status_permohonan_cuti.status_id');
        $this->db->where('A.pegawaicuti_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
  
    function getBerkasByPermohonan($id)
    {
        $this->db->select('pegawai_cuti_online_berkas.*, berkas_nama');
        $this->db->from('ref_berkas_cuti');
        $this->db->join('pegawai_cuti_online_berkas', 'ref_berkas_cuti.berkas_id = pegawai_cuti_online_berkas.berkas_id');
        $this->db->where('cuti_id', $id);
        return $this->db->get()->result_array();
    }

    // insert data
    function insert_row($data)
    {
        $this->db->insert('pegawai_cuti_online', $data);
        return $this->db->insert_id();
    }

    function save_file($data)
    {
        return $this->db->insert('pegawai_cuti_online_berkas', $data);
    }
    
    public function update_by_no($data, $id) {
        $this->db->where('pegawaicuti_no_permohonan', $id);
        return $this->db->update($this->table, $data);
    }


    function delete_file($id_berkas, $id)
    {
        $this->db->where('berkas_id', $id_berkas);
        $this->db->where('cuti_id', $id);
        return $this->db->delete('pegawai_cuti_online_berkas');
    }

    function delete_by_no($id)
    {
        $this->db->where('pegawaicuti_no_permohonan', $id);
        return $this->db->delete($this->table);
    }

    function delete($id)
    {
        $this->db->where('pegawaicuti_id', $id);
        return $this->db->delete($this->table);
    }

	
    function get_cuti_gol_12() {
        $query= "select COUNT(*) as jumlah from pegawai_cuti_online a
                join pegawai b ON a.pegawaicuti_pegawai_nip = b.pegawai_nip  where pegawaicuti_status_permohonan = '2' AND (SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 3) = 'II/' OR SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 2) = 'I/')";
        return $this->db->query($query)->row();
    }
	
    function get_cuti_gol_3() {
        $query= "select COUNT(*) as jumlah from pegawai_cuti_online a
                join pegawai b ON a.pegawaicuti_pegawai_nip = b.pegawai_nip  where pegawaicuti_status_permohonan = '2' AND SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 3) = 'III'";
        return $this->db->query($query)->row();
    }

    function get_cuti_gol_4() {
        $query= "select COUNT(*) as jumlah from pegawai_cuti_online a
                join pegawai b ON a.pegawaicuti_pegawai_nip = b.pegawai_nip  where pegawaicuti_status_permohonan = '2' AND SUBSTRING(pegawai_pangkat_terakhir_golru, 1, 2) = 'IV'";
        return $this->db->query($query)->row();
    }
}

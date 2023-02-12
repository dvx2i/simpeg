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
class M_pegawai_pensiun_esign extends MY_Model{
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
    $this->datatables->select('a.*,pegawaipensiun_nip,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,CONCAT(pangkat_golongan_pangkat,"<br/> (",pegawai_pangkat_terakhir_golru,")") AS pangkat,pegawai_jabatan_nama,pegawai_unit_nama,pegawai_eselon_nama,dpcp.pensiunberkas_file AS file_dpcp,dpcp.pensiunberkas_status AS status_dpcp,sk.pensiunberkas_file AS file_sk,sk.pensiunberkas_status AS status_sk,lampiran.pensiunlampiran_file AS file_lampiran,lampiran.pensiunlampiran_status AS status_lampiran', FALSE);
    $this->datatables->from('pegawai_pensiun a');
    $this->datatables->join('pegawai b', 'a.pegawaipensiun_nip = b.pegawai_nip');
    $this->datatables->join('ref_pangkat_golongan c', 'b.pegawai_pangkat_terakhir_id = c.pangkat_golongan_id');
    $this->datatables->join('pegawai_pensiun_berkas dpcp', 'a.pegawaipensiun_id = dpcp.pensiunberkas_pensiun_id AND dpcp.pensiunberkas_jenis = "1"', "LEFT");
    $this->datatables->join('pegawai_pensiun_berkas sk', 'a.pegawaipensiun_id = sk.pensiunberkas_pensiun_id AND sk.pensiunberkas_jenis = "2"', "LEFT");
    $this->datatables->join('pegawai_pensiun_lampiran lampiran', 'a.pegawaipensiun_kode = lampiran.pensiunlampiran_pensiun_kode', "LEFT");
  	
  	if($session['group_id'] == '11'){
    	$this->datatables->where('sk.pensiunberkas_status', $this->input->post('proses'));
    }
  	if($session['group_id'] == '9'){
    	$this->datatables->where('dpcp.pensiunberkas_status', $this->input->post('proses'));
    }
    $this->datatables->add_column('dpcp', '$1', 'berkasPensiun(file_dpcp,status_dpcp)');
    $this->datatables->add_column('sk', '$1', 'berkasPensiun(file_sk,status_sk)');
    $this->datatables->add_column('lampiran', '$1', 'berkasPensiun(file_lampiran,status_lampiran)');
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
    $this->datatables->select('pensiunlampiran_id,pensiunlampiran_file,pensiunlampiran_status', FALSE);
    
    $this->datatables->from('pegawai_pensiun_lampiran a');
    $this->datatables->where('pensiunlampiran_status', $this->input->post('proses'));
    
    $this->datatables->add_column('lampiran', '$1', 'berkasPensiun(pensiunlampiran_file,pensiunlampiran_status)');
    $this->db->order_by('pensiunlampiran_id', 'DESC');
    return
      $this->datatables->generate();
    die($this->db->last_query());
  }

    function get_lampiran($id) {
        $query= "select pensiunlampiran_file,pensiunlampiran_pensiun_kode FROM pegawai_pensiun_lampiran a
                join pegawai_pensiun b ON a.pensiunlampiran_pensiun_kode = b.pegawaipensiun_kode  where b.pegawaipensiun_id = '$id'";
        return $this->db->query($query)->row();
    }

	
    function get_count_dpcp() {
        $query= "select COUNT(*) as jumlah from pegawai_pensiun_berkas a
                where pensiunberkas_status = '1' AND pensiunberkas_jenis = '1'";
        return $this->db->query($query)->row();
    }
	
    function get_count_sk() {
        $query= "select COUNT(*) as jumlah from pegawai_pensiun_berkas a
                where pensiunberkas_status = '1' AND pensiunberkas_jenis = '2'";
        return $this->db->query($query)->row();
    }


    public function update_berkas($data, $id, $jenis)
    {
        $this->db->where('pensiunberkas_pensiun_id', $id);
        $this->db->where('pensiunberkas_jenis', $jenis);
        return $this->db->update('pegawai_pensiun_berkas', $data);
    }

    public function update_lampiran($data, $id)
    {
        $this->db->where('pensiunlampiran_id', $id);
        return $this->db->update('pegawai_pensiun_lampiran', $data);
    }

}

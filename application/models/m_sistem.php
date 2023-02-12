<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_sistem
 *
 * @author Zanuar
 */
class M_sistem extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    /*function getMenuByUserId($user_id) {
        return $this->db->query("SELECT * FROM v_menu WHERE (parent IN (SELECT MenuParentId FROM v_akses WHERE user_id = '$user_id') AND modul IN (SELECT MenuModule FROM v_akses WHERE user_id = '$user_id')) OR parent IS NULL ORDER BY parent,MenuOrder,menu_id");
    }*/
    function getMenuByUserId($user_id) {
        return $this->db->query("SELECT * FROM v_menu WHERE (parent IN (SELECT MenuParentId FROM v_akses WHERE user_id = '$user_id') AND modul IN (SELECT MenuModule FROM v_akses WHERE user_id = '$user_id'))
        	and aksi_id in (select GroupDetailMenuActionId from sys_group_detail where GroupDetailGroupId in(select UserGroupGroupId from sys_user_group where UserGroupUserId='$user_id'))
         OR parent IS NULL ORDER BY parent,MenuOrder,menu_id");
    }

	function insert_log_esign($data)
    {
        $row = $this->db->insert('log_esign', $data);
        return $row;
    }

    function get_count_kgb($session) {
        $this->db->select('pegawaikgb_id');
        $this->db->from('pegawai_kenaikan_gaji v');
        $this->db->join('ref_pangkat_golongan', 'v.pegawaikgb_pangkat_id = ref_pangkat_golongan.pangkat_golongan_id AND v.status_proses = "2"');
        if($session['group_id'] == '8'){
        $this->db->where('SUBSTRING(pangkat_golongan_nama, 1, 2) =', 'IV'); 
        }elseif($session['group_id'] == '9'){
        $this->db->where('SUBSTRING(pangkat_golongan_nama, 1, 3) =', 'III'); 
        }elseif($session['group_id'] == '10'){
        $this->db->where('(SUBSTRING(pangkat_golongan_nama, 1, 3) = "II/" ', NULL, FALSE); 
        $this->db->or_where('SUBSTRING(pangkat_golongan_nama, 1, 2) = "I/" )', NULL, FALSE); 
        }
        return
         $this->db->get()->num_rows();
    die($this->db->last_query());
        }

    function get_count_kgb_bpkad($session) {
        $this->db->select('pegawaikgb_id');
        $this->db->from('pegawai p');
        $this->db->join('pegawai_kenaikan_gaji v','p.pegawai_nip = v.pegawaikgb_pegawai_nip');
        $this->db->join('pegawai_kenaikan_gaji_sk sk','v.pegawaikgb_id = sk.kgbsk_kenaikan_gaji_id');
        $this->db->where('status_proses', '4'); 
        $this->db->where('pegawai_status', '1'); 
        $this->db->group_by('pegawaikgb_pegawai_nip');
        return $this->db->get()->num_rows();
    }

    function get_count_cuti($session) {
        $this->db->select('pegawaicuti_id');
        $this->db->from('pegawai_cuti_online A');
    if($session['group_id'] != '13' && $session['group_id'] != '1'){
        $this->db->join('pegawai B', 'A.pegawaicuti_pegawai_nip = B.pegawai_nip');
        $this->db->join('ref_pangkat_golongan PG', 'B.pegawai_pangkat_terakhir_id = PG.pangkat_golongan_id');
        $this->db->where('A.pegawaicuti_tahap', '1');
        if($session['group_id'] == '8'){
        $this->db->where('pegawaicuti_status_permohonan', '2');
        // $this->db->where('SUBSTRING(pangkat_golongan_nama, 1, 2) =', 'IV'); 
  		$this->db->where('(SUBSTRING(pangkat_golongan_nama, 1, 2) = "IV" ', NULL, FALSE); 
  		$this->db->or_where('B.pegawai_jabatan_nama LIKE "KEPALA BIDANG%" )', NULL, FALSE); 
        }elseif($session['group_id'] == '9'){
        $this->db->where('pegawaicuti_status_permohonan', '2');
        $this->db->where('SUBSTRING(pangkat_golongan_nama, 1, 3) =', 'III'); 
  		$this->db->where('B.pegawai_jabatan_nama NOT LIKE "KEPALA BIDANG%"', NULL, FALSE); 
        }elseif($session['group_id'] == '12'){
        $this->db->where('pegawaicuti_status_permohonan', '2');
        $this->db->where('(SUBSTRING(pangkat_golongan_nama, 1, 3) = "II/" ', NULL, FALSE); 
        $this->db->or_where('SUBSTRING(pangkat_golongan_nama, 1, 2) = "I/" )', NULL, FALSE); 
        }
        }else{
        	$this->db->where('A.pegawaicuti_jeniscuti_id !=', '0');
        	$this->db->where('A.pegawaicuti_tahap', '1');
        	$this->db->where('pegawaicuti_status_permohonan', '1');   
    	}
        return $this->db->get()->num_rows();
    }


    function get_count_pensiun($session) {
        $this->db->select('pegawaipensiun_nip');
		$this->db->from('pegawai_pensiun a');
    	$this->db->join('pegawai_pensiun_berkas dpcp', 'a.pegawaipensiun_id = dpcp.pensiunberkas_pensiun_id AND dpcp.pensiunberkas_jenis = "1"', "LEFT");
    	$this->db->join('pegawai_pensiun_berkas sk', 'a.pegawaipensiun_id = sk.pensiunberkas_pensiun_id AND sk.pensiunberkas_jenis = "2"', "LEFT");
  	
  		if($session['group_id'] == '11'){
    		$this->db->where('sk.pensiunberkas_status', '1');
    	}
  		if($session['group_id'] == '9'){
    		$this->db->where('dpcp.pensiunberkas_status', '1');
    	}
        return $this->db->get()->num_rows();
    }


    function get_count_pangkat($session) {
        $this->db->select('pangkatsk_nip');
		$this->db->from('pegawai_pangkat_berkas v');
    	$this->db->where('pangkatsk_status',  '1');
  		if($session['group_id'] == '8'){
  		$this->db->where('pangkatsk_golongan', '3'); 
  		}elseif($session['group_id'] == '9'){
  		$this->db->where('(pangkatsk_golongan = "2" ', NULL, FALSE); 
  		$this->db->or_where('pangkatsk_golongan = "1" )', NULL, FALSE); 
  		}
        return $this->db->get()->num_rows();
    }
    
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_jabatan
 *
 * @author Zanuar
 */
class Ref_jabatan_fungsional extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('ref_jabatan_fungsional');
        $this->_set_primary_key('jabatan_id');
        parent::__construct();
    }

        
    function get_jabatan($kode) {
        if($kode == '2'){
            $this->db->order_by('jabatan_nama', 'ASC');
            return $this->db->get($this->table);
        }else if($kode == '4'){
            $this->db->order_by('jabatan_nama', 'ASC');
            return $this->db->get('ref_jabatan_baru');
        }
    }

	function get_jabatan_all() {
    	
        $query = "SELECT jabatan_id,jabatan_kode,jabatan_nama,jabatan_golru_awal,jabatan_golru_awal_nama,jabatan_golru_akhir,jabatan_golru_akhir_nama,jabatan_tunjangan,jabatan_pendidikan_kode,jabatan_pendidikan_nama,jabatan_angka_kredit,jabatan_usia_pensiun FROM ref_jabatan_fungsional UNION ALL
        		  SELECT jabatan_id,null as jabatan_kode,jabatan_nama,null as jabatan_golru_awal, null as jabatan_golru_awal_nama,null as jabatan_golru_akhir, null as jabatan_golru_akhir_nama, null as jabatan_tunjangan,null as jabatan_pendidikan_kode, null as jabatan_pendidikan_nama, null as jabatan_angka_kredit, null as jabatan_usia_pensiun FROM ref_jabatan_baru 
                  ;";
        return $this->db->query($query)->result();
    }                                       
	
}

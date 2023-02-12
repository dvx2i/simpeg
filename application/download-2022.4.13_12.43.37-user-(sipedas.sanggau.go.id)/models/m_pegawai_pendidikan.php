<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_pendidikan
 *
 * @author Zanuar
 */
class M_pegawai_pendidikan extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_pendidikan');
        $this->_set_primary_key('pegawaipendidikan_id');
        parent::__construct();
    }
    
    function get_pendidikan_terakhir($nip) {
        $query= "select * from pegawai_pendidikan where pegawaipendidikan_pegawai_nip = '$nip' order by pegawaipendidikan_tanggal_ijazah desc";
        return $this->db->query($query)->row();
    }

	
    function get_riwayat_pendidikan($where) {
        $this->db->where($where);
    	$this->db->order_by('pegawaipendidikan_pendidikan_tingkat_id', 'ASC');
        $query = $this->db->get($this->table);
        return $query;
    }
}

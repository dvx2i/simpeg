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
class M_pegawai_diklat extends MY_Model {

    public function __construct() {
        $this->_set_table('pegawai_diklat');
        $this->_set_primary_key('diklat_id');
        parent::__construct();
    }
    
    function get_diklat_struktural_terakhir($nip) {
        $query = "select * from pegawai_diklat where diklat_jenis = 'STRUKTURAL' and diklat_pegawai_nip = '$nip' order by diklat_sttpl_tanggal desc";
        return $this->db->query($query);
    }
}

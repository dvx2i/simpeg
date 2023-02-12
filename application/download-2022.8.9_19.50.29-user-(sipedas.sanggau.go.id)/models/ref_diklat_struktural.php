<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_agama
 *
 * @author Zanuar
 */
class Ref_diklat_struktural extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_diklat_struktural');
        $this->_set_primary_key('diklat_struktural_id');
        parent::__construct();
    }
    
    
    function get_diklat_kode()
    {
        $query = "SELECT diklat_struktural_kode, diklat_struktural_nama FROM ref_diklat_struktural WHERE diklat_struktural_kode IN ('12','22','13','33','45') ORDER BY diklat_struktural_nama ASC";
        return $this->db->query($query);
    }
    
    function get_diklat_by_kode($diklat_kode)
    {
        $query = "SELECT diklat_struktural_kode, diklat_struktural_nama FROM ref_diklat_struktural WHERE diklat_struktural_kode = '".$diklat_kode."' ";
        return $this->db->query($query)->row();
    }
}

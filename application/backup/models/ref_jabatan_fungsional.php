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

        
    function get_jabatan() {
    $this->db->order_by('jabatan_nama', 'ASC');
        return $this->db->get($this->table);
    }
}

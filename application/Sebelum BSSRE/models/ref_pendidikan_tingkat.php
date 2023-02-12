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
class Ref_pendidikan_tingkat extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_pendidikan_tingkat');
        $this->_set_primary_key('pendidikan_tingkat_kode');
        parent::__construct();
    }

    function get_by_id($id) {
        $this->db->where('pendidikan_tingkat_id', $id);
        $this->db->select('*');
        $query = $this->db->get('ref_pendidikan_tingkat');
        return $query->row();
    }
}

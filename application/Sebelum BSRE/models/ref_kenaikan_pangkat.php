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
class Ref_kenaikan_pangkat extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('ref_kenaikan_pangkat');
        $this->_set_primary_key('kenaikan_pangkat_id');
        parent::__construct();
    }

    function get_kenaikan_by_kode($id)
    {
        $this->db->where('kenaikan_pangkat_kode', $id);
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->row();
    }
}

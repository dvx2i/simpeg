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
class Ref_pangkat_golongan extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('ref_pangkat_golongan');
        $this->_set_primary_key('pangkat_golongan_id');
        parent::__construct();
    }


    function get_pangkat_golongan()
    {
        $this->db->where('pangkat_golongan_jenis', 1);
        return $this->db->get($this->table);
    }

    function get_pangkat_by_kode($id)
    {
        $this->db->where('pangkat_golongan_kode', $id);
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    function get_pangkat_by_id($id)
    {
        $this->db->where('pangkat_golongan_id', $id);
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->row();
    }
}

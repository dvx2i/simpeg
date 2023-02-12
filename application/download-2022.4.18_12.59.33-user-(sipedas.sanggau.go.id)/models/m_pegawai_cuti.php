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
class M_pegawai_cuti extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_cuti');
        $this->_set_primary_key('pegawaicuti_id');
        parent::__construct();
    }



    function get_cuti_by_nip($where)
    {
        $this->db->select('pegawai_nama,jenis_cuti_nama,pegawai_cuti.*');
        $this->db->from('pegawai_cuti');
        $this->db->join('pegawai', 'pegawai_cuti.pegawaicuti_pegawai_nip = pegawai.pegawai_nip');
        $this->db->join('ref_jenis_cuti', 'pegawai_cuti.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
}

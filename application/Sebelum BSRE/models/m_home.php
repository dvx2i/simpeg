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
class M_home extends MY_Model
{
    var $column_order = array(null, 'pegawai_nip', 'pegawai_nama', 'pegawai_pangkat_terakhir_id', 'pegawai_jabatan_nama','pegawai_eselon_nama', 'pegawai_unit_nama', 'pegawai_pendidikan_terakhir_tingkat'); //set column field database for datatable orderable
    var $column_search = array('pegawai_nip', 'pegawai_nama', 'pegawai_pangkat_terakhir_nama', 'pegawai_jabatan_nama','pegawai_eselon_nama', 'pegawai_unit_nama', 'pegawai_pendidikan_terakhir_tingkat'); //set column field database for datatable searchable 
    var $order = array('pegawai_nip' => 'DESC'); // default order 
    public function __construct()
    {
        $this->_set_table('pegawai');
        $this->_set_primary_key('pegawai_nip');
        //        $this->_set_order(array('pegawai_nip','asc'));
        //        $this->_set_column_oder();
        //        $this->_set_column_search();
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }
    function _set_order($value)
    {
        $this->order = $value;
    }

    function _set_column_oder($value)
    {
        $this->column_order = $value;
    }

    function _set_column_search($value)
    {
        $this->column_search = $value;
    }

    function get_pegawai_detail($nip,$jk)
    {
        $query = "SELECT p.*,cpns.`pangkat_golongan_text` AS cpns_pangkat,pns.`pangkat_golongan_text` AS pns_pangkat,sumpah.`kondisisumpah_nama` FROM pegawai p
LEFT JOIN ref_pangkat_golongan cpns ON (p.`pegawai_cpns_pangkat_id` = cpns.`pangkat_golongan_id`)
LEFT JOIN ref_pangkat_golongan pns ON (p.`pegawai_pns_pangkat_id` = pns.`pangkat_golongan_kode`)
LEFT JOIN ref_kondisi_sumpah sumpah ON (p.`pegawai_pns_sumpah_id` = sumpah.`kondisisumpah_kode`)
WHERE p.`pegawai_nip` = '$nip' AND p.`pegawai_jenkel_id` = '$jk';";
        return $this->db->query($query)->row();
    }

    function cek_sudah_polling($ip)
    {
        $query = "SELECT COUNT(*) as jumlah FROM publik_kepuasan WHERE ip = '$ip'";
        return $this->db->query($query)->row();
    }

    function polling()
    {
        $query = "SELECT SUM(CASE WHEN index_kepuasan = 1 THEN 1 ELSE 0 END) / COUNT(*) * 100 as sangat_puas,
                  SUM(CASE WHEN index_kepuasan = 2 THEN 1 ELSE 0 END) / COUNT(*) * 100 as cukup_puas,
                  SUM(CASE WHEN index_kepuasan = 3 THEN 1 ELSE 0 END) / COUNT(*) * 100 as puas,
                  SUM(CASE WHEN index_kepuasan = 4 THEN 1 ELSE 0 END) / COUNT(*) * 100 as kurang_puas
         FROM publik_kepuasan ";
        return $this->db->query($query)->row();
    }
    
    function insert_polling($data) {
        $row = $this->db->insert('publik_kepuasan', $data);
        return $row;
    }
    
    function insert_kritik($data) {
        $row = $this->db->insert('publik_kritik_saran', $data);
        return $row;
    }
}

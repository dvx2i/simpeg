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
class Ref_gaji extends MY_Model
{
    //put your code here
    public function __construct()
    {
        $this->_set_table('ref_gaji');
        $this->_set_primary_key('gaji_id');
        parent::__construct();
    }


    function get_gaji()
    {
        $this->db->order_by('gaji_golru_kode,gaji_masa_kerja', 'ASC');
        return $this->db->get($this->table);
    }


    function getGajiByPangkatMasaKerja($pangkat, $masa)
    {
        $this->db->select('gaji_jumlah');
        $this->db->from($this->table);
        $this->db->join('ref_pangkat_golongan', 'gaji_golru_kode = pangkat_golongan_kode');
        $this->db->where('pangkat_golongan_id', $pangkat);
        $this->db->where('gaji_masa_kerja', $masa);
        $return = $this->db->get()->result_array();
        // print_r($return->result_array());
        // die;
        if (!empty($return)) {
            return $return[0];
        } else {
            $return['gaji_jumlah'] = 0;
            return $return;
        }
    }
}

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
class Ref_unit extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('ref_unit');
        $this->_set_primary_key('unit_id');
        parent::__construct();
    }

    function get_unit()
    {
        return $this->db->query("SELECT f.*,r.unit_nama AS induk,r.unit_id AS induk_id  FROM ref_unit f LEFT JOIN  ref_unit r ON r.unit_id  =f.unit_parent_id WHERE f.unit_induk <> '00' AND f.unit_status = '1'");
    }

    function get_sub_unit($where)
    {
        $this->db->where($where);
        $query = $this->db->get('v_unit');
        return $query;
    }

    function get_unit_parent()
    {
        return $this->db->query("SELECT *  FROM ref_unit WHERE unit_parent_id IS NULL AND unit_induk <> '00' AND unit_status = '1'");
    }

    function get_unit_bagan()
    {
        return $this->db->query("SELECT u.*  FROM bagan_struktur_v2 b JOIN ref_unit u ON  b.bagan_unit_id = u.unit_id GROUP BY bagan_unit_id");
    }
}

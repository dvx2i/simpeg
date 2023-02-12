<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_group
 *
 * @author Zanuar
 */
class Sys_user extends MY_Model
{
    //put your code here
    public function __construct()
    {
        $this->_set_table('sys_user');
        $this->_set_primary_key('user_id');
        parent::__construct();
    }

    function user_group()
    {
        $this->db->select('sys_user.*,sys_user_group.*,unit_nama');
        $this->db->join('sys_user_group', 'sys_user_group.UserGroupUserId = sys_user.user_id', 'left');
        $this->db->join('ref_unit', 'sys_user.user_unit_id = ref_unit.unit_id', 'left');
        $query = $this->db->get($this->table);
        return $query;
    }

    function getUserByNIP($nip)
    {
        $this->db->where('user_name', $nip);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
}

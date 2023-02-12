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
class M_user extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('sys_user');
        $this->_set_primary_key('user_id');
        parent::__construct();
    }



    function get_user_login($where)
    {
        $this->db->select('sys_user.*,sys_user_group.*');
        $this->db->join('sys_user_group', 'sys_user_group.UserGroupUserId = sys_user.user_id', 'left');
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query;
    }
}

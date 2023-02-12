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
    {   $bupati = '1';
        $this->db->select('sys_user.*,sys_user_group.*,COALESCE(pegawai_foto_kpe,bupati_image) as pegawai_foto_kpe,COALESCE(pegawai_no_ktp,bupati_no_ktp) as pegawai_no_ktp,GroupName', FALSE);
        $this->db->join('sys_user_group', 'sys_user_group.UserGroupUserId = sys_user.user_id', 'left');
        $this->db->join('sys_group', 'sys_user_group.UserGroupGroupId = sys_group.GroupId', 'left');
        $this->db->join('pegawai', 'sys_user.user_pegawai_nip = pegawai.pegawai_nip', 'left');
        $this->db->join('ref_bupati', 'sys_user.user_pegawai_nip = ref_bupati.id', 'left');
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query;
    }
}

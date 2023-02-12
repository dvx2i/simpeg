<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_sistem
 *
 * @author Zanuar
 */
class M_sistem extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    /*function getMenuByUserId($user_id) {
        return $this->db->query("SELECT * FROM v_menu WHERE (parent IN (SELECT MenuParentId FROM v_akses WHERE user_id = '$user_id') AND modul IN (SELECT MenuModule FROM v_akses WHERE user_id = '$user_id')) OR parent IS NULL ORDER BY parent,MenuOrder,menu_id");
    }*/
    function getMenuByUserId($user_id) {
        return $this->db->query("SELECT * FROM v_menu WHERE (parent IN (SELECT MenuParentId FROM v_akses WHERE user_id = '$user_id') AND modul IN (SELECT MenuModule FROM v_akses WHERE user_id = '$user_id'))
        	and aksi_id in (select GroupDetailMenuActionId from sys_group_detail where GroupDetailGroupId in(select UserGroupGroupId from sys_user_group where UserGroupUserId='$user_id'))
         OR parent IS NULL ORDER BY parent,MenuOrder,menu_id");
    }
}

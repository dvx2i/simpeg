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
class Sys_user_group extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('sys_user_group');
        $this->_set_primary_key('UserGroupId');
        parent::__construct();
    }
}

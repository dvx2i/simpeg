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
class Sys_group_detail extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('sys_group_detail');
        $this->_set_primary_key('GroupDetailId');
        parent::__construct();
    }
}

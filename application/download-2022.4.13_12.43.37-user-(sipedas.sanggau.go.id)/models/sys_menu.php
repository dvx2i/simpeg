<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sys_menu
 *
 * @author Zanuar
 */
class Sys_menu extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('sys_menu');
        $this->_set_primary_key('MenuId');
        parent::__construct();
    }
}

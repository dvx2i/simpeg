<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Zanuar
 */
class Ref_diklat_teknis extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_diklat_teknis');
        $this->_set_primary_key('diklat_teknis_id');
        parent::__construct();
    }
    
    
}

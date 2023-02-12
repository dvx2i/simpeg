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
class Ref_propinsi extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_propinsi');
        $this->_set_primary_key('propinsi_id');
        parent::__construct();
    }
}

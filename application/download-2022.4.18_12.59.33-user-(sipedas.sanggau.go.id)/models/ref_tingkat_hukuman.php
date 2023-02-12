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
class Ref_tingkat_hukuman extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_tingkat_hukuman');
        $this->_set_primary_key('tingkat_hukuman_id');
        parent::__construct();
    }
}

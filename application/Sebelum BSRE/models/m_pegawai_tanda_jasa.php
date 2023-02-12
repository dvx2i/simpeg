<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_diklat
 *
 * @author Zanuar
 */
class M_pegawai_tanda_jasa extends MY_Model {

    public function __construct() {
        $this->_set_table('pegawai_tanda_jasa');
        $this->_set_primary_key('pegawaijasa_id');
        parent::__construct();
    }
    
}

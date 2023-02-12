<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_bahasa
 *
 * @author Zanuar
 */
class M_pegawai_bahasa extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_bahasa');
        $this->_set_primary_key('pegawaibahasa_id');
        parent::__construct();
    }
    
}

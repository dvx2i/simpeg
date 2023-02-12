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
class Ref_tugas_belajar extends MY_Model {

    public function __construct() {
        $this->_set_table('ref_tugas_belajar');
        $this->_set_primary_key('tugas_belajar_id');
        parent::__construct();
    }
}

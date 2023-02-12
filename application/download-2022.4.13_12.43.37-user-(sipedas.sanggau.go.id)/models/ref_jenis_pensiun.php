<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_eselon
 *
 * @author Zanuar
 */
class Ref_jenis_pensiun extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('ref_jenis_pensiun');
        $this->_set_primary_key('jenis_pensiun_id');
        parent::__construct();
    }
}

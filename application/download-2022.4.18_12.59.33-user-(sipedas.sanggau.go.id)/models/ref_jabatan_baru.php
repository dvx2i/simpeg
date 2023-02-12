<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_jabatan
 *
 * @author Zanuar
 */
class Ref_jabatan_baru extends MY_Model
{
    //put your code here
    public function __construct()
    {
        $this->_set_table('ref_jabatan_baru');
        $this->_set_primary_key('jabatan_id');
        parent::__construct();
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Zanuar
 */
class Whatsapp extends MY_Controller {

    var $page = "system/whatsapp";

    public function __construct() {
        parent::__construct();
    }

    //put your code here

    public function index() {
        $this->loadView($this->page);
    }

}

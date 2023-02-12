<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * Zanuar AGCI - v1.1 - 2018-01-01
 * Plugin for Code Igniter
 * Auto Generate Controller
 *
 * Free for use WITHOUT WARRANTY
 *
 * For the full plugin or update https://zanuar.com/plugin/Zanuar-AGCI
 *
 */
class Page extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    function index() {
        
    }
    function php($param) {
        $this->load->view('errors/php/'.$param);
    }
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    var $mymenu = '';
    var $myakses = array();
    var $errorAPI  = '';
	var $headerAPI = '';

    function __construct() {
        parent::__construct();
        $user = $this->session->userdata('login');
        if (empty($user)) {

            if($this->uri->segment(1) == 'cuti' || $this->uri->segment(1) == 'cuti_online'){
                redirect(site_url('Akun/index/cuti'));
            }

            redirect(site_url('Home'));
        } else {
            $this->load->model(array('m_sistem'));
            if (function_exists("set_time_limit") == TRUE AND @ ini_get("safe_mode") == 0) {
                @set_time_limit(30000); // change according to your requirement
                ini_set('memory_limit', '2G');
            }
            $loginuser = $this->session->userdata('login');
            $this->mymenu = $this->m_sistem->getMenuByUserId($loginuser['user_id']);
            //security
            $akses = array();
            foreach ($this->mymenu->result() as $value) {
                $akses[$value->modul.'/'.$value->aksi] = $value->aksi_id;
            }
            $this->myakses = $akses;
//            if ( !$this->security2() || !$this->security3()) {                
//                redirect(site_url('user/Page/php/403'));
//                exit;
//            }
        }
    }

    function loadView($content = NULL, $data = NULL) {
        $loginuser = $this->session->userdata('login');
        $data['login'] = $loginuser;
        $data['menu'] = $this->mymenu;
        $data['label'] = $this->get_label($loginuser);
//        print_r($data['menu']->result());
        $data['menu_pegawai'] = $this->load->view('pegawai/pegawai_menu', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['head'] = $this->load->view('template/head', $data, TRUE);
        $data['header'] = $this->load->view('template/header', $data, TRUE);
        $data['sidebar'] = $this->load->view('template/sidebar', $data, TRUE);
        $data['footer'] = $this->load->view('template/footer', $data, TRUE);

        $this->load->view('template/main', $data);
//        $this->load->view('template/content',$content);
//        $this->load->view('template/footer');
    }

    //restrict user akses folder index
    function security1() {
        
        if (!empty($this->uri->segment(1))) {
            $key = $this->uri->segment(1);
            if ($key == 'user') {
                return true;
            }
            $key .= '/view';
            if (array_key_exists($key, $this->myakses)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //restrict user akses file index
    function security2() {
        if (!empty($this->uri->segment(2))) {
            $key = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            if ($this->uri->segment(1) == 'user') {
                return true;
            }
            $key .= '/view';
            if (array_key_exists($key, $this->myakses)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //restrict user to akses function/action
    function security3() {
        if (!empty($this->uri->segment(3))) {
            $key = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
            if ($this->uri->segment(1) == 'user') {
                return true;
            }
            if ($this->uri->segment(3) == 'table') {
                return true;
            }
            if (array_key_exists($key, $this->myakses)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function cek_admin_opd($pegawai)
    {
        $session = $this->session->userdata('login');
        $groupid = $session['group_id'];
        $unitid  = $session['unit_id'];

        if ($groupid != '4') {
            return true;
        } elseif ($groupid == '4' && $unitid == $pegawai->pegawai_unit_id) {
            return true;
        } else {
            return false;
        }
    }

    function cek_admin()
    {
        $session = $this->session->userdata('login');
        $groupid = $session['group_id'];

        if ($groupid != '4') {
            return true;
        } else {
            return false;
        }
    }

	
    function esign($url, $method, $queryData = null, array $files = null)
    {
        $curl = curl_init();
        $headers = [];

        if(!is_null($files)) $content = http_build_query($queryData);
        else $content = '';

        $auth = base64_encode($this->config->item('client_id').':'.$this->config->item('client_secret'));

        if(!is_null($files)) {
            $header = 'Content-Type: multipart/form-data;';
            $body = $this->makeCurlFile($files);
        }
        else {
            $header = '';
            $body = '';
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('client_host') . $url . '?' . $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADERFUNCTION => function($curl, $head) use (&$headers)
            {
              $len = strlen($head);
              $head = explode(':', $head, 2);
              if (count($head) < 2) // ignore invalid headers
                return $len;
          
              $headers[strtolower(trim($head[0]))][] = trim($head[1]);
          
              return $len;
            },
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'cache-control: no-cache',
                'Authorization: Basic ' . $auth,
                $header
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $this->errorAPI = $err;
            return false;
        } else {

            $this->headerAPI = $headers;
            $res = json_decode($response);
            if(json_last_error() == JSON_ERROR_NONE) {
                if(isset($res->error)){
                    $this->errorAPI = $res->error;
                    return false;
                }else return $res;
            }
            else return $response;
        }
        
    }

    /**
     * 
     */
    private function makeCurlFile(array $files = array()){
        $body = [];
        foreach ($files as $k => $v) {
            switch (true) {
                case false === $v = realpath(filter_var($v)):
                case !is_file($v):
                case !is_readable($v):
                    continue; // or return false, throw new InvalidArgumentException
            }
            $mime = mime_content_type($v);
            $info = pathinfo($v);
            $name = $info['basename'];
            $body = array_merge($body, [$k => new \CURLFile($v, $mime, $name)]);
        }
        
        return $body;
    }

    private function get_label($loginuser)
    {
        $label = array();
            
        if($loginuser['group_id'] == '8' || $loginuser['group_id'] == '9' || $loginuser['group_id'] == '10' || $loginuser['group_id'] == '11' || $loginuser['group_id'] == '12'){ // penandatanganan

            $kgb = $this->m_sistem->get_count_kgb($loginuser);
            $label['kgb'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$kgb.'</small>
            </span>';
            $cuti = $this->m_sistem->get_count_cuti($loginuser);
            $label['cuti'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$cuti.'</small>
            </span>';
        }
    	
    	
    	if($loginuser['group_id'] == '1' || $loginuser['group_id'] == '13'){ // bpkad

            $cuti = $this->m_sistem->get_count_cuti($loginuser);
            $label['cuti'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$cuti.'</small>
            </span>';
        }
    	
    	if($loginuser['group_id'] == '7'){ // bpkad

            $kgb = $this->m_sistem->get_count_kgb_bpkad($loginuser);
            $label['kgb'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$kgb.'</small>
            </span>';
        }
    	
    	if($loginuser['group_id'] == '9' || $loginuser['group_id'] == '11'){ // kaban bupati

            $pensiun = $this->m_sistem->get_count_pensiun($loginuser);
            $label['pensiun'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$pensiun.'</small>
            </span>';
        }
    
    	if($loginuser['group_id'] == '8' || $loginuser['group_id'] == '9'){ // kaban sekda

            $pangkat = $this->m_sistem->get_count_pangkat($loginuser);
            $label['pangkat'] = '<span class="pull-right-container">
            <small class="label pull-right label-primary">'.$pangkat.'</small>
            </span>';
        }
        return $label;
          
    }

}

?>
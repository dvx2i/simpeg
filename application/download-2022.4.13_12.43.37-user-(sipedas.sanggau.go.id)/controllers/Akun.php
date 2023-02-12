<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akun extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_user');
        $this->load->model('sys_user_group');
        $this->load->model('sys_user');
        $this->load->model('m_user');
        $this->load->library('form_validation');
    }

    function index()
    {
        $this->load->helper('captcha');

        $vals = array(
            'img_path' => "./captcha/",
            'img_url' => base_url() . "captcha/",
            'img_width' => 200,
            'img_height' => 40,
            'border' => 0,
            'expiration' => 120,
            'word_length' => 4,
            'pool' => '0123456789',
            'font_size' => 18,
            'font_path' => './assets/fonts/cour.ttf',
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(204, 204, 204),
                'text' => array(0, 0, 0),
                'grid' => array(150, 255, 150)
            )
        );

        $cap = create_captcha($vals);


        $data = array(
            'title' => 'Administrator',
            'eror' => '',
            'image' => $cap['image']
        );

        $this->session->set_userdata('mycaptcha', $cap['word']);
        $this->load->view('akun/login', $data);
    }

    function register()
    {
    
        if (empty($this->session->userdata('login'))) {
            $data = array(
                'title' => 'Administrator',
                'eror' => '',
            );

            $this->load->view('akun/register', $data);
        }else{
            redirect('');
        }
    }

    function save()
    {

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            
            $data['user_name'] = $this->input->post('username');
            $data['user_pegawai_nip'] = $this->input->post('nip');
            $data['user_nama_lengkap'] = $this->input->post('nama');
            if (!blank($this->input->post('password'))) {
                $data['user_password'] = sha1($this->input->post('password'));
            }
            $data['user_unit_id'] = $this->input->post('unit');
            //        $data['UserIsActive'] = $this->input->post('status');
            $insert = $this->sys_user->insert($data);
            $group = '6';
            $id_user = $this->db->insert_id();
            $data1['UserGroupUserId'] = $id_user;
            $data1['UserGroupGroupId'] = $group;
            //        foreach ($group as $value) {
            $this->sys_user_group->insert($data1);
            //        }
            if (!blank($insert)) {
                $this->session->set_flashdata('message', alert_show('success', "Registrasi Berhasil. Silakan login menggunakan username dan password"));
            } else {
                $this->session->set_flashdata('message', alert_show('danger', "Registrasi Gagal"));
            }
            redirect('Akun');
        }
        
    }

    function cek_nip($nip)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'sipedas.sanggau.go.id/api/?nip='.$nip,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'token: 43a281b5d1561a9ca5ca2893202f27db'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    function auth()
    {
        if ($_POST) {
            $this->form_validation->set_rules('username', 'Username' . 'required|trim|xss_clean');
            $this->form_validation->set_rules('password', 'Password' . 'required|trim|xss_clean');


            $mycaptcha = $this->session->userdata('mycaptcha');
            $yourcaptcha = $this->input->post('yourcaptcha');
            if ($mycaptcha != $yourcaptcha) {

                $this->session->set_flashdata('message', 'Captcha yang anda ketikkan tidak sesuai');
                redirect(site_url('Akun'));
            }


            if ($this->form_validation->run() == FALSE) {
                redirect('');
            }

            $username = $this->input->post('username');
            $password = $this->encrypt->sha1($this->input->post('password'));

            $auth = $this->m_user->get_user_login("user_name = '$username' and user_password= '$password'")->result_array();
            // print_r($auth);
            // die;
            if ($auth != NULL) {
                $data = array(
                    'username' => $auth[0]['user_name'],
                    'user_id' => $auth[0]['user_id'],
                    'fullname' => $auth[0]['user_nama_lengkap'],
                    'group_id' => $auth[0]['UserGroupGroupId'],
                    'unit_id'  => $auth[0]['user_unit_id'],
                    'nip' => $auth[0]['user_pegawai_nip'],
                );
                $this->session->set_userdata('login', $data);
                //                die("login sukses");
                redirect('');
            } else {

                $this->session->set_flashdata('message', 'Username atau password salah');
                redirect(site_url('Akun'));
            }
        } else {
            echo "Page not found";
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
    
  public function _rules()
  {
    $this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[sys_user.user_pegawai_nip]|xss_clean');
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[sys_user.user_name]|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('repassword', 'Konfirmasi Password', 'required|matches[password]|xss_clean');

    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    $this->form_validation->set_message('required', 'Objek %s harus di isi.');
    $this->form_validation->set_message('matches', 'Password tidak sama.');
    $this->form_validation->set_message('is_unique', '%s telah dipakai');
  }
}

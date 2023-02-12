<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BaganStruktur extends MY_Controller
{

    //variable
    var $view = 'laporan/bagan_struktur';     // file view
    var $redirect = 'laporan/BaganStruktur';     // redirect to here
    var $modul = '';        // this modul or class name

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_laporan', 'm_bagan_struktur', 'ref_unit', 'ref_jabatan_struktural'));
    }

    public function index($mode = null, $versi = null)
    {
        if ($mode == 'json') {
            header('Content-Type: application/json');
            echo $this->m_bagan_struktur->json();
            die;
        } else {
            // $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id' => NULL, 'unit_kode <> ' => '0100000'));
            $data['unit'] = $this->ref_unit->get_unit();
            $data['jenis'] = '';
            //POST
            if (!empty($this->input->post('pegawai_unit_id'))) {
                if ($this->input->post('jenis') == 'setting') {
                    $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
                    $data['where'] = $where;
                    $data['jenis'] = 'setting';
                    $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
                    $data['unit_id'] = $where['pegawai_unit_id'];
                    $data['jabatan'] = $this->ref_jabatan_struktural->get_jabatan_by_unit($where['pegawai_unit_id']);
                	// print_r($data['jabatan']); die;
                	if(empty($data['jabatan']->result_array())){ //get jabatan by parent unit
                    	$parent_unit = $this->ref_unit->get_row($where['pegawai_unit_id']);
                    	$data['jabatan'] = $this->ref_jabatan_struktural->get_jabatan_by_unit($parent_unit->unit_parent_id);
                    }
                
                    $data['bagan'] = $this->m_bagan_struktur->get_bagan_pegawai_by_unit($where['pegawai_unit_id']);
                    $this->loadView($this->view, $data);
                }
                if ($this->input->post('jenis') == 'bagan') {
                    $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
                    $data['where'] = $where;
                    $data['jenis'] = 'bagan';
                    $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
                    // $data['bagan'] = $this->m_bagan_struktur->get_bagan_pegawai_by_unit($where['pegawai_unit_id']);
                    // $data['result'] = $this->m_laporan->get_daftar_urut_kepangkatan($where['pegawai_unit_id']);
                    // $data['level'] = $this->m_bagan_struktur->get_level_by_unit($where['pegawai_unit_id']);
                
                    $data['is_assistant'] = $this->m_bagan_struktur->get_bagan_assistant($where['pegawai_unit_id']);
                    $data['level'] = $this->m_bagan_struktur->get_level_by_unit_v2($where['pegawai_unit_id']);
                    // $this->load->view('laporan/bagan_chart', $data);
                	 // if($versi == '2'){
                    	$data['bagan'] = $this->m_bagan_struktur->get_bagan_pegawai_by_unit_v2($where['pegawai_unit_id']);
                    	$this->loadView('laporan/bagan_struktur_v2', $data);
                	// }
                	// else{
                	// 	$this->loadView($this->view, $data);
                	// }
                }
            } else {

                $this->loadView($this->view, $data);
            }
        }
    }

    public function detail($id)
    {
        $data['result'] = $this->m_model->get_row($id);
        $this->loadView($this->view, $data);
    }

    public function add()
    {
        //extrac post here       
        $data['bagan_parent_id'] = $this->input->post('bagan_parent_id');
        $data['bagan_pegawai_nip'] = $this->input->post('bagan_pegawai_nip');
        $data['bagan_unit_id'] = $this->input->post('bagan_unit_id');
        $data['bagan_jabatan_id'] = $this->input->post('bagan_jabatan_id');
        $data['bagan_level'] = $this->input->post('bagan_level');

        $insert = $this->m_bagan_struktur->insert($data);
        if ($insert) {
            echo json_encode(array('success' => true, 'message' => 'Bagan berhasil disimpan'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Bagan gagal disimpan'));
        }
    }

    public function update()
    {
    
    
        if(isset($_POST['bagan_is_bupati'])){
        	$id = $this->input->post('bagan_id');
        // print_r($_POST); die;
        	$data['bagan_bupati_nama'] = $this->input->post('bagan_bupati_nama');
        	$data['bagan_wabupati_nama'] = $this->input->post('bagan_wabupati_nama');
        
        	$this->upload_file('BUPATI');
        	$this->upload_file('WABUP');
        
        }else{
        //extrac post here and post primary key is id
        	$id = $this->input->post('bagan_id');
        	$data['bagan_parent_id'] = $this->input->post('bagan_parent_id');
        	$data['bagan_pegawai_nip'] = $this->input->post('bagan_pegawai_nip');
        	$data['bagan_unit_id'] = $this->input->post('bagan_unit_id');
        	$data['bagan_jabatan_id'] = $this->input->post('bagan_jabatan_id');
        	$data['bagan_level'] = $this->input->post('bagan_level');
        	$data['bagan_is_bupati'] = 0;
        }

        $update = $this->m_bagan_struktur->update($data, $id);
        if ($update) {
            echo json_encode(array('success' => true, 'message' => 'Bagan berhasil disimpan'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Bagan gagal disimpan'));
        }
    }

    public function delete($id)
    {
        $delete = $this->m_bagan_struktur->delete($id);
        if ($delete) {
            echo json_encode(array('success' => true, 'message' => 'Bagan berhasil disimpan'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Bagan gagal disimpan'));
        }
    }

    public function cetak()
    {
        //$data['unit'] = $this->ref_unit->get_where(array('unit_parent_id'=>NULL,'unit_kode <> '=>'0100000'));
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
            $data['where'] = $where;
            $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
            $data['result'] = $this->m_laporan->get_daftar_urut_kepangkatan($where['pegawai_unit_id']);
        }

        $this->load->view($this->view . '_cetak', $data);
    }

	
    public function upload_file($filename)
    {
    	if($filename == 'BUPATI'){
        	$file = $_FILES['bagan_bupati_foto']['name'];
        }
    	if($filename == 'WABUP'){
        	$file = $_FILES['bagan_wabupati_foto']['name'];
        }
        
        if (!empty($file)) {
            $config['upload_path'] = 'assets/images';
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG';
            $config['overwrite'] = true;
            $config['create_thumb'] = false;
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                //echo 'error 1 ' . $this->upload->display_errors();
                return false;
            } else {
                return true;
            }
        } else {
            //echo 'ksosong';
            return false;
        }
    }
}

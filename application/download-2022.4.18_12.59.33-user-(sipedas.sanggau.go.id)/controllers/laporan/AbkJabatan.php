<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AbkJabatan extends MY_Controller
{

    //variable
    var $view = 'laporan/abk_jabatan';     // file view
    var $redirect = 'laporan/AbkJabatan';     // redirect to here
    var $modul = '';        // this modul or class name

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pegawai', 'm_laporan', 'm_abk_jabatan', 'ref_unit', 'ref_jabatan_struktural', 'ref_jabatan_fungsional'));
    }

    public function index($mode = null)
    {
        if ($mode == 'json') {
            header('Content-Type: application/json');
            echo $this->m_abk_jabatan->json();
            die;
        } else {
            // $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id' => NULL, 'unit_kode <> ' => '0100000'));
            $data['unit'] = $this->ref_unit->get_where(array('unit_is_unit_kerja' => '1'));
            $data['jenis'] = '';
            //POST
            if (!empty($this->input->post('pegawai_unit_id'))) {
                if ($this->input->post('jenis') == 'setting') {
                    $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
                    $data['where'] = $where;
                    $data['jenis'] = 'setting';
                    $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
            		$data['sub_unit'] = $this->ref_unit->get_sub_unit(array('unit_parent_id' => $where['pegawai_unit_id']));
                    $data['unit_id'] = $where['pegawai_unit_id'];
                    $data['jabatan'] = $this->ref_jabatan_struktural->get_jabatan_by_unit($where['pegawai_unit_id']);
                    $data['fungsional'] = $this->ref_jabatan_fungsional->get_jabatan('4');
                    $data['khusus'] = $this->ref_jabatan_fungsional->get_jabatan('2');
                	// print_r($data['jabatan']); die;
                	if(empty($data['jabatan']->result_array())){ //get jabatan by parent unit
                    	$parent_unit = $this->ref_unit->get_row($where['pegawai_unit_id']);
                    	$data['jabatan'] = $this->ref_jabatan_struktural->get_jabatan_by_unit($parent_unit->unit_parent_id);
                    }
                
                    $data['bagan'] = $this->m_abk_jabatan->get_abkjabatan_by_unit($where['pegawai_unit_id']);
                    $this->loadView($this->view, $data);
                }
                if ($this->input->post('jenis') == 'bagan') {
                    $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
                    $data['where'] = $where;
                    $data['jenis'] = 'bagan';
                    $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
                    $bagan = $this->m_abk_jabatan->get_abkjabatan_by_unit($where['pegawai_unit_id'])->result_array();
                    for($i=0; $i < count($bagan); $i++){
                        $data['bagan'][$i] = $bagan[$i];
                        $data['bagan'][$i]['pegawai'] = $this->m_abk_jabatan->get_pegawai_by_jabatan($bagan[$i]['abkjabatan_unit_id'],$bagan[$i]['abkjabatan_sub_unit_id'],$bagan[$i]['abkjabatan_jenis_jabatan_id'],$bagan[$i]['abkjabatan_jabatan_id']);
                    }
                    // print_r($data['bagan']); die;
                    $data['is_assistant'] = $this->m_abk_jabatan->get_abkjabatan_assistant($where['pegawai_unit_id']);
                    // $data['level'] = $this->m_abk_jabatan->get_level_by_unit($where['pegawai_unit_id']);
                    // $this->load->view('laporan/bagan_chart', $data);
                $this->loadView($this->view, $data);
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
        $data['abkjabatan_parent_id'] = $this->input->post('abkjabatan_parent_id');
        $data['abkjabatan_is_assistant'] = $this->input->post('abkjabatan_is_assistant');
        $data['abkjabatan_unit_id'] = $this->input->post('abkjabatan_unit_id');
        $data['abkjabatan_sub_unit_id'] = $this->input->post('abkjabatan_sub_unit_id');
        $data['abkjabatan_jenis_jabatan_id'] = $this->input->post('abkjabatan_jenis_jabatan_id');
        $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id');
        if($data['abkjabatan_jenis_jabatan_id'] == '4'){
            $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id_fungsional');
        }else if($data['abkjabatan_jenis_jabatan_id'] == '2'){
            $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id_fungsional_khusus');
        }
        $data['abkjabatan_level'] = $this->input->post('abkjabatan_level');
        $data['abkjabatan_kebutuhan'] = $this->input->post('abkjabatan_kebutuhan');
        $data['abkjabatan_bezzeting'] = $this->m_abk_jabatan->get_bezzeting($data['abkjabatan_unit_id'],$data['abkjabatan_sub_unit_id'],$data['abkjabatan_jenis_jabatan_id'], $data['abkjabatan_jabatan_id']);
        // die($this->db->last_query());
        $insert = $this->m_abk_jabatan->insert($data);
        if ($insert) {
            echo json_encode(array('success' => true, 'message' => 'Bagan berhasil disimpan'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Bagan gagal disimpan'));
        }
    }

    public function update()
    {
        //extrac post here and post primary key is id
        	$id = $this->input->post('abkjabatan_id');
        	
        $data['abkjabatan_parent_id'] = $this->input->post('abkjabatan_parent_id');
        $data['abkjabatan_is_assistant'] = $this->input->post('abkjabatan_is_assistant');
        $data['abkjabatan_unit_id'] = $this->input->post('abkjabatan_unit_id');
        $data['abkjabatan_jenis_jabatan_id'] = $this->input->post('abkjabatan_jenis_jabatan_id');
        $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id');
        if($data['abkjabatan_jenis_jabatan_id'] == '4'){
            $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id_fungsional');
        }else if($data['abkjabatan_jenis_jabatan_id'] == '2'){
            $data['abkjabatan_jabatan_id'] = $this->input->post('abkjabatan_jabatan_id_fungsional_khusus');
        }
        $data['abkjabatan_level'] = $this->input->post('abkjabatan_level');
        $data['abkjabatan_kebutuhan'] = $this->input->post('abkjabatan_kebutuhan');
        $data['abkjabatan_bezzeting'] = $this->input->post('abkjabatan_bezzeting');
        // die(json_encode($data));

        $update = $this->m_abk_jabatan->update($data, $id);
        if ($update) {
            echo json_encode(array('success' => true, 'message' => 'Bagan berhasil disimpan'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Bagan gagal disimpan'));
        }
    }

    public function delete($id)
    {
        $delete = $this->m_abk_jabatan->delete($id);
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

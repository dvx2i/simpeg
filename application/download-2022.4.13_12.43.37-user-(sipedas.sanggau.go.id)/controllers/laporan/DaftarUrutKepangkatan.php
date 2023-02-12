<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarUrutKepangkatan extends MY_Controller {

    //variable
    var $view = 'laporan/daftar_urut_kepangkatan';     // file view
    var $redirect = 'laporan/DaftarUrutKepangkatan';     // redirect to here
    var $modul = '';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array(    'm_pegawai','m_laporan','ref_unit'    ));
    }

    public function index() {
        $data['unit'] = $this->ref_unit->get_where(array('unit_parent_id'=>NULL,'unit_kode <> '=>'0100000'));
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
            $data['where'] = $where;
            $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
            $data['result'] = $this->m_laporan->get_daftar_urut_kepangkatan($where['pegawai_unit_id']);
        }        
        
        $this->loadView($this->view, $data);
    }

    public function detail($id) {
        $data['result'] = $this->m_model->get_row($id);
        $this->loadView($this->view, $data);
    }

    public function add() {
        //extrac post here       
        $data['kolom'] = $this->input->post('post_name');

        $insert = $this->m_model->insert($data);
        if ($insert) {
            $this->session->set_flashdata('message', alert_show(array('success', "Tambah " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Tambah " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function update() {
        //extrac post here and post primary key is id
        $id = $this->input->post('id');
        $data['kolom'] = $this->input->post('post_name');

        $update = $this->m_model->update($data, $id);
        if ($update) {
            $this->session->set_flashdata('message', alert_show(array('success', "Edit " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Edit " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function delete($id) {
        $delete = $this->m_model->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show(array('success', "Delete " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Delete " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function cetak() {
        //$data['unit'] = $this->ref_unit->get_where(array('unit_parent_id'=>NULL,'unit_kode <> '=>'0100000'));
        //POST
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where['pegawai_unit_id'] = $this->input->post('pegawai_unit_id');
            $data['where'] = $where;
            $data['unit_select'] = $this->ref_unit->get_row($where['pegawai_unit_id']);
            $data['result'] = $this->m_laporan->get_daftar_urut_kepangkatan($where['pegawai_unit_id']);
        }        
        
        $this->load->view($this->view.'_cetak', $data);
    }

}

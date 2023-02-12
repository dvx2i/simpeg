<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PejabatPenetap extends MY_Controller {

    //variable
    var $view = 'referensi/pejabat';     // file view
    var $redirect = 'referensi/PejabatPenetap';     // redirect to here
    var $modul = '';        // this modul or class name

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ref_pejabat'));
    }

    public function index() {
        $data['result'] = $this->ref_pejabat->get_all();
        $this->loadView($this->view, $data);
    }

    public function detail($id) {
        $data['result'] = $this->ref_pejabat->get_row($id);
        $this->loadView($this->view, $data);
    }

    private function set_data() {
        $data['pejabat_nama'] = $this->input->post('nama');
        return $data;
    }

    public function add() {
        //extrac post here       
        $data = $this->set_data();

        $insert = $this->ref_pejabat->insert($data);
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
        $data = $this->set_data();

        $update = $this->ref_pejabat->update($data, $id);
        if ($update) {
            $this->session->set_flashdata('message', alert_show(array('success', "Edit " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Edit " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function delete($id) {
        $delete = $this->ref_pejabat->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show(array('success', "Delete " . $this->modul . " Berhasil")));
        } else {
            $this->session->set_flashdata('message', alert_show(array('danger', "Delete " . $this->modul . " Gagal")));
        }
        redirect($this->redirect);
    }

    public function excel() {
        $data['result'] = $this->ref_pejabat->get_all();
        $data['nama_file'] = date('Ymdhis') . '_' . $this->modul;
        $this->load->view('export/excel', $data);
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_kgb
 *
 * @author Zanuar
 */
class M_bagan_struktur extends MY_Model
{
    //put your code here
    public function __construct()
    {
        $this->_set_table('bagan_struktur');
        $this->_set_primary_key('bagan_id');
        parent::__construct();
    }


    // datatables
    function json($param = null)
    {
        $this->load->helper('my_datatable');
        $this->datatables->select("a.bagan_id,CASE WHEN a.bagan_is_bupati = '1' THEN CONCAT(a.bagan_bupati_nama,'/',a.bagan_wabupati_nama) ELSE b.pegawai_nama END AS pegawai_nama,a.bagan_pegawai_nip,a.bagan_parent_id,a.bagan_unit_id,a.bagan_jabatan_id,b.pegawai_unit_nama,d.jabatan_nama,CASE WHEN a.bagan_is_bupati = '1' THEN 'BUPATI/WAKIL BUPATI' ELSE b.pegawai_jabatan_nama END AS pegawai_jabatan_nama,a.bagan_level,a.bagan_is_bupati,a.bagan_bupati_nama,a.bagan_wabupati_nama", FALSE);
        $this->datatables->from('bagan_struktur a');
        $this->datatables->join('pegawai b', 'a.bagan_pegawai_nip = b.pegawai_nip', 'LEFT');
        $this->datatables->join('bagan_struktur c', 'a.bagan_parent_id = c.bagan_id', 'LEFT');
        $this->datatables->join('ref_jabatan_struktural d', 'c.bagan_jabatan_id = d.jabatan_id', 'LEFT');
        $this->datatables->where('a.bagan_unit_id', $this->input->post('bagan_unit_id'));
        // $this->datatables->add_column('action', ' 
        //             <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit(\'$1\',\'$2\',\'$3\',\'$4\',\'$5\',\'$6\')" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
        //             <a href="#" class="btn btn-danger btn-sm" onclick="delete_bagan(\'$1\')"><i class="fa fa-trash-o fa-fw"></i></a>', 'bagan_id,bagan_parent_id,bagan_pegawai_nip,bagan_unit_id,bagan_jabatan_id,bagan_level');

        $this->datatables->add_column('action', '$1', 'bagan_action(bagan_id,bagan_parent_id,bagan_pegawai_nip,bagan_unit_id,bagan_jabatan_id,bagan_level,bagan_is_bupati,bagan_bupati_nama,bagan_wabupati_nama)');
        return
            $this->datatables->generate();
        // echo $this->db->last_query();
        // die;
    }

    public function get_bagan_pegawai_by_unit($unit_id)
    {
        $this->db->select("a.*,b.pegawai_nama,b.pegawai_jabatan_nama,b.pegawai_nip,b.pegawai_gelar_depan,b.pegawai_gelar_belakang,b.pegawai_pendidikan_terakhir_tingkat,pegawai_tempat_lahir,pegawai_foto_kpe,pegawai_tgl_lahir,pegawai_jabatan_tmt,pegawai_pangkat_terakhir_golru,pegawai_pangkat_terakhir_tmt,jabatan_nama");
        $this->db->from("bagan_struktur a");
        $this->db->join("pegawai b", "a.bagan_pegawai_nip = b.pegawai_nip", "LEFT");
        $this->db->join('ref_jabatan_struktural d', 'a.bagan_jabatan_id = d.jabatan_id', 'LEFT');
        $this->db->where('bagan_unit_id', $unit_id);
        return $this->db->get();
    }

    public function get_bagan_pegawai_by_unit_v2($unit_id)
    {
        $this->db->select("a.*,CONCAT(pegawai_gelar_depan,' ',pegawai_nama,' ',pegawai_gelar_belakang) as pegawai_nama,b.pegawai_jabatan_nama,b.pegawai_nip,b.pegawai_gelar_depan,b.pegawai_gelar_belakang,b.pegawai_pendidikan_terakhir_tingkat,pegawai_tempat_lahir,pegawai_foto_kpe,pegawai_tgl_lahir,pegawai_jabatan_tmt,pegawai_pangkat_terakhir_golru,pegawai_pangkat_terakhir_tmt,jabatan_nama", false);
        $this->db->from("bagan_struktur_v2 a");
        $this->db->join("pegawai b", "a.bagan_pegawai_nip = b.pegawai_nip", "LEFT");
        $this->db->join('ref_jabatan_struktural d', 'a.bagan_jabatan_id = d.jabatan_id', 'LEFT');
        $this->db->where('bagan_unit_id', $unit_id);
        return $this->db->get()->result_array();
    }

    public function get_bagan_assistant($unit_id)
    {
        $this->db->select("*");
        $this->db->from("bagan_struktur_v2 a");
        $this->db->where('bagan_unit_id', $unit_id);
        $this->db->where('bagan_is_assistant', '1');
        return $this->db->get();
    }
    public function get_level_by_unit_v2($unit_id)
    {
        $this->db->select("a.bagan_level");
        $this->db->from("bagan_struktur_v2 a");
        $this->db->where('bagan_unit_id', $unit_id);
        $this->db->group_by('bagan_level');
        return $this->db->get();
    }

    public function get_level_by_unit($unit_id)
    {
        $this->db->select("a.bagan_level");
        $this->db->from("bagan_struktur a");
        $this->db->where('bagan_unit_id', $unit_id);
        $this->db->group_by('bagan_level');
        return $this->db->get();
    }
}

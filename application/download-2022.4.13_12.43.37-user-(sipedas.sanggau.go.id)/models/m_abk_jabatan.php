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
class M_abk_jabatan extends MY_Model
{
    //put your code here
    public function __construct()
    {
        $this->_set_table('pegawai_abk_jabatan');
        $this->_set_primary_key('abkjabatan_id');
        parent::__construct();
    }


    // datatables
    function json($param = null)
    {
        $this->load->helper('my_datatable');
        $this->datatables->select("a.abkjabatan_id,a.abkjabatan_jenis_jabatan_id,a.abkjabatan_jabatan_id,a.abkjabatan_parent_id,a.abkjabatan_unit_id,COALESCE(d.jabatan_nama,e.jabatan_nama,i.jabatan_nama) AS jabatan_nama_parent,COALESCE(f.jabatan_nama,g.jabatan_nama,h.jabatan_nama) AS jabatan_nama,unit_nama,a.abkjabatan_level,a.abkjabatan_kebutuhan,a.abkjabatan_bezzeting", FALSE);
        $this->datatables->from('pegawai_abk_jabatan a');
        $this->datatables->join('pegawai_abk_jabatan c', 'a.abkjabatan_parent_id = c.abkjabatan_id', 'LEFT');
        $this->datatables->join('ref_jabatan_struktural d', 'c.abkjabatan_jabatan_id = d.jabatan_id AND c.abkjabatan_jenis_jabatan_id = "1"', 'LEFT');
        $this->datatables->join('ref_jabatan_fungsional e', 'c.abkjabatan_jabatan_id = e.jabatan_id AND c.abkjabatan_jenis_jabatan_id = "2"', 'LEFT');
        $this->datatables->join('ref_jabatan_struktural f', 'a.abkjabatan_jabatan_id = f.jabatan_id AND a.abkjabatan_jenis_jabatan_id = "1"', 'LEFT');
        $this->datatables->join('ref_jabatan_fungsional g', 'a.abkjabatan_jabatan_id = g.jabatan_id AND a.abkjabatan_jenis_jabatan_id = "2"', 'LEFT');
        $this->datatables->join('ref_jabatan_baru h', 'a.abkjabatan_jabatan_id = h.jabatan_id AND a.abkjabatan_jenis_jabatan_id <> "1"', 'LEFT');
        $this->datatables->join('ref_jabatan_baru i', 'c.abkjabatan_jabatan_id = i.jabatan_id AND c.abkjabatan_jenis_jabatan_id <> "1"', 'LEFT');
        $this->datatables->join('ref_unit j', 'a.abkjabatan_unit_id = j.unit_id', 'LEFT');
        $this->datatables->where('a.abkjabatan_unit_id', $this->input->post('abkjabatan_unit_id'));
        // $this->datatables->add_column('action', ' 
        //             <a href="#" class="btn btn-warning btn-sm" type="button" onclick="edit(\'$1\',\'$2\',\'$3\',\'$4\',\'$5\',\'$6\')" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
        //             <a href="#" class="btn btn-danger btn-sm" onclick="delete_bagan(\'$1\')"><i class="fa fa-trash-o fa-fw"></i></a>', 'abkjabatan_id,abkjabatan_parent_id,abkjabatan_pegawai_nip,abkjabatan_unit_id,abkjabatan_jabatan_id,abkjabatan_level');

        $this->datatables->add_column('action', '$1', 'abk_action(abkjabatan_id,abkjabatan_parent_id,abkjabatan_unit_id,abkjabatan_jabatan_id,abkjabatan_level,abkjabatan_kebutuhan,abkjabatan_bezzeting,abkjabatan_jenis_jabatan_id)');
        return
            $this->datatables->generate();
        // echo $this->db->last_query();
        // die;
    }

    public function get_abkjabatan_by_unit($unit_id)
    {
        $this->db->select("a.*,COALESCE(d.jabatan_nama,e.jabatan_nama,f.jabatan_nama) AS jabatan_nama", FALSE);
        $this->db->from("pegawai_abk_jabatan a");
        $this->db->join('ref_jabatan_struktural d', 'a.abkjabatan_jabatan_id = d.jabatan_id AND a.abkjabatan_jenis_jabatan_id = "1"', 'LEFT');
        $this->db->join('ref_jabatan_fungsional e', 'a.abkjabatan_jabatan_id = e.jabatan_id AND a.abkjabatan_jenis_jabatan_id = "2"', 'LEFT');
        $this->db->join('ref_jabatan_baru f', 'a.abkjabatan_jabatan_id = f.jabatan_id AND a.abkjabatan_jenis_jabatan_id <> "1"', 'LEFT');
        $this->db->where('abkjabatan_unit_id', $unit_id);
        return $this->db->get();
    }
    
    public function get_abkjabatan_assistant($unit_id)
    {
        $this->db->select("*");
        $this->db->from("pegawai_abk_jabatan a");
        $this->db->where('abkjabatan_unit_id', $unit_id);
        $this->db->where('abkjabatan_is_assistant', '1');
        return $this->db->get();
    }

    public function get_level_by_unit($unit_id)
    {
        $this->db->select("a.bagan_level");
        $this->db->from("pegawai_abk_jabatan a");
        $this->db->where('bagan_unit_id', $unit_id);
        $this->db->group_by('bagan_level');
        return $this->db->get();
    }
    
    public function get_bezzeting($unit_id, $jenis, $jabatan_id)
    {
        $this->db->select("*");
        $this->db->from("pegawai a");
        $this->db->where('pegawai_unit_id', $unit_id);
        if($jenis == '1'){
        $this->db->where('pegawai_jenisjabatan_kode', $jenis);
        }else{
            $this->db->where('pegawai_jenisjabatan_kode <> ', '1', FALSE);
        }
        $this->db->where('pegawai_jabatan_id', $jabatan_id);
        $this->db->where('pegawai_status', '1');
        return $this->db->get()->num_rows();
    }
    
    public function get_pegawai_by_jabatan($unit_id, $jenis, $jabatan_id)
    {
        $this->db->select("CONCAT(pegawai_gelar_depan,' ',pegawai_nama,' ',pegawai_gelar_belakang) as nama,pegawai_nip as nip", FALSE);
        $this->db->from("pegawai a");
        $this->db->where('pegawai_unit_id', $unit_id);
        if($jenis == '1'){
        $this->db->where('pegawai_jenisjabatan_kode', $jenis);
        }else{
            $this->db->where('pegawai_jenisjabatan_kode <> ', '1', FALSE);
        }
        $this->db->where('pegawai_jabatan_id', $jabatan_id);
        $this->db->where('pegawai_status', '1');
        return $this->db->get()->result_array();
    }
}

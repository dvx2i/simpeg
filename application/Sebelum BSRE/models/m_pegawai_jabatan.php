<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pegawai_jabatan
 *
 * @author Zanuar
 */
class M_pegawai_jabatan extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_jabatan');
        $this->_set_primary_key('pegawaijabatan_id');
        parent::__construct();
    }
    
    function get_where($where) {
        $this->db->where($where);
        $this->db->order_by('pegawaijabatan_tmt', 'asc');
        $query = $this->db->get($this->table);
        return $query;
    }
    
    function get_jabatan_terakhir($nip) {
        $query= "select * from pegawai_jabatan where pegawaijabatan_pegawai_nip = '$nip' order by pegawaijabatan_tmt desc";
        return $this->db->query($query)->row();
    }
    
    function update_jabatan_terakhir($nip) {
        $pangkat_terakhir = $this->get_jabatan_terakhir($nip);
        $data['pegawai_jenisjabatan_kode'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_id;
        $data['pegawai_jenisjabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jenisjabatan_nama;
        $data['pegawai_jabatan_id'] = $pangkat_terakhir->pegawaijabatan_jabatan_id;
        $data['pegawai_jabatan_nama'] = $pangkat_terakhir->pegawaijabatan_jabatan_nama;
        $data['pegawai_jabatan_tmt'] = $pangkat_terakhir->pegawaijabatan_tmt;
        $data['pegawai_jabatan_sk_nomor'] = $pangkat_terakhir->pegawaijabatan_sk_no;
        $data['pegawai_jabatan_sk_tanggal'] = $pangkat_terakhir->pegawaijabatan_sk_tanggal;
        $this->m_pegawai->update($data, $nip);
    }
}

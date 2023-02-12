<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_agama
 *
 * @author Zanuar
 */
class M_pegawai_pangkat extends MY_Model {

    public function __construct() {
        $this->_set_table('pegawai_pangkat');
        $this->_set_primary_key('pegawaipangkat_id');
        parent::__construct();
    }
    
    function get_where($where) {
        $this->db->where($where);
        $this->db->order_by('pegawaipangkat_tmt', 'asc');
        $query = $this->db->get($this->table);
        return $query;
    }
    
    function get_pangkat_terakhir($nip) {
        $query= "select * from pegawai_pangkat where pegawaipangkat_pegawai_nip = '$nip' order by pegawaipangkat_tmt desc";
        return $this->db->query($query)->row();
    }
    
    function update_pangkat_terakhir($nip) {
        $pangkat_terakhir = $this->get_pangkat_terakhir($nip);
        $data1['pegawai_pangkat_terakhir_id'] = $pangkat_terakhir->pegawaipangkat_pangkat_id;
        $data1['pegawai_pangkat_terakhir_nama'] = $pangkat_terakhir->pegawaipangkat_pangkat_nama;
        $data1['pegawai_pangkat_terakhir_golru'] = $pangkat_terakhir->pegawaipangkat_pangkat_golru;
        $data1['pegawai_pangkat_terakhir_tmt'] = $pangkat_terakhir->pegawaipangkat_tmt;
        $data1['pegawai_pangkat_terakhir_sk'] = $pangkat_terakhir->pegawaipangkat_sk_no;
        $data1['pegawai_pangkat_terakhir_pejabat'] = $pangkat_terakhir->pegawaipangkat_sk_pejabat;
        $data1['pegawai_pangkat_terakhir_tahun'] = $pangkat_terakhir->pegawaipangkat_masa_kerja_tahun;
        $data1['pegawai_pangkat_terakhir_bulan'] = $pangkat_terakhir->pegawaipangkat_masa_kerja_bulan;
        $data1['pegawai_pangkat_terakhir_sk_tgl'] = $pangkat_terakhir->pegawaipangkat_sk_date;
        $data1['pegawai_kenaikan_pangkat_berikutnya'] = date('Y-m-d', strtotime('+4 years', strtotime($pangkat_terakhir->pegawaipangkat_sk_date)));
        $this->m_pegawai->update($data1, $nip);
    }
}

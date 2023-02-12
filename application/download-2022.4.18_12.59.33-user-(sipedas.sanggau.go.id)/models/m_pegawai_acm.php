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

class M_pegawai_acm extends MY_Model {



    public function __construct() {

	
        $this->_set_table('pegawai');

        $this->_set_primary_key('pegawai_nip');

        parent::__construct();

    }

    


    
	function get_pegawaix($where) {
//echo "aaaa";exit;
        $this->db->select("pegawai_nip,pegawai_nama,pegawai_pangkat_terakhir_nama,pegawai_pangkat_terakhir_golru,pegawai_jabatan_nama,pegawai_unit_nama");

        $this->db->where($where);
		$this->db->from('pegawai');
        return $this->db->get();
    }

}


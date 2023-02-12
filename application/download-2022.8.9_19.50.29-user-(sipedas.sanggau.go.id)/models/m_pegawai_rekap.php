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
class M_pegawai_rekap extends MY_Model {

    public function __construct() {
        $this->_set_table('pegawai_rekap');
        $this->_set_primary_key('rekap_id');
        parent::__construct();
    }

    function set_table($table_name) {
        $this->_set_table($table_name);
    }
    
    function update_now($tahun, $bulan) {
        $query = "DELETE FROM pegawai_rekap WHERE rekap_tahun = '".$tahun."' AND rekap_bulan = ".$bulan.";";
        $this->db->query($query);
        $query = "INSERT INTO pegawai_rekap 
	( 
	rekap_tahun, 
	rekap_bulan, 
	pegawai_nip, 
	pegawai_nama, 
	pegawai_gelar_depan, 
	pegawai_gelar_belakang, 
	pegawai_unit_id, 
	pegawai_unit_nama, 
	pegawai_jenkel_id, 
	pegawai_jenkel_nama, 
	pegawai_golongandarah_id, 
	pegawai_golongandarah_nama, 
	pegawai_agama_id, 
	pegawai_agama_nama, 
	pegawai_statusperkawinan_id, 
	pegawai_statusperkawinan_nama, 
	pegawai_status_kepegawaian_id, 
	pegawai_status_kepegawaian_nama, 
	pegawai_pangkat_terakhir_id, 
	pegawai_pangkat_terakhir_nama, 
	pegawai_pangkat_terakhir_golru, 
	pegawai_pendidikan_terakhir_id, 
	pegawai_pendidikan_terakhir_nama, 
	pegawai_pendidikan_terakhir_tingkat_id, 
	pegawai_pendidikan_terakhir_tingkat, 
	pegawai_jenisjabatan_kode, 
	pegawai_jenisjabatan_nama, 
	pegawai_jabatan_id, 
	pegawai_jabatan_nama, 
	pegawai_diklat_struktural_terakhir, 
	pegawai_diklat_struktural_terakhir_id, 
	pegawai_eselon_id, 
	pegawai_eselon_nama, 
	pegawai_status, 
	pegawai_status_description, 
	pegawai_keterangan
	)
		
SELECT 	 
	'".$tahun."' AS rekap_tahun, 
	'".$bulan."' AS rekap_bulan, 
	pegawai_nip, 
	pegawai_nama, 
	pegawai_gelar_depan, 
	pegawai_gelar_belakang, 
	pegawai_unit_id, 
	pegawai_unit_nama, 
	pegawai_jenkel_id, 
	pegawai_jenkel_nama, 
	pegawai_golongandarah_id, 
	pegawai_golongandarah_nama, 
	pegawai_agama_id, 
	pegawai_agama_nama, 
	pegawai_statusperkawinan_id, 
	pegawai_statusperkawinan_nama, 
	pegawai_status_kepegawaian_id, 
	pegawai_status_kepegawaian_nama, 
	pegawai_pangkat_terakhir_id, 
	pegawai_pangkat_terakhir_nama, 
	pegawai_pangkat_terakhir_golru, 
	pegawai_pendidikan_terakhir_id, 
	pegawai_pendidikan_terakhir_nama, 
	pegawai_pendidikan_terakhir_tingkat_id, 
	pegawai_pendidikan_terakhir_tingkat, 
	pegawai_jenisjabatan_kode, 
	pegawai_jenisjabatan_nama, 
	pegawai_jabatan_id, 
	pegawai_jabatan_nama, 
	pegawai_diklat_struktural_terakhir, 
	pegawai_diklat_struktural_terakhir_id, 
	pegawai_eselon_id, 
	pegawai_eselon_nama, 
	pegawai_status, 
	pegawai_status_description, 
	pegawai_keterangan
	 
	FROM 
	pegawai WHERE pegawai_status = '1' AND (pegawai_unit_id IS NOT NULL OR pegawai_unit_id <> '') AND date(insert_time) <= LAST_DAY(date('".$tahun."-".$bulan."-01'));";
        $this->db->query($query);
    }

    function data($tahun, $bulan,$status=2) {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['rekap_golru'] = $this->get_rekap_golru($data['tahun'], $data['bulan'],$status);
        $data['rekap_agama'] = $this->get_rekap_agama($data['tahun'], $data['bulan'],$status);
        $data['rekap_kelamin'] = $this->get_rekap_kelamin($data['tahun'], $data['bulan'],$status);
        $data['rekap_eselon'] = $this->get_rekap_eselon($data['tahun'], $data['bulan'],$status);
        $data['rekap_pendidikan'] = $this->get_rekap_pendidikan($data['tahun'], $data['bulan'],$status);
        $data['rekap_jabatan'] = $this->get_rekap_jabatan($data['tahun'], $data['bulan'],$status);
        $data['data_agama'] = $this->extract($data['rekap_agama'], 'agama');
        $data['data_golru'] = $this->extract($data['rekap_golru'], 'golru');
        $data['data_kelamin'] = $this->extract($data['rekap_kelamin'], 'jenis_kelamin');
        $data['data_eselon'] = $this->extract($data['rekap_eselon'], 'eselon');
        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        $data['data_jabatan'] = $this->extract($data['rekap_jabatan'], 'jenis_jabatan');
        return $data;
    }

    function extract($data, $key) {
        $array_key = array();
        $array_val = array();
        $array_laki = array();
        $array_perempuan = array();
        $max = 0;
        foreach ($data->result_array() as $value) {
            array_push($array_key, $value[$key]);
            array_push($array_val, $value['jumlah']);
            if (array_key_exists('laki', $value)) {
                array_push($array_laki, $value['laki']);
                array_push($array_perempuan, $value['perempuan']);
                if ($value['laki'] > $max) {
                    $max = $value['laki'];
                }
                if ($value['perempuan'] > $max) {
                    $max = $value['perempuan'];
                }
            } else {
                if ($value['jumlah'] > $max) {
                    $max = $value['jumlah'];
                }
            }
        }
        return array($array_key, $array_val, $max, $array_laki, $array_perempuan);
    }

    function update_rekap_agama($tahun,$bulan) {
        $query = "CALL sp_rekap_agama()";
        return $this->db->query($query);
    }

    function update_rekap_eselon($tahun,$bulan) {
        $query = "CALL sp_rekap_eselon('".$tahun."',".$bulan.")";
        return $this->db->query($query);
    }

    function update_rekap_golru($tahun,$bulan) {
        $query = "CALL sp_rekap_golru('".$tahun."',".$bulan.")";
        return $this->db->query($query);
    }

    function update_rekap_jabatan($tahun,$bulan) {
        $query = "CALL sp_rekap_jabatan('".$tahun."',".$bulan.")";
        return $this->db->query($query);
    }

    function update_rekap_jk($tahun,$bulan) {
        $query = "CALL sp_rekap_jk('".$tahun."',".$bulan.")";
        return $this->db->query($query);
    }

    function update_rekap_pendidikan($tahun,$bulan) {
        $query = "CALL sp_rekap_pendidikan('".$tahun."',".$bulan.")";
        return $this->db->query($query);
    }

    function get_tahun() {
        $query = "SELECT rekap_tahun AS tahun  FROM pegawai_rekap  GROUP BY rekap_tahun ORDER BY rekap_tahun DESC";
        return $this->db->query($query);
    }

    function get_bulan($tahun) {
        $query = "SELECT rekap_bulan AS bulan "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' "
                . "GROUP BY rekap_bulan order by rekap_bulan desc";
        return $this->db->query($query);
    }

    function get_rekap_golru($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_pangkat_terakhir_golru AS golru,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_pangkat_terakhir_golru ORDER BY pegawai_pangkat_terakhir_golru ASC";
//        echo $query;
        return $this->db->query($query);
    }

    function get_rekap_agama($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_agama_nama AS agama,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan ,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_agama_nama ORDER BY pegawai_agama_id";
        return $this->db->query($query);
    }

    function get_rekap_kelamin($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_jenkel_nama AS jenis_kelamin,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_jenkel_id";
        return $this->db->query($query);
    }

    function get_rekap_eselon($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_eselon_nama AS eselon,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_eselon_id > 0 and pegawai_eselon_id <> 99 and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_eselon_id";
        return $this->db->query($query);
    }

    function get_rekap_pendidikan($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_pendidikan_terakhir_tingkat AS pendidikan,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_pendidikan_terakhir_tingkat_id > 0 and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_pendidikan_terakhir_tingkat_id";
        return $this->db->query($query);
    }

    function get_rekap_jabatan($tahun = NULL, $bulan = NULL,$status=2) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_jenisjabatan_nama AS jenis_jabatan,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
                . "FROM pegawai_rekap "
                . "WHERE (rekap_tahun = '$tahun' and rekap_bulan = '$bulan') and pegawai_jenisjabatan_kode > 0 and pegawai_status_kepegawaian_id='$status' "
                . "GROUP BY pegawai_jenisjabatan_kode";
        return $this->db->query($query);
    }

    function rekap_golongan_status_pegawai_jenis_kelamin($tahun = NULL, $bulan = NULL) {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT * FROM (SELECT pegawai_pangkat_terakhir_golru AS golru,
SUM(IF(`pegawai_status_kepegawaian_id`=1,1,0)) AS cpns ,
SUM(IF(`pegawai_status_kepegawaian_id`=2,1,0)) AS pns ,
SUM(IF(pegawai_jenkel_id=1 AND `pegawai_status_kepegawaian_id`=1,1,0)) AS cpns_laki,
SUM(IF(pegawai_jenkel_id=2 AND `pegawai_status_kepegawaian_id`=1,1,0)) AS cpns_perempuan,
SUM(IF(pegawai_jenkel_id=1 AND `pegawai_status_kepegawaian_id`=2,1,0)) AS pns_laki,
SUM(IF(pegawai_jenkel_id=2 AND `pegawai_status_kepegawaian_id`=2,1,0)) AS pns_perempuan,
g.`pangkat_golongan_kode`,
pangkat_golongan_kode AS urut,
COUNT(pegawai_nip) AS jumlah FROM pegawai_rekap 
LEFT JOIN ref_pangkat_golongan g ON (pegawai_pangkat_terakhir_id = g.`pangkat_golongan_id`)
WHERE (rekap_tahun = '$tahun' AND rekap_bulan = '$bulan') AND pegawai_status = '1'
GROUP BY pegawai_pangkat_terakhir_golru
UNION
SELECT CONCAT('JUMLAH GOLONGAN ',REPLACE(REPLACE(REPLACE(REPLACE(pegawai_pangkat_terakhir_golru,'/a',' '),'/b',' '),'/c',' '),'/d',' ')) AS golru,
SUM(IF(`pegawai_status_kepegawaian_id`=1,1,0)) AS cpns ,
SUM(IF(`pegawai_status_kepegawaian_id`=2,1,0)) AS pns ,
SUM(IF(pegawai_jenkel_id=1 AND `pegawai_status_kepegawaian_id`=1,1,0)) AS cpns_laki,
SUM(IF(pegawai_jenkel_id=2 AND `pegawai_status_kepegawaian_id`=1,1,0)) AS cpns_perempuan,
SUM(IF(pegawai_jenkel_id=1 AND `pegawai_status_kepegawaian_id`=2,1,0)) AS pns_laki,
SUM(IF(pegawai_jenkel_id=2 AND `pegawai_status_kepegawaian_id`=2,1,0)) AS pns_perempuan,
g.`pangkat_golongan_kode`,
(pangkat_golongan_kode + 5) AS urut,
COUNT(pegawai_nip) AS jumlah FROM pegawai_rekap 
LEFT JOIN ref_pangkat_golongan g ON (pegawai_pangkat_terakhir_id = g.`pangkat_golongan_id`)
WHERE (rekap_tahun = '$tahun' AND rekap_bulan = '$bulan')   AND pegawai_status = '1'
GROUP BY LEFT(g.`pangkat_golongan_kode`,1)) a 
ORDER BY urut";
//        echo $query;
        return $this->db->query($query);
    }

    function rekap_golongan_ruang($tahun = NULL, $bulan = NULL) {
        $query = "SELECT pangkat_golongan_golongan AS golongan,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pangkat_golongan_ruang`='a',1,0)) AS a ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pangkat_golongan_ruang`='b',1,0)) AS b ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pangkat_golongan_ruang`='c',1,0)) AS c ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pangkat_golongan_ruang`='d',1,0)) AS d ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pangkat_golongan_ruang`='e',1,0)) AS e ,
COUNT(pegawai_nip) AS jumlah FROM pegawai_rekap 
LEFT JOIN ref_pangkat_golongan g ON (pegawai_pangkat_terakhir_id = g.`pangkat_golongan_id`)
WHERE rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
GROUP BY LEFT(pangkat_golongan_kode,1)";
        return $this->db->query($query);
    }

//     function rekap_jabatan_eselon($tahun = NULL, $bulan = NULL) {
//         $query = "SELECT
// p.`pegawai_eselon_nama`,
// SUM(IF(p.`pegawai_jenkel_id` = '1',1,0)) AS laki_eselon,
// SUM(IF(p.`pegawai_jenkel_id` = '2' ,1,0)) AS perempuan_eselon,
// (SELECT COUNT(r.unit_kode) FROM `ref_unit` r WHERE r.`unit_eselon` = p.pegawai_eselon_id GROUP BY r.unit_eselon) AS bezeting
// FROM pegawai_rekap p
// WHERE p.`pegawai_eselon_id` NOT IN ('99','') AND  rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
// GROUP BY p.`pegawai_eselon_id`";
//         return $this->db->query($query);
//     }


    function rekap_jabatan_eselon($tahun = NULL, $bulan = NULL) {
        $query = "SELECT
p.`pegawai_eselon_nama`,
SUM(IF(p.`pegawai_jenkel_id` = '1',1,0)) AS laki_eselon,
SUM(IF(p.`pegawai_jenkel_id` = '2' ,1,0)) AS perempuan_eselon,
(SELECT COUNT(r.jabatan_kode) FROM `ref_jabatan_struktural` r WHERE r.`jabatan_eselon_kode` = p.pegawai_eselon_id GROUP BY r.jabatan_eselon_kode) AS bezeting
FROM pegawai_rekap p
WHERE p.`pegawai_eselon_id` NOT IN ('99','') AND  rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
GROUP BY p.`pegawai_eselon_id`";
        return $this->db->query($query);
    }

    function rekap_cpns_pendidikan($tahun = NULL, $bulan = NULL, $status = 1) {
        $query = "SELECT t.`pendidikan_tingkat_nama` AS pendidikan,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('$status') AND `pegawai_jenkel_id` ='1',1,0)) AS laki ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('$status') AND `pegawai_jenkel_id` ='2',1,0)) AS perempuan ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('$status'),1,0)) AS jumlah ,
COUNT(pegawai_nip) AS total 
FROM pegawai_rekap 
LEFT JOIN `ref_pendidikan_tingkat` t ON (`pegawai_pendidikan_terakhir_tingkat_id` = t.`pendidikan_tingkat_kode`)
WHERE rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
GROUP BY t.`pendidikan_tingkat_kode`";
        return $this->db->query($query);
    }

    function rekap_pns_pendidikan($tahun = NULL, $bulan = NULL) {
        $query = "SELECT t.`pendidikan_tingkat_nama` AS pendidikan,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pegawai_jenkel_id` ='1',1,0)) AS laki ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2') AND `pegawai_jenkel_id` ='2',1,0)) AS perempuan ,
SUM(IF(`pegawai_status_kepegawaian_id` IN ('2'),1,0)) AS jumlah ,
COUNT(pegawai_nip) AS total 
FROM pegawai_rekap 
LEFT JOIN `ref_pendidikan_tingkat` t ON (`pegawai_pendidikan_terakhir_tingkat_id` = t.`pendidikan_tingkat_kode`)
WHERE rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
GROUP BY t.`pendidikan_tingkat_kode`";
        return $this->db->query($query);
    }

    function rekap_unit_golongan_eselon_jenis_kelamin($tahun = NULL, $bulan = NULL, $status = 2) {
        $query = "SELECT 
COALESCE(v.`unit_nama`,u.`unit_nama`) AS unit_nama,
COALESCE(v.`unit_id`,u.`unit_id`) AS unit_id,u.`unit_kpok`,
SUM(IF(p.`pegawai_status_kepegawaian_id` ='$status',1,0)) AS jumlah,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status',1,0)) AS laki,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status',1,0)) AS perempuan,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I',1,0)) AS laki_gol_1,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II',1,0)) AS laki_gol_2,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III',1,0)) AS laki_gol_3,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV',1,0)) AS laki_gol_4,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'a',1,0)) AS laki_gol_1a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'b',1,0)) AS laki_gol_1b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'c',1,0)) AS laki_gol_1c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'd',1,0)) AS laki_gol_1d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'a',1,0)) AS laki_gol_2a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'b',1,0)) AS laki_gol_2b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'c',1,0)) AS laki_gol_2c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'd',1,0)) AS laki_gol_2d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'a',1,0)) AS laki_gol_3a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'b',1,0)) AS laki_gol_3b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'c',1,0)) AS laki_gol_3c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'd',1,0)) AS laki_gol_3d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'a',1,0)) AS laki_gol_4a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'b',1,0)) AS laki_gol_4b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'c',1,0)) AS laki_gol_4c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'd',1,0)) AS laki_gol_4d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'a',1,0)) AS laki_gol_5a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'b',1,0)) AS laki_gol_5b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'c',1,0)) AS laki_gol_5c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'd',1,0)) AS laki_gol_5d,

SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I',1,0)) AS perempuan_gol_1,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II',1,0)) AS perempuan_gol_2,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III',1,0)) AS perempuan_gol_3,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV',1,0)) AS perempuan_gol_4,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'a',1,0)) AS perempuan_gol_1a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'b',1,0)) AS perempuan_gol_1b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'c',1,0)) AS perempuan_gol_1c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'I' AND g.pangkat_golongan_ruang = 'd',1,0)) AS perempuan_gol_1d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'a',1,0)) AS perempuan_gol_2a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'b',1,0)) AS perempuan_gol_2b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'c',1,0)) AS perempuan_gol_2c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'II' AND g.pangkat_golongan_ruang = 'd',1,0)) AS perempuan_gol_2d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'a',1,0)) AS perempuan_gol_3a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'b',1,0)) AS perempuan_gol_3b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'c',1,0)) AS perempuan_gol_3c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'III' AND g.pangkat_golongan_ruang = 'd',1,0)) AS perempuan_gol_3d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'a',1,0)) AS perempuan_gol_4a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'b',1,0)) AS perempuan_gol_4b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'c',1,0)) AS perempuan_gol_4c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'IV' AND g.pangkat_golongan_ruang = 'd',1,0)) AS perempuan_gol_4d,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'a',1,0)) AS perempuan_gol_5a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'b',1,0)) AS perempuan_gol_5b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'c',1,0)) AS perempuan_gol_5c,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND g.pangkat_golongan_golongan = 'V' AND g.pangkat_golongan_ruang = 'd',1,0)) AS perempuan_gol_5d,
    
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '21',1,0)) AS laki_eselon_2a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '22',1,0)) AS laki_eselon_2b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '31',1,0)) AS laki_eselon_3a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '32',1,0)) AS laki_eselon_3b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '41',1,0)) AS laki_eselon_4a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '42',1,0)) AS laki_eselon_4b,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '51',1,0)) AS laki_eselon_5a,
SUM(IF(p.`pegawai_jenkel_id` = '1' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '52',1,0)) AS laki_eselon_5b,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '21',1,0)) AS perempuan_eselon_2a,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '22',1,0)) AS perempuan_eselon_2b,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '31',1,0)) AS perempuan_eselon_3a,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '32',1,0)) AS perempuan_eselon_3b,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '41',1,0)) AS perempuan_eselon_4a,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '42',1,0)) AS perempuan_eselon_4b,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '51',1,0)) AS perempuan_eselon_5a,
SUM(IF(p.`pegawai_jenkel_id` = '2' AND p.`pegawai_status_kepegawaian_id` ='$status' AND p.`pegawai_eselon_id` = '52',1,0)) AS perempuan_eselon_5b
FROM pegawai_rekap p
INNER JOIN ref_unit u ON p.`pegawai_unit_id` = u.`unit_id`
LEFT JOIN v_unit_kerja v ON (u.`unit_kpok` = v.`unit_kpok`)
LEFT JOIN ref_pangkat_golongan g ON (p.pegawai_pangkat_terakhir_id = g.`pangkat_golongan_id`)
WHERE rekap_tahun = '$tahun' AND rekap_bulan = '$bulan' 
GROUP BY v.unit_nama
ORDER BY unit_id";
        return $this->db->query($query);
    }

    function rekap_pensiun() {
        $tahun = date('Y');
        $query = "select j.*,count(p.pegawai_nip) as jumlah ";
for($i=0;$i<5;$i++){
    $query .= ",sum(if(left(p.`pegawai_pensiun_tmt`,4)='".($tahun-$i)."',1,0)) as th_".($tahun-$i);
}
        $query .= " from `ref_jenis_pensiun` j 
left join pegawai p on (p.`pegawai_jenis_pensiun_id` = j.`jenis_pensiun_id`)
group by j.`jenis_pensiun_id`";
        return $this->db->query($query);
    }

}

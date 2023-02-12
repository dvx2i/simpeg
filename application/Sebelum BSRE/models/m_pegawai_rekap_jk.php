<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_jk
 *
 * @author Zanuar
 */
class M_pegawai_rekap_jk extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_rekap_jk');
        $this->_set_primary_key('rekap_id');
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }

    function data($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $jk)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['jk'] = $jk;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        if ($jenis == '1') { //jika rekap perbandingan
            $data['rekap_jk'] = $this->get_rekap_jk_perbandingan($data['tahun'], $data['bulan'], $unit, $periode);
            $data['rekap_jk_unit'] = $this->get_rekap_jk_perbandingan_unit($data['tahun'], $data['bulan'], $unit, $periode);
        }
        if ($jenis == '2') { //jika rekap perkembangan
            $data['rekap_jk'] = $this->get_rekap_jk_perkembangan($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $jk);
            $data['rekap_jk_unit'] = $this->get_rekap_jk_perkembangan_unit($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $jk);
        }


        $data['data_jk'] = $this->extract($data['rekap_jk'], 'jk');
        return $data;
    }

    function extract($data, $key)
    {
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

    function get_tahun()
    {
        $query = "SELECT tahun FROM pegawai_rekap_jk  GROUP BY tahun order by tahun desc";
        return $this->db->query($query);
    }

    function get_bulan($tahun)
    {
        $query = "SELECT bulan AS bulan "
            . "FROM pegawai_rekap_jk "
            . "WHERE tahun = '$tahun' "
            . "GROUP BY bulan order by bulan desc";
        return $this->db->query($query);
    }

    function get_unit()
    {
        $query = "SELECT unit_nama  "
            . "FROM ref_unit "
            . "WHERE unit_is_unit_kerja = '1' "
            . "order by unit_nama ASC";
        return $this->db->query($query);
    }

    function get_rekap_jk_perbandingan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if (empty($bulan)) {
                $bulan = $this->get_tahun($tahun)->result_array();
                $bulan = $bulan[0]['bulan'];
            }
            if ($unit == null) {
                $query = "SELECT jk,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_jk WHERE tahun = '$tahun' AND bulan = '$bulan'  
                    GROUP BY jk";
            } else {
                $query = "SELECT jk,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_jk WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan'  
                    GROUP BY jk";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if ($unit == null) {
                $query = "SELECT jk,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_jk WHERE tahun = '$tahun'  
                    GROUP BY jk,tahun";
            } else {
                $query = "SELECT jk,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_jk WHERE unit = '$unit' AND tahun = '$tahun'  
                    GROUP BY jk,tahun";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_jk_perbandingan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if (empty($bulan)) {
                $bulan = $this->get_tahun($tahun)->result_array();
                $bulan = $bulan[0]['bulan'];
            }
            if ($unit == null) {
                $query = "SELECT unit,jk,jumlah
                    FROM pegawai_rekap_jk WHERE tahun = '$tahun' AND bulan = '$bulan'  
                    GROUP BY jk,unit";
            } else {
                $query = "SELECT unit,jk,jumlah
                    FROM pegawai_rekap_jk WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan'  
                    GROUP BY jk,unit";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if ($unit == null) {
                $query = "SELECT unit,jk,jumlah
                    FROM pegawai_rekap_jk WHERE tahun = '$tahun' 
                    GROUP BY jk,unit,tahun";
            } else {
                $query = "SELECT unit,jk,jumlah
                    FROM pegawai_rekap_jk WHERE unit = '$unit' AND tahun = '$tahun' 
                    GROUP BY jk,unit,tahun";
            }
        }
        return $this->db->query($query);
    }

    function get_rekap_jk_perkembangan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $jk = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if (empty($bulan)) {
                $bulan = $this->get_tahun($tahun)->result_array();
                $bulan = $bulan[0]['bulan'];
            }
            if ($unit == null) {
                $query = "SELECT name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND jk = '$jk' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY bulan,jk";
            } else {
                $query = "SELECT name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND jk = '$jk' AND bulan BETWEEN $bulan AND $bulan2
                        GROUP BY bulan,jk";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if ($unit == null) {
                $query = "SELECT tahun as name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        WHERE jk = '$jk' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY tahun,jk";
            } else {
                $query = "SELECT tahun as name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        WHERE unit = '$unit' AND jk = '$jk' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY tahun,jk";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_jk_perkembangan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $jk = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if (empty($bulan)) {
                $bulan = $this->get_tahun($tahun)->result_array();
                $bulan = $bulan[0]['bulan'];
            }
            if ($unit == null) {
                $query = "SELECT unit,name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND jk = '$jk' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY unit,bulan,jk";
            } else {
                $query = "SELECT unit,name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND jk = '$jk' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY unit,bulan,jk";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = $this->get_tahun()->result_array();
                $tahun = $tahun[0]['tahun'];;
            }
            if ($unit == null) {
                $query = "SELECT unit,tahun as name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        WHERE jk = '$jk' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY unit,tahun,jk";
            } else {
                $query = "SELECT unit,tahun as name,jk,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_jk 
                        WHERE unit = '$unit' AND jk = '$jk' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY unit,tahun,jk";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_kelamin($tahun = NULL, $bulan = NULL, $status = 2)
    {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_jenkel_nama AS jenis_kelamin,COUNT(pegawai_nip) AS jumlah "
            . "FROM pegawai_rekap "
            . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan'  "
            . "GROUP BY pegawai_jenkel_id";
        return $this->db->query($query);
    }
}

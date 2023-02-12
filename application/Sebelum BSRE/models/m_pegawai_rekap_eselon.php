<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_eselon
 *
 * @author Zanuar
 */
class M_pegawai_rekap_eselon extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_rekap_eselon');
        $this->_set_primary_key('rekap_id');
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }

    function data($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $eselon)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['eselon'] = $eselon;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_eselon'] = $this->get_eselon();
        if ($jenis == '1') { //jika rekap perbandingan
            $data['rekap_eselon'] = $this->get_rekap_eselon_perbandingan($data['tahun'], $data['bulan'], $unit, $periode);
            $data['rekap_eselon_unit'] = $this->get_rekap_eselon_perbandingan_unit($data['tahun'], $data['bulan'], $unit, $periode);
        }
        if ($jenis == '2') { //jika rekap perkembangan
            $data['rekap_eselon'] = $this->get_rekap_eselon_perkembangan($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $eselon);
            $data['rekap_eselon_unit'] = $this->get_rekap_eselon_perkembangan_unit($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $eselon);
        }


        $data['data_eselon'] = $this->extract($data['rekap_eselon'], 'eselon');
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
        $query = "SELECT tahun FROM pegawai_rekap_eselon  GROUP BY tahun order by tahun desc";
        return $this->db->query($query);
    }

    function get_bulan($tahun)
    {
        $query = "SELECT bulan AS bulan "
            . "FROM pegawai_rekap_eselon "
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

    function get_eselon()
    {
        $query = "SELECT eselon_nama  AS eselon "
            . "FROM ref_eselon "
            . "WHERE eselon_kode > 0 AND eselon_kode <> 99 "
            . "order by eselon_nama ASC";
        return $this->db->query($query);
    }

    function get_rekap_eselon($tahun = NULL, $bulan = NULL, $status = 2)
    {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_pangkat_terakhir_eselon AS eselon,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
            . "FROM pegawai_rekap "
            . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
            . "GROUP BY pegawai_pangkat_terakhir_eselon";
        //        echo $query;
        return $this->db->query($query);
    }

    function get_rekap_eselon_perbandingan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_eselon WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY eselon";
            } else {
                $query = "SELECT eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_eselon WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY eselon";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_eselon WHERE tahun = '$tahun'  AND status_kepegawaian = '2'
                    GROUP BY eselon,tahun";
            } else {
                $query = "SELECT eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_eselon WHERE unit = '$unit' AND tahun = '$tahun'  AND status_kepegawaian = '2'
                    GROUP BY eselon,tahun";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_eselon_perbandingan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,eselon,laki , perempuan ,jumlah
                    FROM pegawai_rekap_eselon WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY eselon,unit";
            } else {
                $query = "SELECT unit,eselon,laki , perempuan ,jumlah
                    FROM pegawai_rekap_eselon WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY eselon,unit";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT unit,eselon,laki , perempuan ,jumlah
                    FROM pegawai_rekap_eselon WHERE tahun = '$tahun' AND status_kepegawaian = '2'
                    GROUP BY eselon,unit,tahun";
            } else {
                $query = "SELECT unit,eselon,laki , perempuan ,jumlah
                    FROM pegawai_rekap_eselon WHERE unit = '$unit' AND tahun = '$tahun' AND status_kepegawaian = '2'
                    GROUP BY eselon,unit,tahun";
            }
        }
        return $this->db->query($query);
    }

    function get_rekap_eselon_perkembangan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $eselon = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND eselon = '$eselon' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY bulan,eselon";
            } else {
                $query = "SELECT name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND eselon = '$eselon' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY bulan,eselon";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT tahun as name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        WHERE eselon = '$eselon' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY tahun,eselon";
            } else {
                $query = "SELECT tahun as name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        WHERE unit = '$unit' AND eselon = '$eselon' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY tahun,eselon";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_eselon_perkembangan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $eselon = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND eselon = '$eselon' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY unit,bulan,eselon";
            } else {
                $query = "SELECT unit,name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND eselon = '$eselon' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY unit,bulan,eselon";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT unit,tahun as name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        WHERE eselon = '$eselon' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY unit,tahun,eselon";
            } else {
                $query = "SELECT unit,tahun as name,eselon,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_eselon 
                        WHERE unit = '$unit' AND eselon = '$eselon' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY unit,tahun,eselon";
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
            . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
            . "GROUP BY pegawai_jenkel_id";
        return $this->db->query($query);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pendidikan
 *
 * @author Zanuar
 */
class M_pegawai_rekap_pendidikan extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_rekap_pendidikan');
        $this->_set_primary_key('rekap_id');
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }

    function data($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $pendidikan)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['pendidikan'] = $pendidikan;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_pendidikan'] = $this->get_pendidikan();
        if ($jenis == '1') { //jika rekap perbandingan
            $data['rekap_pendidikan'] = $this->get_rekap_pendidikan_perbandingan($data['tahun'], $data['bulan'], $unit, $periode);
            $data['rekap_pendidikan_unit'] = $this->get_rekap_pendidikan_perbandingan_unit($data['tahun'], $data['bulan'], $unit, $periode);
        }
        if ($jenis == '2') { //jika rekap perkembangan
            $data['rekap_pendidikan'] = $this->get_rekap_pendidikan_perkembangan($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $pendidikan);
            $data['rekap_pendidikan_unit'] = $this->get_rekap_pendidikan_perkembangan_unit($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $pendidikan);
        }


        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        return $data;
    }

    function data_cpns($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $pendidikan)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['pendidikan'] = $pendidikan;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_pendidikan'] = $this->get_pendidikan();

        $data['rekap_pendidikan'] = $this->get_rekap_pendidikan_cpns($data['tahun'], $data['bulan'], $unit, $periode);
        $data['rekap_pendidikan_unit'] = $this->get_rekap_pendidikan_cpns_unit($data['tahun'], $data['bulan'], $unit, $periode);
       


        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        return $data;
    }
    
    function data_pns($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $pendidikan)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['pendidikan'] = $pendidikan;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_pendidikan'] = $this->get_pendidikan();

        $data['rekap_pendidikan'] = $this->get_rekap_pendidikan_pns($data['tahun'], $data['bulan'], $unit, $periode);
        $data['rekap_pendidikan_unit'] = $this->get_rekap_pendidikan_pns_unit($data['tahun'], $data['bulan'], $unit, $periode);
       


        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
        return $data;
    }

    function data_pppk($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $pendidikan)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['pendidikan'] = $pendidikan;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_pendidikan'] = $this->get_pendidikan();

        $data['rekap_pendidikan'] = $this->get_rekap_pendidikan_pppk($data['tahun'], $data['bulan'], $unit, $periode);
        $data['rekap_pendidikan_unit'] = $this->get_rekap_pendidikan_pppk_unit($data['tahun'], $data['bulan'], $unit, $periode);
       


        $data['data_pendidikan'] = $this->extract($data['rekap_pendidikan'], 'pendidikan');
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
        $query = "SELECT tahun FROM pegawai_rekap_pendidikan  GROUP BY tahun order by tahun desc";
        return $this->db->query($query);
    }

    function get_bulan($tahun)
    {
        $query = "SELECT bulan AS bulan "
            . "FROM pegawai_rekap_pendidikan "
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

    function get_pendidikan()
    {
        $query = "SELECT pendidikan_tingkat_nama AS pendidikan  "
            . "FROM ref_pendidikan_tingkat "
            . "order by pendidikan_tingkat_nama ASC";
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_perbandingan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_pendidikan LEFT JOIN ref_pendidikan_tingkat ON pendidikan = pendidikan_tingkat_nama
                    WHERE tahun = '$tahun' AND bulan = '$bulan' 
                    GROUP BY pendidikan ORDER BY pendidikan_tingkat_id ASC";
            } else {
                $query = "SELECT pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_pendidikan LEFT JOIN ref_pendidikan_tingkat ON pendidikan = pendidikan_tingkat_nama
                    WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan'
                    GROUP BY pendidikan ORDER BY pendidikan_tingkat_id ASC";
            }
        
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_perbandingan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE tahun = '$tahun' AND bulan = '$bulan' 
                    GROUP BY pendidikan,unit";
            } else {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' 
                    GROUP BY pendidikan,unit";
            }
        
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_perkembangan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $pendidikan = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND pendidikan = '$pendidikan' AND bulan BETWEEN $bulan AND $bulan2
                        GROUP BY bulan,pendidikan";
            } else {
                $query = "SELECT name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND pendidikan = '$pendidikan' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY bulan,pendidikan";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT tahun as name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        WHERE pendidikan = '$pendidikan' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY tahun,pendidikan";
            } else {
                $query = "SELECT tahun as name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        WHERE unit = '$unit' AND pendidikan = '$pendidikan' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY tahun,pendidikan";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_perkembangan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $pendidikan = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND pendidikan = '$pendidikan' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY unit,bulan,pendidikan";
            } else {
                $query = "SELECT unit,name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND pendidikan = '$pendidikan' AND bulan BETWEEN $bulan AND $bulan2 
                        GROUP BY unit,bulan,pendidikan";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT unit,tahun as name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        WHERE pendidikan = '$pendidikan' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY unit,tahun,pendidikan";
            } else {
                $query = "SELECT unit,tahun as name,pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_pendidikan 
                        WHERE unit = '$unit' AND pendidikan = '$pendidikan' AND tahun BETWEEN $tahun AND $tahun2 
                        GROUP BY unit,tahun,pendidikan";
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
            . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' "
            . "GROUP BY pegawai_jenkel_id";
        return $this->db->query($query);
    }
    
    function get_rekap_pendidikan_cpns($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            
            $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
            FROM ref_pendidikan_tingkat a
            LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND  unit = '$unit' AND  tahun = '$tahun' AND bulan = '$bulan' 
            AND b.status_kepegawaian = '1'
            GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";

            if ($unit == null) {
                $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
                    FROM ref_pendidikan_tingkat a
                    LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND tahun = '$tahun' AND bulan = '$bulan' 
                    AND b.status_kepegawaian = '1'
                    GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";
            } 
        
        // print_r($query);p
        // die;
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_cpns_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '1'
                    GROUP BY pendidikan,unit";
            } else {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '1'
                    GROUP BY pendidikan,unit";
            }
        
        return $this->db->query($query);
    }

    
    function get_rekap_pendidikan_pns($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            
            $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
            FROM ref_pendidikan_tingkat a
            LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND  unit = '$unit' AND  tahun = '$tahun' AND bulan = '$bulan' 
            AND b.status_kepegawaian = '2'
            GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";

            if ($unit == null) {
                $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
                    FROM ref_pendidikan_tingkat a
                    LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND tahun = '$tahun' AND bulan = '$bulan' 
                    AND b.status_kepegawaian = '2'
                    GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";
            } 
        
        // print_r($query);p
        // die;
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_pns_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY pendidikan,unit";
            } else {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY pendidikan,unit";
            }
        
        return $this->db->query($query);
    }
    
    function get_rekap_pendidikan_pppk($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            
            $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
            FROM ref_pendidikan_tingkat a
            LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND  unit = '$unit' AND  tahun = '$tahun' AND bulan = '$bulan' 
            AND b.status_kepegawaian = '8'
            GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";

            if ($unit == null) {
                $query = "SELECT pendidikan_tingkat_nama AS pendidikan,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(IFNULL(jumlah,0)) AS jumlah
                    FROM ref_pendidikan_tingkat a
                    LEFT JOIN pegawai_rekap_pendidikan b ON a.pendidikan_tingkat_nama = b.pendidikan AND tahun = '$tahun' AND bulan = '$bulan' 
                    AND b.status_kepegawaian = '8'
                    GROUP BY pendidikan_tingkat_id ORDER BY pendidikan_tingkat_id ASC";
            } 
        
        // print_r($query);p
        // die;
        return $this->db->query($query);
    }

    function get_rekap_pendidikan_pppk_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '8'
                    GROUP BY pendidikan,unit";
            } else {
                $query = "SELECT unit,pendidikan,laki , perempuan ,jumlah
                    FROM pegawai_rekap_pendidikan WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '8'
                    GROUP BY pendidikan,unit";
            }
        
        return $this->db->query($query);
    }
}

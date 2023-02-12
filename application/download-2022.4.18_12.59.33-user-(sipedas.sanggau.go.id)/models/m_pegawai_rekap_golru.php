<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_golru
 *
 * @author Zanuar
 */
class M_pegawai_rekap_golru extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai_rekap_golru');
        $this->_set_primary_key('rekap_id');
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }

    function data($tahun, $bulan, $unit, $jenis, $periode, $tahun2, $bulan2, $golru)
    {
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['unit'] = $unit;
        $data['golru'] = $golru;
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['list_tahun'] = $this->get_tahun();
        $data['list_bulan'] = $this->get_bulan($data['tahun']);
        $data['list_unit'] = $this->get_unit();
        $data['list_golru'] = $this->get_golru();
        if ($jenis == '1') { //jika rekap perbandingan
            $data['rekap_golru'] = $this->get_rekap_golru_perbandingan($data['tahun'], $data['bulan'], $unit, $periode);
            $data['rekap_golru_unit'] = $this->get_rekap_golru_perbandingan_unit($data['tahun'], $data['bulan'], $unit, $periode);
        }
        if ($jenis == '2') { //jika rekap perkembangan
            $data['rekap_golru'] = $this->get_rekap_golru_perkembangan($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $golru);
            $data['rekap_golru_unit'] = $this->get_rekap_golru_perkembangan_unit($data['tahun'], $data['bulan'], $unit, $periode, $tahun2, $bulan2, $golru);
        }


        $data['data_golru'] = $this->extract($data['rekap_golru'], 'golru');
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
        $query = "SELECT tahun FROM pegawai_rekap_golru  GROUP BY tahun order by tahun desc";
        return $this->db->query($query);
    }

    function get_bulan($tahun)
    {
        $query = "SELECT bulan AS bulan "
            . "FROM pegawai_rekap_golru "
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

    function get_golru()
    {
        $query = "SELECT golru  "
            . "FROM pegawai_rekap_golru "
            . "group by golru order by golru ASC";
        return $this->db->query($query);
    }

    function get_rekap_golru($tahun = NULL, $bulan = NULL, $status = 2)
    {
        if (empty($tahun)) {
            $tahun = date('Y');
        }
        if (empty($bulan)) {
            $bulan = date('m');
        }
        $query = "SELECT pegawai_pangkat_terakhir_golru AS golru,SUM(IF(pegawai_jenkel_id=1,1,0)) AS laki ,SUM(IF(pegawai_jenkel_id=2,1,0)) AS perempuan,COUNT(pegawai_nip) AS jumlah "
            . "FROM pegawai_rekap "
            . "WHERE rekap_tahun = '$tahun' and rekap_bulan = '$bulan' and pegawai_status_kepegawaian_id='$status' "
            . "GROUP BY pegawai_pangkat_terakhir_golru";
        //        echo $query;
        return $this->db->query($query);
    }

    function get_rekap_golru_perbandingan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_golru WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2' 
                    GROUP BY golru";
            } else {
                $query = "SELECT golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_golru WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY golru";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_golru WHERE tahun = '$tahun'  AND status_kepegawaian = '2'
                    GROUP BY golru,tahun";
            } else {
                $query = "SELECT golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                    FROM pegawai_rekap_golru WHERE unit = '$unit' AND tahun = '$tahun'  AND status_kepegawaian = '2'
                    GROUP BY golru,tahun";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_golru_perbandingan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,golru,laki , perempuan ,jumlah
                    FROM pegawai_rekap_golru WHERE tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY golru,unit";
            } else {
                $query = "SELECT unit,golru,laki , perempuan ,jumlah
                    FROM pegawai_rekap_golru WHERE unit = '$unit' AND tahun = '$tahun' AND bulan = '$bulan' AND status_kepegawaian = '2'
                    GROUP BY golru,unit";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT unit,golru,laki , perempuan ,jumlah
                    FROM pegawai_rekap_golru WHERE tahun = '$tahun' AND status_kepegawaian = '2'
                    GROUP BY golru,unit,tahun";
            } else {
                $query = "SELECT unit,golru,laki , perempuan ,jumlah
                    FROM pegawai_rekap_golru WHERE unit = '$unit' AND tahun = '$tahun' AND status_kepegawaian = '2'
                    GROUP BY golru,unit,tahun";
            }
        }
        return $this->db->query($query);
    }

    function get_rekap_golru_perkembangan($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $golru = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND golru = '$golru' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY bulan,golru";
            } else {
                $query = "SELECT name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND golru = '$golru' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY bulan,golru";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT tahun as name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        WHERE golru = '$golru' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY tahun,golru";
            } else {
                $query = "SELECT tahun as name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        WHERE unit = '$unit' AND golru = '$golru' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY tahun,golru";
            }
        }
        // print_r($query);
        // die;
        return $this->db->query($query);
    }

    function get_rekap_golru_perkembangan_unit($tahun = NULL, $bulan = NULL, $unit = NULL, $periode = NULL, $tahun2 = NULL, $bulan2 = NULL, $golru = NULL)
    {
        if ($periode == 'bulan') {
            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if (empty($bulan)) {
                $bulan = date('m');
            }
            if ($unit == null) {
                $query = "SELECT unit,name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE tahun = '$tahun' AND golru = '$golru' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY unit,bulan,golru";
            } else {
                $query = "SELECT unit,name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        LEFT JOIN tbl_month ON bulan = tbl_month.id
                        WHERE unit = '$unit' AND tahun = '$tahun' AND golru = '$golru' AND bulan BETWEEN $bulan AND $bulan2 AND status_kepegawaian = '2'
                        GROUP BY unit,bulan,golru";
            }
        }
        if ($periode == 'tahun') {

            if (empty($tahun)) {
                $tahun = date('Y');
            }
            if ($unit == null) {
                $query = "SELECT unit,tahun as name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        WHERE golru = '$golru' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY unit,tahun,golru";
            } else {
                $query = "SELECT unit,tahun as name,golru,SUM(IFNULL(laki,0)) AS laki ,SUM(IFNULL(perempuan,0))  AS perempuan ,SUM(jumlah) AS jumlah
                        FROM pegawai_rekap_golru 
                        WHERE unit = '$unit' AND golru = '$golru' AND tahun BETWEEN $tahun AND $tahun2 AND status_kepegawaian = '2'
                        GROUP BY unit,tahun,golru";
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

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
class M_laporan extends MY_Model
{

    public function __construct()
    {
        $this->_set_table('pegawai');
        $this->_set_primary_key('pegawai_nip');
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }

    function get_daftar_nominatif_pegawai($where)
    {
        $this->db->select("pegawai_nip as 'NIP',pegawai_nama as 'NAMA'");
        $this->db->where($where);
        return $this->db->get('pegawai');
    }
    
    function get_daftar_nominatif_pegawai_excel($kolom)
    {
        $sql = 'SELECT ';
        $numItems = count($kolom); //untuk cek total array dan dipakai untuk cari array terakhir (select terakhir no separator)
        $i = 0;

        foreach ($kolom as $kol) {
            $coma = ', ';

            if (++$i === $numItems) {
                $coma = ' ';
            }

            if($kol['value'] == 'pegawai_alamat'){
                $sql .= ' pegawai_alamat, pegawai_rt, pegawai_rw, pegawai_kecamatan_nama ' . $coma;
            }
            if($kol['value'] == 'pegawai_nama'){
                $sql .= ' pegawai_gelar_depan, pegawai_gelar_belakang, pegawai_nama ' . $coma;
            }
            else{
                $sql .= ' ' . $kol['value'] . $coma;
            }

        }

        $sql .= ' FROM pegawai ';


        $where = ' WHERE pegawai_status = "1" ';
        
        if (!empty($this->input->post('pegawai_unit_id'))) {
            $where .= ' AND pegawai_unit_id = '.$this->input->post('pegawai_unit_id');
        }
        if (!empty($this->input->post('pegawai_jenkel_id'))) {
            $where .= ' AND pegawai_jenkel_id = '. $this->input->post('pegawai_jenkel_id');
        }
        if (!empty($this->input->post('pegawai_pangkat_terakhir_id'))) {
            $where .= ' AND pegawai_pangkat_terakhir_id = '. $this->input->post('pegawai_pangkat_terakhir_id');
        }
        if (!empty($this->input->post('pegawai_pendidikan_terakhir_tingkat'))) {
            $where .= ' AND pegawai_pendidikan_terakhir_tingkat = "'. $this->input->post('pegawai_pendidikan_terakhir_tingkat').'" ';
        }
        if (!empty($this->input->post('pegawai_jenisjabatan_kode'))) {
            $where .= ' AND pegawai_jenisjabatan_kode = "'. $this->input->post('pegawai_jenisjabatan_kode').'" ';
        }
        if (!empty($this->input->post('pegawai_eselon_id'))) {
            $where .= ' AND pegawai_eselon_id = '. $this->input->post('pegawai_eselon_id');
        }

        $sql = $sql.$where;

        return $this->db->query($sql)->result_array();
    }

    function get_kolom_pegawai()
    {
        $this->db->select("id,kolom,nama");
        return $this->db->get('pegawai_laporan_kolom')->result();
    }

    function get_masa_kerja_keseluruhan($where = NULL)
    {
        $query = "SELECT
    pegawai_nip as NIP
    , pegawai_nama as NAMA
    , pegawai_cpns_tmt as CPNS_TMT
    ,FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_cpns_tmt`, NOW())/12) AS MK_TAHUN
        ,FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_cpns_tmt`, NOW())%12) AS MK_BULAN
    , pegawai_unit_nama as UNIT_KERJA
    , pegawai_jenisjabatan_nama as JENIS_JABATAN
    , pegawai_jabatan_nama as JABATAN
    , pegawai_pangkat_terakhir_nama as PANGKAT
    , pegawai_pangkat_terakhir_golru as GOLONGAN_RUANG
FROM
    pegawai ";
        if (!empty($where)) {
            $query .= "where " . $where;
        }
        return $this->db->query($query);
    }

    function get_pegawai_satya_lancana($where)
    {
        $query = "SELECT
    pegawai.*,pegawai_tanda_jasa.*
    ,COALESCE(FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_cpns_tmt`, NOW())/12),pegawai_pangkat_terakhir_tahun) AS MK_TAHUN
        ,COALESCE(FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_cpns_tmt`, NOW())%12),pegawai_pangkat_terakhir_bulan) AS MK_BULAN,
        FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_tgl_lahir`, NOW())/12) AS USIA_TAHUN,
        FLOOR(TIMESTAMPDIFF(MONTH, `pegawai_tgl_lahir`, NOW())%12) AS USIA_BULAN
FROM
    pegawai
    LEFT JOIN pegawai_tanda_jasa ON pegawai.pegawai_nip = pegawai_tanda_jasa.pegawaijasa_pegawai_nip
     where pegawai_status = '1' ";
        if (!empty($where['pegawai_unit_id'])) {
            $query .= " AND pegawai_unit_id = " . $where['pegawai_unit_id'];
        }
        if (!empty($where['pegawaijasa_tahun'])) {
            $query .= " AND pegawaijasa_tahun = " . $where['pegawaijasa_tahun'];
        }
        return $this->db->query($query);
    }

    function get_pegawai_diklat_pim($where)
    {
        $wheresubq = "";
        if (!empty($where['tahun'])) {
            $wheresubq .= " AND YEAR(diklat_sttpl_tanggal) = '" . $where['tahun']."' ";
        }
        
        if (!empty($where['diklat_struktural_kode'])) {
            $wheresubq .= " AND diklat_kode = '" . $where['diklat_struktural_kode']."' ";
        }

        $query = "SELECT * FROM (SELECT
    p.*,diklat_struktural_nama,(SELECT COUNT(*) FROM pegawai_diklat WHERE diklat_jenis = 'STRUKTURAL' AND diklat_pegawai_nip = p.pegawai_nip ".$wheresubq.") as jumlah
    FROM
    pegawai p
    LEFT JOIN ref_diklat_struktural r ON r.diklat_struktural_kode = '" . $where['diklat_struktural_kode']."' 
    WHERE pegawai_status = '1') q 
    WHERE q.jumlah > 0 ";
        return $this->db->query($query);
    }

    function get_pensiun()
    {
        $query = "SELECT `pegawai`.`pegawai_nip` AS `NIP`,`pegawai`.`pegawai_nama` AS `NAMA`,`pegawai`.`pegawai_propinsi_nama` AS `PROPINSI`,`pegawai`.`pegawai_kabupaten_nama` AS `KABUPATEN`,`pegawai`.`pegawai_kecamatan_nama` AS `KECAMATAN`,`pegawai`.`pegawai_kelurahan_nama` AS `KELURAHAN`,`pegawai`.`pegawai_unit_nama` AS `UNIT_KERJA`,`pegawai`.`pegawai_nip_lama` AS `NIP_LAMA`,`pegawai`.`pegawai_tempat_lahir` AS `TEMPAT_LAHIR`,`pegawai`.`pegawai_tgl_lahir` AS `TGL_LAHIR`,`pegawai`.`pegawai_jenkel_nama` AS `JENIS_KELAMIN`,`pegawai`.`pegawai_golongandarah_nama` AS `GOL._DARAH`,`pegawai`.`pegawai_agama_nama` AS `AGAMA`,`pegawai`.`pegawai_statusperkawinan_nama` AS `PERKAWINAN`,`pegawai`.`pegawai_alamat` AS `ALAMAT`,`pegawai`.`pegawai_rw` AS `RW`,`pegawai`.`pegawai_rt` AS `RT`,`pegawai`.`pegawai_kodepos` AS `KODEPOS`,`pegawai`.`pegawai_telpon` AS `TELP`,`pegawai`.`pegawai_hp` AS `HP`,`pegawai`.`pegawai_email` AS `EMAIL`,`pegawai`.`pegawai_status_kepegawaian_nama` AS `STATUS`,`pegawai`.`pegawai_no_karpeg` AS `KARPEG`,`pegawai`.`pegawai_no_askes` AS `ASKES`,`pegawai`.`pegawai_no_taspen` AS `TASPEN`,`pegawai`.`pegawai_no_karis` AS `KARIS/KARSU`,`pegawai`.`pegawai_no_npwp` AS `NPWP`,`pegawai`.`pegawai_no_kk` AS `KK`,`pegawai`.`pegawai_no_ktp` AS `KTP`,`pegawai`.`pegawai_pangkat_terakhir_nama` AS `PANGKAT`,`pegawai`.`pegawai_pangkat_terakhir_golru` AS `GOLRU`,`pegawai`.`pegawai_pendidikan_terakhir_tingkat` AS `TINGKAT_PENDIDIKAN`,`pegawai`.`pegawai_jenisjabatan_nama` AS `JENIS_JABATAN`,`pegawai`.`pegawai_jabatan_nama` AS `JABATAN`,`pegawai`.`pegawai_diklat_struktural_terakhir` AS `DIKLATPIM`,`pegawai`.`pegawai_eselon_nama` AS `ESELON`,`pegawai`.`pegawai_gaji` AS `GAJI` FROM `pegawai` WHERE (`pegawai`.`pegawai_status` = '0')";
        return $this->db->query($query);
    }

    function get_daftar_pendidikan()
    {
        $query = "SELECT pegawai_pendidikan_terakhir_tingkat as PENDIDIKAN,COUNT(pegawai_nip) as JUMLAH FROM pegawai GROUP BY pegawai.pegawai_pendidikan_terakhir_tingkat
ORDER BY pegawai_pendidikan_terakhir_tingkat_id";
        return $this->db->query($query);
    }

    function get_daftar_jenis_guru()
    {
        $query = "SELECT pegawai_jabatan_jenis_guru_nama as JENIS_GURU,COUNT(pegawai_nip) as JUMLAH FROM pegawai 
WHERE pegawai_jabatan_jenis_guru_id !='' AND pegawai_jabatan_jenis_guru_id <> 1
GROUP BY pegawai.pegawai_jabatan_jenis_guru_id
ORDER BY pegawai_jabatan_jenis_guru_id";
        return $this->db->query($query);
    }

    function get_daftar_jabatan()
    {
        $query = "SELECT pegawai_jabatan_nama as JABATAN,pegawai_jenisjabatan_nama as JENIS_JABATAN,COUNT(pegawai_nip) as JUMLAH FROM pegawai 
WHERE pegawai_jabatan_nama !='' 
GROUP BY pegawai.pegawai_jabatan_nama
ORDER BY pegawai_jenisjabatan_kode";
        return $this->db->query($query);
    }

    function get_penjagaan_pensiun()
    {
        $query = "SELECT
    pegawai.pegawai_nip AS NIP
    , pegawai.pegawai_nama AS NAMA
    , pegawai.pegawai_jenisjabatan_nama AS JENIS_JABATAN
    , pegawai.pegawai_eselon_nama AS ESELON
    , pegawai.pegawai_tgl_lahir AS TGL_LAHIR
    ,FLOOR(TIMESTAMPDIFF(MONTH, pegawai.pegawai_tgl_lahir, NOW())/12) AS USIA
    , COALESCE(ref_jabatan_fungsional.jabatan_usia_pensiun,ref_eselon.eselon_usia_pensiun) AS BUP 
FROM
    pegawai
    LEFT JOIN ref_jabatan_fungsional 
        ON (pegawai.pegawai_jabatan_id = ref_jabatan_fungsional.jabatan_id)
    LEFT JOIN ref_eselon 
        ON (pegawai.pegawai_eselon_id = ref_eselon.eselon_kode)
        WHERE (COALESCE(ref_jabatan_fungsional.jabatan_usia_pensiun,ref_eselon.eselon_usia_pensiun) - FLOOR(TIMESTAMPDIFF(MONTH, pegawai.pegawai_tgl_lahir, NOW())/12)) <=0
AND pegawai.pegawai_status = 1        
ORDER BY (BUP - USIA)";
        return $this->db->query($query);
    }

    function get_penjagaan_kenaikan_pangkat()
    {
        $query = "SELECT
    pegawai.pegawai_nip AS NIP
    , pegawai.pegawai_nama AS NAMA
    , pegawai.pegawai_jenisjabatan_nama AS JENIS_JABATAN
    , pegawai.pegawai_eselon_nama AS ESELON
    , pegawai.pegawai_pendidikan_terakhir_tingkat AS PENDIDIKAN
    , pegawai_pangkat_terakhir_tmt AS PANGKAT_TERAKHIR_TMT
    , FLOOR(TIMESTAMPDIFF(MONTH, pegawai_pangkat_terakhir_tmt, NOW())/12) AS SELISIH_TAHUN_TMT
FROM
    pegawai
    LEFT JOIN ref_jabatan_fungsional 
        ON (pegawai.pegawai_jabatan_id = ref_jabatan_fungsional.jabatan_id)
    LEFT JOIN ref_eselon 
        ON (pegawai.pegawai_eselon_id = ref_eselon.eselon_kode)
        WHERE pegawai.pegawai_status = '1' AND FLOOR(TIMESTAMPDIFF(MONTH, pegawai_pangkat_terakhir_tmt, NOW())/12) >= 4
        ORDER BY SELISIH_TAHUN_TMT DESC";
        return $this->db->query($query);
    }

    function get_penjagaan_kgb()
    {
        $query = "SELECT
    pegawai.pegawai_nip AS NIP
    , pegawai.pegawai_nama AS NAMA
    , pegawai.pegawai_jenisjabatan_nama AS JENIS_JABATAN
    , pegawai.pegawai_eselon_nama AS ESELON
    , pegawai.pegawai_pendidikan_terakhir_tingkat AS PENDIDIKAN
    , pegawai_kgb_terakhir_tmt AS KGB_TERAKHIR_TMT
    , FLOOR(TIMESTAMPDIFF(MONTH, pegawai_kgb_terakhir_tmt, NOW())/12) AS SELISIH_TAHUN_TMT
FROM
    pegawai
    LEFT JOIN ref_jabatan_fungsional 
        ON (pegawai.pegawai_jabatan_id = ref_jabatan_fungsional.jabatan_id)
    LEFT JOIN ref_eselon 
        ON (pegawai.pegawai_eselon_id = ref_eselon.eselon_kode)
        WHERE pegawai.pegawai_status = '1' AND FLOOR(TIMESTAMPDIFF(MONTH, pegawai_kgb_terakhir_tmt, NOW())/12) >= 2
        ORDER BY SELISIH_TAHUN_TMT DESC";
        return $this->db->query($query);
    }

    function get_daftar_urut_kepangkatan($unit_id)
    {
        $query = 'SELECT * FROM (SELECT `pegawai`.*,FLOOR(((DATE_FORMAT(NOW(),"%Y")-DATE_FORMAT(pegawai_cpns_tmt,"%Y"))*12+(DATE_FORMAT(NOW(),"%m")-DATE_FORMAT(pegawai_cpns_tmt,"%m")))/12) Tahun , 
				  MOD((DATE_FORMAT(NOW(),"%Y")-DATE_FORMAT(pegawai_cpns_tmt,"%Y"))*12+(DATE_FORMAT(NOW(),"%m")-DATE_FORMAT(pegawai_cpns_tmt,"%m")),12) Bulan FROM `pegawai` WHERE `pegawai_unit_id` = "'.$unit_id.'" AND pegawai_status = "1" ) t
                  ORDER BY `pegawai_pangkat_terakhir_golru` DESC,`pegawai_jabatan_id` ASC, `Tahun` DESC ';
        return $this->db->query($query);
    }

    function daftar_nominatif_pensiun($tahun, $bulan,$jenis)
    {
        $and = "";
        if ($bulan != '') {
            $and .= " AND MONTH(`pegawai_pensiun_tmt`) = '$bulan'";
        }
        if ($jenis != '') {
            $and .= " AND pegawai_jenis_pensiun_id = '$jenis'";
        }
        $query = "SELECT * FROM pegawai WHERE YEAR(`pegawai_pensiun_tmt`) = '$tahun' $and ORDER BY pegawai_pensiun_tmt";
        return $this->db->query($query);
    }

    function get_tahun_pensiun()
    {
        $query = "select year(pegawai_pensiun_tmt) as tahun from pegawai where pegawai_pensiun_tmt is not NULL group by year(pegawai_pensiun_tmt) ";
        $get = $this->db->query($query);
        //        echo $query;
        return $get;
    }

    function get_pegawai_cuti($where)
    {
        $and = "";
        if ($where['pegawaicuti_tahun'] != '') {
            $and .= " AND YEAR(`pegawaicuti_sk_tanggal`) = '" . $where['pegawaicuti_tahun'] . "' ";
        }
        if ($where['pegawai_unit_id'] != '') {
            $and .= " AND pegawai_unit_id = '" . $where['pegawai_unit_id'] . "' ";
        }
        if ($where['pegawaicuti_jeniscuti_id'] != '') {
            $and .= " AND pegawaicuti_jeniscuti_id = '" . $where['pegawaicuti_jeniscuti_id'] . "' ";
        }
        $query = "SELECT pegawai_cuti.*,pegawai_nama,jenis_cuti_nama,pegawai_nip,pegawai_pangkat_terakhir_golru,pegawai_unit_nama,pegawai_gelar_belakang,DATEDIFF(pegawaicuti_lama_cuti_selesai,pegawaicuti_lama_cuti_mulai) pegawaicuti_lama_cuti FROM pegawai_cuti join pegawai on pegawai_cuti.pegawaicuti_pegawai_nip = pegawai.pegawai_nip join ref_jenis_cuti on pegawai_cuti.pegawaicuti_jeniscuti_id = ref_jenis_cuti.jenis_cuti_id WHERE 1=1 $and";
        return $this->db->query($query);
    }
}

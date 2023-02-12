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
class M_pegawai_kgb extends MY_Model{
    //put your code here
    public function __construct() {
        $this->_set_table('pegawai_kenaikan_gaji');
        $this->_set_primary_key('pegawaikgb_id');
        parent::__construct();
    }
    
    function get_kgb_terakhir($nip) {
        $query= "select * from pegawai_kenaikan_gaji where pegawaikgb_pegawai_nip = '$nip' order by pegawaikgb_tmt desc";
        return $this->db->query($query);
    }

    function get_by_id($kgb_id) {
        $query= "select pegawai_kenaikan_gaji.*,pegawai.*,c.pegawaikgb_gaji as gaji_lama,c.pegawaikgb_tmt as tmt_lama from pegawai_kenaikan_gaji
                join pegawai on pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = pegawai.pegawai_nip
                left join (select pegawaikgb_pegawai_nip,pegawaikgb_gaji,pegawaikgb_tmt from pegawai_kenaikan_gaji) c ON pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = c.pegawaikgb_pegawai_nip AND (YEAR(pegawai_kenaikan_gaji.pegawaikgb_tmt) - 2) = YEAR(c.pegawaikgb_tmt)
                where pegawaikgb_id = '$kgb_id'";
        return $this->db->query($query)->row();
    }

    function get_pegawai_gaji($nips)
    {
        $query= "SELECT pegawaikgb_tmt,pegawai_nip,pegawai_pangkat_terakhir_id,a.`pegawai_gaji`,c.`gaji_jumlah`,c.`gaji_masa_kerja`,pangkat_golongan_text FROM pegawai a
        LEFT JOIN ref_pangkat_golongan b ON a.`pegawai_pangkat_terakhir_id` = b.`pangkat_golongan_id`
        LEFT JOIN (SELECT
    `pegawai_kenaikan_gaji`.`pegawaikgb_id`  AS `pegawaikgb_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip`      AS `pegawaikgb_pegawai_nip`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_no`            AS `pegawaikgb_sk_no`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_tanggal`       AS `pegawaikgb_sk_tanggal`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pejabat`          AS `pegawaikgb_pejabat`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_tmt`              AS `pegawaikgb_tmt`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_tahun` AS `pegawaikgb_masa_kerja_tahun`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_bulan` AS `pegawaikgb_masa_kerja_bulan`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_gaji`             AS `pegawaikgb_gaji`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_id`       AS `pegawaikgb_pangkat_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_text`     AS `pegawaikgb_pangkat_text`
  FROM `pegawai_kenaikan_gaji`
  INNER JOIN (SELECT MAX(pegawaikgb_id) AS pegawaikgb_id
              FROM pegawai_kenaikan_gaji GROUP BY pegawaikgb_pegawai_nip) b ON `pegawai_kenaikan_gaji`.`pegawaikgb_id` = b.pegawaikgb_id) d ON a.`pegawai_nip` = d.`pegawaikgb_pegawai_nip`
        LEFT JOIN ref_gaji c ON b.`pangkat_golongan_kode` = c.`gaji_golru_kode` AND c.`gaji_masa_kerja` = TIMESTAMPDIFF(YEAR, DATE(a.`pegawai_cpns_tmt`),DATE(CURRENT_DATE()))
        WHERE a.`pegawai_status` = '1' AND a.`pegawai_nip` IN ('".$nips."')";
        return $this->db->query($query);
    }

    function proses_kgb($nip,$pangkat,$pangkat_text,$gaji,$masa_kerja,$user_id,$tmt){
        // die("CALL sp_proses_kgb('".$nip."','".$pangkat."','".$pangkat_text."','".$gaji."','".$masa_kerja."','".$user_id."')");
        $sql = "CALL sp_proses_kgb('".$nip."','".$pangkat."','".$pangkat_text."','".$gaji."','".$masa_kerja."','".$user_id."','".$tmt."')";

        $query = $this->db->query($sql);
        // print_r($query->result_array()); die;
    }
    
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pegawaikgb_id,pegawai_nip,pegawaikgb_tmt,MONTH(pegawaikgb_tmt) as bulan,YEAR(pegawaikgb_tmt) as tahun,MONTH(pegawaikgb_tmt) as bulan_next_2,YEAR(pegawaikgb_tmt) + 2 as tahun_next_2,CONCAT(pegawai_nama," ",pegawai_gelar_belakang) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru', FALSE);
    $this->datatables->from('pegawai');
    $this->datatables->join('ref_pangkat_golongan', 'pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id','LEFT');
    $this->datatables->join('(SELECT
    `pegawai_kenaikan_gaji`.`pegawaikgb_id`  AS `pegawaikgb_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip`      AS `pegawaikgb_pegawai_nip`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_no`            AS `pegawaikgb_sk_no`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_tanggal`       AS `pegawaikgb_sk_tanggal`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pejabat`          AS `pegawaikgb_pejabat`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_tmt`              AS `pegawaikgb_tmt`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_tahun` AS `pegawaikgb_masa_kerja_tahun`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_bulan` AS `pegawaikgb_masa_kerja_bulan`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_gaji`             AS `pegawaikgb_gaji`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_id`       AS `pegawaikgb_pangkat_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_text`     AS `pegawaikgb_pangkat_text`
  FROM `pegawai_kenaikan_gaji`
  INNER JOIN (SELECT MAX(pegawaikgb_id) AS pegawaikgb_id
              FROM pegawai_kenaikan_gaji GROUP BY pegawaikgb_pegawai_nip) b ON `pegawai_kenaikan_gaji`.`pegawaikgb_id` = b.pegawaikgb_id) v', 'pegawai.pegawai_nip = v.pegawaikgb_pegawai_nip','LEFT');
    
    $this->datatables->where('pegawai_status', '1', FALSE);
    
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }

    if ($this->input->post('proses') != '1') {
        $this->datatables->where('(YEAR(pegawaikgb_tmt) + 2) =', $this->input->post('tahun'));
    }else if($this->input->post('proses') == '1'){
        $this->datatables->where('YEAR(pegawaikgb_tmt)', $this->input->post('tahun'));
    }
    $this->datatables->where('MONTH(pegawaikgb_tmt)', $this->input->post('bulan'));
    // $this->datatables->where('YEAR(pegawai_kenaikan_gaji_berikutnya)', $this->input->post('tahun'));
    $this->datatables->add_column('cetak', '$1', 'cetak_kgb(pegawaikgb_id)');
    $this->datatables->edit_column('pegawaikgb_tmt', '$1', 'date_time(pegawaikgb_tmt)');
    return 
    $this->datatables->generate();
    // die($this->db->last_query());
	
  }
}

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
        $query= "select * from pegawai_kenaikan_gaji where pegawaikgb_pegawai_nip = '$nip' AND status_proses IN ('4','5') order by pegawaikgb_tmt desc";
        return $this->db->query($query);
    }

	function get_pangkat_terakhir($nip) {
    	$query = "SELECT a.* FROM pegawai_pangkat a
JOIN (SELECT MAX(pegawaipangkat_tmt) AS tmt_terakhir,pegawaipangkat_pegawai_nip FROM pegawai_pangkat WHERE pegawaipangkat_pegawai_nip = '$nip') b ON a.`pegawaipangkat_pegawai_nip` = b.`pegawaipangkat_pegawai_nip` AND a.`pegawaipangkat_tmt` = b.tmt_terakhir
WHERE a.pegawaipangkat_pegawai_nip = '$nip' 
ORDER BY pegawaipangkat_pangkat_id DESC LIMIT 1;";
        return $this->db->query($query)->row();
    }


    function get_by_id($kgb_id) {
        $query= "select a.*,b.pegawai_status_kepegawaian_id,b.pegawai_cpns_tmt from pegawai_kenaikan_gaji a
                join pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip  where pegawaikgb_id = '$kgb_id' ";
        return $this->db->query($query)->row();
    }

    function get_data_cetak($kgb_id,$nip) {
    	// select pegawai_kenaikan_gaji.*,pegawai.*,c.pegawaikgb_gaji as gaji_old,c.pegawaikgb_tmt as tmt_old,c.pegawaikgb_masa_kerja_tahun as masa_kerja_tahun_old,c.pegawaikgb_masa_kerja_bulan as masa_kerja_bulan_old,c.pegawaikgb_sk_tanggal as tgl_sk_old,c.pegawaikgb_sk_no as no_sk_old from pegawai_kenaikan_gaji
        //        join pegawai on pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = pegawai.pegawai_nip
        //        left join (select pegawaikgb_pegawai_nip,pegawaikgb_gaji,pegawaikgb_tmt,pegawaikgb_sk_tanggal,pegawaikgb_masa_kerja_tahun,pegawaikgb_masa_kerja_bulan,pegawaikgb_sk_no from pegawai_kenaikan_gaji) c ON pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = c.pegawaikgb_pegawai_nip AND (YEAR(pegawai_kenaikan_gaji.pegawaikgb_tmt) - 2) = YEAR(c.pegawaikgb_tmt)
        //        where pegawaikgb_id = '$kgb_id'
        $query= "
                SELECT a.*,b.*,f.pangkat_golongan_pangkat,u.unit_kpok,CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_gaji_pokok ELSE c.pegawaikgb_gaji END AS gaji_old, CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_tmt ELSE c.pegawaikgb_tmt END AS tmt_old, CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_masa_kerja_tahun ELSE c.pegawaikgb_masa_kerja_tahun END AS masa_kerja_tahun_old, CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_masa_kerja_bulan ELSE c.pegawaikgb_masa_kerja_bulan END AS masa_kerja_bulan_old,CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_sk_date ELSE c.pegawaikgb_sk_tanggal END AS tgl_sk_old,CASE WHEN c.pegawaikgb_pangkat_id <>  d.pegawaipangkat_pangkat_id THEN d.pegawaipangkat_sk_no ELSE c.pegawaikgb_sk_no END AS no_sk_old,a.pegawaikgb_masa_kerja_tahun AS masa_kerja_tahun,a.pegawaikgb_masa_kerja_bulan AS masa_kerja_bulan 
				FROM pegawai_kenaikan_gaji a
				JOIN pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip 
				LEFT JOIN (SELECT a.* FROM pegawai_pangkat a
				JOIN (SELECT MAX(pegawaipangkat_tmt) AS tmt_terakhir,pegawaipangkat_pegawai_nip FROM pegawai_pangkat WHERE pegawaipangkat_pegawai_nip = '$nip') b ON a.`pegawaipangkat_pegawai_nip` = b.`pegawaipangkat_pegawai_nip` AND a.`pegawaipangkat_tmt` = b.tmt_terakhir
				WHERE a.pegawaipangkat_pegawai_nip = '$nip' 
				ORDER BY pegawaipangkat_pangkat_id DESC LIMIT 1) d ON b.`pegawai_nip` = d.pegawaipangkat_pegawai_nip
				LEFT JOIN (SELECT pegawaikgb_pangkat_id,pegawaikgb_pegawai_nip,pegawaikgb_gaji,pegawaikgb_tmt,pegawaikgb_sk_tanggal,pegawaikgb_masa_kerja_tahun,pegawaikgb_masa_kerja_bulan,pegawaikgb_sk_no FROM pegawai_kenaikan_gaji) c 
				ON a.pegawaikgb_pegawai_nip = c.pegawaikgb_pegawai_nip AND (YEAR(a.pegawaikgb_tmt) - 2) = YEAR(c.pegawaikgb_tmt) 
                LEFT JOIN ref_pangkat_golongan f ON b.`pegawai_pangkat_terakhir_id` = f.`pangkat_golongan_id`
                LEFT JOIN ref_unit u ON b.pegawai_unit_id = u.unit_id
				WHERE pegawaikgb_id = '$kgb_id' ";
    // die($query);
        return $this->db->query($query)->row();
    }
    
    function get_data_cetak_cpns($kgb_id,$nip) {
    	// select pegawai_kenaikan_gaji.*,pegawai.*,c.pegawaikgb_gaji as gaji_old,c.pegawaikgb_tmt as tmt_old,c.pegawaikgb_masa_kerja_tahun as masa_kerja_tahun_old,c.pegawaikgb_masa_kerja_bulan as masa_kerja_bulan_old,c.pegawaikgb_sk_tanggal as tgl_sk_old,c.pegawaikgb_sk_no as no_sk_old from pegawai_kenaikan_gaji
        //        join pegawai on pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = pegawai.pegawai_nip
        //        left join (select pegawaikgb_pegawai_nip,pegawaikgb_gaji,pegawaikgb_tmt,pegawaikgb_sk_tanggal,pegawaikgb_masa_kerja_tahun,pegawaikgb_masa_kerja_bulan,pegawaikgb_sk_no from pegawai_kenaikan_gaji) c ON pegawai_kenaikan_gaji.pegawaikgb_pegawai_nip = c.pegawaikgb_pegawai_nip AND (YEAR(pegawai_kenaikan_gaji.pegawaikgb_tmt) - 2) = YEAR(c.pegawaikgb_tmt)
        //        where pegawaikgb_id = '$kgb_id'
        $query= "
                SELECT a.*,b.*,f.pangkat_golongan_pangkat,u.unit_kpok,g.gaji_jumlah AS gaji_old,b.pegawai_pns_tmt AS tmt_old, CASE WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'II/' THEN '4' WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'III' THEN '1' ELSE d.pegawaipangkat_masa_kerja_tahun END AS masa_kerja_tahun_old, CASE WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'II/' THEN '7' WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'III' THEN '7' ELSE d.pegawaipangkat_masa_kerja_bulan END AS masa_kerja_bulan_old,b.pegawai_pns_sk_date AS tgl_sk_old,b.pegawai_pns_sk_no AS no_sk_old,CASE WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'II/' THEN '5' WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'III' THEN '2' ELSE a.pegawaikgb_masa_kerja_tahun END AS masa_kerja_tahun, '0' AS masa_kerja_bulan
				FROM pegawai_kenaikan_gaji a
				JOIN pegawai b ON a.pegawaikgb_pegawai_nip = b.pegawai_nip 
				LEFT JOIN (SELECT a.* FROM pegawai_pangkat a
				JOIN (SELECT MAX(pegawaipangkat_tmt) AS tmt_terakhir,pegawaipangkat_pegawai_nip FROM pegawai_pangkat WHERE pegawaipangkat_pegawai_nip = '$nip') b ON a.`pegawaipangkat_pegawai_nip` = b.`pegawaipangkat_pegawai_nip` AND a.`pegawaipangkat_tmt` = b.tmt_terakhir
				WHERE a.pegawaipangkat_pegawai_nip = '$nip' 
				ORDER BY pegawaipangkat_pangkat_id DESC LIMIT 1) d ON b.`pegawai_nip` = d.pegawaipangkat_pegawai_nip
				LEFT JOIN (SELECT pegawaikgb_pangkat_id,pegawaikgb_pegawai_nip,pegawaikgb_gaji,pegawaikgb_tmt,pegawaikgb_sk_tanggal,pegawaikgb_masa_kerja_tahun,pegawaikgb_masa_kerja_bulan,pegawaikgb_sk_no FROM pegawai_kenaikan_gaji) c 
				ON a.pegawaikgb_pegawai_nip = c.pegawaikgb_pegawai_nip AND (YEAR(a.pegawaikgb_tmt) - 2) = YEAR(c.pegawaikgb_tmt) 
                LEFT JOIN ref_pangkat_golongan f ON b.`pegawai_pangkat_terakhir_id` = f.`pangkat_golongan_id`
        		LEFT JOIN ref_gaji g ON f.`pangkat_golongan_kode` = g.`gaji_golru_kode` AND g.gaji_jumlah = (
        		select min(gaji_jumlah)
        		from ref_gaji
        		where gaji_golru_kode = f.`pangkat_golongan_kode`
   				)
                LEFT JOIN ref_unit u ON b.pegawai_unit_id = u.unit_id
				WHERE pegawaikgb_id = '$kgb_id' ";
    // die($query);
        return $this->db->query($query)->row();
    die(json_encode($this->db->query($query)->row()));
    }

    function get_pegawai_gaji($nips)
    {
        $query= "SELECT pegawaikgb_tmt,pegawai_nip,COALESCE(a.pegawai_hp,a.pegawai_telpon) AS no_telp, d.pegawaikgb_pangkat_id,pegawai_pangkat_terakhir_id,a.`pegawai_gaji`,COALESCE(c.`gaji_jumlah`,a.`pegawai_gaji`) AS `gaji_jumlah`,`d`.`pegawaikgb_masa_kerja_tahun`+2 AS `gaji_masa_kerja`,d.pegawaikgb_masa_kerja_bulan,pangkat_golongan_text,golru FROM pegawai a
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
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_text`     AS `pegawaikgb_pangkat_text`,
    ref_pangkat_golongan.pangkat_golongan_nama AS golru
  FROM `pegawai_kenaikan_gaji`
  LEFT JOIN ref_pangkat_golongan ON `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_id` = ref_pangkat_golongan.`pangkat_golongan_id`
  INNER JOIN (SELECT MAX(pegawaikgb_tmt) AS pegawaikgb_tmt_old,pegawaikgb_pegawai_nip
              FROM pegawai_kenaikan_gaji GROUP BY pegawaikgb_pegawai_nip) b ON `pegawai_kenaikan_gaji`.`pegawaikgb_tmt` = b.pegawaikgb_tmt_old  AND `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip` = b.pegawaikgb_pegawai_nip) d ON a.`pegawai_nip` = d.`pegawaikgb_pegawai_nip`
        LEFT JOIN ref_gaji c ON b.`pangkat_golongan_kode` = c.`gaji_golru_kode` AND CASE WHEN `d`.`pegawaikgb_masa_kerja_tahun` = '31' AND b.`pangkat_golongan_kode` NOT IN ('21','22','23','24') THEN c.`gaji_masa_kerja` = '32' ELSE  c.`gaji_masa_kerja` = (`d`.`pegawaikgb_masa_kerja_tahun`+2) END
        WHERE a.`pegawai_status` = '1' AND a.`pegawai_nip` IN ('".$nips."')";
        return 
        $this->db->query($query);
    // die($this->db->last_query());
    }

    function get_pegawai_gaji_cpns($nips)
    {
        $query= "SELECT pegawai_cpns_tmt AS pegawaikgb_tmt,pegawai_nip,COALESCE(a.pegawai_hp,a.pegawai_telpon) AS no_telp,pegawai_pangkat_terakhir_id AS pegawaikgb_pangkat_id,pegawai_pangkat_terakhir_id,a.`pegawai_gaji`,COALESCE(d.`gaji_jumlah`,c.`gaji_jumlah`) AS gaji_jumlah,d.`gaji_masa_kerja`, '0' AS pegawaikgb_masa_kerja_bulan,pangkat_golongan_text,pangkat_golongan_nama as golru FROM pegawai a
        LEFT JOIN ref_pangkat_golongan b ON a.`pegawai_pangkat_terakhir_id` = b.`pangkat_golongan_id`
        LEFT JOIN ref_gaji c ON b.`pangkat_golongan_kode` = c.`gaji_golru_kode` AND c.gaji_jumlah = (
        		select min(gaji_jumlah)
        		from ref_gaji
        		where gaji_golru_kode = b.`pangkat_golongan_kode`
   				)
        LEFT JOIN ref_gaji d ON b.`pangkat_golongan_kode` = d.`gaji_golru_kode` AND d.`gaji_masa_kerja` = CASE WHEN SUBSTR(pangkat_golongan_nama,1,3) = 'II/' THEN '5' ELSE '2' END 
        WHERE a.`pegawai_status` = '1' AND a.`pegawai_nip` IN ('".$nips."')";
        return 
        $this->db->query($query);
    // die(json_encode($this->db->query($query)->result()));
    }

    function proses_kgb($nip,$pangkat,$pangkat_text,$gaji,$masa_kerja,$masa_kerja_bulan,$user_id,$tmt,$pegawaikgb_sk_no,$pegawaikgb_sk_tanggal,$pegawaikgb_pejabat){
        // die("CALL sp_proses_kgb('".$nip."','".$pangkat."','".$pangkat_text."','".$gaji."','".$masa_kerja."','".$masa_kerja_bulan."','".$user_id."','".$tmt."','".$pegawaikgb_sk_no."','".$pegawaikgb_sk_tanggal."','".$pegawaikgb_pejabat."')");
        $sql = "CALL sp_proses_kgb('".$nip."','".$pangkat."','".$pangkat_text."','".$gaji."','".$masa_kerja."','".$masa_kerja_bulan."','".$user_id."','".$tmt."','".$pegawaikgb_sk_no."','".$pegawaikgb_sk_tanggal."','".$pegawaikgb_pejabat."')";

        $query = $this->db->query($sql);
        $res      = $query->result_array();
        // die(json_encode($query));
        //         //add this two line 
                // $query->next_result(); 
                // $query->free_result(); 
    $this->db->freeDBResource($this->db->conn_id);
        //end of new code
        return $res[0];
        // print_r($query->result_array()); die;
    }

    
  
  // datatables
  function json()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pegawaikgb_id,pegawai_nip,pegawaikgb_tmt,pegawaikgb_sk_no,pegawaikgb_sk_tanggal,MONTH(pegawaikgb_tmt) as bulan,YEAR(pegawaikgb_tmt) as tahun,MONTH(pegawaikgb_tmt) as bulan_next_2,YEAR(pegawaikgb_tmt) + 2 as tahun_next_2,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru,status_proses,kgbsk_file,pegawaikgb_keterangan', FALSE);
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
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_text`     AS `pegawaikgb_pangkat_text`,
    `pegawai_kenaikan_gaji`.`status_proses`     AS `status_proses`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_keterangan` AS `pegawaikgb_keterangan`
  FROM `pegawai_kenaikan_gaji`
  INNER JOIN (SELECT MAX(pegawaikgb_tmt) AS pegawaikgb_tmt_old,pegawaikgb_pegawai_nip
              FROM pegawai_kenaikan_gaji GROUP BY pegawaikgb_pegawai_nip) b ON `pegawai_kenaikan_gaji`.`pegawaikgb_tmt` = b.pegawaikgb_tmt_old AND `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip` = b.pegawaikgb_pegawai_nip) v', 'pegawai.pegawai_nip = v.pegawaikgb_pegawai_nip','LEFT');
    $this->datatables->join('pegawai_kenaikan_gaji_sk', 'v.pegawaikgb_id = pegawai_kenaikan_gaji_sk.kgbsk_kenaikan_gaji_id','LEFT');
    
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
    $this->datatables->add_column('aksi', '$1', 'aksi_kgb(pegawaikgb_id,"'.$this->input->post('proses').'",pegawai_nip,pegawai_nama, status_proses,pegawaikgb_sk_no,pegawaikgb_sk_tanggal)');
    $this->datatables->add_column('sk', '$1', 'sk_kgb(pegawaikgb_id,status_proses,kgbsk_file,pegawaikgb_keterangan)');
    $this->datatables->edit_column('pegawaikgb_tmt', '$1', 'date_time(pegawaikgb_tmt)');
    $this->db->order_by('pegawaikgb_id', 'DESC');
    return 
    $this->datatables->generate();
    die($this->db->last_query());
	
  }
  
  // datatables
  function json_cpns()
  {
    $session = $this->session->userdata('login');
    $this->load->helper('my_datatable');
    $this->datatables->select('pegawaikgb_id,pegawai_nip,pegawai_cpns_tmt ,pegawai_cpns_tmt AS pegawaikgb_tmt,pegawaikgb_sk_no,pegawaikgb_sk_tanggal,MONTH(pegawai_cpns_tmt) as bulan,YEAR(pegawai_cpns_tmt) as tahun,MONTH(pegawai_cpns_tmt) as bulan_next_2,YEAR(pegawai_cpns_tmt) + 2 as tahun_next_2,CONCAT(IFNULL(pegawai_gelar_depan,"")," ",pegawai_nama," ",IFNULL(pegawai_gelar_belakang,"")) as nama,pegawai_nama,pegawai_jabatan_nama,pegawai_eselon_nama,pegawai_unit_nama,pegawai_telpon,pegawai_email,pangkat_golongan_pangkat,CONCAT(pangkat_golongan_pangkat,"</br>",pegawai_pangkat_terakhir_golru) pangkat,pegawai_pangkat_terakhir_golru,status_proses,kgbsk_file,pegawaikgb_keterangan', FALSE);
    $this->datatables->from('pegawai');
    $this->datatables->join('ref_pangkat_golongan', 'pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id','LEFT');
    $this->datatables->join('(SELECT
    `pegawai_kenaikan_gaji`.`pegawaikgb_id`  AS `pegawaikgb_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip`      AS `pegawaikgb_pegawai_nip`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_no`            AS `pegawaikgb_sk_no`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_sk_tanggal`       AS `pegawaikgb_sk_tanggal`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pejabat`          AS `pegawaikgb_pejabat`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_tmt`              AS `kgb_tmt`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_tahun` AS `pegawaikgb_masa_kerja_tahun`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_masa_kerja_bulan` AS `pegawaikgb_masa_kerja_bulan`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_gaji`             AS `pegawaikgb_gaji`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_id`       AS `pegawaikgb_pangkat_id`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_pangkat_text`     AS `pegawaikgb_pangkat_text`,
    `pegawai_kenaikan_gaji`.`status_proses`     AS `status_proses`,
    `pegawai_kenaikan_gaji`.`pegawaikgb_keterangan` AS `pegawaikgb_keterangan`
  FROM `pegawai_kenaikan_gaji`
  INNER JOIN (SELECT MAX(pegawaikgb_tmt) AS pegawaikgb_tmt_old,pegawaikgb_pegawai_nip
              FROM pegawai_kenaikan_gaji GROUP BY pegawaikgb_pegawai_nip) b ON `pegawai_kenaikan_gaji`.`pegawaikgb_tmt` = b.pegawaikgb_tmt_old AND `pegawai_kenaikan_gaji`.`pegawaikgb_pegawai_nip` = b.pegawaikgb_pegawai_nip) v', 'pegawai.pegawai_nip = v.pegawaikgb_pegawai_nip','LEFT');
    $this->datatables->join('pegawai_kenaikan_gaji_sk', 'v.pegawaikgb_id = pegawai_kenaikan_gaji_sk.kgbsk_kenaikan_gaji_id','LEFT');
    $this->datatables->where('pegawai_status', '1', FALSE);
    
    if ($this->input->post('opd') != 'all') {
        $this->datatables->where('pegawai_unit_id', $this->input->post('opd'));
    }
    
    if($this->input->post('proses') == '1'){
        $this->datatables->where('YEAR(kgb_tmt)', $this->input->post('tahun'));
    }else{
        $this->datatables->where('(YEAR(pegawai_cpns_tmt) + 2) =', $this->input->post('tahun'));
        $this->datatables->where('kgb_tmt IS NULL', '', FALSE);
    }
    $this->datatables->where('MONTH(pegawai_cpns_tmt)', $this->input->post('bulan'));
    // $this->datatables->where('YEAR(pegawai_kenaikan_gaji_berikutnya)', $this->input->post('tahun'));
    $this->datatables->add_column('aksi', '$1', 'aksi_kgb(pegawaikgb_id,"'.$this->input->post('proses').'",pegawai_nip,pegawai_nama, status_proses,pegawaikgb_sk_no,pegawaikgb_sk_tanggal)');
    $this->datatables->add_column('sk', '$1', 'sk_kgb(pegawaikgb_id,status_proses,kgbsk_file,pegawaikgb_keterangan)');
    $this->datatables->edit_column('pegawaikgb_tmt', '$1', 'date_time(pegawai_cpns_tmt)');
  	$this->db->order_by('pegawaikgb_id', 'DESC');
    return 
    $this->datatables->generate();
    die($this->db->last_query());
	
  }

  function get_sk($kgb_id)
  {
      $query= "SELECT a.*,pegawai_nip,pegawai_nama,pegawai_gelar_depan,pegawai_gelar_belakang,pegawai_tgl_lahir,pegawai_unit_nama,pegawai_pangkat_terakhir_golru FROM pegawai_kenaikan_gaji_sk a
      JOIN pegawai_kenaikan_gaji b ON a.kgbsk_kenaikan_gaji_id = b.pegawaikgb_id
      JOIN pegawai c ON b.`pegawaikgb_pegawai_nip` = c.`pegawai_nip`
      WHERE a.`kgbsk_kenaikan_gaji_id` = '".$kgb_id."'";
      return 
      $this->db->query($query)->row();
  // die(json_encode($this->db->query($query)->result()));
  }
  
  function insert_sk($data)
  {
      return $this->db->insert('pegawai_kenaikan_gaji_sk', $data);
  }
  
  
  function update_sk($data, $id)
  {
    $this->db->where('kgbsk_kenaikan_gaji_id', $id);
      return $this->db->update('pegawai_kenaikan_gaji_sk', $data);
  }

  function delete_file($id)
  {
      $this->db->where('kgbsk_kenaikan_gaji_id', $id);
     return $this->db->delete('pegawai_kenaikan_gaji_sk');
  }
}

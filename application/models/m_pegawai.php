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
class M_pegawai extends MY_Model
{
    var $column_order = array(null, 'pegawai_nip', 'pegawai_nama', 'pegawai_pangkat_terakhir_id', 'pegawai_jabatan_nama','pegawai_eselon_nama', 'pegawai_unit_nama', 'pegawai_pendidikan_terakhir_tingkat'); //set column field database for datatable orderable
    var $column_search = array('pegawai_nip', 'pegawai_nama', 'pegawai_pangkat_terakhir_nama', 'pegawai_jabatan_nama','pegawai_eselon_nama', 'pegawai_unit_nama', 'pegawai_pendidikan_terakhir_tingkat'); //set column field database for datatable searchable 
    var $order = array('pegawai_nip' => 'DESC'); // default order 
    public function __construct()
    {
        $this->_set_table('pegawai');
        $this->_set_primary_key('pegawai_nip');
        //        $this->_set_order(array('pegawai_nip','asc'));
        //        $this->_set_column_oder();
        //        $this->_set_column_search();
        parent::__construct();
    }

    function set_table($table_name)
    {
        $this->_set_table($table_name);
    }
    function _set_order($value)
    {
        $this->order = $value;
    }

    function _set_column_oder($value)
    {
        $this->column_order = $value;
    }

    function _set_column_search($value)
    {
        $this->column_search = $value;
    }

    function get_pegawai_detail($nip)
    {
        $query = "SELECT p.*,cpns.`pangkat_golongan_text` AS cpns_pangkat,pns.`pangkat_golongan_text` AS pns_pangkat,sumpah.`kondisisumpah_nama` FROM pegawai p
LEFT JOIN ref_pangkat_golongan cpns ON (p.`pegawai_cpns_pangkat_id` = cpns.`pangkat_golongan_id`)
LEFT JOIN ref_pangkat_golongan pns ON (p.`pegawai_pns_pangkat_id` = pns.`pangkat_golongan_kode`)
LEFT JOIN ref_kondisi_sumpah sumpah ON (p.`pegawai_pns_sumpah_id` = sumpah.`kondisisumpah_kode`)
WHERE p.`pegawai_nip` = '$nip';";
        return $this->db->query($query)->row();
    }

    function get_daftar_nominatif_pegawai($where)
    {
        $this->db->select("pegawai_nip as 'NIP',pegawai_nama as 'NAMA'");
        $this->db->where($where);
        return $this->db->get('pegawai');
    }

    function get_pegawai_pensiun()
    {
        $this->db->select("pegawai.*,ref_jenis_pensiun.*");
        $this->db->join('ref_jenis_pensiun', 'pegawai_jenis_pensiun_id = jenis_pensiun_id', 'LEFT');
        $this->db->where('pegawai_status <> 1');
        return $this->db->get('pegawai');
    }

    //DATA TABEL
    private function _get_datatables_query()
    {

        // $this->db->from($this->table);
        // $this->db->where('pegawai_status', '1');

        // $i = 0;


        // foreach ($this->column_search as $item) // loop column 
        // {
        //     if ($_POST['search']['value']) // if datatable send POST for search
        //     {

        //         if ($i === 0) // first loop
        //         {
        //             // $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
        //             $this->db->like($item, $_POST['search']['value']);
        //         } else {
        //             $this->db->or_like($item, $_POST['search']['value']);
        //         }

        //         // if (count($this->column_search) - 1 == $i) //last loop
        //         //     $this->db->group_end(); //close bracket
        //     }
        //     $i++;
        // }

        // if (!empty($_POST['order']['0']['column'])) // here order processing
        // {
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } else if (isset($this->order)) {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }

        $i = 0;
        $jenis_jabatan = $this->input->post('jenis_jabatan');
        $pangkat = $this->input->post('pangkat');
        $opd = $this->input->post('opd');
        $pendidikan = $this->input->post('pendidikan');
        $agama = $this->input->post('agama');
        $eselon = $this->input->post('eselon');
        $jk = $this->input->post('jk');
        $status_pegawai = $this->input->post('status_pegawai');
    	$pegawai_masuk_sanggau = $this->input->post('pegawai_masuk_sanggau');
    	$pegawai_cpns_jenis_pengadaan = $this->input->post('pegawai_cpns_jenis_pengadaan');

        if ($_POST['search']['value']) // if datatable send POST for search
        {
            $where = ' WHERE ( ';

            foreach ($this->column_search as $item) // loop column 
            {

                if ($i === 0) // first loop
                {
                    $where .= " $item LIKE '%" . $_POST['search']['value'] . "%' ";
                } else {
                    // $this->db->or_like($item, $_POST['search']['value']);
                    $where .= " OR $item LIKE '%" . $_POST['search']['value'] . "%'  ";
                }

                $i++;
            }
            $where .= ' ) ';
        } else {

            $where = " WHERE 1=1 ";
        }

        $user = $this->session->userdata('login');
        $user_group = $user['group_id'];
        $user_opd   = $user['unit_id'];

        if ($user_group == '4') {
            $andWhere = " AND (pegawai_unit_id = '$user_opd')";
        } else {
            $andWhere = " ";
        }

        $filter = " ";
    
    if($user_group == '1'){
        if ($jenis_jabatan != 'all') {
            $filter .= " AND (pegawai_jenisjabatan_kode = '" . $jenis_jabatan . "') ";
        }
        if ($opd != 'all') {
            $filter .= " AND (pegawai_unit_id = '" . $opd . "') ";
        }
        if ($pangkat != 'all') {
            $filter .= " AND (pegawai_pangkat_terakhir_id = '" . $pangkat . "') ";
        }
        if ($pendidikan != 'all') {
            $filter .= " AND (pegawai_pendidikan_terakhir_tingkat_id = '" . $pendidikan . "') ";
        }
        if ($agama != 'all') {
            $filter .= " AND (pegawai_agama_id = '" . $agama . "') ";
        }
        if ($eselon != 'all') {
            $filter .= " AND (pegawai_eselon_id = '" . $eselon . "') ";
        }
        if ($jk != 'all') {
            $filter .= " AND (pegawai_jenkel_id = '" . $jk . "') ";
        }
        if ($status_pegawai != 'all') {
            $filter .= " AND (pegawai_status_kepegawaian_id = '" . $status_pegawai . "') ";
        }
        if ($pegawai_masuk_sanggau != 'all') {
            $filter .= " AND (pegawai_masuk_sanggau = '" . $pegawai_masuk_sanggau . "') ";
        }
        if ($pegawai_cpns_jenis_pengadaan != 'all') {
            $filter .= " AND (pegawai_cpns_jenis_pengadaan = '" . $pegawai_cpns_jenis_pengadaan . "') ";
        }
    }

        $sql = "SELECT pegawai.*,pangkat_golongan_pangkat
                FROM pegawai
                LEFT JOIN ref_pangkat_golongan ON pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id
                $where
                AND pegawai_status =  '1'  $andWhere       $filter
                ";

        if (!empty($_POST['order']['0']['column'])) // here order processing
        {
            $order = $this->column_order[$_POST['order']['0']['column']];
            $order_dir =  $_POST['order']['0']['dir'];
            // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            // if ($user_group == '4') {
            //     $sql .= " ORDER BY pegawai_pangkat_terakhir_id DESC";
            // } else {
            $sql .= " ORDER BY $order $order_dir";
            // }

        } else if (isset($this->order)) {
            $orders = $this->order;
            $order = key($orders);
            $order_dir =  $orders[key($orders)];
            // $this->db->order_by(key($order), $order[key($order)]);
            if ($user_group == '4') {
                $sql .= " ORDER BY pegawai_pangkat_terakhir_golru DESC";
            } else {
                $sql .= " ORDER BY $order $order_dir";
            }
        }

        $sLimit = ""; //limit
        if (
            isset($_POST['start']) && $_POST['length'] != '-1'
        ) {
            $sLimit = " LIMIT " . $_POST['start'] . ", " .
                $_POST['length'];
        }

        $sql = $sql . $sLimit;
        return $sql;
    }

    private function _get_datatables_query_total()
    {

        $i = 0;
        $jenis_jabatan = $this->input->post('jenis_jabatan');
        $pangkat = $this->input->post('pangkat');
        $opd = $this->input->post('opd');
        $pendidikan = $this->input->post('pendidikan');
        $agama = $this->input->post('agama');
        $eselon = $this->input->post('eselon');
        $jk = $this->input->post('jk');
        $status_pegawai = $this->input->post('status_pegawai');
    	$pegawai_masuk_sanggau = $this->input->post('pegawai_masuk_sanggau');
    	$pegawai_cpns_jenis_pengadaan = $this->input->post('pegawai_cpns_jenis_pengadaan');

        $user = $this->session->userdata('login');
        $user_group = $user['group_id'];
        $user_opd   = $user['unit_id'];

        if ($user_group == '4') {
            $where = " WHERE (pegawai_unit_id = '$user_opd')";
        } else {
            $where = " WHERE 1=1 ";
        }
    
    
        $filter = " ";

    if($user_group == '1'){
        if ($jenis_jabatan != 'all') {
            $filter .= " AND (pegawai_jenisjabatan_kode = '" . $jenis_jabatan . "') ";
        }
        if ($opd != 'all') {
            $filter .= " AND (pegawai_unit_id = '" . $opd . "') ";
        }
        if ($pangkat != 'all') {
            $filter .= " AND (pegawai_pangkat_terakhir_id = '" . $pangkat . "') ";
        }
        if ($pendidikan != 'all') {
            $filter .= " AND (pegawai_pendidikan_terakhir_tingkat_id = '" . $pendidikan . "') ";
        }
        if ($agama != 'all') {
            $filter .= " AND (pegawai_agama_id = '" . $agama . "') ";
        }
        if ($eselon != 'all') {
            $filter .= " AND (pegawai_eselon_id = '" . $eselon . "') ";
        }
        if ($jk != 'all') {
            $filter .= " AND (pegawai_jenkel_id = '" . $jk . "') ";
        }
        if ($status_pegawai != 'all') {
            $filter .= " AND (pegawai_status_kepegawaian_id = '" . $status_pegawai . "') ";
        }
        if ($pegawai_masuk_sanggau != 'all') {
            $filter .= " AND (pegawai_masuk_sanggau = '" . $pegawai_masuk_sanggau . "') ";
        }
        if ($pegawai_cpns_jenis_pengadaan != 'all') {
            $filter .= " AND (pegawai_cpns_jenis_pengadaan = '" . $pegawai_cpns_jenis_pengadaan . "') ";
        }
    }



        $sql = "SELECT pegawai.*
                FROM pegawai 
                $where 
                AND pegawai_status =  '1'  $filter       
                ";

        return $sql;
    }

    function get_datatables()
    {
        $sql = $this->_get_datatables_query();
        $query = $this->db->query($sql);
        return $query->result();
    }

    function count_filtered()
    {

        $i = 0;
        $jenis_jabatan = $this->input->post('jenis_jabatan');
        $pangkat = $this->input->post('pangkat');
        $opd = $this->input->post('opd');
        $pendidikan = $this->input->post('pendidikan');
        $agama = $this->input->post('agama');
        $eselon = $this->input->post('eselon');
        $jk = $this->input->post('jk');
        $status_pegawai = $this->input->post('status_pegawai');
    	$pegawai_masuk_sanggau = $this->input->post('pegawai_masuk_sanggau');
    	$pegawai_cpns_jenis_pengadaan = $this->input->post('pegawai_cpns_jenis_pengadaan');

        if ($_POST['search']['value']) // if datatable send POST for search
        {
            $where = ' WHERE ( ';

            foreach ($this->column_search as $item) // loop column 
            {

                if ($i === 0) // first loop
                {
                    $where .= " $item LIKE '%" . $_POST['search']['value'] . "%' ";
                } else {
                    // $this->db->or_like($item, $_POST['search']['value']);
                    $where .= " OR $item LIKE '%" . $_POST['search']['value'] . "%'  ";
                }

                $i++;
            }
            $where .= ' ) ';
        } else {

            $where = " WHERE 1=1 ";
        }

        $user = $this->session->userdata('login');
        $user_group = $user['group_id'];
        $user_opd   = $user['unit_id'];

        if ($user_group == '4') {
            $andWhere = " AND (pegawai_unit_id = '$user_opd')";
        } else {
            $andWhere = " ";
        }

        $filter = " ";

    if($user_group == '1'){
        if ($jenis_jabatan != 'all') {
            $filter .= " AND (pegawai_jenisjabatan_kode = '" . $jenis_jabatan . "') ";
        }
        if ($opd != 'all') {
            $filter .= " AND (pegawai_unit_id = '" . $opd . "') ";
        }
        if ($pangkat != 'all') {
            $filter .= " AND (pegawai_pangkat_terakhir_id = '" . $pangkat . "') ";
        }
        if ($pendidikan != 'all') {
            $filter .= " AND (pegawai_pendidikan_terakhir_tingkat_id = '" . $pendidikan . "') ";
        }
        if ($agama != 'all') {
            $filter .= " AND (pegawai_agama_id = '" . $agama . "') ";
        }
        if ($eselon != 'all') {
            $filter .= " AND (pegawai_eselon_id = '" . $eselon . "') ";
        }
        if ($jk != 'all') {
            $filter .= " AND (pegawai_jenkel_id = '" . $jk . "') ";
        }
        if ($status_pegawai != 'all') {
            $filter .= " AND (pegawai_status_kepegawaian_id = '" . $status_pegawai . "') ";
        }
        if ($pegawai_masuk_sanggau != 'all') {
            $filter .= " AND (pegawai_masuk_sanggau = '" . $pegawai_masuk_sanggau . "') ";
        }
        if ($pegawai_cpns_jenis_pengadaan != 'all') {
            $filter .= " AND (pegawai_cpns_jenis_pengadaan = '" . $pegawai_cpns_jenis_pengadaan . "') ";
        }
    }

        $sql = "SELECT pegawai.*
                FROM pegawai
                $where
                AND pegawai_status =  '1'  $andWhere       $filter
                ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function count_all()
    {
        $sql = $this->_get_datatables_query_total();
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_pegawai_aktif($id)
    {
        $this->db->where($this->primary_key, $id);
        $this->db->where('pegawai_status', '1');
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    

    //DATA TABEL
    public function get_pegawai_report()
    {
        $i = 0;
        $jenis_jabatan = $this->input->post('jenis_jabatan');
        $pangkat = $this->input->post('pangkat');
        $opd = $this->input->post('opd');
        $pendidikan = $this->input->post('pendidikan');
        $agama = $this->input->post('agama');
        $eselon = $this->input->post('eselon');
        $jk = $this->input->post('jk');
        $status_pegawai = $this->input->post('status_pegawai');


        $where = " WHERE 1=1 ";

        $user = $this->session->userdata('login');
        $user_group = $user['group_id'];
        $user_opd   = $user['unit_id'];

        if ($user_group == '4') {
            $andWhere = " AND (pegawai_unit_id = '$user_opd')";
        } else {
            $andWhere = " ";
        }

        $filter = " ";
    
    if($user_group == '1'){
        if ($jenis_jabatan != 'all') {
            $filter .= " AND (pegawai_jenisjabatan_kode = '" . $jenis_jabatan . "') ";
        }
        if ($opd != 'all') {
            $filter .= " AND (pegawai_unit_id = '" . $opd . "') ";
        }
        if ($pangkat != 'all') {
            $filter .= " AND (pegawai_pangkat_terakhir_id = '" . $pangkat . "') ";
        }
        if ($pendidikan != 'all') {
            $filter .= " AND (pegawai_pendidikan_terakhir_tingkat_id = '" . $pendidikan . "') ";
        }
        if ($agama != 'all') {
            $filter .= " AND (pegawai_agama_id = '" . $agama . "') ";
        }
        if ($eselon != 'all') {
            $filter .= " AND (pegawai_eselon_id = '" . $eselon . "') ";
        }
        if ($jk != 'all') {
            $filter .= " AND (pegawai_jenkel_id = '" . $jk . "') ";
        }
        if ($status_pegawai != 'all') {
            $filter .= " AND (pegawai_status_kepegawaian_id = '" . $status_pegawai . "') ";
        }
    }

        $sql = "SELECT pegawai.*,pangkat_golongan_pangkat
                FROM pegawai
                LEFT JOIN ref_pangkat_golongan ON pegawai.pegawai_pangkat_terakhir_id = ref_pangkat_golongan.pangkat_golongan_id
                $where
                AND pegawai_status =  '1'  $andWhere       $filter
                ";


        $sql .= " ORDER BY pegawai_pangkat_terakhir_golru DESC";

        $sLimit = ""; //limit

        $sql = $sql . $sLimit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}

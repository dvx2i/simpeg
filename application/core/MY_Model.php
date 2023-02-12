<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Copyright (C) 2016 @zanuar [yanuar@zanuar.com]
* Everyone is permitted to copy and distribute verbatim or modified copies of this license document,
* and changing it is allowed as long as the name is changed.
* DON'T BE A DICK PUBLIC LICENSE TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
* simpel dan apa adanya
 *
 */
class MY_Model extends CI_Model
{
    var $table = '';
    var $primary_key = "";
    public function __construct() {
        parent::__construct();
    }
    
    function _set_table($value) {
        $this->table = $value;
    }
    
    function _set_primary_key($value) {
        $this->primary_key = $value;
    }
                
    function get_all() {
        return $this->db->get($this->table);
    }
    
    function get_row($id) {
        $this->db->where($this->primary_key, $id);
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    function get_data($column,$search,$column_return) {
        $this->db->where($column, $search);
        $query = $this->db->get($this->table);
        if($query->num_rows()>0){
            $return = $query->row_array();
            return $return[$column_return];
        }else{
            return '';
        }
        
        
    }
    
    function get_where($where) {
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query;
    }
    
    function get_count($where=NULL) {
        if(!empty($where)){
            $this->db->where($where);
        }        
        $query = $this->db->get($this->table);
        return $query->num_rows;
    }
    
    function insert($data) {
        $row = $this->db->insert($this->table, $data);
        return $row;
    }
    
    function insert_ignore($data) {
        foreach ($data as $key => $value) {
            $datas[$key] = "'" . str_replace("'",'',$value) . "'";
        }
        $keys = array_keys($datas);
        $values = array_values($datas);

        $sql = "INSERT IGNORE INTO " . $this->table . " (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";

        $row = $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
    public function update($data, $id) {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }

    
    function get_where_custom($select,$where, $table) {
        $this->db->select($select, FALSE);
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query;
    }

    public function update_custom($data, $id, $key)
    {
        $this->db->where($key, $id);
        return $this->db->update($this->table, $data);
    }

    public function update_custom_table($data, $id, $key, $table)
    {
        $this->db->where($key, $id);
        return $this->db->update($table, $data);
    }
    
    function delete($id) {
        $this->db->where($this->primary_key, $id);
        $row = $this->db->delete($this->table);
        return $row;
    }
}
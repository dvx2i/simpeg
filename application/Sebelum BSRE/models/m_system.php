<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_system
 *
 * @author Zanuar
 */
class M_system extends CI_Model {

    //put your code here
    public function getMenu($id=NULL) {
        return $this->db->query("SELECT m.*,a.* FROM sys_menu m INNER JOIN sys_menu_action a
        ON (a.MenuActionMenuId = m.MenuId) 
INNER JOIN sys_group_detail d
        ON (d.GroupDetailMenuActionId = a.MenuActionId)        
        WHERE m.MenuId IN(SELECT MenuParentId FROM sys_menu) AND m.MenuIsShow='1' AND d.GroupDetailGroupId='$id' ORDER BY MenuOrder");
    }
    
    function getMenuAll() {
        return $this->db->query("SELECT MenuActionId,MenuId,MenuParentId,MenuName,ActionName
         FROM sys_menu_action
         	LEFT JOIN sys_menu ON MenuActionMenuId=MenuId
         	LEFT JOIN sys_action ON MenuActionActionId=ActionId
         WHERE MenuIsShow='1'
         ORDER BY MenuParentId,MenuOrder,MenuName,ActionId");
    }

    public function getMenuByIdGroup($id) {
        return $this->db->query("SELECT * FROM sys_menu WHERE MenuId IN(SELECT MenuParentId FROM sys_menu) and sys_menu.GroupId = '$id' ORDER BY MenuOrder");
    }
    public function getDataByidGroup($id) {
        return $this->db->query("SELECT GroupId,GroupName,GroupDescription,MenuName,GroupName,MenuParentId,
         	MenuId,GROUP_CONCAT(ActionName order by ActionId) as aksi
         FROM sys_group_detail
         	LEFT JOIN sys_group ON GroupId=GroupDetailGroupId
         	LEFT JOIN sys_menu_action ON GroupDetailMenuActionId=MenuActionId
         	LEFT JOIN sys_action ON MenuActionActionId=ActionId
         	LEFT JOIN sys_menu ON MenuActionMenuId=MenuId
         WHERE GroupId = '$id' AND MenuParentId!=0
         GROUP BY MenuId,GroupId
         ORDER BY GroupName");
    }
    
    function getMenuDetailByGroupId($group_id) {
        return $this->db->query("SELECT
    sys_group.GroupId
    , sys_menu.MenuName AS submenu
    ,sys_menu.MenuModule AS modul
    , CONCAT(sys_menu.MenuModule,'/', sys_action.ActionName) AS segmen
    , s.MenuName AS menu
,s.MenuId AS id
FROM
    sys_group_detail
    INNER JOIN sys_group 
        ON (sys_group_detail.GroupDetailGroupId = sys_group.GroupId)
    INNER JOIN sys_menu_action 
        ON (sys_group_detail.GroupDetailMenuActionId = sys_menu_action.MenuActionId)
    INNER JOIN sys_menu 
        ON (sys_menu_action.MenuActionMenuId = sys_menu.MenuId)
    INNER JOIN sys_action 
        ON (sys_menu_action.MenuActionActionId = sys_action.ActionId)
        INNER JOIN sys_menu s ON (sys_menu.MenuParentId = s.MenuId)
        WHERE sys_menu.MenuIsShow = '1' and GroupId = '$group_id' ORDER BY id,submenu,s.MenuOrder");
    }

    public function groupUpdate($id, $data) {
        $data['GroupUpdateUserId'] = $this->session->userdata('id');
        $this->db->where('GroupId', $id);
        return $this->db->update('sys_group', $data);
    }

    public function groupInsert($data) {
        $data['GroupAddUserId'] = $this->session->userdata('id');
        $data['GroupAddTime'] = tgljam();
        return $this->db->insert('sys_group', $data);
    }

    public function groupDelete($id) {
        $this->db->where('GroupId', $id);
        return $this->db->delete('sys_group');
    }
    
    function groupDetailInsert($data) {
        $data['GroupDetailAddUserId'] = $this->session->userdata('id');
        $data['GroupDetailAddTime'] = tgljam();
        return $this->db->simple_query("INSERT INTO `sys_group_detail` (`GroupDetailGroupId`, `GroupDetailMenuActionId`, `GroupDetailAddUserId`, `GroupDetailAddTime`) VALUES ('".$data['GroupDetailGroupId']."', '".$data['GroupDetailMenuActionId']."', '".$this->session->userdata('id')."', NOW())");
    }

    public function getSubMenu($id_menu,$idg) {
        return $this->db->query("select DISTINCT m.* from sys_menu m INNER JOIN sys_menu_action a
        ON (a.MenuActionMenuId = m.MenuId) 
INNER JOIN sys_group_detail d
        ON (d.GroupDetailMenuActionId = a.MenuActionId) WHERE m.MenuParentId ='$id_menu' AND d.GroupDetailGroupId='$idg' and m.MenuIsShow = '1' ORDER BY MenuOrder");
    }

    public function getGroupAll() {
        return $this->db->query("SELECT * FROM sys_group");
    }

    public function getGroupById($id_group) {
        return $this->db->query("SELECT
    sys_group.GroupId
    , sys_group.GroupName
    , sys_group.GroupDescription
    , sys_unit.UnitId
    , sys_group.GroupIsAdmin
    FROM
    sys_group
    INNER JOIN sys_unit 
        ON (sys_group.GroupUnitId = sys_unit.UnitId)
        WHERE sys_group.GroupId = '$id_group'")->row();
    }
    public function getGroupByIdUser($id_user) {
        return $this->db->query("SELECT
    sys_group.GroupId
    , sys_group.GroupName
    , sys_user_group.UserGroupUserId
FROM
    sys_group
    LEFT JOIN  sys_user_group
        ON (sys_user_group.UserGroupGroupId = sys_group.GroupId AND UserGroupUserId = '$id_user')");
    }

    public function getUnitAktif() {
        return $this->db->query("SELECT * FROM sys_unit where UnitIsActive='1'");
    }
    public function getUnitAll() {
        return $this->db->query("SELECT *,RPAD(TRIM(TRAILING '0' FROM unit_kode),11,'x') as hirarki_baru FROM sys_unit");
    }
    public function getUnitNameById($id) {
        return $this->db->query("SELECT UnitName as nama FROM sys_unit where UnitId='$id'")->row()->nama;
    }
    public function getUnitIdByName($name) {
        $get = $this->db->query("SELECT UnitId as nama FROM sys_unit where UnitName='$name'");
        if($get->num_rows()>0){
            return $get->row()->nama;
        }else{
            alert_set('danger', "Unit $name tidak ada di referensi");
            return null;
        }
        
    }
    public function getUnitById($unit_id) {
        
        return $this->db->query("SELECT 	UnitId, 
	UnitName, 
	UnitDescription, 
	UnitParentId, 
	UnitHirarki, 
	UnitIsActive, 
	UnitPimpinan, 
	UnitPimpinanNip, 
	UnitPimpinanJabatan, 
	UnitAlamat, 
	UnitRt, 
	UnitRw, 
	COALESCE(UnitKelurahanId,0) AS UnitKelurahanId, 
	UnitNipBendahara, 
	UnitNipPembdaftGaji, 
	UnitPokjatypeId, 
	UnitLevel, 
	UnitAddUserId, 
	UnitAddTime, 
	UnitUpdateUserId, 
	UnitUpdateTime
	 
	FROM 
	sys_unit where UnitId='$unit_id'")->row();
    }
    public function getUnitCount() {
        return $this->db->query("SELECT count(UnitId) as jumlah FROM sys_unit where UnitIsActive='1'")->row();
    }
    public function getUnitByKode($kode) {
        return $this->db->query("SELECT * FROM sys_unit where UnitHirarki='$kode'");
    }
    public function unitInsert($data) {
        $data['UnitAddUserId'] = $this->session->userdata('id');
        $data['UnitAddTime'] = tgljam();
        return $this->db->insert('sys_unit', $data);
    }
    public function unitUpdate($id,$data) {
        $data['UnitUpdateUserId'] = $this->session->userdata('id');
        $data['UnitUpdateTime'] = tgljam();
        $this->db->where('UnitId', $id);
        return $this->db->update('sys_unit', $data);
    }
    public function unitDelete($id) {
        $this->db->where('UnitId', $id);
        return $this->db->delete('sys_unit');
    }
    
    public function getSubUnitByIdUnit($id,$status=NULL) {
        $q = "select *,RPAD(TRIM(TRAILING '0' FROM pokja_hirarki),15,'x') AS hirarki_baru from ref_pokja where pokja_unit_id='$id' ";
        if(!blank($status)){
            $q.= " and pokja_status='$status' ";
        }
        return $this->db->query($q);
    }
    public function getSubUnitNameById($id) {
        return $this->db->query("select sub_unit_name as nama from sys_sub_unit where sub_unit_id='$id'")->row()->nama;
    }
    
    public function subUnitUpdate($id,$data) {
        $data['sub_unit_update_user_id'] = $this->session->userdata('id');
        $data['sub_unit_update_time'] = tgljam();
        $this->db->where('sub_unit_id', $id);
        return $this->db->update('sys_sub_unit', $data);
    }
    public function subUnitInsert($data) {
        $data['sub_unit_insert_user_id'] = $this->session->userdata('id');
        $data['sub_unit_insert_time'] = tgljam();
        return $this->db->insert('sys_sub_unit', $data);
    }
    public function pokjaUpdate($id,$data) {
        $data['update_user_id'] = $this->session->userdata('id');
        $data['update_time'] = tgljam();
        $this->db->where('pokja_id', $id);
        return $this->db->update('ref_pokja', $data);
    }
    public function pokjaInsert($data) {
        $data['insert_user_id'] = $this->session->userdata('id');
        $data['insert_time'] = tgljam();
        return $this->db->insert('ref_pokja', $data);
    }

    public function getUserAll() {
        return $this->db->query("SELECT
    u.UserId AS id
    , u.UserName AS username
    , u.UserPassword AS pass
    , GROUP_CONCAT(g.GroupName) AS groupname
    , u.UserRealName AS realname
    , IF(u.UserIsActive=1,'Aktif','Tidak Aktif') AS aktif
    FROM
    sys_user_group ug
    INNER JOIN sys_user u
        ON (ug.UserGroupUserId = u.UserId)
    INNER JOIN sys_group g
        ON (ug.UserGroupGroupId = g.GroupId)
    GROUP BY u.UserId
        ORDER BY u.UserId");
    }
    public function getUserById($id_user) {
        return $this->db->query("select * from sys_user where UserId = '$id_user'")->row();
    }
    public function getUserByUsernamePassword($username,$password) {
        return $this->db->query("SELECT
    *
FROM
    sys_user_group
    INNER JOIN sys_user 
        ON (sys_user_group.UserGroupUserId = sys_user.UserId) where sys_user.UserIsActive = '1' and sys_user.UserName='$username' and sys_user.UserPassword=md5('$password')");
    }
    public function getUserByUsername($username) {
        return $this->db->query("SELECT
    sys_user.UserId
    , sys_user_group.UserGroupId
    , sys_user.UserRealName
    , sys_user.UserName
    , sys_user.UserPassword
    , sys_user.UserIsActive
    , sys_user.UserFoto
    , sys_user.UserUnitId
    , sys_user_group.UserGroupGroupId
FROM
    sys_user_group
    INNER JOIN sys_user 
        ON (sys_user_group.UserGroupUserId = sys_user.UserId) where sys_user.UserIsActive = '1' and sys_user.UserName='$username'");
    }
    public function userUpdate($id, $data) {
        $data['UserUpdateUserId'] = $this->session->userdata('id');
        $data['UserUpdateTime'] = tgljam();
        $this->db->where('UserId', $id);
        return $this->db->update('sys_user', $data);
    }
    public function userInsert($data) {
        $data['UserAddUserId'] = $this->session->userdata('id');
        $data['UserAddTime'] = tgljam();
        return $this->db->insert('sys_user', $data);
    }
    public function userDelete($id_user) {
        $this->userGroupDelete(" where UserGroupUserId = '$id_user'");
        $this->db->where('UserId', $id_user);
        return $this->db->delete('sys_user');
    }
    public function userLastRow() {
        return $this->db->query("SELECT UserId FROM sys_user ORDER BY UserId DESC LIMIT 1")->row();
    }
    public function userGroupInsert($id_user,$id_group) {
        return $this->db->simple_query("insert into sys_user_group (UserGroupUserId,UserGroupGroupId) values ('$id_user','$id_group')");
    }
    public function userGroupDelete($where) {
        return $this->db->query("delete from sys_user_group ".$where);
    }
    
    public function getPokjaAll($limit = NULL) {
        return $this->db->query("SELECT
ref_pokja.pokja_name as sub_unit_name,pokja_hirarki as sub_unit_hirarki,pokja_id as sub_unit_id,
    sys_unit.UnitName,ref_pokja.pokja_status
FROM
    ref_pokja
    left JOIN sys_unit 
        ON (ref_pokja.pokja_unit_id = sys_unit.UnitId) ORDER BY ref_pokja.pokja_name 
        LIMIT $limit");
    }
    function getPokja($aktif=NULL) {
        $query = "select * from ref_pokja ";
        if(!blank($aktif)){
            $query .= " where pokja_status = '$aktif'";
        }
        return $this->db->query($query);
    }
    function getPokjaById($id) {
        return $this->db->query("select * from ref_pokja where pokja_id = '$id'")->row();
    }
    function getPokjaNameById($id) {
        return $this->db->query("select * from ref_pokja where pokja_id = '$id'")->row()->pokja_name;
    }
    public function getPokjaCount() {
        return $this->db->query("SELECT COUNT(sub_unit_id) AS jumlah FROM sys_sub_unit inner join sys_unit on (sys_unit.UnitId = sys_sub_unit.sub_unit_unit_id and sys_unit.UnitIsActive='1') WHERE sub_unit_status='1' AND sub_unit_name !='-' AND sub_unit_id !='0'")->row();
    }
    public function getSubUnitById($id) {
        return $this->db->query("select * from sys_sub_unit where sub_unit_id='$id'")->row();
    }
    public function getPokjaByKode($kode) {
        return $this->db->query("select * from sys_sub_unit where sub_unit_id='$kode'")->row();
    }
    public function getPokjaByIdUnit($id) {
        return $this->db->query("SELECT 	pokja_id, 
	pokja_parent_id, 
	pokja_unit_id, 
	IF(pokja_status='1',pokja_name,CONCAT('<i>',pokja_name,'</i>'))AS pokja_name, 
	pokja_hirarki, 
	pokja_pejabat, 
	pokja_nip, 
	pokja_status, 
	pokja_pokjatype_id, 
	insert_user_id, 
	insert_time, 
	update_user_id, 
	update_time
	 
	FROM 
	ref_pokja where pokja_unit_id = '$id'");
    }
    public function subUnitDelete($id) {
        $this->db->where('sub_unit_id', $id);
        return $this->db->delete('sys_sub_unit');
    }
    function getPokjaIdByIdUnitName($id_unit,$nama) {
        return $this->db->query("select * from ref_pokja where pokja_unit_id = '$id_unit' and pokja_name='$nama'")->row()->pokja_id;
    }
    
    function getBeritaAll() {
        return $this->db->query("select *,if(berita_status=1,'Aktif','Tidak Aktif') as aktif from data_berita order by berita_id desc");
    }
    function getBeritaAktif() {
        return $this->db->query("select * from data_berita where berita_status = '1' order by berita_id desc");
    }
    public function beritaInsert($data) {
        $data['insert_user_id'] = $this->session->userdata('id');
        $data['insert_time'] = tgljam();
        return $this->db->insert('data_berita', $data);
    }
    function beritaUpdate($data,$id) {
        $this->db->where('berita_id', $id);
        $data['update_user_id'] = $this->session->userdata('id');
        $data['update_time'] = tgljam();
        return $this->db->update('data_berita', $data);
    }
    function getBeritaById($id) {
        return $this->db->query("select * from data_berita where berita_id = '$id' limit 1")->row();
    }
}

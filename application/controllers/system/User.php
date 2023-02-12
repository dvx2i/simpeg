<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Zanuar
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('sys_group', 'ref_unit', 'sys_user', 'sys_user_group', 'm_pegawai'));
    }
    //put your code here
    public function index($mode = null)
    {
        if ($mode == 'nip') {

            $nip = $this->input->post('nip');
            $pegawai = $this->m_pegawai->get_row($nip);
            $status = isset($pegawai->pegawai_nip) ? TRUE : FALSE;

            if ($status) {

                if ($this->sys_user->getUserByNIP($pegawai->pegawai_nip) > 0) {
                    $status = FALSE;
                    echo json_encode(array('status' => $status, 'message' => 'NIP sudah terdaftar.'));
                } else {
                    $status = TRUE;
                    $data = array(
                        'pegawai_nama' => $pegawai->pegawai_nama,
                        'pegawai_unit_id' => $pegawai->pegawai_unit_id
                    );
                    echo json_encode($data);
                }
            } else {
                echo json_encode(array('status' => $status, 'message' => 'Data tidak ditemukan.'));
            }
        } else {
            $data['group'] = $this->sys_group->get_all();
            $data['unit'] = $this->ref_unit->get_all();
            $data['user'] = $this->sys_user->user_group();
            //        $this->loadView('progress');
            //        $data['user'] = $this->m_system->getUserAll();
            $this->loadView('system/user', $data);
        }
    }
    public function add1()
    {

        $this->loadView('system/user_add', $data);
    }
    public function update1($id_user)
    {
        $data['user'] = $this->m_system->getUserById($id_user);
        $data['group'] = $this->m_system->getGroupByIdUser($id_user);
        $data['unit'] = $this->m_system->getUnitAll();
        $this->loadView('system/user_update', $data);
    }
    public function add()
    {
        $data['user_pegawai_nip'] = $this->input->post('nama');
        $data['user_name'] = $this->input->post('nama');
        $data['user_nama_lengkap'] = $this->input->post('nama_lengkap');
        if (!blank($this->input->post('password'))) {
            $data['user_password'] = sha1($this->input->post('password'));
        }
        $data['user_unit_id'] = $this->input->post('unit');
        //        $data['UserIsActive'] = $this->input->post('status');
        $insert = $this->sys_user->insert($data);
        $group = $this->input->post('group');
        $id_user = $this->db->insert_id();
        $data1['UserGroupUserId'] = $id_user;
        $data1['UserGroupGroupId'] = $group;
        //        foreach ($group as $value) {
        $this->sys_user_group->insert($data1);
        //        }
        if (!blank($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah User Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah User Gagal"));
        }
        redirect('system/User');
    }
    public function update()
    {
        $data['user_pegawai_nip'] = $this->input->post('nama');
        $data['user_name'] = $this->input->post('nama');
        $data['user_nama_lengkap'] = $this->input->post('nama_lengkap');
        if (!blank($this->input->post('password'))) {
            $data['user_password'] = md5($this->input->post('password'));
        }
        $data['user_unit_id'] = $this->input->post('unit');
        //        $data['UserIsActive'] = $this->input->post('status');
        $insert = $this->sys_user->update($data, $this->input->post('id'));
        $group = $this->input->post('group');
        $id_user = $this->input->post('id');
        $data1['UserGroupUserId'] = $id_user;

        $where = $this->sys_user_group->get_where(array('UserGroupUserId' => $id_user))->row();
        $data1['UserGroupGroupId'] = $group;
        //        foreach ($group as $value) {
        $this->sys_user_group->update($data1, $where->UserGroupId);
        //        }
        if (!blank($insert)) {
            $this->session->set_flashdata('message', alert_show('success', "Tambah User Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Tambah User Gagal"));
        }
        redirect('system/User');
    }
    public function update_save($id_user)
    {
        $data['Username'] = $this->input->post('nama');
        $data['UserRealName'] = $this->input->post('real_name');
        if (!blank($this->input->post('password'))) {
            $data['Userpassword'] = md5($this->input->post('password'));
        }
        $data['UserUnitId'] = $this->input->post('unit');
        $data['UserIsActive'] = $this->input->post('status');
        $update = $this->m_system->userUpdate($id_user, $data);
        $group = $this->input->post('group');
        $delete = " WHERE userGroupUserId = '$id_user' ";
        foreach ($group as $value) {
            $delete .= " and UserGroupGroupId != '$value' ";
            $this->m_system->userGroupInsert($id_user, $value);
        }
        $this->m_system->userGroupDelete($delete);
        if (!blank($update)) {
            $this->session->set_flashdata('message', alert_show('success', "Update User Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Update User Gagal"));
        }
        redirect('system/User');
    }

    public function delete($id_user)
    {
        $delete = $this->sys_user->delete($id_user);
        if ($delete) {
            $this->session->set_flashdata('message', alert_show('success', "Hapus User Berhasil"));
        } else {
            $this->session->set_flashdata('message', alert_show('danger', "Hapus User Gagal"));
        }
        redirect('system/User');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of System_user_model
 *
 * @author Pravinkumar
 */
class System_user_model extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getGroups() {
        return $this->getResult($this->db->select('id,name')->get('groups'));
    }
    public function getGroupsAllDetails($id) {
       return $this->getResult($this->db->get_where('groups', array('id' => $id)));
    }
    public function getSubject(){
         return $this->getResult($this->db->select('sub_id,sub_name')->get('rs_subjects_1423552512'));
    }
    public function saveUserGroup($data) {
        if ($this->db->insert('groups', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }
    public function getUser($id) {
        return $this->getResult($this->db->get_where('system_users', array('id' => $id)));
    }

    public function getAdminMenus() {
        return $this->getResult($this->db->select('id,name')->get_where('admin_menu', array('parent_id' => 0)));
    }

    public function getAdminMenu($id) {
        return $this->getResult($this->db->get_where('admin_menu', array('id' => $id)));
    }

    public function saveSystemUser($data) {
        if ($this->db->insert('system_users', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function saveMenu($data) {
        if ($this->db->insert('admin_menu', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function saveJob($data) {
        if ($this->db->insert('rs_job', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function updateSystemUser($data, $id) {
        if ($this->db->update('system_users', $data, array('id' => $id))) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function updateAdminMenu($data, $id) {
        if ($this->db->update('admin_menu', $data, array('id' => $id))) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function updateUserGroup($data, $id) {
        if ($this->db->update('groups', $data, array('id' => $id))) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function saveSystemUserMenuAlloc($data) {
        if ($this->db->select('admin_id')->get_where('menu_alloc', array('admin_id' => $data['admin_id']))->num_rows()) {
            $id = $data['admin_id'];
            unset($data['admin_id']);
            $data['menu_ids'] = json_decode($data['menu_ids'], true);
            $data['menu_ids'] = array_filter($data['menu_ids']);
            $data['menu_ids'] = array_unique($data['menu_ids']);
            $data['menu_ids'] = json_encode($data['menu_ids']);
            if ($this->db->update('menu_alloc', $data, array('admin_id' => $id))) {
                return TRUE;
            } else {
                return false;
            }
        } else {
            if ($this->db->insert('menu_alloc', $data)) {
                return TRUE;
            } else {
                return false;
            }
        }
    }
    public function view($id, $table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id);
        $query = $this->db->get()->row();
        return $query;
    }
    public function getAllocMenus($id) {
        $rss = $this->db->get_where('group_alloc', array('group_id' => $id))->row();
        return $rss;
    }
    public function saveSystemGroupMenuAlloc($data) {
        if ($this->db->select('group_id')->get_where('group_alloc', array('group_id' => $data['group_id']))->num_rows()) {
            $id = $data['group_id'];
            unset($data['group_id']);
            $data['menu_ids'] = json_decode($data['menu_ids'], true);
            $data['menu_ids'] = array_filter($data['menu_ids']);
            $data['menu_ids'] = array_unique($data['menu_ids']);
            $data['menu_ids'] = json_encode($data['menu_ids']);
            $data['modify_by'] = $this->session->userdata('user_id');
            $data['created_by'] = $this->session->userdata('user_id');
            $data['create_date'] = date('Y-m-d h:i:s');
            $data['modify_date'] = date('Y-m-d h:i:s');
            if ($this->db->update('group_alloc', $data, array('group_id' => $id))) {
                return TRUE;
            } else {
                return false;
            }
        } else {
            if ($this->db->insert('group_alloc', $data)) {
                return TRUE;
            } else {
                return false;
            }
        }
    }
    
    public function getJobDetails($id){
        return $this->getResult($this->db->get_where('rs_job', array('id' => $id)));
    }
    
    public function updateJob($data, $id) {
        if ($this->db->update('rs_job', $data, array('id' => $id))) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function saveQuestionType($data) {
        if ($this->db->insert('rs_qtype_31052015', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function getQuestionTypeDetails($id){
        return $this->getResult($this->db->get_where('rs_qtype_31052015', array('id' => $id)));
    }
    
    public function updateQuestionType($data, $id) {
        if ($this->db->update('rs_qtype_31052015', $data, array('id' => $id))) {
            return TRUE;
        } else {
            return false;
        }
    }
    public function getWeeklyMarksDetail(){
        return $this->getResult($this->db->select('id,weekly_marks,cumulative_marks')->get('rs_weekly_marks'));
    }
    
    public function getSubNameById($id){
        return $this->getResult($this->db->select('sub_name')->get_where('rs_subjects_1423552512', array('sub_id' => $id)));
    }
    public function getUserNameById($id){
        return $this->getResult($this->db->select('UID_FirstName,UID_LastName')->get_where('rs_user_info_1423552512', array('UID' => $id)));
    }
    
    public function getAcadamicsInfo($id){
        return $this->getResult($this->db->select('academics')->get_where('rs_other_info_5072015', array('UID' => $id)));
    }
}

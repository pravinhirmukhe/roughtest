<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_model
 *
 * @author Neeta
 */
class Site_model extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('Ion_auth_model', 'ion');
    }
    
    public function bulkDelete($key, $id, $table) {
        foreach ($id as $i) {
            $r = $this->db->delete($table, array($key => $i));
        }
        return $r;
    }
    
   public function getMenus() {
        $rss = array();
        $usz = array();
        if ($this->session->userdata('group_id') != 1) {
            $us = $this->db->select('menu_ids')->get_where('menu_alloc', array('admin_id' => $this->session->userdata('user_id')))->row();
            if (!empty($us)) {
                $usx = json_decode($us->menu_ids, true);
                foreach ($usx as $u) {
                    $i = explode(":", $u);
                    $usz[] = $i[1];
                }
            }
        }
        $this->db->where('parent_id', 0);
        if (!empty($usz)) {
            $this->db->where_in('id', $usz);
        }
        $rs = $this->db->get('admin_menu')->result();
        $i = 0;
        foreach ($rs as $r) {
            $rss[$i] = $r;
            $this->db->where('parent_id', $r->id);
            if (!empty($usz)) {
                $this->db->where_in('id', $usz);
            }
            $rss[$i++]->nodes = $this->db->get('admin_menu')->result();
        }
        return $rss;
    }
    public function getAllocMenus($id) {
        $rss = $this->db->get_where('menu_alloc', array('admin_id' => $id))->row();
        return $rss;
    }
    public function setStatus($key, $id, $table) {
        $status1 = $this->db->select('status')->from($table)->where($key, $id)->get()->row()->status;
        $status = ($status1 == 'Active') ? 'Deactive' : 'Active';
        $r = $this->db->update($table, array('status' => $status), array($key => $id));
        return $r;
    }
     public function setUStatus($key, $id, $table) {
        $status1 = $this->db->select('active')->from($table)->where($key, $id)->get()->row()->active;
        $status = ($status1 == 1) ? 0 : 1;
        $r = $this->db->update($table, array('active' => $status), array($key => $id));
        return $r;
    }

}

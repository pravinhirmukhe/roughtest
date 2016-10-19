<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rank_model
 *
 * @author comc
 */
class Rank_model extends MY_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getPaymentDetails($id) {
       //return $this->getResult($this->db->get_where('rs_recruiter_payment_info', array('recruiter_id' => $id)));
       $query = $this->db->query("SELECT id,payment_date,expiry_date FROM rs_recruiter_payment_info WHERE recruiter_id = '".$id."' and CURDATE() between payment_date and expiry_date");
       return $query->result_array();
    }
    
    public function getprivacyData($id) {
       return $this->getResult($this->db->select('id,settings')->get_where('rs_privacy', array('UID' => $id)));
       
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * @author Pravinkumar
 */
class MY_Model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getResult($data) {
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rank_controller
 *
 * @author Pravinkumar
 */
class Rank_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getRanking() {
        $res = array();
        $i = 0;
        foreach ($this->site->getAllSubIds() as $r) {
            $res[$i] = array('sub_id' => $r, 'subname' => $this->site->getSubName($r));
            $i++;
        }
        echo json_encode(array('ids' => $res));
    }

    public function getRankingDomains() {
        $this->load->view('templates/rankDomain', array('subid' => $_POST['subid']));
    }

    public function getRankingTypes() {
        $this->load->view('templates/rankType', array('subid' => $_POST['subid'], 'type' => $_POST['type']));
    }

    public function getGenerateRanks() {
        $this->load->view('templates/rank', "");
    }

    

}
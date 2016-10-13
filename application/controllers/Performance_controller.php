<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Performance_controller
 *
 * @author Pravinkumar
 */
class Performance_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getPerformance() {
        $uid = $this->session->userdata('UID');
        $q = $this->db->get(SUBJECTS);
        echo json_encode(array('s' => '1', 'data' => $q->result()));
    }

    public function getGraph() {
        $uid = $this->session->userdata('UID');
        $this->session->set_userdata('subid_graph', $_REQUEST['subid']);
        echo "<iframe src='" . SITEURL . "Performance_controller/showgraph' width='100%' height='60%' style='border:none;' /><br><br><br><br><br>";
    }

    public function getRankGraph() {
        $uid = $this->session->userdata('UID');
        $this->session->set_userdata('subid_graph', $_REQUEST['subid']);
        echo"<iframe src='" . SITEURL . "Performance_controller/showrankgraph' width='100%' height='60%' style='border:none;' /><br><br><br><br><br>";
    }

    public function getRankGraphPC() {
        $uid = $this->session->userdata('UID');
        $this->session->set_userdata('subid_graph', $_REQUEST['subid']);
        echo"<iframe src='" . SITEURL . "Performance_controller/showrankgraphpc' width='100%' height='60%' style='border:none;' /><br><br><br><br><br>";
    }

    public function getRankGraphW() {
        $uid = $this->session->userdata('UID');
        $this->session->set_userdata('subid_graph', $_REQUEST['subid']);
        echo"<iframe src='" . SITEURL . "Performance_controller/showrankgraphw' width='100%' height='60%' style='border:none;' /><br><br><br><br><br>";
    }

    public function getRankGraphC() {
        $uid = $this->session->userdata('UID');
        $this->session->set_userdata('subid_graph', $_REQUEST['subid']);
        echo"<iframe src='" . SITEURL . "Performance_controller/showrankgraphc' width='100%' height='60%' style='border:none;' /><br><br><br><br><br>";
    }

    public function changepermonth() {
        $subid = $_REQUEST['subid'];
        $type = $_REQUEST['type'];
        $month_arr = explode("-", $this->session->userdata('perfMonth'));
        $month = $month_arr[0];
        $year = $month_arr[1];
        if ($type == 'NEXT') {
            if ($month < 1) {
                $month = 1;
            } elseif ($month == 12) {
                $month = 1;
                $year++;
            } else {
                $month++;
            }
        } else {
            if ($month > 12) {
                $month = 12;
            } elseif ($month == 1) {
                $month = 12;
                $year--;
            } else {
                $month--;
            }
        }
//        $_SESSION['perfMonth'] = $month . '-' . $year;
        $this->session->set_userdata('perfMonth', $month . '-' . $year);
    }

    public function showgraph() {
        $this->load->view('templates/graph');
    }

    public function showrankgraph() {
        $this->load->view('templates/rankgraph');
    }

    public function showrankgraphpc() {
        $this->load->view('templates/rankgraphpc');
    }

    public function showrankgraphw() {
        $this->load->view('templates/rankgraphw');
    }

    public function showrankgraphc() {
        $this->load->view('templates/rankgraphc');
    }

}

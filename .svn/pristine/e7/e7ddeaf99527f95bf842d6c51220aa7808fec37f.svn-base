<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Focus_controller
 *
 * @author Pravinkumar
 */
class Focus_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getFocusArea() {
        $uid = $this->session->userdata('UID');
        $subjects_q = $this->db->get_where(SUBJECTS);
        $s_c = $subjects_q->num_rows();
        $sub_ids = array();
        $id_p = 0;
        $s_rev = 0;
        $i = 0;
        $data = array();
        foreach ($subjects_q->result_array() as $subjects_d) {
            $data[$id_p] = $subjects_d;
            $data[$id_p]['subname'] = $this->site->getSubName($data[$id_p]['sub_id']);
            $sub_ids[$id_p] = $subjects_d['sub_id'];
            $tid_arr = $this->site->getAllTopicIds($subjects_d['sub_id']);
            $tid_str = "";
            $data[$id_p]['tname'] = array();
            $sub_s_rev = 0;
            foreach ($tid_arr as $tid) {
                $tid_q = $this->db->get_where(DPP_LOG, array('UID' => $uid, 'sub_id' => $tid));
                $tid_d = (array) $tid_q->row();
                if ($tid_q->num_rows() > 0) {
                    $dpp_data = json_decode($tid_d['data']);
                    $dpp_count = count($dpp_data) - 1;
                    $marks = 0;
                    if ($dpp_count <= 0) {
                        goto skip_sub;
                    } elseif ($dpp_count == 1) {
                        $c = $dpp_data[0][0];
                        $i = $dpp_data[0][1];
                        $marks = $c * 3 - $i;
                    } else {
                        $c = $dpp_data[$dpp_count][0] + $dpp_data[$dpp_count - 1][0];
                        $i = $dpp_data[$dpp_count][1] + $dpp_data[$dpp_count - 1][1];
                        $marks = $c * 3 - $i;
                    }
                    if ($marks < 6) {
                        $t_name = $this->site->getTopicName($tid);
                        array_push($data[$id_p]['tname'], array('n' => $t_name));
                        $s_rev++;
                        $sub_s_rev++;
                    }
                    skip_sub:
                }
            }

            $data[$id_p]['sub_s'] = $sub_s_rev;
            $id_p++;
        }
        if ($s_rev == 0) {
            echo json_encode(array('s' => '0', 's_rev' => $s_rev));
        } else {
            echo json_encode(array('s' => '1', 'data' => $data));
        }
    }

}

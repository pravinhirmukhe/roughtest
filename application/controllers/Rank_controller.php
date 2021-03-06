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

    public function rankalgo() {
        $week_arr = array(
            "Mon" => 0
            , "Tue" => 1
            , "Wed" => 2
            , "Thu" => 3
            , "Fri" => 4
            , "Sat" => 5
            , "Sun" => 6
        );
        $timestamp = time();
        $datetime = new DateTime();
        $datetime->setTimestamp($timestamp);
        $datetime->modify('-7 day');
        $before_week_timestamp = strtotime($datetime->format("Y-m-d"));
        $week_val = $week_arr[date('D', $before_week_timestamp)];
        $week_val_seconds = $week_val * 24 * 60 * 60;
        $before_week_monday_val = $before_week_timestamp - $week_val_seconds;
        $before_week_date_arr['Mon'] = date('Y-m-d', $before_week_monday_val);
        $before_week_timestamp_arr['Mon'] = $before_week_monday_val;
        for ($i = 1; $i <= 6; $i++) {
            $before_week_date_arr[array_search($i, $week_arr)] = date('Y-m-d', $before_week_monday_val + ($i * 24 * 60 * 60));
            $before_week_timestamp_arr[array_search($i, $week_arr)] = $before_week_monday_val + ($i * 24 * 60 * 60);
        }
        /*
          //printing dates with week day value
          foreach($before_week_timestamp_arr as $key => $val){
          echo date('Y-m-d',$val) . date('D',$val) . '<br>';
          }
         */
        $max_marks = 30;
        $min_marks = -10;
        $user_q = $this->db->select('UID')->get(LOGIN_TABLE);
//                mysql_query('select UID from ' . LOGIN_TABLE) or die(mysql_error());
        $user_data = array(); //Format: arr[UID][sub_id]=>val
        $sub_arr = $this->site->getAllSubIds();
        foreach ($user_q->result_array() as $user_d) {
            $current_uid = $user_d['UID'];
            foreach ($sub_arr as $sub_key => $sub_id) {
                if ($this->site->chk_dpp_flag_for_subject($current_uid, $sub_id)) {
                    $data = null;
                    $dpp_time = null;
                    $data = $this->site->getDppData($current_uid, $sub_id);
                    $dpp_time = $data['dpp_dates'];
                    foreach ($before_week_date_arr as $key => $val) {
                        $date_arr = null;
                        $date_arr = array_keys($dpp_time, $val);
                        if ($date_arr != null || !empty($date_arr)) {
                            $counter = 0;
                            $value = 0;
//			print_r($date_arr);
//			print_r($data['dpp_data']);
                            foreach ($date_arr as $key1 => $val1) {
                                $value = $value + $data['dpp_data'][$val1][0];
                                $counter++;
                            }
                            $value = $value / $counter;
                            if (isset($user_data[$current_uid][$sub_id])) {
                                $user_data[$current_uid][$sub_id] = ($user_data[$current_uid][$sub_id] + $value) / 2;
                            } else {
                                $user_data[$current_uid][$sub_id] = $value;
                            }
                        }//if ends
                    }//foreach
                }//foreach -- sub arr
            }//if user has given sub dpp
        }//user q while loop ends
//calculating avg2 key for table rs_weekly_marks
        foreach ($user_data as $uid => $d_arr) {
            foreach ($d_arr as $s_id => $m) {
                if (isset($avg2[$s_id])) {
                    $avg2[$s_id] = ($avg2[$s_id] + $m) / 2;
                } else {
                    $avg2[$s_id] = $m;
                }
            }
        }
//calculating avg1
        foreach ($user_data as $uid => $a) {
            foreach ($sub_arr as $sub_key => $sub_id) {
                if ($this->site->chk_dpp_flag_for_subject($uid, $sub_id)) {
                    $value_1 = $this->site->getLatestDppMarksForAvg1($uid, $sub_id);
                    if ($value_1 > $avg2[$sub_id]) {
                        $avg1[$uid][$sub_id] = $avg2[$sub_id];
                    } else {
                        $avg1[$uid][$sub_id] = $value_1;
                    }
                } else {
                    echo"here";
                }
            }
        }
//calc cm_enc and done.
        $wm_enc = json_encode($user_data);
        $cm_enc = json_encode($avg1);
        $time = time();
        $insertdata = array(
            'weekly_marks' => $wm_enc,
            'cumulative_marks' => $cm_enc,
            'timestamp' => $time,
        );
        $x = $this->db->insert('rs_weekly_marks', $insertdata);
        return $x;
//        mysql_query("insert into rs_weekly_marks(weekly_marks,cumulative_marks,timestamp) Values('$wm_enc','$cm_enc','$time')") or die(mysql_error());
    }

}

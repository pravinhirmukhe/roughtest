<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Practice_controller
 *
 * @author Pravinkumar
 */
class Practice_controller extends MY_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getTPPS() {
        $uid = $this->session->userdata('UID');
//DPP
        $new_d1 = (array) $this->db->get_where(READ_LOG, array('UID' => $uid))->row();
////        $new_q1 = mysql_query("SELECT * FROM " . READ_LOG . " WHERE UID='$uid'") or die(mysql_error());
////        $new_d1 = mysql_fetch_assoc($new_q1);
//        echo"<div class='panel panel-default glass' style='border-color:#25af60;'>
//  <div class='panel-heading glass' style='background:#25af60;color:#fff'><h3 class='panel-title'><center>Today’s Daily Practice Problem Sheets</center></h3></div>
//  <div class='panel-body'><ul class='list-group'>";
        $kc_arr = json_decode($new_d1['kc']);
        if (is_array($kc_arr)) {
            $sub_arr = array();
            $t_arr = array();
            $sub_name_arr = array();
            $pos = 0;
            foreach ($kc_arr as $key => $val) {
                $s_id = $this->site->getSubId($val);
                $msg = $this->site->validStatus($s_id);
                error_log("Subject Id : $s_id :: " . $msg);
                if ($msg == "VALID") {
                    if (!in_array($s_id, $sub_arr)) {
                        $sub_name = $this->site->getSubName($s_id);
                        $sub_name_arr[$pos] = $sub_name;
                        $t_arr[$pos] = $val;
                        $sub_arr[$pos] = $s_id;
                        $pos++;
                    } else {
                        $p_subid = array_search($s_id, $sub_arr);
                        $t_arr[$p_subid] = $val;
                    }
//echo"<li style='margin-top:0px;' style='color:#333;list-style: none;width:100%;height:34px;border:1px #eee solid;padding-left:10px;padding-top:3px;'><a onclick='getdpp(" . $val . ")'>$sub_name</a></li>";
                }
            }
            $t_pos = 0;
            $subjects = array();
            foreach ($sub_arr as $key => $val) {
                $subjects[] = array('sub_id' => $t_arr[$t_pos], 'sub_name' => $sub_name_arr[$t_pos]);
//                echo"<li class='panel-heading' style='font-size:16px;list-style: none;width:100%;border-radius:4px;border:1px #eee solid;padding-left:20px;cursor:pointer;padding:8px;margin-bottom:3px;padding-left:15px;'><a data-toggle='modal' style='color:#333;' data-target='.exam_inst' onclick='instructionsDppTpp(\"DPP\"," . $t_arr[$t_pos] . ")'>$sub_name_arr[$t_pos]</a></li>";
                $t_pos++;
            }
//            if ($t_pos == 0) {
//                echo"<div class='alert alert-info' style='font-size:18px;'><center><p>No pending Daily Practice Problem Sheets.</p></center></div>";
//            }
            echo json_encode(array('s' => '1', 'sub' => $subjects, 'tp' => $t_pos));
        } else {
            echo json_encode(array('s' => '0'));
//            echo "<div class='alert alert-info' style='font-size:18px;'><center><p>No pending Topic Practice Problem Sheets.</p></center></div>";
        }
//        echo"</ul></div></div>";
    }

    public function getTPP() {
        $uid = $this->session->userdata('UID');
//TPP
        $new_d = (array) $this->db->get_where(READ_LOG, array('UID' => $uid))->row();
//        $new_q = mysql_query("SELECT * FROM " . READ_LOG . " WHERE UID='$uid'") or die(mysql_error());
//        $new_d = mysql_fetch_assoc($new_q);
        $kc_arr = json_decode($new_d['kc']);
        $kc_time_arr = unserialize($new_d['kc_time']);
        $exam_count = 0; // used to check no of pending tests.
        $tpp = array();
        if (is_array($kc_arr)) {
            foreach ($kc_arr as $key => $val) {
//echo"$key __  $val";
                $kc_time_4_topic = $kc_time_arr[$val];
//echo "___ $kc_time_4_topic";
                if (!empty($kc_time_4_topic)) {
                    $kc_time_format = new DateTime(date("Y-m-d H:i:s", $kc_time_4_topic));
                    $now = new DateTime(date("Y-m-d H:i:s"));
//                            $d1=new DateTime("2015-07-24 23:14:31");
//$d2=new DateTime("2012-07-07 11:14:15.889342");
                    $diff = $kc_time_format->diff($now);
//print_r($diff);
                    $sub_4_topic = $this->site->getSubId($val);
                    if ($diff->days >= 7) {

                        $t_d = (array) $this->db->get_where(TOPICS, array('topic_id' => $val))->row();
//                        $t_q = mysql_query("select * from " . TOPICS . " where topic_id='$val'") or die(mysql_error());
//                        $t_d = mysql_fetch_assoc($t_q);
                        $tpp[] = array('tid' => $val, 'tname' => $t_d[topic_name]);
//                        echo"<li class='panel-heading' style='font-size:16px;list-style: none;width:100%;border-radius:4px;border:1px #eee solid;padding-left:20px;cursor:pointer;padding:8px;margin-bottom:3px;padding-left:15px;'><a data-toggle='modal' style='color:#333;' data-target='.exam_inst' onclick='instructionsDppTpp(\"TPP\"," . $val . ")'>$t_d[topic_name]</a></li>";
                        $exam_count++;
                    }
                }
            }
            echo json_encode(array('s' => '1', 'tpp' => $tpp, 'exam_count' => $exam_count));
//            if ($exam_count == 0) {
//                echo"<div class='alert alert-info' style='font-size:18px;'><center><p>No pending Topic Practice Problem Sheets.</p></center></div>";
//            }
        } else {
            echo json_encode(array('s' => '0'));
//            echo"<div class='alert alert-info'  style='font-size:18px;'><center><p>You haven't read any topic yet.</p></center></div>";
        }
//        echo"</ul></div></div>";
    }

}

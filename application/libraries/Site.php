<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site
 *
 * @author Pravinkumar
 */
class Site {

//put your code here
    var $data = null;
    var $ci = null;

    public function __get($var) {
        return get_instance()->$var;
    }

    public function __construct() {
        $this->ci = &get_instance();
    }

    public function encryptPass($pass) {
        $salt = $this->config->item('salt');
        return md5($pass . $salt);
    }

    function str_encrypt_n_decrypt($string, $function_type) {
        $return_str = null; //setting up variable with `null` value.
        if ($function_type == 'enc') {
            $return_str = base64_encode($string);
        }
        if ($function_type == 'dec') {
            $return_str = base64_decode($string);
        }
        return $return_str;
    }

    function getInviteCode() {
        $uid = $this->ci->session->userdata('UID');
        $d = $this->ci->db->select('invitation_code')->get_where(USER_INFO, array('UID' => $uid))->row()->invitation_code;
        return $d;
    }

    function getInviteCodeUsed() {
        $uid = $this->ci->session->userdata('UID');
        $u_q = $this->ci->db->select('UID_FirstName,UID_LastName,UID_Email')->get_where(USER_INFO, array("ic_used_UID" => $uid))->result_array();
//        $d = $u_q = mysql_query("select UID_FirstName,UID_LastName,UID_Email from " . USER_INFO . " where ic_used_UID='$_SESSION[UID]'") or die(mysql_error());
        return $u_q;
    }

    function getTopicName($tid) {
        return $this->ci->db->select('topic_name')->get_where(TOPICS, array('topic_id' => $tid))->row()->topic_name;
    }

    function getSubName($sub_id) {
        return $this->ci->db->select('sub_name')->get_where(SUBJECTS, array('sub_id' => $sub_id))->row()->sub_name;
    }

    function getSubId($tid) {
        return $this->ci->db->select('sub_id')->get_where(TOPICS, array('topic_id' => $tid))->row()->sub_id;
    }

    function get_pic_name() {
        return $this->ci->session->userdata('UID_Pro_Pic');
    }

    function getKc($topic) {
        return $this->ci->db->select('kc_text')->get_where(KEY_CONCEPTS, array('topic_id' => $topic))->row()->kc_text;
    }

    function updateDppFlag($c, $i, $u) {
//update dpp flag
//c: correct, i: incorrect, u: unattempted, a: accuracy
//calculating accuracy
        $acc_tot = $c + $i;
        $acc_perc = $c * 100 / $acc_tot;
//accuracy calculated
        $uid = $this->ci->session->userdata('UID');
        $topicid = $this->ci->session->userdata('topic_id');
        $subid = $this->getSubId($topicid);
        $ex_q = $this->ci->db->get_where(DPP_LOG, array('UID' => $uid, 'sub_id' => $subid));
//        $ex_q = mysql_query("SELECT * FROM " . DPP_LOG . " WHERE UID='$uid' and sub_id='$subid'") or die(mysql_error());
//        $ex_d_count = mysql_num_rows($ex_q);
        if (!isset($acc_perc) || $acc_perc == null || $acc_perc == "" || $acc_perc == false) {
            $acc_perc = 0;
        }
        if ($ex_q->num_rows() == 0) {
            $dpp_arr = array();
            $dpp_arr[0] = array($c, $i, $u, $acc_perc);
            $dpp_time_arr[0] = strtotime(date("H:i:s"));
            $enc_dpp_arr = json_encode($dpp_arr);
            $enc_dpp_time_arr = json_encode($dpp_time_arr);
            $this->ci->db->insert(DPP_LOG, array('UID' => $uid, 'sub_id' => $subid, 'data' => $enc_dpp_arr, 'dpp_time' => $enc_dpp_time_arr));
//            mysql_query("INSERT INTO " . DPP_LOG . "(UID,sub_id,data,dpp_time) VALUES('$uid','$subid','$enc_dpp_arr','$enc_dpp_time_arr')") or error_log(mysql_error());
        } else {
            $ex_d = (array) $ex_q->row();
            $dpp_arr = json_decode($ex_d['data']);
            $dpp_arr_count = count($dpp_arr);
            $dpp_time_arr = json_decode($ex_d['dpp_time']);
            $data_arr_formation = array($c, $i, $u, $acc_perc);
            //$enc_data_arr_formation=json_encode($data_arr_formation);
            $dpp_arr[$dpp_arr_count] = $data_arr_formation;
            $dpp_time_arr[$dpp_arr_count] = strtotime(date("H:i:s"));
            $enc_dpp_arr = json_encode($dpp_arr);
            $enc_dpp_time_arr = json_encode($dpp_time_arr);
            $this->ci->db->update(DPP_LOG, array('data' => $enc_dpp_arr, 'dpp_time' => $enc_dpp_time_arr), array('UID' => $uid, 'sub_id' => $subid));
//            mysql_query("Update " . DPP_LOG . " set data='$enc_dpp_arr', dpp_time='$enc_dpp_time_arr' where UID='$uid' and sub_id='$subid'") or die(mysql_error());
        }
    }

    function updateExFlag() {
        //update exercise flag
        $uid = $this->ci->session->userdata('UID');
        $ex_type = $this->ci->session->userdata('ex_type');
        $topicid = $this->ci->session->userdata('topic_id');
        $ex_d = (array) $this->ci->db->get_where(READ_LOG, array('UID' => $uid))->row();
//        $ex_q = mysql_query("SELECT * FROM " . READ_LOG . " WHERE UID='$uid'") or die(mysql_error());
//        $ex_d = mysql_fetch_assoc($ex_q);
        $ex_str = "e$ex_type";
        $ex_arr = json_decode($ex_d[$ex_str]);
        if (is_array($ex_arr)) {
            $ex_count = count($ex_arr);
            if (!in_array($topicid, $ex_arr)) {
                $ex_arr[$ex_count] = $topicid;
            }
        } else {
            $ex_arr[0] = $topicid;
        }
        $enc_ex_arr = json_encode($ex_arr);
        if ($this->ci->db->update(READ_LOG, array("e$ex_type" => $enc_ex_arr), array('UID' => $uid))) {
            
        } else {
            echo "Couldnt update exercise";
        }
    }

    function getFriendsAndRequests() {
        $uid = $this->ci->session->userdata('UID');
        $friends_data = (array) $this->ci->db->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
        return $friends_data;
    }

    function getUserInfo($uid) {
        $f_d_fetch = (array) $this->ci->db->get_where(USER_INFO, array('UID' => $uid))->row();
//        $f_d_query = mysql_query("select * from " . USER_INFO . " where UID='$uid'") or die(mysql_error());
//        $f_d_fetch = mysql_fetch_assoc($f_d_query);
        return $f_d_fetch;
    }

    function validStatus($sid) {
        $uid = $this->ci->session->userdata('UID');
        $topic_id_arr = $this->getAllTopicIds($sid);
        $msg = "VALID";
        foreach ($topic_id_arr as $k => $tid) {
            //error_log("tia : $tid ::" . print_r($topic_id_arr,true));
            $q = $this->ci->db->get(DPP_LOG, array('UID' => $uid, 'sub_id' => $sid));
//            $q = mysql_query("select * from " . DPP_LOG . " where UID='$uid' and sub_id='$sid'") or die(mysql_error());
//            $c = mysql_num_rows($q);
            if ($q->num_rows() != 0) {
                $d = (array) $q->row();
                $dpp_arr = json_decode($d['dpp_time']);
                $dpp_arr_c = count($dpp_arr);
                $dpp_arr_c--;
                //error_log("DPP TIME : $tid ::" . print_r($dpp_arr,true));
                $now = new DateTime(date("Y-m-d H:i:s"));
                $dpp_time = new DateTime(date("Y-m-d H:i:s", $dpp_arr[$dpp_arr_c]));
                $diff = $dpp_time->diff($now);
                //error_log("DIFF : > " . $diff->days);
                $tot_days = $diff->days;
                if ($tot_days <= 0) {
                    $msg = "INVALID";
                    goto RET_MSG;
                }
            }
        }
        /*
          $q=mysql_query("select * from " . DPP_LOG . " where UID='$uid' and topic_id='$tid'") or die(mysql_error());
          $c=mysql_num_rows($q);
          if($c==0){
          $msg="VALID";
          }
          else{
          $d=mysql_fetch_assoc($q);
          $dpp_arr=json_decode($d['dpp_time']);
          $dpp_arr_c=count($dpp_arr);
          $dpp_arr_c--;
          $latest_dpp_time=new DateTime(date("Y-m-d H:i:s","$dpp_arr[$dpp_arr_c]"));
          $now=new DateTime(date("Y-m-d H:i:s"));
          $diff=$latest_dpp_time->diff($now);
          if($diff->days >= 1){
          $msg="VALID";
          }
          else{
          //day hasnt past yet
          $msg="INVALID";
          }
          }
         */
        RET_MSG:
        return $msg;
    }

    function getAllTopicIds($sub_id) {
        //get all topic ids where $tid lies
        $q = $this->ci->db->select('topic_id')->get_where(TOPICS, array('sub_id' => $sub_id));
//        $q = mysql_query("select topic_id from " . TOPICS . " Where sub_id='$sub_id'") or die(mysql_error());
        $id_arr = array();
        $p = 0;
        foreach ($q->result_array() as $d) {
            $id_arr[$p] = $d['topic_id'];
            $p++;
        }
        return $id_arr;
    }

    function checkIntroStatus($val) {
        //val => qid
        $intro_data = (array) $this->ci->db->select('Introduction')->get_where(QUESTIONS, array('id' => $val))->row();
//        $Question_intro_check_q = mysql_query("select Introduction from " . QUESTIONS . " where id='$val'") or die(mysql_error());
//        $intro_data = mysql_fetch_assoc($Question_intro_check_q);
        if ($intro_data['Introduction'] == "" || $intro_data['Introduction'] == null || empty($intro_data['Introduction'])) {
            $msg = false;
        } else {
            $msg = true;
        }
        return $msg;
    }

    function getRemainingIds($qid) {
        //for intro ques
        $q_ids = (array) $this->ci->db->select('id')->get_where(QUESTIONS, array('Introduction' => "( SELECT Introduction FROM " . QUESTIONS . " where id=$qid )"))->result_array();
//        $q_ids = mysql_query("select id from " . QUESTIONS . " where Introduction=(SELECT Introduction FROM " . QUESTIONS . " where id=$qid ) ") or error_log(mysql_error());
        $ids = array();
        $p = 0;
        foreach ($q_ids as $q_d) {
            $ids[$p] = $q_d['id'];
            $p++;
        }
        return $ids;
    }

    function getAllSubIds() {
        $q = $this->ci->db->select('sub_id')->get(SUBJECTS)->result_array();
        $sub_arr = array();
        foreach ($q as $d) {
            $sub_arr[] = $d['sub_id'];
        }
        return $sub_arr;
    }

    function getAllUID() {
        $q = $this->ci->db->select('UID')->get(LOGIN_TABLE)->result_array();
//        $q = mysql_query("select UID from " . LOGIN_TABLE) or die(mysql_error());
        $uid_arr = array();
        foreach ($q as $d) {
            $uid_arr[] = $d['UID'];
        }
        return $uid_arr;
    }

    function getRespectiveMarksArr($type) {
        if ($type != "cumulative" && $type != "weekly") {
            die('Incorrective Type');
        }
        $type = $type . '_marks';
        $q = $this->db->select($type)->order_by('id', 'desc')->limit(1)->get('rs_weekly_marks');
        $d = (array) $q->row();
       
        return json_decode($d["$type"]);
    }

    function getCities() {
        return $this->db->select('id,city_name')->order_by('city_name', 'asc')->get(CITIES)->result();
    }

    function getInstitutes() {
        return $this->db->select('id,institute')->order_by('institute', 'asc')->get(INSTITUTE)->result();
    }

    function getBranches() {
        return $this->db->select('id,branch_name')->order_by('branch_name', 'asc')->get(BRANCHES)->result();
    }

    function getPayGetWay() {
        return $this->db->get_where('rs_paygateway', array('status' => "Active"))->row();
    }

    function chk_dpp_flag_for_subject($uid, $subid) {
        $c = $this->db->where(array('sub_id' => $subid, 'UID' => $uid))->count_all(DPP_LOG);
        if ($c > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getDppData($user, $sub_id) {
        $q = $this->db->select('data,dpp_time')->get_where(DPP_LOG, array('UID' => $user, 'sub_id' => $sub_id));
//        $q = mysql_query("select data,dpp_time from " . DPP_LOG . " where UID=$user and sub_id=$sub_id ") or die(mysql_error());
        $d = (array) $q->row();
        $dpp_data = json_decode($d['data']);
        $dpp_time = json_decode($d['dpp_time']);
        $dpp_dates = array();
        foreach ($dpp_time as $key => $val) {
            $dpp_dates[$key] = date('Y-m-d', $val);
        }
        $data['dpp_data'] = $dpp_data;
        $data['dpp_dates'] = $dpp_dates;
        return $data;
    }

    function getLatestDppMarksForAvg1($uid, $subid) {
        $dpp_data = $this->getDppData($uid, $subid);
        $time_count = count($dpp_data['dpp_dates']);
        $time_count--;
        $time_count;
        $control_unit = 4;
        $control_counter = 0;
        $value = 0;
        for ($i = $time_count; $i >= 0; $i--) {
            if ($control_counter >= $control_unit) {
                break;
            } else {
                $value = $value + $dpp_data[$i][0]; //correct marks value from dpp data.
            }
            $control_counter++;
        }
        return $value / $control_counter;
    }

}

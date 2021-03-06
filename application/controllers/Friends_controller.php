<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Friends_controller
 *
 * @author Pravinkumar
 */
class Friends_controller extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getFriends() {
        $uid = $this->session->userdata('UID');
        $friends_data = $this->site->getFriendsAndRequests();
        $existing_friends_encarr = $friends_data['F_UID'];
        $friends_requests_encarr = $friends_data['FR_UID'];
        if (isset($just_requests)) {
            goto REQUESTS;
        }
        FRIENDS:
        $menu_f_arr = json_decode($existing_friends_encarr);
        $f_count = count($menu_f_arr);
        if ($f_count == 0) {
            $f_count = "";
        }
        REQUESTS:
        $menu_fr_arr = json_decode($friends_requests_encarr);
        $fr_count = count($menu_fr_arr);
        if ($fr_count == 0) {
            $fr_count = "";
        }
        if ($f_count == 0) {
            echo json_encode(array('s' => "2", 'data' => "No Friends !", 'imgpath' => IMGURL));
        } else {
            $rss = array();
            $i = 0;
            //printing friends profile
            foreach ($menu_f_arr as $val) {
                $f_d_fetch = $this->site->getUserInfo($val);
                $rss[$i] = $f_d_fetch;
                $rss[$i]['val'] = $val;
                $i++;
            }
            $inv = $this->site->getData(USER_INFO, array('UID' => $uid), 'invitation_code');
            $invite = array(
                'link' => SITEURL,
                'img' => USERASSETS . "img/rs_logo_1.png",
                'name' => "Invite in Rough sheet.",
                'caption' => "Invitation.",
                'caption' => "Invitation.",
                'msg' => "Here is invitation code for free signup on roughsheet website. \"" . $inv . "\""
            );
            echo json_encode(array('s' => "1", 'data' => $rss, 'imgpath' => IMGURL, 'invite' => $invite));
        }
    }

    public function getProfile() {
        $fid = isset($_POST['fid']) ? $_POST['fid'] : $this->session->userdata('UID');
        $prof = $this->db->get_where(USER_INFO, array('UID' => $fid))->row();
        $other_info = (array) $this->db->get_where(OTHER_INFO, array('UID' => $fid))->row();
//        $other_info_q = mysql_query("select * from " . OTHER_INFO . " where UID='$fid'") or error_log(mysql_error());
//        $other_info = mysql_fetch_assoc($other_info_q);
        $prof_info = array();
        $academics = array();
        $achievements = array();
        $certificates = array();
        $social_work = array();
        $sports = array();
        $extra = array();
        $documents = array();
        $prof_info = json_decode($other_info['prof_arr'], true);
        $academics = json_decode($other_info['academics'], true);
        $achievements = json_decode($other_info['achievements'], true);
        $certificates = json_decode($other_info['certificates'], true);
        $social_work = json_decode($other_info['social_work'], true);
        $extra = json_decode($other_info['extra'], true);
        $sports = json_decode($other_info['sports'], true);
        $documents = json_decode($other_info['documents'], true);
        if (!empty($prof_info)) {
            foreach ($prof_info as $k => $v) {
                $sy[$k] = $v['start_year'];
                $sm[$k] = $v['start_month'];
            }
            array_multisort($sy, SORT_DESC, $sm, SORT_DESC, $prof_info);
            error_log(print_r($prof_info, true));
        }
        $other_info['prof_info'] = $prof_info;
        $other_info['academics'] = $academics;
        $other_info['achievements'] = $achievements;
        $other_info['certificates'] = $certificates;
        $other_info['social_work'] = $social_work;
        $other_info['extra'] = $extra;
        $other_info['sports'] = $sports;
        $other_info['documents'] = $documents;
        $setting = $this->db->get_where(PRIVACY, array('UID' => $this->session->userdata('UID')));
        $set = $setting->num_rows() ? json_decode($setting->row()->settings) : "0";
        $permission = "0";
        if ($_POST['fid'] != $this->session->userdata('UID')) {
            $ids = $this->site->getFriendsAndRequests();
            $setting = $this->db->get_where(PRIVACY, array('UID' => $_POST['fid']));
            $per = $setting->num_rows() ? json_decode($setting->row()->settings) : "0";
            if (in_array($_POST['fid'], json_decode($ids['F_UID']))) {
                $permission = $per->private;
            } else {
                $permission = $per->public;
            }
        }
        echo json_encode(array('s' => "1", 'prof' => $prof, 'othdata' => $other_info, 'uid' => $this->session->userdata('UID') == $fid ? $this->session->userdata('UID') : "", 'fid' => $fid, "fields" => $this->db->list_fields(USER_INFO), 'privacy' => $set, 'permission' => $permission));
    }

    public function getSideMenu() {
        $fid = $_POST['fid'];
        $fdata = $this->site->getUserInfo($fid);
        echo '<div class="row side_static_menu visible-lg" style="padding: 0px;background:#fff;border-right:solid 2px #febf10;border-left:solid 2px #fc6f4b;border-bottom:solid 2px #febf10;">
    <div class="thumbnail " style="border:0px;margin: 0px;background:#fff;">
        <?php //call_pic(180,180,"img-circle"); ?>
        <img class="media-object" src="' . IMGURL . $fdata['UID_Pro_Pic'] . '" style="width:200px;height:214px;border-bottom:solid 3px #37a8df;margin-bottom:1px;" alt="user">
        <p class="media-heading" style="padding:6px;width:170px;color:#fff;background:#fc6f4b;border-top:3px solid #fff;z-index:1000;cursor: pointer;position: absolute;top: 186;border-right:solid 2px #37a8df;border-radius: 0 20px 1px 0px;">
            ' . $fdata['UID_FirstName'] . "&nbsp" . $fdata['UID_LastName'] . '
        </p>
    </div>  
</div>';
    }

    public function getSideMenud() {
        $this->load->view('user/layout/sidemenu');
    }

    public function setUpdatePer() {
        $data = $_POST;
        if ($this->db->update(USER_INFO, $data, array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateProf() {
        $data = $_POST['prof'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['prof']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('prof_arr' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateCertificate() {
        $data = $_POST['cer'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['cer']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('certificates' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateSocial_work() {
        $data = $_POST['social'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['social']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('social_work' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateSports() {
        $data = $_POST['sports'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['sports']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('sports' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateDocuments() {
        $dt = $this->db->select('documents')->get_where(OTHER_INFO, array('UID' => $this->session->userdata('UID')))->row()->documents;
        $data = $_POST['documents'];
        $data = json_decode($data, true);
        if (!is_dir(FCPATH . "assets/userdoc/{$this->session->userdata('UID')}/")) {
            mkdir(FCPATH . "assets/userdoc/{$this->session->userdata('UID')}/");
        }
        $filename = FCPATH . "assets/userdoc/{$this->session->userdata('UID')}/" . $dt[$_POST['id']]['doc'];
        if (is_file($filename)) {
            chmod($filename, 0777);
            unlink($filename);
        }
        $config['upload_path'] = "./assets/userdoc/{$this->session->userdata('UID')}/";
        $config['file_name'] = "doc_" . random_string("numeric", 5);
        $config['allowed_types'] = '*';
        $config['max_size'] = '102400';
        $rs = array();
        $up = array();
        $i = 0;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('doc')) {
            $up = $this->upload->data();
//            $d = array('doc' => $up['file_name'], "path" => base_url() . "assets/userdoc/{$this->session->userdata('UID')}/");
        }
        foreach ($data as $d) {
            $rs[$i] = $d;
            if ($i == $_POST['id']) {
                if (!empty($up)) {
                    $rs[$i]['doc'] = $up['file_name'];
                }
                $rs[$i]['path'] = base_url() . "assets/userdoc/{$this->session->userdata('UID')}/";
            }
            unset($rs[$i]['documents']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('documents' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateExtra() {
        $data = $_POST['extraca'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['extraca']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('extra' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateAcad() {
        $data = $_POST['acad'];
        if ($this->db->update(OTHER_INFO, array('academics' => $data), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function setUpdateAchivement() {

        $data = $_POST['achive'];
        $data = json_decode($data, true);
        $rs = array();
        $i = 0;
        foreach ($data as $d) {
            $rs[$i] = $d;
            unset($rs[$i]['achive']);
            unset($rs[$i]['$$hashKey']);
            $i++;
        }
        if ($this->db->update(OTHER_INFO, array('achievements' => json_encode($rs)), array('UID' => $this->session->userdata('UID')))) {
            $this->getProfile();
        } else {
            echo json_encode(array('s' => "0"));
        }
    }

    public function search() {
        $uid = $this->session->userdata('UID');
        $sq = trim(htmlspecialchars($_REQUEST['data'], ENT_QUOTES));
        $query = $this->db->where("( UID_FirstName LIKE '$sq%' or UID_MiddleName LIKE '$sq%' or UID_LastName LIKE '$sq%' ) AND UID!='$uid'")
                ->get(USER_INFO);
        $f_d = $this->db->get_where(FRIENDS_TABLE, array('UID' => $uid));

        if ($query->num_rows() == 0) {
            echo json_encode(array('s' => '0', 'msg' => "No Person Found With Such Name. <pre>" . htmlspecialchars_decode($sq) . "</pre>"));
        } else {
            $ef_arr = array(); //existing friends array
            $fr_arr = array(); //Recieved requests array
            $sfr_arr = array(); //sent friends request
            if ($f_d->num_rows() > 0) {
                $ef_arr = json_decode($f_d->row()->F_UID); //existing friends array
                $fr_arr = json_decode($f_d->row()->FR_UID); //Recieved requests array
                $sfr_arr = json_decode($f_d->row()->SFR_UID); //sent friends request
            }
            echo json_encode(array('s' => '1', 'data' => $query->result_array(), 'ef_arr' => $ef_arr, 'fr_arr' => $fr_arr, 'sfr_arr' => $sfr_arr, 'imgpath' => IMGURL));
        }
    }

    public function unfriend() {
        $uid = $this->session->userdata('UID');
        $fid = $_REQUEST['fid'];
        $f = $_REQUEST['f'];
        $q = (array) $this->db->select('F_UID')->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
//        $q = mysql_query("select F_UID from " . FRIENDS_TABLE . " WHERE UID='$uid'") or error_log(mysql_error());
//        $d = mysql_fetch_assoc($q);
        $fuid_arr = json_decode($q['F_UID']);
        $pos = array_search($fid, $fuid_arr);
        unset($fuid_arr[$pos]);
        $new_fuid_arr = json_encode(array_values($fuid_arr));
        $f_q = (array) $this->db->select('F_UID')->get_where(FRIENDS_TABLE, array('UID' => $fid))->row();
//        $f_q = mysql_query("select F_UID from " . FRIENDS_TABLE . " WHERE UID='$fid'") or error_log(mysql_error());
//        $f_d = mysql_fetch_assoc($f_q);
        $f_uid_arr = json_decode($f_q['F_UID']);
        $f_pos = array_search($uid, $f_uid_arr);
        unset($f_uid_arr[$f_pos]);
        $new_f_uid_arr = json_encode(array_values($f_uid_arr));
        $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $new_fuid_arr), array('UID' => $uid));
        $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $new_f_uid_arr), array('UID' => $fid));
//
//        mysql_query("LOCK TABLES " . FRIENDS_TABLE . " write");
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET F_UID='$new_fuid_arr' WHERE UID='$uid'") or error_log(mysql_error()); //own
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET F_UID='$new_f_uid_arr' WHERE UID='$fid'") or error_log(mysql_error()); //friends
//        mysql_query("UNLOCK TABLES");
        if ($x) {
            if ($f == "frli") {
                $this->getFriends();
            } else {
                $this->search();
            }
        } else {
            if ($f == "frli") {
                $this->getFriends();
            } else {
                $this->search();
            }
        }
    }

    public function addfriend() {
        $uid = $this->session->userdata('UID');
        $f_data = (array) $this->db->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
//        $f_query = mysql_query("select * from " . FRIENDS_TABLE . " where UID='$uid'") or die(mysql_error());
//        $f_data = mysql_fetch_assoc($f_query);
        $f_arr = json_decode($f_data['SFR_UID']);
        $f_arr_count = count($f_arr);
        $f_uid = $_POST['id'];
        $ef_arr = json_decode($f_data['F_UID']); //existing friends array
        $fr_arr = json_decode($f_data['FR_UID']); //Recieved requests array
        if ($uid == $f_uid) {
            //self requesting: so don't do anything.
        } elseif (in_array($f_uid, $f_arr)) {
//            echo"Friend Request Already Sent !";
            echo json_encode(array('s' => "2", "msg" => "Friend Request Already Sent !"));
        } elseif (in_array($f_uid, $ef_arr)) {
//            echo"Already Friends !";
            echo json_encode(array('s' => "3", "msg" => "Already Friends !"));
        } elseif (in_array($f_uid, $fr_arr)) {
//            echo"Confirm request of the user.";
            echo json_encode(array('s' => "4", "msg" => "Confirm request of the user."));
        } else {
            if ($f_arr_count == 0) {
                $f_arr = array($f_uid);
            } else {
                $f_arr[$f_arr_count] = $f_uid;
            }
            $enc_f_arr = json_encode($f_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('SFR_UID' => $enc_f_arr), array('UID' => $uid));
//            mysql_query("Update " . FRIENDS_TABLE . " SET SFR_UID='$enc_f_arr' WHERE UID='$uid' ") or error_log(mysql_error());
//            mysql_query("LOCK TABLES " . FRIENDS_TABLE . " WRITE");
            $f_d = (array) $this->db->select('FR_UID')->get_where(FRIENDS_TABLE, array('UID' => $f_uid))->row();
//            $f_q = mysql_query("select FR_UID from " . FRIENDS_TABLE . " WHERE UID='$f_uid'") or error_log(mysql_error());
//            $f_d = mysql_fetch_assoc($f_q);
            $fr_arr_d = json_decode($f_d['FR_UID']);
            $fr_count = count($fr_arr_d);
            $fr_arr_d[$fr_count] = $uid;
            $enc_fr_arr = json_encode($fr_arr_d);
            $x = $this->db->update(FRIENDS_TABLE, array('FR_UID' => $enc_fr_arr), array('UID' => $f_uid));
//            mysql_query("UPDATE " . FRIENDS_TABLE . " SET FR_UID='$enc_fr_arr' WHERE UID='$f_uid'") or error_log(mysql_error());
//            mysql_query("UNLOCK TABLES");
            if ($x) {
                echo $this->search();
            }
//            echo"<button disabled class='btn btn-default'>Request Sent</button>";
        }
    }

    public function addFBfriend() {
        $uid = $_POST['uid'];

        $f_data = (array) $this->db->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();

//        $f_query = mysql_query("select * from " . FRIENDS_TABLE . " where UID='$uid'") or die(mysql_error());
//        $f_data = mysql_fetch_assoc($f_query);
        $f_arr = json_decode($f_data['SFR_UID']);
        $f_arr_count = count($f_arr);
        if ($_POST['id'] != 0) {
            $f_uid = $this->db->select('UID')->get_where(USER_INFO, array('fb_id' => $_POST['id']))->row()->UID;
        } else {
            $f_uids = $this->db->select('UID')->where_in('fb_id', $_POST['ids'])->get(USER_INFO)->result_array();
        }
        $ef_arr = json_decode($f_data['F_UID']); //existing friends array
        $fr_arr = json_decode($f_data['FR_UID']); //Recieved requests array
        if (isset($f_uid)) {
            if ($uid == $f_uid) {
                //self requesting: so don't do anything.
            } elseif (in_array($f_uid, $f_arr)) {
//            echo"Friend Request Already Sent !";
                echo json_encode(array('s' => "2", "msg" => "Friend Request Already Sent !"));
            } elseif (in_array($f_uid, $ef_arr)) {
//            echo"Already Friends !";
                echo json_encode(array('s' => "3", "msg" => "Already Friends !"));
            } elseif (in_array($f_uid, $fr_arr)) {
//            echo"Confirm request of the user.";
                echo json_encode(array('s' => "4", "msg" => "Confirm request of the user."));
            } else {
                if ($f_arr_count == 0) {
                    $f_arr = array($f_uid);
                } else {
                    $f_arr[$f_arr_count] = $f_uid;
                }
                $enc_f_arr = json_encode($f_arr);
                $x = $this->db->update(FRIENDS_TABLE, array('SFR_UID' => $enc_f_arr), array('UID' => $uid));
//            mysql_query("Update " . FRIENDS_TABLE . " SET SFR_UID='$enc_f_arr' WHERE UID='$uid' ") or error_log(mysql_error());
//            mysql_query("LOCK TABLES " . FRIENDS_TABLE . " WRITE");
                $f_d = (array) $this->db->select('FR_UID')->get_where(FRIENDS_TABLE, array('UID' => $f_uid))->row();
//            $f_q = mysql_query("select FR_UID from " . FRIENDS_TABLE . " WHERE UID='$f_uid'") or error_log(mysql_error());
//            $f_d = mysql_fetch_assoc($f_q);
                $fr_arr_d = json_decode($f_d['FR_UID']);
                $fr_count = count($fr_arr_d);
                $fr_arr_d[$fr_count] = $uid;
                $enc_fr_arr = json_encode($fr_arr_d);
                $x = $this->db->update(FRIENDS_TABLE, array('FR_UID' => $enc_fr_arr), array('UID' => $f_uid));
//            mysql_query("UPDATE " . FRIENDS_TABLE . " SET FR_UID='$enc_fr_arr' WHERE UID='$f_uid'") or error_log(mysql_error());
//            mysql_query("UNLOCK TABLES");
//            if ($x) {
//                echo $this->search();
//            }
//            echo"<button disabled class='btn btn-default'>Request Sent</button>";
                if ($x) {
                    echo json_encode(array('s' => "1", "msg" => "Request Send Successfully!!"));
                } else {
                    echo json_encode(array('s' => "0", "msg" => "Request Sending Failed!!"));
                }
            }
        } else {

            if ($f_arr_count == 0) {
                foreach ($f_uids as $fid) {
                    $f_arr[] = $fid['UID'];
                }
            } else {
                foreach ($f_uids as $fid) {
                    $f_arr[] = $fid['UID'];
                }
            }
            $enc_f_arr = json_encode($f_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('SFR_UID' => $enc_f_arr), array('UID' => $uid));
//            mysql_query("Update " . FRIENDS_TABLE . " SET SFR_UID='$enc_f_arr' WHERE UID='$uid' ") or error_log(mysql_error());
//            mysql_query("LOCK TABLES " . FRIENDS_TABLE . " WRITE");
            $f_d = (array) $this->db->select('FR_UID')->get_where(FRIENDS_TABLE, array('UID' => $f_uid))->row();
//            $f_q = mysql_query("select FR_UID from " . FRIENDS_TABLE . " WHERE UID='$f_uid'") or error_log(mysql_error());
//            $f_d = mysql_fetch_assoc($f_q);
            $fr_arr_d = json_decode($f_d['FR_UID']);
            $fr_count = count($fr_arr_d);
            $fr_arr_d[$fr_count] = $uid;
            $enc_fr_arr = json_encode($fr_arr_d);
            $x = $this->db->update(FRIENDS_TABLE, array('FR_UID' => $enc_fr_arr), array('UID' => $f_uid));
//            mysql_query("UPDATE " . FRIENDS_TABLE . " SET FR_UID='$enc_fr_arr' WHERE UID='$f_uid'") or error_log(mysql_error());
//            mysql_query("UNLOCK TABLES");
//            if ($x) {
//                echo $this->search();
//            }
//            echo"<button disabled class='btn btn-default'>Request Sent</button>";
            if ($x) {
                echo json_encode(array('s' => "1", "msg" => "Request Send Successfully!!"));
            } else {
                echo json_encode(array('s' => "0", "msg" => "Request Sending Failed!!"));
            }
        }
    }

    public function confirm() {
        $fid = $_REQUEST['fid'];
        $f = $_REQUEST['f'];
        $uid = $this->session->userdata('UID');
        $f_data = (array) $this->db->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
        $fr_arr = json_decode($f_data['FR_UID']);
        if (in_array($fid, $fr_arr)) {
            $f_arr = json_decode($f_data['F_UID']);
            $f_count = count($f_arr);
            $f_arr[$f_count] = $fid;
            $enc_f_arr = json_encode($f_arr);
            $f_key = array_search($fid, $fr_arr);
            array_splice($fr_arr, $f_key, 1);
            $enc_fr_arr = json_encode($fr_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $enc_f_arr, 'FR_UID' => $enc_fr_arr), array('UID' => $uid));
            $f_d_arr = json_decode($f_d['SFR_UID']);
            echo $fid_key = array_search($fid, $f_d_arr);
            array_splice($f_d_arr, $fid_key, 1);
            $enc_f_d_arr = json_encode($f_d_arr);
            $f_uid_arr = json_decode($f_d['F_UID']);
            $f_uid_count = count($f_uid_arr);
            $f_uid_arr[$f_uid_count] = $uid;
            $enc_ef_arr = json_encode($f_uid_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $enc_ef_arr, 'SFR_UID' => $enc_f_d_arr), array('UID' => $fid));
            if ($x) {
                if ($f == "frli") {
                    $this->getFriends();
                } else {
                    $this->search();
                }
            } else {
                if ($f == "frli") {
                    $this->getFriends();
                } else {
                    $this->search();
                }
            }
        } else {
            echo "Warning: This person haven't added you as a friend.";
        }
    }

    public function reject() {
        $f_uid = $_REQUEST['uid'];
        $f = $_REQUEST['f'];
        $uid = $this->session->userdata('UID');
        $f_data = (array) $this->db->select('FR_UID')->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
//        $f_query = mysql_query("select FR_UID from " . FRIENDS_TABLE . " where UID='$uid'") or die(mysql_error());
//        $f_data = mysql_fetch_assoc($f_query);
        $fr_arr = json_decode($f_data['FR_UID']);
        $f_uid_key = array_search($f_uid, $fr_arr);
        array_splice($fr_arr, $f_uid_key, 1);
        $enc_fr_arr = json_encode($fr_arr);
        $x = $this->db->update(FRIENDS_TABLE, array('FR_UID' => $enc_fr_arr), array('UID' => $uid));
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET FR_UID='$enc_fr_arr' WHERE UID='$uid'") or error_log(mysql_error());
//        mysql_query("LOCK TABLES " . FRIENDS_TABLE . " WRITE");
        $d = (array) $this->db->select('SFR_UID')->get_where(FRIENDS_TABLE, array('UID' => $f_uid))->row();
//        $d = mysql_query("select SFR_UID from " . FRIENDS_TABLE . " WHERE UID='$f_uid'") or error_log(mysql_error());
//        $d = mysql_fetch_assoc($q);
        $sfr_data = json_decode($d['SFR_UID']);
        $uid_key = array_search($uid, $sfr_data);
        array_splice($sfr_data, $uid_key, 1);
        $enc_sfr_data = json_encode($sfr_data);
        $x = $this->db->update(FRIENDS_TABLE, array('SFR_UID' => $enc_sfr_data), array('UID' => $f_uid));
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET SFR_UID='$enc_sfr_data' WHERE UID='$f_uid'") or error_log(mysql_error());
//        mysql_query("UNLOCK TABLES");
        if ($x) {
            if ($f == "frli") {
                $this->getFriends();
            } else {
                $this->search();
            }
        } else {
            if ($f == "frli") {
                $this->getFriends();
            } else {
                $this->search();
            }
        }
    }

    public function mconfirm() {
        $fid = $_REQUEST['fid'];
        $f = $_REQUEST['f'];
        $uid = $this->session->userdata('UID');
        $f_data = (array) $this->db->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
        $fr_arr = json_decode($f_data['FR_UID']);
        if (in_array($fid, $fr_arr)) {
            $f_arr = json_decode($f_data['F_UID']);
            $f_count = count($f_arr);
            $f_arr[$f_count] = $fid;
            $enc_f_arr = json_encode($f_arr);
            $f_key = array_search($fid, $fr_arr);
            array_splice($fr_arr, $f_key, 1);
            $enc_fr_arr = json_encode($fr_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $enc_f_arr, 'FR_UID' => $enc_fr_arr), array('UID' => $uid));
            $f_d_arr = json_decode($f_d['SFR_UID']);
            echo $fid_key = array_search($fid, $f_d_arr);
            array_splice($f_d_arr, $fid_key, 1);
            $enc_f_d_arr = json_encode($f_d_arr);
            $f_uid_arr = json_decode($f_d['F_UID']);
            $f_uid_count = count($f_uid_arr);
            $f_uid_arr[$f_uid_count] = $uid;
            $enc_ef_arr = json_encode($f_uid_arr);
            $x = $this->db->update(FRIENDS_TABLE, array('F_UID' => $enc_ef_arr, 'SFR_UID' => $enc_f_d_arr), array('UID' => $fid));
            echo $x;
        } else {
            echo "Warning: This person haven't added you as a friend.";
        }
    }

    public function mreject() {
        $f_uid = $_REQUEST['uid'];
        $f = $_REQUEST['f'];
        $uid = $this->session->userdata('UID');
        $f_data = (array) $this->db->select('FR_UID')->get_where(FRIENDS_TABLE, array('UID' => $uid))->row();
//        $f_query = mysql_query("select FR_UID from " . FRIENDS_TABLE . " where UID='$uid'") or die(mysql_error());
//        $f_data = mysql_fetch_assoc($f_query);
        $fr_arr = json_decode($f_data['FR_UID']);
        $f_uid_key = array_search($f_uid, $fr_arr);
        array_splice($fr_arr, $f_uid_key, 1);
        $enc_fr_arr = json_encode($fr_arr);
        $x = $this->db->update(FRIENDS_TABLE, array('FR_UID' => $enc_fr_arr), array('UID' => $uid));
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET FR_UID='$enc_fr_arr' WHERE UID='$uid'") or error_log(mysql_error());
//        mysql_query("LOCK TABLES " . FRIENDS_TABLE . " WRITE");
        $d = (array) $this->db->select('SFR_UID')->get_where(FRIENDS_TABLE, array('UID' => $f_uid))->row();
//        $d = mysql_query("select SFR_UID from " . FRIENDS_TABLE . " WHERE UID='$f_uid'") or error_log(mysql_error());
//        $d = mysql_fetch_assoc($q);
        $sfr_data = json_decode($d['SFR_UID']);
        $uid_key = array_search($uid, $sfr_data);
        array_splice($sfr_data, $uid_key, 1);
        $enc_sfr_data = json_encode($sfr_data);
        $x = $this->db->update(FRIENDS_TABLE, array('SFR_UID' => $enc_sfr_data), array('UID' => $f_uid));
//        mysql_query("UPDATE " . FRIENDS_TABLE . " SET SFR_UID='$enc_sfr_data' WHERE UID='$f_uid'") or error_log(mysql_error());
//        mysql_query("UNLOCK TABLES");
        echo $x;
    }

    public function setPrivacySetting() {
        $data = $_POST['setting'];
        $d = $this->db->get_where(PRIVACY, array('UID' => $this->session->userdata('UID')));
        if ($d->num_rows()) {
            $x = $this->db->update(PRIVACY, array('settings' => json_encode($data)), array('UID' => $this->session->userdata('UID')));
        } else {
            $x = $this->db->insert(PRIVACY, array(
                'UID' => $this->session->userdata('UID'),
                'settings' => json_encode($data),
                'create_date' => date('Y-m-d h:i:s')
            ));
        }
        if ($x) {
            $d = $this->db->get_where(PRIVACY, array('UID' => $this->session->userdata('UID')));
            $set = json_decode($d->row()->settings);
            echo json_encode(array('s' => "1", "msg" => "Privacy Setting Save Successfully!", 'setting' => $set));
        } else {
            echo json_encode(array('s' => "2", "msg" => "Privacy Setting Saving Failed!"));
        }
    }

    public function getAllFiles() {
        $this->load->library('zip');
        $data = $this->db->select('documents')->get_where(OTHER_INFO, array('UID' => $this->session->userdata('UID')))->row()->documents;
        $data = json_decode($data);
        foreach ($data as $d) {
            $this->zip->read_file(FCPATH . "assets/userdoc/{$this->session->userdata('UID')}/" . $d->doc);
        }
        $this->zip->download('mydocs_' . strtotime(date('Y-m-d h:i:s')) . '.zip');
    }

    public function downloadCV() {
        ob_clean();
        ob_flush();
        $this->load->library('PDF');
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Resume');

// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Resume', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
// ---------------------------------------------------------
// // set JPEG quality
        $pdf->setJPEGQuality(75);
// set font
        $pdf->SetFont('freeserif', '', 10);

// add a page
        $pdf->AddPage();
        // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// create some HTML content
//        $data['services'] = $this->prof_model->getProfServiceId($id);
//        $data['content'] = $this->prof_model->getProfId($id);
//$pdf->Image('images/image_demo.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
//        echo '<pre>';
//        echo $this->db->last_query();
//        print_r($data);
//        die();
//        . $this->load->view('emails/resume', array(), true)
        $html = '' . $this->load->view('emails/resume', array(), true);

//        $html = "<h1>Pravinkumar</h1>";
// output the HTML content
        $pdf->writeHTML($html, true, 0, true, 0);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// reset pointer to the last page


        $pdf->lastPage();
//        $pdf->SetXY(162, 34);
//        $pdf->Image(IMGURL . $this->session->userdata('UID_Pro_Pic'), '', '', 30, 30, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
// ---------------------------------------------------------
//Close and output PDF document
//        $pdf->Output(FCPATH . 'assets/pdf/RegForm_' . $id . '.pdf', 'FI');
        $pdf->Output(FCPATH . 'assets/pdf/RegForm_.pdf', 'I');
//        $path = FCPATH . 'assets/pdf/RegForm_' . $id . '.pdf';
//        header("Content-Length: " . filesize($path));
//        header("Content-type: application/pdf");
//        header("Content-disposition: inline; filename=" . basename($path));
//        header('Expires: 0');
//        header('Cache-Control: must-revalidate, post-check = 0, pre-check = 0');
//        ob_clean();
//        flush();
//        readfile($path);
//============================================================+
// END OF FILE
//============================================================+
    }

}

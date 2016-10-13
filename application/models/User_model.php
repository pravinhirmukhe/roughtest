<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author Pravinkumar
 */
class User_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    public function login($data) {
        $d['UID_Username'] = $data['username_email'];
        $d['UID_Password'] = $data['password'];
        $rs = $this->db->get_where(LOGIN_TABLE, $d);
        if ($rs->num_rows() > 0) {
            $r = $rs->row();
            $this->session->set_userdata(array(
                'UID' => $r->UID,
                'UID_PRIVILEGE_TYPE' => $r->UID_PRIVILEGE_TYPE,
                'UID_login_flag' => $r->UID_login_flag,
            ));
            return $r->UID;
        } else {
            return false;
        }
    }

    public function checkIcode($icode) {
        $id = $this->db->get_where(USER_INFO, array('invitation_code' => $icode));
        $gid = $this->db->get_where(INVITATION_CODE_STORAGE, array('invitation_code' => $icode));
        if (!$id->num_rows()) {
            if ($gid->num_rows()) {
                $gid = $gid->row();
                $this->session->set_userdata('ic_uid', $gid->id);
                return true;
            } else {
                $this->session->set_userdata('ic_uid', "");
                return false;
            }
        } else {
            $id = $id->row();
            $this->session->set_userdata('ic_uid', $id->UID);
            return true;
        }
    }

    public function signup() {
        $data = $_POST;
        $data['dob'] = "" . $data['dob']['d'] . "/" . $data['dob']['m'] . "/" . $data['dob']['y'];
        $data['email'] = $data['regemail'];
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < 17; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->db->trans_begin();
//        mysql_query("LOCK TABLES " . USER_INFO . " WRITE," . READ_LOG . " WRITE," . OTHER_INFO . " WRITE, " . FRIENDS_TABLE . " WRITE, " . NEW_USER . " WRITE, rs_dpp_log WRITE, " . INVITATION_REQUESTS . " WRITE") or die(mysql_error());
        $element_arr = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $element_arr_count = count($element_arr);
        $element_arr_count--;
        Generate_code:
        $invitation_code = 'EU';
        for ($i = 0; $i < 6; $i++) {
            $random_val = rand(0, $element_arr_count);
            $invitation_code.=$element_arr[$random_val];
        }
        $code = $this->db->get_where(USER_INFO, array('invitation_code' => $invitation_code));
        if ($code->num_rows() > 0) {
            goto Generate_code;
        }
//        $mysql_q = mysql_query("select UID from " . USER_INFO . " where invitation_code='$invitation_code'") or die(mysql_error());
//        if (mysql_num_rows($mysql_q) != 0) {
//            
//        }
        $fb = $this->session->userdata('fb_id');
        $ic_uid = $this->session->set_userdata('ic_uid');
        $data['fb_id'] = isset($fb) ? $fb : "";
        $ic_uid = isset($ic_uid) ? $ic_uid : 0;
        $this->db->insert(USER_INFO, array(
            "UID_FirstName" => $data['f_name'],
            "UID_MiddleName" => '',
            "UID_LastName" => $data['l_name'],
            "UID_Gender" => $data['gender'],
            "UID_CurrentCity" => '',
            "UID_Hometown" => '',
            "UID_DOB" => $data['dob'],
            "UID_Contact" => '',
            "UID_Email" => $data['email'],
            "UID_CurrentLevel" => $data['currently'],
            "UID_CurrentRoleOrFuncArea" => '',
            "UID_CurrentInstitutionOrCompany" => '',
            "invitation_code" => $invitation_code,
            "ic_used_UID" => $ic_uid,
            "fb_link" => $data['fb_link'],
            "fb_id" => $data['fb_id'],
            "payment_id" => $data['payment_id']
        ));
        $uid_data = (array) $this->db->get_where(USER_INFO, array('UID_Email' => $data['email']))->row();
//        mysql_query("insert into " . USER_INFO . " (`UID_FirstName`, `UID_MiddleName`, `UID_LastName`, `UID_Gender`, `UID_CurrentCity`, `UID_Hometown`, `UID_DOB`, `UID_Contact`, `UID_Email`, `UID_CurrentLevel`, `UID_CurrentRoleOrFuncArea`, `UID_CurrentInstitutionOrCompany`, `invitation_code`,`ic_used_UID`,`fb_link`,`fb_id`)
//                    VALUES('$data[f_name]','','$data[l_name]','$data[gender]','','','$data[dob]','','$data[email]','$data[currently]','','','$invitation_code','$ic_uid','$data[fb_link]','$data[fb_id]')") or die(mysql_error());
//        $getuid_q = mysql_query("select * from " . USER_INFO . " where UID_Email='$data[email]'") or die(mysql_error());
//        $uid_data = mysql_fetch_assoc($getuid_q);
//        ["THDC Institute of Hydropower Engineering &amp; Technology","Tehri,Uttarakhand","ECE","2015","70.80","","","","","","Doon Global School","Dehradun","PCM","2010","87.60","Rajiv Gandhi Navodaya Vidyalaya","Dehradun","English","2008","91.00"]
        $inst = $data['institutes'] == "other" ? $data['institute'] : $data['institutes'];
        $loc = $data['locations'] == "other" ? $data['location'] : $data['locations'];
        $branch = $data['branchs'] == "other" ? $data['branch'] : $data['branchs'];
        $academics = json_encode(array($inst, $loc, $branch, $data['graduationyear'], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""));
        $this->db->insert(READ_LOG, array("UID" => $uid_data['UID'], "kc" => "", "e1" => "", "e2" => "", "e3" => ""));
        $this->db->insert(OTHER_INFO, array("UID" => $uid_data['UID'], "prof_arr" => "", "academics" => $academics, "achievements" => "", "certificates" => "", "social_work" => "", "extra" => "", "sports" => ""));
        $this->db->insert(FRIENDS_TABLE, array("UID" => $uid_data['UID'], "F_UID" => "", "FR_UID" => "", "SFR_UID" => ""));
//        mysql_query("insert into " . READ_LOG . " (`UID`, `kc`, `e1`, `e2`, `e3`) VALUES('$uid_data[UID]','','','','')") or die(mysql_error());
//        mysql_query("insert into " . OTHER_INFO . " (`UID`, `prof_arr`, `academics`, `achievements`, `certificates`, `social_work`, `extra`, `sports`) VALUES ('$uid_data[UID]','','$academics','','','','','')") or die(mysql_error());
//        mysql_query("insert into " . FRIENDS_TABLE . " (`UID`, `F_UID`, `FR_UID`, `SFR_UID`) VALUES('$uid_data[UID]','','','')") or die(mysql_error());
        if (strtolower($data['i_code_present']) == 'yes') {
            $this->db->insert(NEW_USER, array("UID" => $uid_data['UID'], "UID_link" => $randomString, "UID_pass" => $data['password']));
//            mysql_query("insert into " . NEW_USER . " (`UID`, `UID_link`, `UID_pass`) VALUES ('$uid_data[UID]','$randomString','$data[u_pass]')") or die(mysql_error());
        } else {
            $this->db->insert(INVITATION_REQUESTS, array("UID" => $uid_data['UID'], "UID_link" => $randomString, "UID_pass" => $data['password']));
//            mysql_query("insert into " . INVITATION_REQUESTS . " (`UID`, `UID_link`, `UID_pass`) VALUES ('$uid_data[UID]','$randomString','$data[u_pass]')") or die(mysql_error());
        }
        $dpp_log_q = $this->db->insert('rs_dpp_log', array("UID" => $uid_data['UID'], "data" => ""));
//        $dpp_log_q = mysql_query("INSERT INTO rs_dpp_log (UID,data) VALUES('$uid_data[UID]','')") or die(mysql_error());
//        mysql_query("UNLOCK TABLES") or die(mysql_error());
//        $enc_random = str_encrypt_n_decrypt($randomString, "enc");
        $email = array(
            'to' => $data['email'],
            'from' => "hello@roughsheet.com",
            'from_name' => "RoughSheet",
            'enc_random' => $randomString,
            'i_code_present' => $data['i_code_present']
        );
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('s' => 0);
        } else {
            $this->db->trans_commit();
            return array('s' => 1, 'data' => $email);
        }
    }

    public function registerme($ud, $email) {
        $transfer_q = null;
        $transfer_q = $this->db
                ->from(NEW_USER)
                ->join(USER_INFO, NEW_USER . ".UID=" . USER_INFO . ".UID", 'inner')
                ->where("UID_link", $ud)
                ->where("UID_email", $email)
                ->get();
//        $transfer_q = mysql_query("select * from " . NEW_USER . "," . USER_INFO . " where " . NEW_USER . ".UID=" . USER_INFO . ".UID && UID_link='$ud' && UID_email='$email'") or die("Something went wrong !");
//        $transfer_q_count = mysql_num_rows($transfer_q);

        if ($transfer_q->num_rows() == 0) {
            $transfer_q = $this->db
                    ->from(INVITATION_REQUESTS)
                    ->join(USER_INFO, INVITATION_REQUESTS . ".UID=" . USER_INFO . ".UID", 'inner')
                    ->where("UID_link", $ud)
                    ->where("UID_email", $email)
                    ->get();
        } else if ($transfer_q->num_rows() == 0) {
            return array('s' => '1');
        } else {
            $t_data = (array) $transfer_q->row();
            $pass = $this->site->encryptPass($t_data[UID_pass]);
            $this->db->trans_begin();
            $this->db->insert(LOGIN_TABLE, array('UID' => $t_data['UID'], "UID_Username" => "$email", "UID_Password" => "$pass", "UID_AccountType" => "1", "UID_PRIVILEGE_TYPE" => "1"));
            $this->db->delete(NEW_USER, array('UID' => $t_data['UID']));
            $this->db->delete(INVITATION_REQUESTS, array('UID' => $t_data['UID']));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return array('s' => '0');
            } else {
                $this->db->trans_commit();
                return array('s' => '2', 'invitation_code' => $t_data['invitation_code']);
            }
        }
    }

    public function resendAct() {
        $email = $_POST['email'];
        $code = $this->db
                        ->select('UID_link')
                        ->from(NEW_USER)
                        ->join(USER_INFO, USER_INFO . ".UID=" . NEW_USER . ".UID", 'inner')
                        ->where(USER_INFO . ".UID_Email", $email)
                        ->get()->row()->UID_link;
        return array('to' => $email, 'enc_random' => $code);
    }

    public function forgetPass() {
//forgot pass
        $email = $_POST['email'];
        $uid_d = (array) $this->db->select('UID')->get_where(USER_INFO, array('UID_Email' => $email))->row();
//        $existing_check = mysql_query("select UID from " . USER_INFO . " WHERE UID_Email='$email'") or error_log(mysql_error());
//        $uid_d = mysql_fetch_Assoc($existing_check);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ><,.%?/}[]{';
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 1; $i <= 60; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $enc_rs = base64_encode($randomString);
        $s_q = $this->db->select('id')->get_where(FORGOT_PASS, array('email' => $email));
//        $s_q = mysql_query("SELECT id FROM " . FORGOT_PASS . " WHERE email='$email'") or error_log(mysql_error());
//        $s_row_count = mysql_num_rows($s_q);
        if ($s_q->num_rows() == 0) {
            $this->db->insert(FORGOT_PASS, array('UID' => $uid_d['UID'], 'email' => $email, 'link' => $enc_rs));
//            $statement = "INSERT INTO " . FORGOT_PASS . "(UID,email,link) VALUES('$uid_d[UID]','$email','$enc_rs')";
        } else {
            $this->db->update(FORGOT_PASS, array('link' => $enc_rs), array('UID' => $uid_d['UID']));
//            $statement = "UPDATE " . FORGOT_PASS . " SET link='$enc_rs' WHERE UID='$uid_d[UID]'";
        }
//        mysql_query("LOCK TABLES " . FORGOT_PASS . " write");
//        mysql_query($statement) or error_log(mysql_error());
//        mysql_query("UNLOCK TABLES");
//        $confirm = "YES_I_WANT_TO_MAIL";
//        include"../forgotpass_mailer.php";
//        $to = $email;
//        $message = "
//To recover your account, click on the link below.<br>
//<br>
//<a href='http://www.roughsheet.com/app/recover_rs_account.php?rs_secure_token=$enc_rs&ma=$email'><button>Reset Password</button></a><br>
//<br><br>
//Regards,
//RoughSheet
//        ";
//        smtpmailer("$to", 'recover@roughsheet.com', 'RoughSheet', "RoughSheet: Recover Account", "$message");
//        $msg = "Link has been mailed to your registered email address";
//        echo $msg;

        return array('s' => '1', 'data' => array('enc' => $enc_rs, 'email' => $email));
    }

}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_controller
 *
 * @author Pravinkumar
 */
class User_controller extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->library('cart');
        $this->data['filters'] = $this->session->userdata('filters');
        $this->load->helper('message');
    }

    public function index() {
        $this->data['template'] = "index";
        $this->user_layout($this->data);
    }

    public function getCities() {
        echo json_encode($this->site->getCities());
    }

    public function getInstitutes() {
        echo json_encode($this->site->getInstitutes());
    }

    public function getBranches() {
        echo json_encode($this->site->getBranches());
    }

    public function getPayGetWay() {
        echo json_encode($this->site->getPayGetWay());
    }

    public function login() {
        $data = $_POST;
        $data['password'] = $this->site->encryptPass($data['password']);
        $rs = $this->user->login($data);
        if ($rs) {
            $plid = $this->session->userdata('UID_PRIVILEGE_TYPE');
            $loginflag = $this->session->userdata('UID_login_flag');
            $this->db->query("UPDATE " . LOGIN_TABLE . " SET UID_login_flag=UID_login_flag+1 WHERE `UID`='$rs'");
            $info = $this->db->get_where(USER_INFO, array('UID' => $rs))->row();
            $cookie_value = $this->site->str_encrypt_n_decrypt(time() . "_RS_SCI_$rs" . "_$plid" . "_$info->UID_FirstName" . "_$info->UID_Pro_Pic" . "_" . $loginflag . "_" . time(), "enc");
            if (isset($_REQUEST["remember"])) {
                $this->session->set_userdata('ROUGHSHEET_SCI', $cookie_value);
                $this->session->set_userdata('UID_Pro_Pic', $info->UID_Pro_Pic);
                $this->session->set_userdata('UID_Fname', $info->UID_FirstName);
                $this->session->set_userdata('UID_Lname', $info->UID_LastName);
                $this->session->set_userdata('FBID', $info->fb_id);
            } else {
                $this->session->set_userdata('ROUGHSHEET_SCI', $cookie_value);
                $this->session->set_userdata('UID_Pro_Pic', $info->UID_Pro_Pic);
                $this->session->set_userdata('UID_Fname', $info->UID_FirstName);
                $this->session->set_userdata('UID_Lname', $info->UID_LastName);
                $this->session->set_userdata('FBID', $info->fb_id);
            }
            echo json_encode(array('s' => '1', "msg" => "Login Successfully"));
        } else {
            echo json_encode(array('s' => '0', "msg" => "Login Failed"));
        }
    }

    public function checkpass() {
        $uid = $this->session->userdata('UID');
        $pass = $this->site->encryptPass($_REQUEST['cpass']);
        $chk_q = $this->db->get_where(LOGIN_TABLE, array('UID' => $uid, 'UID_Password' => $pass));
        if ($chk_q->num_rows() > 0) {
            echo "1"; //correct
        } else {
            echo "0"; //incorrect
        }
    }

    public function propictempup($c = null) {
        $uid = $this->session->userdata('UID');
        if (!isset($c)) {
            $config['file_name'] = "dpic-" . random_string('numeric', 16) . ".jpg";
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('pro_pic_file')) {
//            $error = array('error' => $this->upload->display_errors());
//            $this->load->view('upload_form', $error);
                echo json_encode(array('s' => "0", 'msg' => $this->upload->display_errors()));
            } else {
                $data = $this->upload->data();
                $this->session->set_userdata('temp_pro_pic', array('UID' => $uid, 'imgsrc' => $data));
                $x = $this->db->update(USER_INFO, array('UID_Pro_Pic' => $data['file_name']), array('UID' => $uid));
                chmod(FCPATH . "assets\\images\\" . $this->session->userdata('UID_Pro_Pic'), 0777);
//                delete_files(FCPATH . "assets\\images\\" . $this->session->userdata('UID_Pro_Pic'));
                unlink(FCPATH . "assets\\images\\" . $this->session->userdata('UID_Pro_Pic'));
                echo json_encode(array('s' => "1", 'imgurl' => IMGURL . $data['file_name']));
            }
        } else {
            $data = $this->session->userdata('temp_pro_pic');
            $d = $_POST;
            $config['file_name'] = 's' . $data['imgsrc']['file_name'];
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('cropimg')) {
                echo json_encode(array('s' => "0", 'msg' => "Croped Image Saving Failed! " . $this->upload->display_errors()));
            } else {
                $dx = $this->upload->data();
                $x = $this->db->update(USER_INFO, array('UID_Pro_Pic' => "s" . $data['imgsrc']['file_name']), array('UID' => $data['UID']));
                chmod(FCPATH . "assets\\images\\" . $data['imgsrc']['file_name'], 0777);
                unlink(FCPATH . "assets\\images\\" . $data['imgsrc']['file_name']);
//                delete_files(FCPATH . "assets\\images\\" . $data['imgsrc']['file_name']);
                $this->session->set_userdata('UID_Pro_Pic', "s" . $data['imgsrc']['file_name']);
                echo json_encode(array('s' => "1", 'msg' => "Croped Image Save Successfully!"));
            }
        }
    }

    public function changepass() {
        $uid = $this->session->userdata('UID');
        $pass = $this->site->encryptPass($_REQUEST['pass']);
        $update_q = $this->db->update(LOGIN_TABLE, array('UID_Password' => $pass), array('UID' => $uid));
//        $update_q = mysql_query("update " . LOGIN_TABLE . " SET UID_Password='$pass' WHERE UID='$uid'") or die(mysql_error());
        if ($update_q) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function forgetpass() {
        $rs = $this->user->forgetpass();
        if ($rs['s']) {
            $msg = $this->load->view('emails/forgetpass', $rs['data'], true);
            $e = $this->sendMail($rs['data']['email'], 'RoughSheet: Recover Account', "$msg", 'RoughSheet', 'recover@roughsheet.com');
            if ($e['s']) {
                echo json_encode(array('s' => '1', 'msg' => "Email Send Successfuly!"));
            } else {
                echo json_encode(array('s' => '0', 'msg' => "Email Sending Failed! ($e[err])"));
            }
        } else {
            echo json_encode(array('s' => '0', 'msg' => "Email Sending Failed!"));
        }
    }

    public function resetpassword($link, $email) {
        $this->load->view('user/layout/resetpass', array('link' => $this->uri->segment(2), 'email' => $this->uri->segment(3)));
    }

    public function resetp() {
        $pas2 = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES));
//            include"includes/header.php";
//            include"includes/def_paths.php";
//            $call_db = "GRANT_ACCESS_TO_DB";
//            $ConnArray = getMySqlConnectionValues("user");
//            $host = $ConnArray["HOST"];
//            $user = $ConnArray["USER"];
//            $pass = $ConnArray["PASS"];
//            $db = $ConnArray["DB"];
//            require ext_file_include('db_connectivity', 'config');
        $this->db->update(LOGIN_TABLE, array('UID_Password' => $this->site->encryptPass($pas2)), array('UID_Username' => urldecode($_POST['email'])));
        $this->db->delete(FORGOT_PASS, array('email' => urldecode($_POST['email'])));
//                mysql_query("update " . LOGIN_TABLE . " set UID_Password='$pas2' where UID_Username='$_SESSION[RECOVER_ACCOUNT]'") or die("There was a problem resetting your password");
//                mysql_query("LOCK TABLES " . FORGOT_PASS . " write");
//                mysql_query("delete from " . FORGOT_PASS . " WHERE email='$_SESSION[RECOVER_ACCOUNT]'") or die("Pass Update : ERR-PANIC");
//                mysql_query("UNLOCK TABLES");
//            session_destroy();
        echo "<body><div class='alert alert-info'><center>Your password has been successfully updated.</center></div><a class='navbar-brand' href='index.php'>
          <img  src='assets/img/rs_logo.png' style='margin:200px 200px 200px 230px' alt='roughsheet' /></a></body>";
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function calDays() {
        $year = htmlspecialchars($_POST['year']);
        $month = htmlspecialchars($_POST['month']);
        $d = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        echo json_encode(range(1, $d));
    }

    public function checkEmail() {
        $email = $_POST['email'];
        if ($this->db->get_where('rs_user_info_1423552512', array('UID_Email' => $email))->num_rows()) {
            echo json_encode(array('s' => '1'));
        } else {
            echo json_encode(array('s' => '0'));
        }
    }

    public function checkICode() {
        $icode = $_POST['i_code'];
        if ($this->user->checkIcode($icode)) {
            echo json_encode(array('s' => '1'));
        } else {
            echo json_encode(array('s' => '0'));
        }
    }

    public function signup() {
        $rs = $this->user->signup();
        if ($rs['s']) {
            $d = $rs['data'];
            $d['enc_random'] = $this->site->str_encrypt_n_decrypt($d['enc_random'], "enc");
            $to = $d['to'];
            $from = $d['from'];
            $from_name = $d['from_name'];
            $i_code_present = $d['i_code_present'];
            $msg = $this->load->view('emails/registration', $d, true);
            $e = $this->sendMail($to, "Welcome! Let's talk about you.", $msg, $from_name, $from);
//            sleep(1);
//            if (trim($i_code_present) == "yes") {
//                $msgx = $this->load->view('emails/registration_verify', $d, true);
//                $e = $this->sendMail($to, "Welcome to RoughSheet", $msgx, $from_name, "donotreply@roughsheet.com");
//            }
            if ($e['s']) {
                echo json_encode(array('s' => '1'));
            } else {
                echo json_encode(array('s' => 2, 'msg' => $e['err']));
            }
        } else {
            echo json_encode(array('s' => '0'));
        }
    }

    public function resendAct() {
        $rs = $this->user->resendAct();
        $msgx = $this->load->view('emails/registration_verify', $rs, true);
        $e = $this->sendMail($rs['to'], "Welcome to RoughSheet", $msgx, "Roughsheet", "donotreply@roughsheet.com");
        if ($e['s']) {
            echo json_encode(array('s' => '1', 'msg' => "Mail Send Successfully!"));
        } else {
            echo json_encode(array('s' => '2', 'msg' => $e['err']));
        }
    }

    public function registerme($code, $to) {
        $code = $this->uri->segment(2);
        $to = $this->uri->segment(3);
        $ud = $this->site->str_encrypt_n_decrypt(urldecode($code), "dec");
        $rs = $this->user->registerme($ud, urldecode($to));
        if ($rs['s'] == '1') {
            echo"<center><h3>To login <a href='" . site_url() . "'>click here</a> </h3></center>";
        } else if ($rs['s'] == '2') {
            $d = array();
            $msg = $this->load->view('emails/verify', $d, true);
            $e = $this->sendMail($to, "Thank You !", $msg, "RoughSheet", "donotreply@roughsheet.com");
            $d['ic'] = $rs['invitation_code'];
            $msg = $this->load->view('emails/icmail', $d, true);
            $e = $this->sendMail($to, "Your Invitation Code", $msg, "RoughSheet", "donotreply@roughsheet.com");
            echo"<center><h3><img src='http://" . site_url() . "/assets/img/rs_sm_logo.png' width='300px' height='90px'><table width='100%'> <tr><td style='width:100%;background:green;color:#fff;font-size:25px;'><center>Your account is verified successfully. </center></span></td></tr></table><br>Please wait, you will be redirected shortly.<br> Please click the following link if it is taking time <a href='http://" . site_url() . "/index.php'>Click Here</a> </h3></center>";
            echo"<script>
                        function gotol(){
                            window.location.assign('" . site_url() . "/index.php')
                        }
                        setTimeout(gotol, 2000);</script>";
        }
    }

    public function fblogin() {
        $rs = $this->db
                ->where(array('fb_id' => $_POST['id']))
                ->where(array('fb_link' => $_POST['link']))
                ->get(USER_INFO);
        if ($rs->num_rows() > 0) {
            $data = $this->db->get_where(LOGIN_TABLE, array('UID_Username' => $rs->row()->UID_Email));
            if ($data->num_rows()) {
                $d['password'] = $data->row()->UID_Password;
                $d['username_email'] = $data->row()->UID_Username;
                $rsx = $this->user->login($d);
                if ($rsx) {
                    $plid = $this->session->userdata('UID_PRIVILEGE_TYPE');
                    $loginflag = $this->session->userdata('UID_login_flag');
                    $this->db->query("UPDATE " . LOGIN_TABLE . " SET UID_login_flag=UID_login_flag+1 WHERE `UID`='$rsx'");
                    $info = $this->db->get_where(USER_INFO, array('UID' => $rsx))->row();
                    $cookie_value = $this->site->str_encrypt_n_decrypt(time() . "_RS_SCI_$rsx" . "_$plid" . "_$info->UID_FirstName" . "_$info->UID_Pro_Pic" . "_" . $loginflag . "_" . time(), "enc");
                    if (isset($_REQUEST["remember"])) {
                        $this->session->set_userdata('ROUGHSHEET_SCI', $cookie_value);
                        $this->session->set_userdata('UID_Pro_Pic', $info->UID_Pro_Pic);
                        $this->session->set_userdata('UID_Fname', $info->UID_FirstName);
                        $this->session->set_userdata('UID_Lname', $info->UID_LastName);
                        $this->session->set_userdata('FBID', $info->fb_id);
                    } else {
                        $this->session->set_userdata('ROUGHSHEET_SCI', $cookie_value);
                        $this->session->set_userdata('UID_Pro_Pic', $info->UID_Pro_Pic);
                        $this->session->set_userdata('UID_Fname', $info->UID_FirstName);
                        $this->session->set_userdata('UID_Lname', $info->UID_LastName);
                        $this->session->set_userdata('FBID', $info->fb_id);
                    }
                }
                echo json_encode(array('status' => 1));
            } else {
                echo json_encode(array('status' => 3));
            }
        } else {
            $this->session->set_userdata('fb_id', $_POST['id']);
            $this->session->set_userdata('fb_link', $_POST['link']);
            echo json_encode(array('status' => 2));
        }
    }

    public function getFBConnect() {
        $x = $this->db->update(USER_INFO, array(
            'fb_link' => $_POST['link'],
            'fb_id' => $_POST['id']
                ), array('UID' => $this->session->userdata('UID')));
        if ($x) {
            $this->session->set_userdata('FBID', $_POST['id']);
            echo json_encode(array('s' => '1', 'fbid' => $_POST['id']));
        } else {
            echo json_encode(array('s' => '2'));
        }
    }

    public function contactus() {
        $data = $_POST;
        $e = $this->sendMail("userquery@roughsheet.com", $data['Subject'], $data['Message'], $data['Name'], $data['Email']);
        if ($e['s']) {
            echo json_encode(array('s' => '1'));
        } else {
            echo json_encode(array('s' => '2', 'msg' => $e['err']));
        }
    }

    public function contactusto() {
        $data = $_POST;
        $u_info = $this->site->getUserInfo($this->session->userdata('UID'));
        $d = array(
            'name' => $u_info['UID_FirstName'] . ' ' . $u_info['UID_LastName'],
            'subject' => $data['sub'],
            'email' => $u_info['UID_Email'],
            'msg' => $data['msg']
        );
        $msg = $this->load->view('emails/query', $d, true);
        $e = $this->sendMail("userquery@roughsheet.com", "User Query @ Roughsheet", $msg, $u_info['UID_FirstName'] . ' ' . $u_info['UID_LastName'], $u_info['UID_Email']);
        if ($e['s']) {
            echo json_encode(array('s' => '1'));
        } else {
            echo json_encode(array('s' => '2', 'msg' => $e['err']));
        }
    }

    public function getQuote() {
        echo json_encode($this->db->order_by('id', 'RANDOM')->limit(1)->get(QUOTE_LIST)->row());
    }

}
<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->less = $this->config->item('less');
        define("ADMINASSETS", base_url() . "assets/admin/");
        define("USERASSETS", base_url() . "assets/");
        define('SITEURL', site_url());
        define('BASEURL', base_url());
        define('ASSETSURL', base_url() . 'assets/');
        define('ANGULARURL', base_url() . 'angular-js/');
        define('IMGURL', base_url() . 'assets/images/');
        define('SITENAME', "Roughsheet");
        defined("ACC_TYPE") ? "" : define('ACC_TYPE', 'rs_account_type_table_1423552512');
        defined("LOGIN_TABLE") ? "" : define('LOGIN_TABLE', 'rs_login_table_1423552512');
        defined("USER_INFO") ? "" : define('USER_INFO', 'rs_user_info_1423552512');
        defined("EDU_INFO") ? "" : define('EDU_INFO', 'rs_edu_info_1423552512');
        defined("SUBJECTS") ? "" : define('SUBJECTS', 'rs_subjects_1423552512');
        defined("QUESTIONS") ? "" : define('QUESTIONS', 'rs_questions_db_24052015');
        defined("FRIENDS_TABLE") ? "" : define('FRIENDS_TABLE', 'rs_friends_26052015');
        defined("TOPICS") ? "" : define('TOPICS', 'rs_sub_topics_23052015');
        defined("KEY_CONCEPTS") ? "" : define('KEY_CONCEPTS', 'rs_key_concepts_27062015');
        defined("READ_LOG") ? "" : define('READ_LOG', 'rs_read_log');
        defined("OTHER_INFO") ? "" : define('OTHER_INFO', 'rs_other_info_5072015');
        defined("NEW_USER") ? "" : define('NEW_USER', 'rs_new_user_1472015');
        defined("DPP_LOG") ? "" : define('DPP_LOG', 'rs_dpp_log');
        defined("TPP_LOG") ? "" : define('TPP_LOG', 'rs_tpp_log');
        defined("SCHEDULE_DATA") ? "" : define('SCHEDULE_DATA', 'rs_schedule_data');
        defined("FORGOT_PASS") ? "" : define('FORGOT_PASS', 'rs_forgot_pass_9082015');
        defined("RSS_NAVIGATION") ? "" : define('RSS_NAVIGATION', 'rs_rss_navigation');
        defined("RSS_SOURCES") ? "" : define('RSS_SOURCES', 'rs_rss_sources');
        defined("QUOTE_LIST") ? "" : define('QUOTE_LIST', 'rs_quotes_5082015');
        defined("RSS_SOURCE_LINKS") ? "" : define('RSS_SOURCE_LINKS', 'rs_rss_source_links');
        defined("INVITATION_REQUESTS") ? "" : define('INVITATION_REQUESTS', 'rs_invitation_requests');
        defined("INVITATION_CODE_STORAGE") ? "" : define('INVITATION_CODE_STORAGE', 'rs_invitation_code_storage');
        defined("PRIVACY") ? "" : define('PRIVACY', 'rs_privacy');
        defined("CITIES") ? "" : define('CITIES', 'cities');
        defined("INSTITUTE") ? "" : define('INSTITUTE', 'rs_institutes');
        defined("BRANCHES") ? "" : define('BRANCHES', 'rs_branch');
        $this->load->model('Site_model', 'site_model');
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->loggedIn = $this->ion_auth->logged_in();
    }

    public function user_layout($data) {
        if ($this->session->userdata('UID') != null) {
            $temp['data'] = $data;
            $this->load->view('user/layout/index', $temp);
        } else {
            $this->data['title'] = "Main";
            $this->load->view('user/layout/main', $this->data);
        }
    }

    function sendMail($to, $sub, $msg, $from_name, $from) {

        $this->load->library('phpmailer/Pmailer');
        $mail = $this->pmailer->getMailer();
//        $config['mailtype'] = "html";
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//        $this->email->set_newline("\r\n");
//        $this->email->from($from); // change it to yours
//        $this->email->to($to); // change it to yours
//        $this->email->subject($sub);
//        $this->email->message($msg);
//        return $this->email->send();
//        $mail->isSMTP();                                      // Set mailer to use SMTP
//        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//        $mail->SMTPAuth = true;                               // Enable SMTP authentication
//
//        $from_pass = '';
//        if ($from == "ankur@roughsheet.com") {
//            $from_pass = "Sh@dow45";
//        } else if ($from == "hello@roughsheet.com") {
//            $from_pass = "Hello@123";
//        } else if ($from == "donotreply@roughsheet.com") {
//            $from_pass = "Donotreply@123";
//        } else if ($from == "recover@roughsheet.com") {
//            $from_pass = "Recover@123";
//        } else if ($from == "connect@roughsheet.com") {
//            $from_pass = "Connect@123";
//        } else if ($from == "contact@roughsheet.com") {
//            $from_pass = "Contact@123";
//        } else if ($from == "userquery@roughsheet.com") {
//            $from_pass = "Userquery@123";
//        }
//        $from = "pravinkumar.hirmukhe@gmail.com";
//        $from_pass = "7507546002";
//        $mail->Username = $from;                 // SMTP username
//        $mail->Password = $from_pass;                           // SMTP password
//        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//        $mail->Port = 587;                                    // TCP port to connect to
//        $mail->isSMTP();                                      // Set mailer to use SMTP
//        $mail->Host = 'email-smtp.us-west-2.amazonaws.com';  // Specify main and backup SMTP servers
//        $mail->SMTPAuth = true;                               // Enable SMTP authentication
//        $mail->Username = 'AKIAJJDAU4DFAEVRDF2A';                 // SMTP username
//        $mail->Password = 'AmD5Px3BsJiAFrW+E28Zww1/qOuxCV4kafxtEb7dc72n';                           // SMTP password
//        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom("$from", "$from_name");
        $mail->addReplyTo("$from", "$from_name");

        $mail->addAddress($to);  // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "$sub";
        $mail->Body = "$msg";

        if (!$mail->send()) {
            return array('s' => 0, 'err' => $mail->ErrorInfo);
        } else {
            return array('s' => 1, 'err' => "");
        }
    }

    function curlReq($url, $vars) {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $vars);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $object = json_decode($buffer);
        return $object;
    }

    public function admin_layout($data) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->data['menus'] = $this->site_model->getMenus();
        $this->data['data'] = $data;
        $this->data['title'] = ucfirst($data['template']);
        $this->load->view('admin/layout/index', $this->data);
    }

    /* public function get_angluar() {
      return json_decode(file_get_contents("php://input"), true);
      }

      function sendMail($to, $sub, $msg, $from = 'info@yollodeals.com') {
      $this->load->library('email');
      $config['mailtype'] = "html";
      $config['wordwrap'] = TRUE;
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from($from); // change it to yours
      $this->email->to($to); // change it to yours
      $this->email->subject($sub);
      $this->email->message($msg);
      return $this->email->send();
      }

      //    akash for otp picked up from previous yollo

      public function send_sms($mobile, $message) {
      $url = "http://sms4.ajgroups.net/api/sendmsg.php?";
      $params = array(
      'user' => 'ravipune',
      'pass' => 'abc',
      'sender' => 'YODEAL',
      'phone' => is_array($mobile) ? implode(',', $mobile) : $mobile,
      'text' => $message,
      'priority' => 'ndnd',
      'stype' => 'normal',
      );
      foreach ($params as &$value) {
      $value = urlencode($value);
      }
      $params = implode('&', array_map(function ($v, $k) {
      return $k . '=' . $v;
      }, $params, array_keys($params)));
      $url.=$params;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $transactionID = curl_exec($ch);
      curl_close($ch);
      return $transactionID;
      }

      public function fb_login_link() {
      $this->load->library('facebook/Facebook');
      $data = $this->facebook->getLoginUrl(array(
      'redirect_uri' => site_url('User_controller/facebookLogin'),
      'scope' => array("email") // permissions here
      ));
      return $data;
      }

      function applyTemplate($templateData, $templateVars = array()) {
      $content = $templateData;
      if (is_array($templateVars)) {
      foreach ($templateVars as $key => $value) {
      $content = preg_replace('/' . $key . '/', $value, $content);
      }
      }
      return $content;
      }

      public function getGplus() {

      include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
      include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

      // Google Project API Credentials
      $clientId = '934301057466-9st2h05eurtn8gnd4quuo62osfnu2398.apps.googleusercontent.com';
      $clientSecret = 'lJE8GH43fi7ztUAjbaGgUGsv';
      $redirectUrl = base_url() . 'gpluslogin/';

      // Google Client Configuration
      $gClient = new Google_Client();
      $gClient->setApplicationName('Login to ' . base_url());
      $gClient->setClientId($clientId);
      $gClient->setClientSecret($clientSecret);
      $gClient->setRedirectUri($redirectUrl);
      $google_oauthV2 = new Google_Oauth2Service($gClient);

      if (isset($_REQUEST['code'])) {
      $gClient->authenticate();
      $this->session->set_userdata('token', $gClient->getAccessToken());
      redirect($redirectUrl);
      }

      $token = $this->session->userdata('token');
      if (!empty($token)) {
      $gClient->setAccessToken($token);
      }

      if (!$gClient->getAccessToken()) {
      return $gClient->createAuthUrl();
      } else {
      return null;
      }
      } */
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rank_controller
 *
 * 
 */
class Rank_controller extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/System_user_model', 'sysuser');
        $this->load->model('admin/Rank_model', 'Rank_model');
        
        //$this->load->model('site');
        $this->load->model('Ion_auth_model', 'ion');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('message');
        $this->load->library('session');
    }
    
    public function rank(){
        $this->data['template'] = "Rank/stud_rank";
         $this->data['subject'] = $this->sysuser->getSubject();
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Student Rank"));
        $this->admin_layout($this->data);
    }
    public function show_rank(){
        
        if ($_REQUEST['domain'] == 'global') {
            $uid_data = $this->site->getAllUID();
        } else {
            $friends_data_arr = $this->site->getFriendsAndRequests();
            $uid_data = json_decode($friends_data_arr['F_UID']);
        }
        $std_obj_marks = (array) $this->site->getRespectiveMarksArr($_REQUEST['type']);

        $marks = array();
        foreach ($std_obj_marks as $key1 => $val1) {
            $marks[$key1] = (array) $val1;
        }
        
        $subid = $_REQUEST['subid'];
        $filtered_uid_arr = array();
        $data2sort = array();
        foreach ($marks as $temp_uid => $data) {
            //echo $temp_uid;
           $temp_data = null;
            $temp_data = (array) $data;
            foreach ($temp_data as $key => $val) {
                if ($key == $subid) {
                    $data2sort[$temp_uid] = $temp_data[$subid];
                    $filtered_uid_arr[] = $temp_uid; //fileterd for the particular subject
                }
            }
        }
        
        array_multisort($data2sort, SORT_DESC, $filtered_uid_arr);
        $rank_limit = 10; //ranks to dispaly
        $current_rank = 1; //rank start from 1
        $arr_count = count($filtered_uid_arr);
        $last_marks = -100; //just a start
        
        
        //new 
        if ($arr_count != 0) {
            for ($i = 0; $i < $arr_count; $i++) {
                //get student name from id
                $userName[] = $this->sysuser->getUserNameById($filtered_uid_arr[$i]);
                //get 10 and 12 th marks
                $acadamicsjsonArr[] = $this->sysuser->getAcadamicsInfo($filtered_uid_arr[$i]);
            }
        }
       
        $acadamicsArr =array();
        if(isset($acadamicsjsonArr) && !empty($acadamicsjsonArr)){
            foreach($acadamicsjsonArr as $value){
                $acadamicsArr[] = (array)json_decode($value[0]->academics);
            }
        }
       
        //get 10 th and 12th marks
        $marks = array();
        if(isset($acadamicsArr) && !empty($acadamicsArr)){
            foreach($acadamicsArr as $key=>$value){

                $marks['twelth'][] = $value[14];
                $marks['tenth'][] = $value[16];
            }
        }
        //get subject name
        $subjectName= $this->sysuser->getSubNameById($subid);
        
       
        $this->data['template'] = "Rank/rank_table";
        $this->data['subjectName'] = $subjectName;
        $this->data['marks'] = $marks;
        $this->data['userName'] = $userName;
        $this->data['filtered_uid_arr'] = $filtered_uid_arr;
        
        $this->data['data2sort'] = $data2sort;
        $this->data['rank_limit'] = $rank_limit;
        $this->data['current_rank'] = $current_rank;
        $this->data['arr_count'] = $arr_count;
        $this->data['last_marks'] = $last_marks;
        $html = '';
        if ($arr_count != 0) {
            for ($i = 0; $i < $arr_count; $i++) {
                if ($current_rank > $rank_limit) {
                    break;
                } else {
                    $current_user = $filtered_uid_arr[$i];
                    $f_d_fetch = $this->site->getUserInfo($current_user);

                    //for the rowspan value we can check in data2sort array that how many of such marks entries are present for that subject 
                    if ($last_marks != $data2sort[$current_user]) {
                        $last_marks = $data2sort[$current_user];

                            $html ='<tr>';
                            $html = $html.'<td style="text-align: center;"><input name="select" value="'.$current_user.'" type="checkbox"/></td>';
                            $html = $html.'<td style="text-align: center;">'.$current_rank.'</td>';
                            $html = $html.'<td>'.$userName[$i][0]->UID_FirstName. ' '.$userName[$i][0]->UID_LastName.' </td>';
                            $html = $html.'<td>'.$marks['tenth'][$i].'</td>';
                            $html = $html.'<td>'.$marks['twelth'][$i].'</td>';
                            $html = $html.'<td>'.$subjectName[0]->sub_name.'</td>';
                            $html = $html.'<td><a class="btn btn-default" href="'.site_url().'admin/Rank_controller/show_user_profile/'.$current_user.'")">View Profile</a></td></tr>';
                            
                                           
                    $current_rank++;
                } else {
                   
                        $html ='<tr>';
                        $html = $html.'<td style="text-align: center;"><input name="select" value="'.$current_user.'" type="checkbox"/></td>';
                        $html = $html.'<td style="text-align: center;">'.$current_rank.'</td>';
                        $html = $html.'<td>'.$userName[$i][0]->UID_FirstName.' '.$userName[$i][0]->UID_LastName.'</td>';
                        $html = $html.'<td>'.$marks['tenth'][$i].'</td>';
                        $html = $html.'<td>'.$marks['twelth'][$i].'</td>';
                        $html = $html.'<td>'.$subjectName[0]->sub_name.'</td>';
                        $html = $html.'<td><a class="btn btn-default" href="'.site_url().'admin/Rank_controller/show_user_profile/'.$current_user.'")">View Profile</a></td></tr>';
                            
                                            
                }
            }
        }
    } else {
       
        $html = $html.'<tr><td colspan="7">Ranks not calculated yet.</td></tr>';
       
    }
    echo $html;
        //end
    }
    
    public function show_user_profile($id){
        $this->data['template'] = "Rank/user_profile";
        //get recruiter id to check payment is done or not
        $user_id = $this->session->userdata('user_id');
        $paymentDetails = array();
        $privacyUserData = array();
        $paymentDetails = $this->Rank_model->getPaymentDetails($user_id);
        //get privacy data of user  from rs_privacy table
        $privacyUserData =  $this->Rank_model->getprivacyData($id);
        $settingArr[] =  (array)json_decode($privacyUserData[0]->settings);
        
        if(! empty($paymentDetails)){       //recruiter has done payment
            $this->data['userDetails'] = $settingArr[0]['private'];
        }else{
             $this->data['userDetails'] = $settingArr[0]['public'];
        }
        
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Add Question Type"));
        $this->admin_layout($this->data);
    }
}

<?php

error_reporting(E_ALL);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_controller
 *
 * @author Pravinkumar
 */
class Admin_controller extends MY_Controller {

//put your code here

    function __construct() {
        parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->load->library('form_validation');
        $this->load->helper('message');
        $this->load->model('site_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->data['filters'] = $this->session->userdata('filters');
    }

    public function dashboard() {
        $group_id = $this->session->userdata('group_id');
        $rec_jobs = array();
        if ($group_id == 2) {   //if login by recruiter then show jobs 
            $user_id = $this->session->userdata('user_id');
            $rec_jobs = $this->Admin_model->getJobsByRecruiter($user_id);

            if (isset($rec_jobs) && !empty($rec_jobs)) {

                $this->data['job'] = count($rec_jobs);
                $this->data['job_details'] = $rec_jobs;
            }
        }
        $this->data['subjects'] = $this->Admin_model->getSubjects();
        $this->data['topics'] = $this->Admin_model->getTopics();

        //get topic name under subject
        $sub = array();
        $sub = $this->data['subjects'];

        for ($i = 0; $i < count($sub); $i++) {

            $this->data['topic'][] = $this->Admin_model->getTopicBySubId($sub[$i]->sub_id);
        }

        //get total number of question in each topic
        if (isset($this->data['topic'])) {


            $topicArr = array();
            $topicArr = $this->data['topic'];

            for ($i = 0; $i < count($sub); $i++) {
                for ($j = 0; $j < count($topicArr[$i]); $j++) {


                    $this->data['queCount'][] = $this->Admin_model->getQuestionCount($topicArr[$i][$j]->topic_id);
                    //get key concepts exist or not
                    $this->data['keyConcept'][] = $this->Admin_model->checkKeyConcept($topicArr[$i][$j]->topic_id);
                }
            }
        }

        //get month wise user data for graph
        $MonthWiseUser = array();
        $WeekWiseUser = array();
        $dayWiseUser = array();
        $MonthWiseUser = $this->Admin_model->getMonthWiseUserData();
        $WeekWiseUser = $this->Admin_model->getWeekWiseUserData();
        $dayWiseUser = $this->Admin_model->getdayWiseUserData();
        $res_dayWiseUser = array();
        $res_WeekWiseUser = array();
        $res_MonthWiseUser = array();
        $dayData = array();

        foreach ($MonthWiseUser as $value) {  //removed std class object
            $res_MonthWiseUser[] = (array) $value;
        }
        foreach ($WeekWiseUser as $value) {  //removed std class object
            $res_WeekWiseUser[] = (array) $value;
        }

        foreach ($dayWiseUser as $value) {  //removed std class object
            $res_dayWiseUser[] = (array) $value;
        }


        $res1 = array();
        $monthData = array();
        $countData = array();
        if (isset($res_MonthWiseUser) && !empty($res_MonthWiseUser)) {
            for ($i = 0; $i < count($res_MonthWiseUser); $i++) {
                $monthData[$i] = $res_MonthWiseUser[$i]['month'];
                $countData[$i] = $res_MonthWiseUser[$i]['total_users'];
            }
        }

        $res2 = array();
        $WeekData = array();
        $weekcountData = array();
        if (isset($res_WeekWiseUser) && !empty($res_WeekWiseUser)) {
            for ($i = 0; $i < count($res_WeekWiseUser); $i++) {
                $WeekData[$i] = $res_WeekWiseUser[$i]['day'];
                $weekcountData[$i] = $res_WeekWiseUser[$i]['total_users'];
            }
        }
        //for month of year
        $this->data['res_monthData'] = json_encode($monthData);
        $this->data['res_countData'] = json_encode($countData);

        //for days of week
        $this->data['res_weekData'] = json_encode($WeekData);
        $this->data['res_weekcountData'] = json_encode($weekcountData);

        //for current date
        $res3 = array();

        $daycountData = array();
        if (isset($res_dayWiseUser) && !empty($res_dayWiseUser)) {

            for ($i = 0; $i < count($res_dayWiseUser); $i++) {
                $dayData[$i] = $res_dayWiseUser[$i]['create_date'] . $res_WeekWiseUser[$i]['day'];
                $daycountData[$i] = $res_dayWiseUser[$i]['total_users'];
            }
        }

        //for current date
        //for days of week
        $this->data['res_dayData'] = json_encode($dayData);
        $this->data['res_daycountData'] = json_encode($daycountData);

        $this->data['template'] = "dashboard";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Dashboard"));
        $this->admin_layout($this->data);
    }

    public function bulkDelete() {

        $key = $_POST['key'];
        $val = $_POST['val'];
        $table = $_POST['tab'];
        $r = $this->site_model->bulkDelete($key, $val, $table);
        if ($r) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function setStatus() {
        $key = $_POST['key'];
        $id = $_POST['id'];
        $table = $_POST['tab'];
        $r = $this->site_model->setStatus($key, $id, $table);
        if ($r) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function setUStatus() {
        $key = $_POST['key'];
        $id = $_POST['id'];
        $table = $_POST['tab'];
        $r = $this->site_model->setUStatus($key, $id, $table);
        if ($r) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function save_key_concepts() {
        $this->form_validation->set_rules('sub_id', 'Subject Name', 'required');
        $this->form_validation->set_rules('topic_id', 'Topic Name', 'required|is_unique[rs_key_concepts_27062015.topic_id]');
        $this->form_validation->set_rules('kc_text', 'Key Concepts Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->key_concepts();
        } else {
            $result = $this->Admin_model->saveKeyConcepts($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Key Concept Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/KeyConcepts');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Key Concept Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/KeyConcepts');
            }
        }
    }

    public function key_concepts() {
        $this->data['subject'] = $this->Admin_model->getSubject();
        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['template'] = "KeyConcepts/key_concepts";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "KeyConcepts"));
        $this->admin_layout($this->data);
    }

    public function key_concepts_list() {
        $this->data['template'] = "KeyConcepts/key_concepts_list";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "KeyConcepts"));
        $this->admin_layout($this->data);
    }

    public function getKeyConceptData() {
        $detail_link = anchor('admin/view/$1', '<i class="fa fa-file-text-o"></i> ' . 'Key Concept Details');
        $edit_link = anchor('admin/KC-edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'Key Concept edit');

        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
                        <li>' . $edit_link . '</li>
                </ul>
		</div></div>';
        $this->load->library('datatables');
        $a = $this->db->dbprefix('rs_key_concepts_27062015');
        $this->datatables
                ->select("$a.kc_id as id,s.sub_name,st.topic_name as topic_name", false)
                ->from("rs_key_concepts_27062015")
                ->join("rs_sub_topics_23052015 st", "rs_key_concepts_27062015.topic_id=st.topic_id", "left")
                ->join("rs_subjects_1423552512 s", "st.sub_id=s.sub_id", "left");
        $this->datatables->add_column("Actions", $action, "id");
        //$fun = decode_html($str);

        echo $this->datatables->generate();
    }

    public function key_concept_edit($id) {
        $this->data['subject'] = $this->Admin_model->getSubject();
        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['kc'] = $this->Admin_model->getKeyConceptsById($id);
        $topicId = $this->data['kc'][0]->topic_id;
        $this->data['sub'] = $this->Admin_model->getSubByTopicId($topicId);

        $this->data['id'] = $id;
        $this->data['template'] = "KeyConcepts/key_concepts_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "KeyConcept Edit"));
        $this->admin_layout($this->data);
    }

    public function key_concept_update($id) {
        $this->form_validation->set_rules('topic_id', 'Topic', 'required');
        $this->form_validation->set_rules('kc_text', 'Key Concepts Description', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->key_concept_edit($id);
        } else {

            unset($_POST['id']);
            unset($_POST['sub_id']);
            $result = $this->Admin_model->updateKeyConcept($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Key Concept Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/KeyConcepts');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Key Concept Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/KeyConcepts');
            }
        }
    }

    public function view($id) {
        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['kc'] = $this->Admin_model->getKeyConceptsById($id);
        $this->data['id'] = $id;
        $this->data['template'] = "KeyConcepts/view";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Key Concept view"));
        $this->admin_layout($this->data);
    }

    public function exercise() {
        $this->data['template'] = "Exercise/exercise";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Exercise"));
        $this->admin_layout($this->data);
    }

    public function getExerciseData() {
        $detail_link = anchor('admin/Exercise-view/$1', '<i class="fa fa-file-text-o"></i> ' . 'exercise Details');
        $edit_link = anchor('admin/Exercise_edit/$1', '<i class="fa fa-file-text-o"></i> ' . 'exercise edit');
        $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . 'Actions' . ' <i style="color:#fff" class="fa fa-caret-down"></i></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li>' . $detail_link . '</li>
                        <li>' . $edit_link . '</li>
                </ul>
		</div></div>';
        $this->load->library('datatables');
        $a = $this->db->dbprefix('rs_questions_db_24052015');
        $this->datatables
                ->select("$a.id as id,st.topic_name,qt.type,$a.Difficulty_level", false)
                ->from("rs_questions_db_24052015")
                ->join("rs_sub_topics_23052015 st", "rs_questions_db_24052015.topic_id=st.topic_id", "left")
                ->join("rs_qtype_31052015 qt", "rs_questions_db_24052015.q_type=qt.id", "left");
        $this->datatables->add_column("Actions", $action, "id");
        //$fun = decode_html($str);

        echo $this->datatables->generate();
    }

    public function exercise_add() {
        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['qtype'] = $this->Admin_model->getQuestionType();
        $this->data['template'] = "Exercise/exercise_add";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Add Exercise"));
        $this->admin_layout($this->data);
    }

    public function save_exercise() {
        $this->form_validation->set_rules('topic_id', 'Topic Id', 'required');
        $this->form_validation->set_rules('q_type', 'Question Type', 'required');
        $this->form_validation->set_rules('Question', 'Question', 'required|is_unique[rs_questions_db_24052015.Question]');
        $this->form_validation->set_rules('Op1', 'Option 1', 'required');
        $this->form_validation->set_rules('Op2', 'Option 2', 'required');
        $this->form_validation->set_rules('Op3', 'Option 3', 'required');
        $this->form_validation->set_rules('Op4', 'Option 4', 'required');
        $this->form_validation->set_rules('Answer', 'Answer', 'required');
        $this->form_validation->set_rules('Solution', 'Solution', 'required');
        $this->form_validation->set_rules('Difficulty_level', 'Difficulty Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->exercise_add();
        } else {
            $result = $this->Admin_model->saveExercise($_POST);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Exercise Question Added Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Exercise');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Exercise Question Adding Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Exercise');
            }
        }
    }

    public function exercise_edit($id) {

        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['exercise'] = $this->Admin_model->getexerciseId($id);
        $this->data['qtype'] = $this->Admin_model->getQuestionType();
        $this->data['id'] = $id;
        $this->data['template'] = "Exercise/exercise_edit";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Exercise Question Edit"));
        $this->admin_layout($this->data);
    }

    public function exercise_update($id) {
        $this->form_validation->set_rules('topic_id', 'Topic Id', 'required');
        $this->form_validation->set_rules('q_type', 'Question Type', 'required');
        $this->form_validation->set_rules('Question', 'Question', 'required|is_unique[rs_questions_db_24052015.Question]');
        $this->form_validation->set_rules('Op1', 'Option 1', 'required');
        $this->form_validation->set_rules('Op2', 'Option 2', 'required');
        $this->form_validation->set_rules('Op3', 'Option 3', 'required');
        $this->form_validation->set_rules('Op4', 'Option 4', 'required');
        $this->form_validation->set_rules('Answer', 'Answer', 'required');
        $this->form_validation->set_rules('Solution', 'Solution', 'required');
        $this->form_validation->set_rules('Difficulty_level', 'Difficulty Level', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->exercise_edit($id);
        } else {

            unset($_POST['id']);
            $result = $this->Admin_model->updateExercise($_POST, $id);
            if ($result == true) {
                $this->session->set_flashdata('message', array('title' => 'Success.', 'content' => 'Exercise Updated Successfully.', 'type' => 's'));
                redirect(site_url() . 'admin/Exercise');
            } else {
                $this->session->set_flashdata('message', array('title' => 'Error.', 'content' => 'Exercise Updating Failed.', 'type' => 'e'));
                redirect(site_url() . 'admin/Exercise');
            }
        }
    }

    public function exercise_view($id) {
        $this->data['topics'] = $this->Admin_model->getTopics();
        $this->data['exercise'] = $this->Admin_model->getexerciseId($id);
        $this->data['qtype'] = $this->Admin_model->getQuestionType();
        $this->data['id'] = $id;
        $this->data['template'] = "Exercise/exercise_view";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Key Concept view"));
        $this->admin_layout($this->data);
    }

    public function track_user_list() {
        $this->data['template'] = "Track/track";
        $this->data['bc'] = array(array('link' => site_url('admin'), 'page' => "Home"), array('link' => '#', 'page' => "Track Users"));
        $this->admin_layout($this->data);
    }

    public function getUserData() {

        $this->load->library('datatables');
        $a = $this->db->dbprefix('rs_login_table_1423552512');
        $this->datatables
                ->select("$a.UID as id,$a.UID_Username as User_name,at.ATID_Name,p.PLID_Name", false)
                ->from("rs_login_table_1423552512")
                ->join("rs_account_type_table_1423552512 at", "rs_login_table_1423552512.UID_AccountType=at.ATID", "left")
                ->join("rs_privilege_table_1423552512 p", "rs_login_table_1423552512.UID_PRIVILEGE_TYPE=p.PLID", "left");
        //$this->datatables->add_column("Actions", $action, "id");
        //$fun = decode_html($str);

        echo $this->datatables->generate();
    }

    public function getTopic($id) {
        echo json_encode($this->Admin_model->getTopicBySubId($id));
    }

    public function getPrevGraph() {
        $sel_yr = $_POST['sel_yr'];
        $MonthWiseUser = $this->Admin_model->getMonthDataPrev($sel_yr);

        $res1 = array();
        $monthData = array();
        $countData = array();
        if (isset($MonthWiseUser)) {
            for ($i = 0; $i < count($MonthWiseUser); $i++) {
                $monthData[$i] = $MonthWiseUser[$i]['month'];
                $countData[$i] = $MonthWiseUser[$i]['total_users'];
            }
        }
        $monthGraphArr = array("res_monthData" => $monthData, "res_countData" => $countData);

        echo json_encode($monthGraphArr);
    }

}

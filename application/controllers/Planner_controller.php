<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Planner_controller
 *
 * @author Pravinkumar
 */
class Planner_controller extends MY_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getCal() {
//        $y = date('y');
//        $m = date('m');
//        if (isset($_POST)) {
//            $y = $_POST['y'];
//            $m = $_POST['m'];
//        }
//        $prefs['template'] = '{table_open}<table class="table table-bordered table-striped" class border="1" cellpadding="0" cellspacing="0">{/table_open}
//    {heading_row_start}<tr>{/heading_row_start}
//        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
//        {heading_title_cell}<th colspan="{colspan}" style="text-align:center">{heading}</th>{/heading_title_cell}
//        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
//        {heading_row_end}</tr>{/heading_row_end}
//    {week_row_start}<tr>{/week_row_start}
//        {week_day_cell}<th>{week_day}</th>{/week_day_cell}
//        {week_row_end}</tr>{/week_row_end}
//    {cal_row_start}<tr>{/cal_row_start}
//        {cal_cell_start}<td class="col-sm-1 row">{/cal_cell_start}
//            {cal_cell_content}<a class="pull-left col-md-12" style="padding:5px">{day}</a><div class="col-md-12 pull-right">{content}</div>{/cal_cell_content}
//            {cal_cell_content_today}<span class="pull-left col-md-12"><label style="padding:5px" class="label label-info"><a >{day}</a></label></span><div class="col-md-12 pull-right">{content}</div>{/cal_cell_content_today}
//            {cal_cell_no_content}{day}{/cal_cell_no_content}
//            {cal_cell_no_content_today}<div class="label label-success">{day}</div>{/cal_cell_no_content_today}
//            {cal_cell_blank}&nbsp;{/cal_cell_blank}
//            {cal_cell_end}</td>{/cal_cell_end}
//        {cal_row_end}</tr>{/cal_row_end}
//    {table_close}</table>{/table_close}';
//        $this->load->library('calendar', $prefs);
        $uid = $this->session->userdata('UID');
        $rs = $this->db->select('data')->get_where(SCHEDULE_DATA, array('UID' => $uid));
        $read = $this->db->get_where(READ_LOG, array('UID' => $uid))->row();
        $read->kc = json_decode($read->kc);
        $read->e1 = json_decode($read->e1);
        $read->e2 = json_decode($read->e2);
        $read->e3 = json_decode($read->e3);
        $links = array();
        if ($rs->num_rows() > 0) {
            $data = json_decode($rs->row()->data);
//            $date = date('d');
            $i = 1;
            foreach ($data as $d) {
                if (in_array($d[2], $read->kc) && in_array($d[2], $read->e1) && in_array($d[2], $read->e2) && in_array($d[2], $read->e3)) {
                    $rid = 'b';
                } else
                if (!(in_array($d[2], $read->kc) && in_array($d[2], $read->e1) && in_array($d[2], $read->e2) && in_array($d[2], $read->e3) || (in_array($d[2], $read->kc) || in_array($d[2], $read->e1) || in_array($d[2], $read->e2) || in_array($d[2], $read->e3)))) {
                    $rid = 'c';
                } else if ($d[1] < strtotime(date('y-m-d'))) {
                    $rid = 'd';
                } else {
                    $rid = 'a';
                }
                $links[] = array(
                    'id' => $i++,
                    'title' => $d[3],
                    'start' => date('Y,m,d', $d[1]),
                    'url' => $d[4],
                    'rid' => $rid
                );
//                if (date('Y', $d[1]) == $y && date('m', $d[1]) == $m) {
//                    $str = "<ul class='list-group '>";
//                    foreach ($data as $dx) {
//                        if (date('d', $dx[1]) == date('d', $d[1])) {
//                            $str.="<li class='list-group-item label '><div class='dropdown'>";
//                            $tid = $this->site->getAllTopicIds($dx[2]);
////                            $str.="<a class='' href='#/planner'>" . $this->site->getSubName($this->site->getSubId($dx[0])) . "</a>";
////                            $str.='<ul class="dropdown-menu" role="menu">';
////                            foreach ($tid as $t) {
//                            if (in_array($dx[2], $read->kc) && in_array($dx[2], $read->e1) && in_array($dx[2], $read->e2) && in_array($dx[2], $read->e3)) {
//                                $str.="<i class='glyphicon glyphicon-ok green'></i><a href='#/keyconcept/{$dx[2]}/{$dx[0]}'>" . $this->site->getSubName($this->site->getSubId($dx[0])) . "-" . $this->site->getTopicName($dx[0]) . '</a></li>';
////                                $str.="<a class='green' href='#/keyconcept/$dx[2]/$dx[0]'>" . $this->site->getSubName($this->site->getSubId($dx[0])) . "</a>";
//                            } else {
//                                $str.="<a href='#/keyconcept/{$dx[2]}/{$dx[0]}'>" . $this->site->getSubName($this->site->getSubId($dx[0])) . "-" . $this->site->getTopicName($dx[0]) . '</a></li>';
//                            }
////                            }
//                            $str.="</li>";
//                        }
//                    }
//                    $str.="</ul>";
//                    $links[date('d', $d[1])] = $str;
//                }
            }
        }

//        echo $this->calendar->generate($y, $m, $links);
        echo json_encode($links);
    }

    public function getSubjects() {
        echo json_encode($this->db->get(SUBJECTS)->result());
    }

    public function getTopics() {
        echo json_encode($this->db->get_where(TOPICS, $_POST)->result());
    }

    public function todolist() {
        $uid = $this->session->userdata('UID');
        $today = strtotime(date('Y-m-d'));
        $one_day_before = strtotime(date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d')))));
        $two_days_before = strtotime(date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d')))));
        $testdays = array();
        for ($i = 1; $i < 14; $i++) {
            array_push($testdays, strtotime(date('Y-m-d', strtotime('-' . $i . ' days', strtotime(date('Y-m-d'))))));
        }
        $tq = $this->db->select('data')->get_where(SCHEDULE_DATA, array('UID' => $uid));
        $todo_count = 0;
        $propic = 0;
        if ($this->site->get_pic_name() == 'dpic.png') {
            $propic = 1;
        }
        if ($tq->num_rows() == 0) {
            echo json_encode(array('s' => 2, 'msg' => "You haven't planned your study schedule", 'data' => array('pro_pic' => $propic)));
        } else {
            $data = json_decode($tq->row()->data, true);
            $sr = 1;
            $todo = array();
            $dates = array('today' => $today, "one_day_before" => $one_day_before, "two_days_before" => $two_days_before);
            foreach ($data as $k => $v) {
                array_push($todo, array("date" => $v[1], "id" => $v[0], "task" => $this->site->getSubName($this->site->getSubId($v[0])), "name" => $this->site->getTopicName($v[0]), 'sid' => $v[2]));
                $todo_count++;
            }
            echo json_encode(array('s' => 1, 'msg' => "", 'data' => array('testdays' => $testdays, 'dates' => $dates, 'todo' => $todo, 'toc' => $todo_count, 'pro_pic' => $propic)));
        }
    }

    public function getSchedule() {
        $uid = $this->session->userdata('UID');
        $rs = $this->db->select('data')->get_where(SCHEDULE_DATA, array('UID' => $uid));
        if ($rs->num_rows() > 0) {
            $data = json_decode($rs->row()->data);
            for ($i = 1; $i <= 15; $i++) {

                if ($i == 1) {
                    array_push($data, array(
                        $_POST['tid'],
                        strtotime($_POST['schdate']),
                        $_POST['sub_id'],
                        $this->site->getSubName($this->site->getSubId($_POST['tid'])) . "-" . $this->site->getTopicName($_POST['tid']) . "-Key Concepts",
                        "#/keyconcept/{$_POST['sub_id']}/{$_POST['tid']}"
                            )
                    );
                    array_push($data, array(
                        $_POST['tid'],
                        strtotime($_POST['schdate']),
                        $_POST['sub_id'],
                        $this->site->getSubName($this->site->getSubId($_POST['tid'])) . "-" . $this->site->getTopicName($_POST['tid']) . "-Exercise $i",
                        "#/keyconcept/{$_POST['sub_id']}/{$_POST['tid']}"
                            )
                    );
                } else if ($i == 2 && $i == 3) {
                    array_push($data, array(
                        $_POST['tid'],
                        strtotime(date("Y-m-d", strtotime($_POST['schdate'] . ' +' . ($i - 1) . ' days'))),
                        $_POST['sub_id'],
                        $this->site->getSubName($this->site->getSubId($_POST['tid'])) . "-" . $this->site->getTopicName($_POST['tid']) . "-Exercise $i",
                        "#/keyconcept/{$_POST['sub_id']}/{$_POST['tid']}"
                            )
                    );
                }

                array_push($data, array(
                    $_POST['tid'],
                    strtotime(date("Y-m-d", strtotime($_POST['schdate'] . ' +' . ($i - 1) . ' days'))),
                    $_POST['sub_id'],
                    $this->site->getSubName($this->site->getSubId($_POST['tid'])) . "-" . $this->site->getTopicName($_POST['tid']) . "-Exercise $i",
                    "#/keyconcept/{$_POST['sub_id']}/{$_POST['tid']}"
                        )
                );
            }
            $x = $this->db->update(SCHEDULE_DATA, array('data' => json_encode($data)), array('UID' => $uid));
        } else {
            $data = array();
            array_push($data, array($_POST['tid'], strtotime($_POST['schdate']), $_POST['sub_id']));
            $x = $this->db->insert(SCHEDULE_DATA, array('UID' => $uid, 'data' => json_encode($data)));
        }
        if ($x) {
            echo json_encode(array('s' => "1", "msg" => "Sechedule Successfully!"));
        } else {
            echo json_encode(array('s' => "2", "msg" => "Secheduleing Failed!"));
        }
    }

}

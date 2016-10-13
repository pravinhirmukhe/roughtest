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
        $y = date('y');
        $m = date('m');
        if (isset($_POST)) {
            $y = $_POST['y'];
            $m = $_POST['m'];
        }
        $prefs['template'] = '{table_open}<table class="table table-bordered table-striped" class border="1" cellpadding="0" cellspacing="0">{/table_open}
    {heading_row_start}<tr>{/heading_row_start}
        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}" style="text-align:center">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
        {heading_row_end}</tr>{/heading_row_end}
    {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}
    {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="label label-info"><a href="{content}" >{day}</a></div>{/cal_cell_content_today}
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="label label-success">{day}</div>{/cal_cell_no_content_today}
            {cal_cell_blank}&nbsp;{/cal_cell_blank}
            {cal_cell_end}</td>{/cal_cell_end}
        {cal_row_end}</tr>{/cal_row_end}
    {table_close}</table>{/table_close}';
        $this->load->library('calendar', $prefs);
        echo $this->calendar->generate($y, $m);
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
        $tq = $this->db->select('data')->get_where(SCHEDULE_DATA, array('UID' => $uid));
        $todo_count = 0;
        $propic = 0;
        if ($this->site->get_pic_name() == 'dpic.png') {
            //pro pic remaining to upload.
            $propic = 1;
        }
        if ($tq->num_rows() == 0) {
            echo json_encode(array('s' => 2, 'msg' => "You haven't planned your study schedule", 'data' => array('pro_pic' => $propic)));
//            $todo_count++;
        } else {
            $data = json_decode($tq->row()->data, true);
            $sr = 1;
            $todo = array();
            $dates = array('today' => $today, "one_day_before" => $one_day_before, "two_days_before" => $two_days_before);
            foreach ($data as $k => $v) {
//                if ($v[1] == $today) {
                array_push($todo, array("date" => $v[1], "id" => $v[0], "task" => $this->site->getSubName($this->site->getSubId($v[0])), "name" => $this->site->getTopicName($v[0])));
//                    echo "<tr style='text-align: center;'><td>$sr</td><td>" . $this->site->getSubName($this->site->getSubId($v[0])) . "</td><td>" . $this->site->getTopicName($v[0]) . "</td> <td><a href=# onclick='setKc(" . $this->site->getSubId($v[0]) . ",$v[0])'> Key-Concepts</a></td></tr>";
//                    $sr++;
//                    echo "<tr style='text-align: center;'><td>$sr</td><td>" . $this->site->getSubName($this->site->getSubId($v[0])) . "</td><td>" . getTopicName($v[0]) . "</td> <td><a href=# onclick='setSub(" . $this->site->getSubId($v[0]) . "," . $v[0] . ",1)'>Exercise 1</a></td></tr>";
                $todo_count++;
//                    $sr++;
//                } elseif ($v[1] == $one_day_before) {
//                    echo "<tr style='text-align: center;'><td>$sr</td><td>" . $this->site->getSubName($this->site->getSubId($v[0])) . "</td><td>" . getTopicName($v[0]) . "</td> <td><a href=# onclick='setSub(" . $this->site->getSubId($v[0]) . "," . $v[0] . ",2)'>Exercise 2</a></td></tr>";
//                    $todo_count++;
//                    $sr++;
//                } elseif ($v[1] == $two_days_before) {
//                    echo "<tr style='text-align: center;'><td>$sr</td><td>" . $this->site->getSubName($this->site->getSubId($v[0])) . "</td><td>" . getTopicName($v[0]) . "</td> <td><a href=# onclick='setSub(" . $this->site->getSubId($v[0]) . "," . $v[0] . ",3)'>Exercise 3</a></td></tr>";
//                    $todo_count++;
//                    $sr++;
//                }
            }
            echo json_encode(array('s' => 1, 'msg' => "", 'data' => array('dates' => $dates, 'todo' => $todo, 'toc' => $todo_count, 'pro_pic' => $propic)));
        }
    }

}

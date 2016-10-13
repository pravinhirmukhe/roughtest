
<style type="text/css">
    .pad{margin:0px;}
    .exam{width: 100%;}
    .panel_custom{border-color:#fc6f4b;position:absolute;top:-130px;}
    .panel_custom > .panel-heading {background: #fc6f4b;color:#fff;text-align: center;}
    @media (max-width: 350px){
        .panel_custom{position:absolute;top:0;}}
    @media (max-width: 414px){.panel_custom{position:absolute;top:0;}}
    @media (max-width: 767px){.panel_custom{position:absolute;top:0;}}
    @media (max-width: 900px){.panel_custom{position:absolute;top:20;}}
    @media (max-width: 1200px) {.panel_custom{position:absolute;top:40;}}
    input[type="radio"]:checked + label {background-color: yellow;}
    .exam_options{height:200px;width:200px;top:140;padding:8px;background:#fff url(assets/images/tab_icon.png)center center no-repeat;border-radius:100px;right:10;border-bottom:2px solid #eea73c;}
    .exam_btn{width: 200px;right:10;height:205px;top:205;padding:35px;margin-top:110px;background: #fff;border-bottom:3px solid #333;border-top:10px double #ec8528;}
    .option_btn{width:90px;height:90px;border-radius:50px;border-top:solid 2px #febf10;border-bottom:2px solid #37a8df;border-left:2px solid #fc6f4b;border-right:2px solid #25af60;}
    .option_btn:hover{border-radius:50px;border-top:solid 3px #febf10;border-bottom:3px solid #37a8df;border-left:3px solid #fc6f4b;border-right:3px solid #25af60;}
    .q_btn{font-size:15px;padding:5px;width:25px;border-radius:1px;box-shadow:0px 0px 1px #999;margin:1px;}
    .sm_color1{background:transparent !important;color:#fc6f4b !important;}
    .btn-default:hover{border:1px solid #00ae00;}
    .review_btn{top:180;position: relative;background: #ffffff; color:#fc6f4b;font-size:16px;font:bolder;}
    .review_btn:hover{background: #ffffff; color:#fc6f4b;font-size:16px;font:bolder;border-top:solid 2px #febf10;border-bottom:2px solid #37a8df;border-left:2px solid #fc6f4b;border-right:2px solid #25af60;}
</style>
<script>
    function deselect(pos) {
        $('#o1').prop("checked", false);
        $('#o2').prop("checked", false);
        $('#o3').prop("checked", false);
        $('#o4').prop("checked", false);
        var btn_no = pos + 1;
        //$('##'+btn_no).html('btn-success');
        document.getElementById('#' + btn_no).style.background = "white";
        document.getElementById('#' + btn_no).style.color = "#428bca";
    }
    function markAsReview(srno) {
        $.ajax({
            type: "POST",
            url: "<?= site_url() ?>Study_controller/markAsReview",
            data: "srno=" + srno,
            success: function (result)
            {
                $('#' + srno).css('background', '#fdbd00');
//                document.getElementById('#' + srno).style.background = "#fdbd00";
            }
        });
    }
</script>
<div class='panel panel-default panel_custom'>
    <div class='panel-heading'>
        <div class='panel-title'><?= strtoupper($subname) ?> / <?= strtoupper($topic_name) ?> / EXERCISE <?= $ex_type ?></div>
    </div>
    <div class="container-fluid" style="padding: 0px;">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1">
                <?php
                if (isset($sub) && $sub != "") {

//setting up the exam parameters
//LIMIT : NO OF QUESTIONS
                    $limit = 20;
//setting subject and topic
                    $this->session->set_userdata('limit', $limit);
                    $this->session->set_userdata('subid', $subid);
                    $this->session->set_userdata('topicid', $topicid);
                    $this->session->set_userdata('ex_type', $ex_type);
//filling or getting the questions array
                    $table = QUESTIONS;
//printing question
                    $get_q_ids = $this->db->select('id')->get_where(QUESTIONS, array('topic_id' => $topicid, 'q_type' => $ex_type));
//                        $get_q_ids = mysql_query("select id from $table where topic_id='$topicid' and q_type='$ex_type'") or die(mysql_error());
                    $data_count = $get_q_ids->num_rows();
//if no of questions are less than limit 
                    if ($data_count < $limit) {
                        echo"MINIMUM $limit QUESTIONS ARE REQUIRED $data_count";
//                            goto End_Page;
                    }
//get ids in an array
                    $j = 0;
                    foreach ($get_q_ids->result_array() as $q_data1) {
                        $data_arr[$j] = $q_data1['id'];
                        $j++;
                    }
                    $data_count--;
//setting random questions values
                    $selected_questions_arr = $data_arr;
                    /*
                      for($i=0;$i<$limit;$i++){
                      GETID:
                      $random_id=rand(0,$data_count);
                      $val=$data_arr[$random_id];
                      if($i==0){
                      $selected_questions_arr[$i]=$val;
                      }
                      else{
                      if(in_array($val,$selected_questions_arr)){
                      goto GETID;
                      }
                      else{
                      $selected_questions_arr[$i]=$val;
                      }
                      }
                      }
                     */
                    $this->session->set_userdata('ans_arr', array_fill(0, $this->session->userdata('limit'), 'U'));
                    $this->session->set_userdata('q_arr', $selected_questions_arr);
                    $this->session->set_userdata('qno', $qno);
                } else {
                    //if exam already started
                    $limit = $this->session->userdata('limit');
//setting subject and topic
                    $subid = $this->session->userdata('subid');
                    $topicid = $this->session->userdata('topicid');
//filling or getting the questions array
                    $selected_questions_arr = $this->session->userdata('q_arr');
                    $this->session->set_userdata('qno', $qno);
                }
//Current question id position
                $getQpos = $this->session->userdata('qno'); //later get position using POST method
                $curQid = $selected_questions_arr[$getQpos];
//setting previous and next
                $next = $getQpos + 1;
                $previous = $getQpos - 1;
//table selection
                $table = QUESTIONS;
//printing question
                $question_fetch_query123 = $this->db->get_where(QUESTIONS, array('id' => $curQid));
//                    $question_fetch_query123 = mysql_query("select * from $table Where id='$curQid'") or die(mysql_error());
                $q_data = (array) $question_fetch_query123->row();
//                    $intro_sr_no = $q_data['Intro_serial_no'];
                $intro = htmlspecialchars_decode(str_replace("tinymce", base_url() . "assets/tinymce", $q_data['Introduction']));
//STAR CODE
                ?>
                <div id='star'></div>
                <div class="exam_btn btn-group btn-group"  style='border-radius:100px;font-size:12px;'>
                    <?php
                    $markAsReview = $this->session->userdata('markAsReview') ? $this->session->userdata('markAsReview') : array();
                    $ans_arr = $this->session->userdata('ans_arr');
                    for ($qp = 1; $qp <= $limit; $qp++) {
                        $qp_pos = $qp - 1;
                        if (in_array($qp, $markAsReview)) {
                            echo "<a id='#$qp' class='btn btn-lg q_btn' style='border-radius:30px;background:#fdbd00' onclick=\"directQ('$getQpos','$qp_pos', 'next')\" >$qp</a>";
                        } elseif ($ans_arr[$qp_pos] == "U" || $ans_arr[$qp_pos] == "" || $ans_arr[$qp_pos] == null) {
                            echo "<a id='#$qp' class='btn btn-lg q_btn' style='border-radius:30px;' onclick=\"directQ('$getQpos','$qp_pos', 'next')\" >$qp</a>";
                        } else {
                            echo "<a id='#$qp' class='btn btn-lg q_btn btn-success' style='border-radius:30px;'  onclick=\"directQ('$getQpos','$qp_pos', 'next')\" >$qp</a>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class='exam_options'>
                <?php
                $type = "previous";
                $previous_button = "<input type=button class='btn previous option_btn' name='previous' onclick=\"getQ('$previous','$type')\" value='PREVIOUS'";
                $type = "next";
                if ($next == $limit) {
                    $next_button = "<input type=button class='btn btn-info option_btn' name='next' onclick=\"getQ('0', '$type')\" value='NEXT' ";
                } else {
                    $next_button = "<input type=button class='btn btn-info option_btn' name='next' onclick=\"getQ('$next', '$type')\" value='NEXT' ";
                }
                if ($getQpos == 0) {
                    echo "<tr><td colspan=2>" . $previous_button . "DISABLED />";
                    echo $next_button . "/>";
                } elseif ($getQpos == $limit - 1) {
                    echo "<tr><td colspan=2>" . $previous_button . "/>";
                    echo $next_button . "DISABLED />";
                } else {
                    echo "<tr><td colspan=2>" . $previous_button . "/>";
                    echo $next_button . "/>";
                }
                echo "<button class='btn btn-default option_btn' onclick='deselect($getQpos)'>DESELECT</button>
<input type=button class=' btn btn-default option_btn btn-block review_btn' style='float:right' name='end' onclick='askEndTest($getQpos)' value='END TEST' />";
//echo "<input type=button class='btn btn-default option_btn btn-block' name='mar' value='MARK AS REVIEW' /> </div>";
                ?>
                <button class='btn btn-default option_btn' style="padding:0px;text-align: center" onclick="markAsReview(<?php // echo $next                                                                                                ?>)" name='mar' >MARK </br>FOR </br>REVIEW</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table exam" style="width: 100%">
                <?php
//STAR DIV ENDS
                $ans_arr = $this->session->userdata('ans_arr');
                if ($intro == "" || empty($intro) || $intro == null) {
                    echo "<tr><th><p><b>$next.</b></th><th>" . "" . $question = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Question'])) . "</p></th></tr>";
                } else {
                    echo "<tr><th><p><b>$next.</b></th><th>$intro</th></tr><tr><td></td><th>" . "" . $question = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Question'])) . "</p></th></tr>";
                }
                $op1 = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Op1']));
                $op2 = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Op2']));
                $op3 = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Op3']));
                $op4 = htmlspecialchars_decode(str_replace("tinymce", "assets/tinymce", $q_data['Op4']));
                $ans = htmlspecialchars_decode($q_data['Answer']);
                ?>
                <?php
                $o1_statement = "<tr style='border:none'><td colspan=2><label class='btn btn-default' style='text-align:left;width:100%;'><input type=radio name='op' id='o1' value='1'";
                $o2_statement = "<tr><td colspan=2 style='border:none'><label class='btn btn-default' style='text-align: left;width:100%;'><input type=radio name='op' id='o2' value='2'";
                $o3_statement = "<tr><td colspan=2 style='border:none'><label class='btn btn-default' style='text-align: left;width:100%;'><input type=radio name='op' id='o3' value='3'";
                $o4_statement = "<tr><td colspan=2 style='border:none'><label class='btn btn-default' style='text-align: left;width:100%;'><input type=radio name='op' id='o4' value='4'";
                if ($ans_arr[$getQpos] == '1') {
                    echo "$o1_statement CHECKED /> $op1</label> </td></tr>";
                } else {
                    echo "$o1_statement />$op1 </label> </td></tr>";
                }
                if ($ans_arr[$getQpos] == '2') {
                    echo "$o2_statement CHECKED />$op2</label> </td></tr>";
                } else {
                    echo "$o2_statement />$op2 </label> </td></tr>";
                }
                if ($ans_arr[$getQpos] == '3') {
                    echo "$o3_statement CHECKED />$op3</label> </td></tr>";
                } else {
                    echo "$o3_statement /> $op3</label></td></tr>";
                }
                if ($ans_arr[$getQpos] == '4') {
                    echo "$o4_statement CHECKED /> $op4 </label></td></tr>";
                } else {
                    echo "$o4_statement /> $op4 </label></td></tr>";
                }
                $type = "previous";
                $previous_button = "<input type=button class='btn pad previous' name='previous' onclick=\"getQ('$previous','$type')\" value='PREVIOUS'";
                $type = "next";
                if ($next == $limit) {
                    $next_button = "<input type=button class='btn btn-info pad' name='next' onclick=\"getQ('0', '$type')\" value='NEXT' ";
                } else {
                    $next_button = "<input type=button class='btn btn-info pad' name='next' onclick=\"getQ('$next', '$type')\" value='NEXT' ";
                }
                if ($getQpos == 0) {
                    echo "<tr class='hidden-lg'><td colspan=2>" . $previous_button . "DISABLED />";
                    echo $next_button . "/>";
                } elseif ($getQpos == $limit - 1) {
                    echo "<tr class='hidden-lg'><td colspan=2>" . $previous_button . "/>";
                    echo $next_button . "DISABLED />";
                } else {
                    echo "<tr class='hidden-lg'><td colspan=2>" . $previous_button . "/>";
                    echo $next_button . "/>";
                }
                echo "<input type=button class='btn pad' name='mar' value='MARK AS REVIEW' /> </div>";
                echo "<button class='btn' onclick='deselect($getQpos)'>DESELECT</button><input type=button class='btn btn-info pad' style='float:right' name='end' onclick='askEndTest($getQpos)' value='END TEST' />";
                ?>
                </td></tr></table></div>
    </div>

    <script>
        $('.btn-info').on('click', function () {
            var $btn = $(this).button('loading')
            // business logic...
            //$btn.button('reset')
        });
        $('.previous').on('click', function () {
            var $btn = $(this).button('loading')
            // business logic...
            //$btn.button('reset')
        });
    </script>
    <?php
//$star_q=mysql_query("") or die(mysql_error());
//End_Page:
    ?>
</div>
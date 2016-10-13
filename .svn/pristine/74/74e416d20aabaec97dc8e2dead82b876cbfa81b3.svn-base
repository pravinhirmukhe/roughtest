<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//function flash_message() {
//    // get flash message from CI instance
//    $CI = & get_instance();
//    $flashmsg = $CI->session->flashdata('message');
//    $html = '';
////	$html=$flashmsg['content'];
//    if ($flashmsg['type'] == "s") {
//        $html = "    <div class='alert alert-success'>  ";
//    } else {
//        $html = "   <div class='alert alert-danger'> ";
//    }
//    $html = $html . " <a class='close' data-dismiss='alert'></a>  <strong>";
//    $html = $html . $flashmsg['content'] . " </strong></div>";
//    return $html;
//}

function flash_message() {
    $CI = get_instance();
    $r = $CI->session->flashdata('message');
    $msg = "";
    if (isset($r['type']) && $r['type'] && $r['type'] == "s") {
        $msg.= '<div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom: -8px;border-radius: 0px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        $msg.="<strong>" . $r['title'] . "</strong>";
        $msg.=$r['content'];
        $msg.="</div>";
    }
    if (isset($r['type']) && $r['type'] && $r['type'] == "e") {
        $msg.= '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: -8px;border-radius: 0px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        $msg.="<strong>" . $r['title'] . "</strong>";
        $msg.=$r['content'];
        $msg.="</div>";
    }
    echo $msg;
}

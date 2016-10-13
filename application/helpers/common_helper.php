<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function setValue($v1, $v2) {
    if (isset($v1) && $v1 != "") {
        return $v1;
    } else {
        return $v2;
    }
}

function currancyformat($p) {
    return "&#8377 " . number_format($p, 2);
}

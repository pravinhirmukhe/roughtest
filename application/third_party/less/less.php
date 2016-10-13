<?php

define('BASEPATH', '');
require_once '../system/core/Config.php';
require "lessc.inc.php";
header('Content-Type: text/css');
$path = $_GET['path'];
$con = new CI_Config();
//information about a file path
$filename = '' . ltrim($path, '/');
$path_parts = pathinfo($filename);


if ($path_parts['extension'] != 'less') {
    echo "/**\n * invalid file extension \n */";
    http_response_code(500);
    exit();
}

if (file_exists($filename)) {
    // $last_modified_time = filemtime($filename);
    // $etag = md5_file($filename);
    //
	// header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
    // header("Etag: $etag");
    //
	// if (!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && !empty($_SERVER['HTTP_IF_NONE_MATCH'])) {
    // 	if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time ||
    // 	    trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
    // 	    header("HTTP/1.1 304 Not Modified");
    // 	    exit;
    // 	}
    // }

    echo "/**\n * " . $path . "\n */\n\n";

    $less = new lessc;
    $less->setVariables($con->item('less'));
    $less->setPreserveComments(true);

    $file = $less->compileFile($filename);

    //relative url
    $file = preg_replace('/url\s*\((\'|\")*/', '$0' . $path_parts['dirname'] . '/', $file);
    echo $file;
} else {

    echo "/**\n * file \"" . $filename . "\" not exists \n */";

    http_response_code(404);

    exit();
}


<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Asset URL
 * 
 * Create a local URL to your assets based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('asset_url')) {

    function asset_url($uri = '', $group = FALSE) {
        $CI = & get_instance();

        if (!$dir = $CI->config->item('assets_path')) {
            $dir = 'assets/'; // change folder name
        }

        if ($group) {
            return $CI->config->base_url($dir . $group . '/' . $uri);
        } else {
            return $CI->config->base_url($dir . $uri);
        }
    }

}

/**
 * Less URL
 * Create a local URL to .less file
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('less_url')) {

    function less_url($uri = '') {
        $CI = & get_instance();

        if (!$dir = $CI->config->item('assets_path')) {
            $dir = '/'; // change folder name
        }
        return setLess($uri);
    }

}
if (!function_exists('setLess')) {

    function setLess($path) {

        require FCPATH . "application/third_party/less/lessc.inc.php";
        $CI = & get_instance();
        $filename = ltrim($path, '/');
        $path_parts = pathinfo($filename);


        if ($path_parts['extension'] != 'less') {
            echo "/**\n * invalid file extension \n */";
            http_response_code(500);
            exit();
        }

        if (file_exists($filename)) {
//            echo "/**\n * " . $path . "\n */\n\n";

            $less = new lessc;
            $less->setVariables($CI->config->item('less'));
            $less->setPreserveComments(true);
            $file = $less->compileFile($filename);
            $file = preg_replace('/url\s*\((\'|\")*/', '$0' . $path_parts['dirname'] . '/', $file);
            $f1 = fopen(FCPATH . "assets/css/less/my" . ucfirst(basename($filename, ".less")) . ".min.css", "w");
            fwrite($f1, $file, strlen($file));
            fclose($f1);
            return $CI->config->base_url("assets/css/less/my" . ucfirst(basename($filename, ".less")) . ".min.css");
        } else {
            $file = "/**\n * file \"" . $filename . "\" not exists \n */";
            $f1 = fopen(FCPATH . "assets/css/less/my" . ucfirst(basename($filename, ".less")) . ".min.css", "w");
            fwrite($f1, $file, strlen($file));
            fclose($f1);
            return $CI->config->base_url("assets/css/less/my" . ucfirst(basename($filename, ".less")) . ".min.css");
        }
    }

}

function setShadow() {
    echo"
    <style type='text/css'>
     .shadow{
        position: fixed;
	 top: 0;
	  right: 0;	
	  bottom: 0;
	  left: 0;
	  z-index: 1030;
	  background-color: #333333;
	  opacity:0.8; // I ADDED THIS LINE 
 }
    .panel{
        position:absolute;
        min-height:90%;
        min-width:100%;
        z-index:1040;
    }
    .rank{
        z-index:0;
    }
    .u_menu{
    z-index:-10;
    }
</style>
    ";
}

/* End of file url_helper.php */
/* Location: ./application/helpers/url_helper.php */
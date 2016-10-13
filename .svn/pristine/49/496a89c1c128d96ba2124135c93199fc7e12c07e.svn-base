<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" ng-app="flybuy"> 
    <?php $this->load->view('admin/layout/head'); ?>
    <body>
        <div id="<?php
        if (isset($data['metadata'])) {
            echo $data['metadata'];
        }
        ?>">
            <div id="wrapper">
                <?php $this->load->view('admin/layout/navbar'); ?>
                <?php $this->load->view('admin/layout/content', $data); ?>
            </div>
            <?php $this->load->view('admin/layout/footerlink'); ?>
        </div>
    </body>
</html>
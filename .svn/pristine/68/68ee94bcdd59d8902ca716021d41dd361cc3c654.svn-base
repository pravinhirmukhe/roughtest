
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>Roughsheet Admin | Signin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" /> 
        <meta name="keywords" content="" /> 
        <meta name="author" content="">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="<?= ADMINASSETS ?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <link href="<?= ADMINASSETS ?>css/style.css" rel='stylesheet' type='text/css' />
        <link href="<?= ADMINASSETS ?>css/font-awesome.css" rel="stylesheet"> 
        <script src="<?= ADMINASSETS ?>js/jquery.min.js"></script>
        <script src="<?= ADMINASSETS ?>js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h1><a href="<?= site_url('admin') ?>"><?= SITENAME ?></a></h1>
            <div class="login-bottom">
                <h2><?php echo lang('login_heading'); ?></h2>
                <div id="infoMessage"><?php echo $message; ?></div>
                <?php echo form_open(site_url() . "auth/login"); ?>
                <div class="col-md-6">
                    <?php // echo lang('login_identity_label', 'identity'); ?>
                    <div class="login-mail">

                        <?php echo form_input($identity); ?>
                        <i class="fa fa-envelope"></i>

                    </div>
                    <?php // echo lang('login_password_label', 'password'); ?>
                    <div class="login-mail">

                        <?php echo form_input($password); ?>

                        <i class="fa fa-lock"></i>
                    </div>
                    <?php echo lang('login_remember_label', 'remember'); ?>
                    <!--                    <label class="checkbox1">-->
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                    <!--</label>-->
                </div>
                <div class="col-md-6 login-do">
                    <label class="hvr-shutter-in-horizontal login-sub">
                        <?php echo form_submit('submit', lang('login_submit_btn')); ?>
                    </label>
<!--                    <p>Do not have an account?</p>
                    <a href="signup.html" class="hvr-shutter-in-horizontal">Signup</a>-->
                    <p>Do not have password?</p>
                    <a href="<?= site_url() ?>auth/forgot_password" class="hvr-shutter-in-horizontal"><?php echo lang('login_forgot_password'); ?></a>
                </div>

                <div class="clearfix"> </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!---->
        <div class="copy-right">
            <p> &copy; 2016. All Rights Reserved</p>
        </div>  
        <!---->
        <!--scrolling js-->
        <script src="<?= ADMINASSETS ?>js/jquery.nicescroll.js"></script>
        <script src="<?= ADMINASSETS ?>js/scripts.js"></script>
        <!--//scrolling js-->
    </body>
</html>


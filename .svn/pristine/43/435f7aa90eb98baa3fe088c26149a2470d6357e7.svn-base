
<!DOCTYPE HTML>
<html>
    <head>
        <title>FlyBuy Admin | Signin</title>
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
            <h1><a href="index.html"><?= SITENAME ?></a></h1>
            <div class="login-bottom">
                <h2><?php echo lang('forgot_password_heading'); ?></h2>
                <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>
                <div id="infoMessage"><?php echo $message; ?></div>
                <?php echo form_open(site_url() . "auth/forgot_password"); ?>
                <div class="col-md-12">
                    <?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?>
                    <div class="login-mail">
                        <?php echo form_input($identity); ?>
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="col-md-3 login-do">
                        <label class="hvr-shutter-in-horizontal login-sub">
                            <?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?>
                        </label>
                    </div>
                    <div class="col-md-3 login-do">

                        <a href="<?= site_url() ?>auth/login" class="hvr-shutter-in-horizontal"><?php echo lang('login_submit_btn'); ?></a>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!---->
        <div class="copy-right">
            <p> &copy; 2016. All Rights Reserved</p></div>  
        <!---->
        <!--scrolling js-->
        <script src="<?= ADMINASSETS ?>js/jquery.nicescroll.js"></script>
        <script src="<?= ADMINASSETS ?>js/scripts.js"></script>
        <!--//scrolling js-->
    </body>
</html>


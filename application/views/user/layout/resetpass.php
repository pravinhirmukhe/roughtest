<?php
//$chk_data = mysql_query("select * from " . FORGOT_PASS . " where email='$email' and link='$token_link'") or error_log(mysql_error());
$chk_data = $this->db->get_where(FORGOT_PASS, array('email' => urldecode($email), 'link' => urldecode($link)));
if ($chk_data->num_rows() == 0) {
    echo '<center><h3>Token Link Expierd Please Resend your email Address from forget password</h3></center>';
    exit;
}
?>
<link rel="icon" href="<?= ASSETSURL ?>images/tab_icon.png">
<title>RoughSheet</title>
<body>
    <link href="<?= ASSETSURL ?>css/bootstrap.css" rel="stylesheet">
    <style>
        body{background:url(assets/img/f_bg.jpg);}
        .f_box{
            width:300px;
            height:400px;
            border-radius:5px;
            margin:90px auto;
            box-shadow: 0 0 2px #eee;
            background:#fff;
            padding:40px;
            opacity:0.8;
        }
        footer{display:none;}
    </style>    
    <div class='f_box'>
        <a class="navbar-brand" href="index.php">
            <img  src="<?= ASSETSURL ?>images/rs_logo.png" style="width:220px;height:70px;margin-left:-20px;margin-top:-30px; " alt="roughsheet" />
        </a>
        </br></br>
        <form method="POST" class="form-horizontal" style='margin-top:20px;' action="<?= SITEURL ?>resetp">
            <div class="form-group">
                <input type="hidden" name="hidden_flag" value="1_rs_recover" >
                <label>New Password:</label> 
                <input  type="password" class="form-control" name="pass">
            </div>
            <div class="form-group">
                <label>Re-Type Password: </label>
                <input type="password" class="form-control" name="cpass"><br>
                <input type="hidden" value="<?= $link ?>" class="form-control" name="link"><br>
                <input type="hidden" value="<?= $email ?>" class="form-control" name="email"><br>
                <input type="submit" class='btn btn-block' value="Reset">
            </div>
        </form>
    </div>
</body>
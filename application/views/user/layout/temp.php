<html lang="en">
    <!-- Mirrored from localhost/roughsheet/ by HTTrack Website Copier/3.x [XR&CO'2006], Fri, 09 Sep 2016 04:09:08 GMT -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RoughSheet is a FREE Interactive and Online Platform to Learn and Practice Aptitude to help crack Company Placement Papers,Daily pratice problem sheet,analysis,Study planner, Focus area,Topic practice problem sheet,Online test,roughsheet, RoughSheet, Aptitude,free test,jobs, recruitment,placements, rough,sheet,rough sheet,www.roughsheet.com,roughsheet.com">
        <meta name="author" content="">
        <link rel="icon" href="assets/images/tab_icon.png">
        <title>RoughSheet</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/datepicker.css" rel="stylesheet">
        <link href="assets/css/animate.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/crumble.css" >
        <link rel="stylesheet" href="assets/css/grumble.min.css">
        <!-- Custom styles for this template -->
        <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="assets/js/ie-emulation-modes-warning.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--[if lte IE 9]>
        <script src="animation-legacy-support.js"></script>
    <![endif]-->
        <script src="assets/js/ajax_func.js"></script> 
        <link href="http://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
    </head>
    <!-- Build  your Aptitude for free, forever--><body ><style type="text/css">
            .alert{margin-left:60px;width:300px;color:#333;}
            .he{width:100%;background:#fff;min-width:100%;height:30px;}
            .navbar .navbar-nav .dropdown >a:hover{background:#fff;color:#dfe3ee;}
            .dropdown-menu > li > a:hover{background:#24b060;color:#333;}
            .navbar-default .navbar-nav > .active > a {background:#24b060;color:#24b060;}
            .navbar-default .navbar-nav > .active > a:hover {background:#fff;color: #24b060;}
            .navbar-default .navbar-nav > li > a{color:#333;}
            .navbar-default .navbar-nav > li > a:hover{background:#fff;color:#24b060;}
            .navbar-nav > li > a {padding-top:15px !important; padding-bottom:15px !important;}
            .navbar {background:#fff;min-height:53px !important}
            ul{text-align:justify}
            .carousel-caption{padding:0 0px;margin-top:-100px;color:#333;text-align: left;}
            .item{margin:0px;min-height:480px;padding: 30px;color:#333;text-align:center;}
        </style>
        <style type="text/css">
            section {padding-top:0px;margin-top:0px;padding-bottom:100px;/*border-radius: 500px 0px 0px 500px;*/}
            .min-height-cls {min-height:600px;}
            .pad-top {padding-top:60px;}
            .movx{-webkit-transform: skewY(40deg);transform: skewY(40deg);}
            .movy{-webkit-transform: skewX(10deg);}
            .social{float:right;background:transparent;margin-right:160px;}
            /*input[type="text"], input[type="password"], input[type="email"] {background-color : #d1d1d1;}*/
            input[type="text"], input[type="password"], input[type="email"] {background-color :#fff;}
            .navbar-custom {background-color:#fff;color:#24b060;border-radius:0;}
            .navbar-custom .navbar-nav > li > a {color:#333;padding-left:20px;padding-right:20px;}
            .navbar-custom .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus {color:#333;background-color:transparent;}
            .navbar-custom .navbar-nav > li > a:hover, .nav > li > a:focus {text-decoration: none;background-color:transparent;}
            .navbar-custom .icon-bar {background-color:#fff;}
            html>body .navbar { 
                height: auto;
            }
            .item >p,.item >h4,.item > ul li{color:#fff;}
            .item >p,.item > ul li{font-size:19px;}
        </style>
    <body data-spy="scroll" data-target=".navbar-default" style="position:inherit;">
        <script type="text/javascript">
            function toggle_i_code() {
                if (document.getElementById('i_code_present_yes').checked) {
                    document.getElementById('i_code').disabled = false;
                    document.getElementById('i_code').style.display = "block";
                }
                else {
                    document.getElementById('i_code').disabled = true;
                    document.getElementById('i_code').style.display = "none";
                }
            }
            function prevStep() {
                document.getElementById('page1').style.display = "block";
                document.getElementById('page2').style.display = "none";
                document.getElementById('back').style.display = "none";
                document.getElementById('next').style.display = "block";
                document.getElementById('submit').style.display = "none";
                document.getElementById('loader').innerHTML = "";
            }
            function nextStep() {
                document.getElementById('page1').style.display = "none";
                document.getElementById('page2').style.display = "block";
                document.getElementById('back').style.display = "block";
                document.getElementById('next').style.display = "none";
                document.getElementById('submit').style.display = "block";
            }
            function mailq() {
                name = document.getElementById('fname').value;
                subject = document.getElementById('sub').value;
                email = document.getElementById('email').value;
                msg = document.getElementById('message').value;
                $.ajax({
                    type: "POST",
                    url: "app/contact_smtpmailer.php",
                    data: {
                        "name": name,
                        "sub": subject,
                        "email": email,
                        "msg": msg
                    },
                    success: function (result)
                    {
                        var data = JSON.parse(result);
                        //data['name'] => email,subject,msg
                        $("#print_message").html("<i>" + data['success'] + "</i>");
                        $("#print_error_name").html("<i>" + data['name'] + "</i>");
                        $("#print_error_email").html("<i>" + data['email'] + "</i>");
                        $("#print_error_subject").html("<i>" + data['subject'] + "</i>");
                        $("#print_error_msg").html("<i>" + data['msg'] + "</i>");
                        document.getElementById('fname').value = "";
                        document.getElementById('sub').value = "";
                        document.getElementById('email').value = "";
                        document.getElementById('message').value = "";
                    }
                });
            }
        </script>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top scrollclass" style="border-bottom: 3px #37a8df solid;max-height:30px;height:30px;" >
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="border-top:solid 1px #febf10;
                            border-bottom:2px solid #37a8df;border-left:1px solid #fc6f4b;border-right:1px solid #25af60;">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#home">
                        <img src="assets/images/logo_beta.png"  alt="roughsheet" style='margin-top:-4px;' />
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse navbar-custom">
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                        <li><a href="#roughsheet_how" class="animated fadeIn">How it Works</a></li>
                        <li><a href="#features" class="animated fadeIn">Features</a></li>
                        <li><a href="#about"  class="animated fadeIn">About Us</a></li>
                        <li><a href="#contact" class="animated fadeIn">Contact Us</a></li>
                        <li><a href="http://www.roughsheet.com/app/blog/" class="animated fadeIn">Blog</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div></div>
        <section id="home" class="res_home">
            <div class="container-fluid" style="margin-top:50px;width:100%;">
                <div class="row text-center">
                    <div class="col-md-12" style="margin-top:80px;">      
                        <center>
                            <img src="assets/images/rs_logo_1.png" class="r_big_logo wow fadeInLeft"  alt="roughsheet"/>
                            <!--<h1 class="welcome animated bounceInUp" style="color:#111;">Welcome to Roughsheet</h1>      -->
                            <h1 style='color:#37a8df;' class="wow fadeIn home_h1">Want to join us?</h1></center>
                        <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success btn-lg">Sign up</a></br></br>
                        <a href="#features" class='btn btn-defalut btn-info btn-lg' style="border-radius:50px;">
                            <!--<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>-->
                            Learn More
                        </a> 
                        <form method=POST action=http://localhost/roughsheet/index.php class="form-inline login-form ">
                            <input type=hidden name=func_type value=login />
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 col-xs-4">Email</label>
                                <div class="col-sm-2 col-xs-8 col-md-3">
                                    <input type="text" class="form-control" name="username_email" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 col-xs-4">Password</label>
                                <div class="col-sm-4 col-xs-8 col-md-3">
                                    <input type="password" class="form-control " name="password" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"  value="remember">Keep me logged in
                                        </label>
                                        </br><a href="index888b.html?func_type=forgotpass" style="color:#fff;font-size:12px;margin-top:5px;float:right;">Forgot your password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div  style="float:left;margin-left:20%;">
                                    <button type="submit" name=submit class="btn btn-block btn-default" style="width:100px;">Log in</button>
                                </div>
                            </div><!--
                            <div class="form-group">
                              <div  style="float:left">
                                <center><p>Want to join us?</p></center>
                             <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-block btn-warning">Sign up</a>
                              </div>
                            </div>
                            -->
                        </form>
                    </div>  
                </div>
            </div> 
        </section>
        <!-- how it works start -->
        <section id="roughsheet_how" class="how_it_works" style="background: #f8f8f8;">
            <div class="container">
                <div class="row pad-top placeholders">
                    <center><h1 style="color: #24b060">
                            How it works</h1></center>
                    <div class="col-sm-3 placeholder wow fadeIn">
                        <img class='img-responsive' src="assets/images/how_icons/login_1.png" >
                        <h4>Login to get started!</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.1s">
                        <img class='img-responsive' style="padding-top: 20px;" src="assets/images/how_icons/right.png" >
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="0.2s">
                        <img class='img-responsive' src="assets/images/how_icons/planner_1.png" >
                        <h4>Plan your studies</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.4s">
                        <img class='img-responsive' style="padding-top: 20px;" src="assets/images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="0.5s">
                        <img class='img-responsive' src="assets/images/how_icons/stdy_1.png" >
                        <h4>Build your concepts</h4>
                    </div>
                </div>
                <div class="row  placeholders" style=''>
                    <div class="col-sm-11 placeholder"  >
                        <p>&nbsp;</p>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.8s">
                        <img class='img-responsive' style="float: left;margin-left:-180px;margin-top:20px;" src="assets/images/how_icons/down.png" >   
                    </div>
                </div>   
                <div class="row  placeholders">
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1.9s">
                        <img class='img-responsive' src="assets/images/how_icons/perform_4.png" >
                        <h4>Monitor your progress</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="1.8s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="assets/images/how_icons/left.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1.5s">
                        <img class='img-responsive' src="assets/images/how_icons/fa_1.png" >
                        <h4>Indentify your weakness</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="1.1s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="assets/images/how_icons/left.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1s">
                        <img class='img-responsive' src="assets/images/how_icons/pp_1.png" >
                        <h4>Practice and revise</h4>
                    </div>
                </div>   
                <div class="row placeholders" style="">
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.1s">
                        <img class='img-responsive pad-top' style='margin-left:100px;margin-top:-40px;'src="assets/images/how_icons/down.png" >   
                    </div>
                </div>
                <div class="row placeholders" style="">
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="2.2s">
                        <img class='img-responsive' src="assets/images/how_icons/rank_1.png" >
                        <h4>Understand the competition</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.4s">
                        <img class='img-responsive pad-top'  style="padding-top: 20px;" src="assets/images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="2.6s">
                        <img class='img-responsive' src="assets/images/how_icons/imp_3.png" >
                        <h4>Improve!</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.9s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="assets/images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="3.1s">
                        <img class='img-responsive' src="assets/images/how_icons/target_2.png" >
                        <h4>With your hardwork and RoughSheet, let us achieve the target that you set out for!</h4>
                    </div>
                    <!-- <div class="col-sm-9 placeholder wow bounceIn" data-wow-delay="4.2s">
                     <img class='img-responsive' src="assets/images/how_icons/free_red.png" >   
                    <h4>The best part - we're free!</h4> 
                     </div>-->
                </div>
            </div>
        </section>
        <!-- ends -->
        <section id="features">
            <div class="container-fluid">
                <div class="row pad-top  min-height-cls" >
                    <center><h1 style="color: #24b060">
                            Features</h1></center>
                    <div class="col-md-6" >
                        <img src="assets/images/flowchart.jpg" class="img-responsive wow zoomInRight glass features_img" data-wow-delay="0.3s" alt="roughsheet" />             
                    </div>
                    <div class="col-md-6">    
                        <!--1-->
                        <div id="carousel-example-generic" class="carousel slide wow zoomInLeft" data-ride="carousel"  >
                            <ol class="carousel-indicators" >
                                <li data-target="#carousel-example-captions" data-slide-to="0" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="2" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="3" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="4" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="5" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="6" class=""></li>
                                <li data-target="#carousel-example-captions" data-slide-to="7" class=""></li>
                            </ol>    
                            <div class="carousel-inner" role="listbox" >
                                <div class="item  active" style="background:#f04b23;">  
                                    <center>
                                        <img class="media-object" src="assets/images/network.png"  style="background:#f04b23;">
                                    </center>
                                    <hr><h4 class="media-heading">NETWORK</h4>
                                    <p>Connect with people aspiring to hone their aptitude skills</p>
                                    <p>Understand your competition</p>    
                                </div>
                                <!-- end-->
                                <!-- 3-->
                                <div class="item" style="background: #37a8df;">
                                    <center>
                                        <img class="media-object" src="assets/images/study.png"  style="background: #37a8df;" alt="its free image">
                                    </center>
                                    <hr><h4 class="media-heading">STUDY & REVISION PLANNER</h4>
                                    <ul><li>Based on your time availability, our algorithm will devise a study plan for you
                                        </li><li>Based on your efficiency, our algorithm will pan out a revision plan for you</li>
                                    </ul>
                                </div> 
                                <!-- end-->
                                <!-- 4-->
                                <div class="item" style="background: #febf10;">
                                    <center>
                                        <img class="media-object" src="assets/images/material.png"  style="background: #febf10;" alt="its free image">
                                    </center>          
                                    <hr><h4 class="media-heading">STUDY MATERIAL</h4>
                                    <uL><li>Categorical and comprehensive study material to help your concept-building
                                        </li><li>Solved illustrations to help you understand the applications of various concepts
                                        </li><li>Standard sets of exercises and detailed solutions to apply finishing touch to your preparation
                                        </li></uL>
                                </div>
                                <!-- end-->
                                <!-- 5-->
                                <div class="item" style="background:#25af60;">
                                    <center>
                                        <img class="media-object" src="assets/images/dpp.png"  style="background:#25af60;" alt="its free image">
                                    </center>
                                    <hr><h4 class="media-heading">DAILY PRACTICE PROBLEM SHEETS</h4>
                                    <ul><li>DPPS is the perfect tool to constantly and regularly revise concepts
                                        </li><li>You'll get 10 problems, of varying difficulty level, per subject on a daily basis from those topics that you've completed
                                        </li><li>Solutions of the problems will help you check your approach
                                        </li><li>Your performance, in all the subjects, will be analysed on these parameters - percentage accuracy, percentage marks obtained, percentile ranking</p>
                                        </li></ul>
                                </div>
                                <!-- end-->
                                <!-- 6-->
                                <div class="item" style="background:#25af60;">
                                    <center>
                                        <img class="media-object" src="assets/images/tpp.png"  style="background:#25af60; " alt="its free image">
                                    </center>
                                    <hr><h4 class="media-heading">TOPIC PRACTICE PROBLEM SHEETS</h4>
                                    <ul><li>Topic Practice Problem Sheet is the perfect tool to constantly and regularly revise concepts
                                        </li><li>A TPPS will have 10 problems on a particular topic of a specific subject, to be attempted once in a week, in order to revise properly
                                        </li><li>Solutions of the problems will help you check your approach
                                        </li><li>Your performance, in all the topics, will be analysed on these parameters - percentage accuracy, percentage marks obtained, percentile ranking
                                        </li></ul>
                                </div>
                                <!-- end-->
                                <!-- 7-->
                                <div class="item" style="background:#febf10;">
                                    <center>
                                        <img class="media-object" src="assets/images/pr.png"  style="background:#febf10;width:64px;height:64px;" alt="its free image">
                                    </center> 
                                    <hr><h4 class="media-heading">PERFORMANCE & RANKING</h4>
                                    <ul><li>Ranking of two types - Weekly and Cumulative</li>
                                        <li>Ranking at two levels - Friends and Overall</li>
                                        <li>Based on your performance in the DPPS, ranking will be generated to give a better understanding of where you stand amongst the masses</li>
                                    </ul>
                                </div>
                                <!-- end-->
                                <!-- 8-->
                                <div class="item" style="background: #37a8df;">
                                    <center>
                                        <img class="media-object" src="assets/images/wa.png"  style="background: #37a8df;width:64px;height:64px;" alt="its free image">
                                    </center> 
                                    <hr><h4 class="media-heading">WEAK AREA ANALYSIS</h4>
                                    <ul><li>Based on your performances, our algorithms will determine and identify the weak areas that you may have in each subject</li></ul>           
                                    <!--ends-->
                                </div>
                                <!-- 2-->
                                <div class="item" style="background:#f04b23;">
                                    <center><img class="media-object" src="assets/images/free.png"  style="background:#f04b23;" alt="its free image">
                                    </center>
                                    <hr>
                                    <h4 class="media-heading">IT'S FREE</h4>
                                    <p>Yes! It's free Forever.</p>
                                </div>
                                <!-- end-->
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div></div></div>
        </section >
        <section  id="about">
            <div class="container-fluid">
                <div class="row pad-top" >
                    <div class="col-md-12">
                        <center>
                            <h1>About Us</h1>         
                        </center>
                        <div class="col-sm-5 about_li glass wow rotateIn" data-wow-delay="0.5s" >
                            <p style="margin-top:-10px;"> Rome wasn't built in a day. It all started with a humble beginning.
                                RoughSheet has arrived, to innovate, redefine and simplify education. RoughSheet has a big vision going forward and our humble beginning is this platform to hone aptitude skills.
                            </p></div>
                        <div class="col-sm-5 about_li glass wow rotateIn about_circle_pad" data-wow-delay="0.8s" >
                            <p style="margin-top:10px;"> We're a team of highly motivated individuals - marketing minds, developers, business analysts, teachers who share the common vision of making education and learning easier, more enticing and above all, free.
                            </p></div> 
                        <div class="col-sm-5 about_li glass wow rotateIn" data-wow-delay="1s" >
                            <p style="margin-top:10px;"> Two things are at the core of RoughSheet - simplicity and equality.
                                Simplicity is quite evident in the design, look and feel of our website.
                                And, because we're staunch believers of equality, RoughSheet is free at the user-end.</p>
                        </div> 
                        <div class="col-sm-5 about_li glass wow rotateIn about_circle_pad" data-wow-delay="1.2s">
                            <p style="margin-top:30px;">Come and join our community in making this world a better place to learn, grow and flourish. Together, we can make an everlasting dent in this universe.
                            </p>
                        </div>
                    </div></div></div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <center>
                        <h1>Contact Us</h1>   </center>
                    <div class="col-md-3">
                        <center><div class="detail">
                                <img  src="assets/images/rs_logo.png" style="width:200px;height:50px;"  alt="roughsheet" />
                            </div></br>
                            </br></br></center>
                        <div class="detail">
                            <h4>Drop Us An Email</h4>
                            <p>contact@roughsheet.com</p>
                        </div> 
                        </br></br>
                        <div class="detail">
                            <h4>Follow Us On</h4>
                            <div class="wow flipInX">
                                <p class="wowload flipInX">
                                    <a href="https://twitter.com/roughsheetinc"><img src="assets/images/tw.png"/></a>
                                    <a href="https://www.facebook.com/roughsheet"><img  src="assets/images/fb.png"/></a>
                                    <a href="https://www.linkedin.com/company/roughsheet"><img  src="assets/images/in.png"/></a>
                                    <!--<a href="#"><i class="fa fa-flickr fa-2x">flicker</i></a>-->
                                </p>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-9">
                        <br>     
                        <center></center>
                        <span class="form-horizontal">
                            <div class="form-group wow fadeInDown" data-wow-delay="0.1s">
                                <span class="col-md-1 col-md-offset-2 ">Name</span>
                                <div class="col-md-8">
                                    <input id="fname" name="name" type="text" placeholder="Name" class="form-control">
                                    <span class='error' id="print_error_name"></span>
                                </div>
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-delay="0.2s">
                                <span class="col-md-1 col-md-offset-2 ">Subject</span>
                                <div class="col-md-8">
                                    <input id="sub" name="subject" type="text" placeholder="Subject" class="form-control">
                                    <span class='error' id="print_error_subject"></span>
                                </div>
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-delay="0.3s" >
                                <span class="col-md-1 col-md-offset-2 ">Email</span>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                                    <span class='error' id="print_error_email"></span>
                                </div>
                            </div>
                            <div class="form-group wow slideInDown" data-wow-delay="2">
                                <span class="col-md-1 col-md-offset-2 ">Message</span>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="message" name="message" placeholder="what's on your mind?" rows="7"></textarea>
                                    <span class='error' id="print_error_msg"></span>
                                </div>
                            </div>
                            <div class="form-group wow slideInDown" data-wow-delay="2.4">
                                <div class="col-md-8 col-md-offset-3 text-center">
                                    <button type="submit" onclick="mailq()" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span</button>
                                </div>
                                <div class="col-md-8 col-md-offset-3 text-center">
                                    </br>
                                    <span style='color:green' id="print_message"></span>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <!--registration model code-->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background: #f8f8f8;opacity: 1" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center><h4 class="modal-title" id="myModalLabel">Sign Up</h4></center>
                    </div>
                    <div class="modal-body" style="background:#f4f4f4;">
                        <div class="container-fluid"> 
                            <div class="row" id="reg_info">
                                <div class="col-xs-8 col-sm-12">
                                    <!--      registration form        -->
                                    <form method="post" action="http://localhost/roughsheet/index.php" id="register" class="form-horizontal" style="padding: 5px;"> 
                                        <input type=hidden name=func_type value=register />
                                        <!----start---->
                                        <span id="page1">
                                            <div class="form-group">
                                                <label for="fb_link" class="col-sm-4 control-label">Facebook Profile Link</label> 
                                                <div class="col-sm-6 col-sm-3">
                                                    <input type="text" name="fb_link" class="col-md-3 form-control" placeholder="Facebook Profile Link" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_fb_link"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="first name" class="col-sm-4 control-label">First Name</label> 
                                                <div class="col-sm-6 col-sm-3">
                                                    <input type="text" name="f_name" class="col-md-3 form-control" placeholder="First Name" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_f_name"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4  control-label">
                                                    Last Name
                                                </label> 
                                                <div class="col-sm-3">
                                                    <input type=text name="l_name" class="form-control" placeholder="last Name"/>
                                                </div><span class="label label-danger animated fadeIn"  style="position: relative ; top:10;" id="err_l_name"></span></div>
                                            <div class="form-group" >
                                                <label for="gender" class="col-sm-4 control-label">
                                                    Gender
                                                </label>
                                                <div class="col-sm-6 ">  
                                                    <input type=radio id="gender" name="gender" value="Male" />
                                                    Male
                                                    <input type=radio id="gender" name="gender" value="Female" /> Female
                                                    <span class="label label-danger animated fadeIn" style="position: relative;left:75;" id="err_gender"></span>
                                                    <span class="label label-danger animated fadeIn" style="position: relative;left:75;" id="err_gender"></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="dob" class="col-sm-4 col-md-4 control-label">
                                                    Date of birth </label>
                                                <div class="col-sm-8">
                                                    <!-- <input type="text"  class="form-control datepicker" name="dob"  readonly/> -->
                                                    <select id="dob_y" name='dob_y' class='form-control  input-sm col-xs-1' style='width:73px;'>
                                                        <option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option><option value='1997'>1997</option><option value='1996'>1996</option><option value='1995'>1995</option><option value='1994'>1994</option><option value='1993'>1993</option><option value='1992'>1992</option><option value='1991'>1991</option><option value='1990'>1990</option><option value='1989'>1989</option><option value='1988'>1988</option><option value='1987'>1987</option><option value='1986'>1986</option><option value='1985'>1985</option><option value='1984'>1984</option><option value='1983'>1983</option><option value='1982'>1982</option><option value='1981'>1981</option><option value='1980'>1980</option><option value='1979'>1979</option><option value='1978'>1978</option><option value='1977'>1977</option><option value='1976'>1976</option><option value='1975'>1975</option><option value='1974'>1974</option><option value='1973'>1973</option><option value='1972'>1972</option><option value='1971'>1971</option><option value='1970'>1970</option><option value='1969'>1969</option><option value='1968'>1968</option><option value='1967'>1967</option><option value='1966'>1966</option><option value='1965'>1965</option><option value='1964'>1964</option><option value='1963'>1963</option><option value='1962'>1962</option><option value='1961'>1961</option><option value='1960'>1960</option><option value='1959'>1959</option><option value='1958'>1958</option><option value='1957'>1957</option><option value='1956'>1956</option><option value='1955'>1955</option><option value='1954'>1954</option><option value='1953'>1953</option><option value='1952'>1952</option><option value='1951'>1951</option><option value='1950'>1950</option><option value='1949'>1949</option><option value='1948'>1948</option><option value='1947'>1947</option><option value='1946'>1946</option><option value='1945'>1945</option><option value='1944'>1944</option><option value='1943'>1943</option><option value='1942'>1942</option><option value='1941'>1941</option><option value='1940'>1940</option><option value='1939'>1939</option><option value='1938'>1938</option><option value='1937'>1937</option><option value='1936'>1936</option><option value='1935'>1935</option><option value='1934'>1934</option><option value='1933'>1933</option><option value='1932'>1932</option><option value='1931'>1931</option><option value='1930'>1930</option><option value='1929'>1929</option><option value='1928'>1928</option><option value='1927'>1927</option><option value='1926'>1926</option><option value='1925'>1925</option><option value='1924'>1924</option><option value='1923'>1923</option><option value='1922'>1922</option><option value='1921'>1921</option><option value='1920'>1920</option><option value='1919'>1919</option><option value='1918'>1918</option><option value='1917'>1917</option><option value='1916'>1916</option>                                                    </select>
                                                    <script>
                                                        function getDates() {
                                                            var e = document.getElementById("dob_m");
                                                            var month_val = e.options[e.selectedIndex].value;
                                                            var y = document.getElementById("dob_y");
                                                            var year = y.options[y.selectedIndex].value;
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "app/includes/set.php?totalDays",
                                                                data: {
                                                                    "year": year,
                                                                    "month": month_val
                                                                },
                                                                success: function (result) {
                                                                    document.getElementById('dob_d_place').innerHTML = "<select id='dob_d' class='form-control  input-sm' style='width:70px;' name='dob_d'>" + result + "</select>";
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    <select id="dob_m" class='form-control input-sm' style='width:90px;' name='dob_m' onchange="getDates()">
                                                        <option value='0' >Month</option>
                                                        <option value='1'>Jan</option><option value='2'>Feb</option><option value='3'>Mar</option><option value='4'>Apr</option><option value='5'>May</option><option value='6'>June</option><option value='7'>July</option><option value='8'>Aug</option><option value='9'>Sep</option><option value='10'>Oct</option><option value='11'>Nov</option><option value='12'>Dec</option>                                                    </select>
                                                    <span id='dob_d_place'><select class='form-control input-sm' style='width:73px;' ><option value="0">Date</option></select></span>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;left:540;top:-24" id="err_dob"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="i_code" class="col-sm-4 control-label">Do you have invitation code ?</label> 
                                                <div class="col-sm-6 col-sm-3">
                                                    <input type="radio" name="i_code_present" CHECKED id="i_code_present_yes" value="yes" onclick="toggle_i_code()"/> Yes
                                                    <input type="radio" name="i_code_present" id="i_code_present_no" value="no" onclick="toggle_i_code()"/> No
                                                    <br>
                                                    <span id='i_code_area'>
                                                        <input type=text name="i_code" id="i_code" class="form-control" placeholder="Invitation Code">
                                                    </span>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_i_code"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4 control-label"></label>
                                                <div class="col-sm-5 col-md-3">
                                                    <img src="app/captcha.jpg" id="captcha"/>
                                                    <!-- CHANGE TEXT LINK -->
                                                    <a href="#" onclick="
                                                            document.getElementById('captcha').src = 'app/captchad41d.jpg?' + Math.random();
                                                            document.getElementById('captcha-form').focus();"
                                                       id="change-image">Not readable? Change text.</a><br/>
                                                    <input type="text" name="captcha" id="captcha-form" autocomplete="off" class="form-control" placeholder="Captcha"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:100;left30;" id="err_captcha"></span></div>
                                        </span>
                                        <!-- page 1 -->
                                        <!-- page 2 -->
                                        <span id="page2" style="display:none;">
                                            <div class="form-group">
                                                <label for="email" class="col-sm-4 control-label">
                                                    Email </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <input type=email name="email" class="form-control" placeholder="Email" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_email"></span></div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4 control-label">  
                                                    Password
                                                </label>
                                                <div class="col-sm-6 col-md-3">
                                                    <input type=password name="u_pass" class="form-control" placeholder="Password" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_u_pass"></span></div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4 control-label">  
                                                    Confirm-Password
                                                </label>
                                                <div class="col-sm-6 col-md-3"><input type=password name="u_pass_confirm"  class="form-control" placeholder="Confirm password"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_u_pass_confirm"></span></div> 
                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Location </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <input type=text name="location" class="form-control" placeholder="Location" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span></div>
                                            <div class="form-group">
                                                <label for="currently" class="col-sm-4 control-label">
                                                    Currently </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <input type=radio name="currently" value="1" /> Studying in school <br>
                                                    <input type=radio name="currently" value="2" /> Studying in college <br>
                                                    <input type=radio name="currently" value="3" /> Working.
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_currently"></span></div>
                                            </div>
                                        </span>
                                        <input type="button" class="btn" id="back" onclick="prevStep()" style="float:left;display:none;" value=" < Back ">
                                        <input type="button" class="btn" id="next" onclick="nextStep()" style="float:right;" value=" Next > ">
                                        <input type="button" name="submit" id="submit" style="display:none;float:right;" value="Sign Up" onclick="try_register()" class="btn btn-success btn-lg" id="reg_btn" /><span id="loader"></span>
                                </div>
                                <div class="col-xs-4 col-sm-6" id="reg_err" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top:solid 2px #febf10;">
                            <center>   By signing up, you agree to our <a href="#" onclick="window.open('app/legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href=# onclick="window.open('app/legal_docs/Privacy_Policy.html');">Privacy Policy</a>.
                            </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </br></br>
        <footer class="footer">
            <div class="footer_line">&nbsp;</div>
            <div  style='float:right;padding-right:40px;margin-top:0px;color:#333;'>
                <a href="#" onclick="window.open('app/legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href="#" onclick="window.open('app/legal_docs/Privacy_Policy.html');">Privacy Policy</a>.</div>
            <div  class="icon_links">
                <a href="https://twitter.com/roughsheetinc"><img src="assets/images/tw.png" class='social_icons' /></a>
                <a href="https://www.facebook.com/roughsheet"><img src="assets/images/fb.png" class='social_icons'/></a>
                <a href="https://www.linkedin.com/company/roughsheet"><img src="assets/images/in.png" class='social_icons' /></a>
                <!--<a href="#"><i class="fa fa-flickr fa-2x">flicker</i></a>-->
            </div>
        </footer>
        <!-- hide elements-->
        <script>
            document.getElementById("notification-bar").style.display = 'none';
        </script>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script type="text/javascript">
            $('body').scrollspy({target: '.navbar-example'});
        </script>
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.js"></script>
        <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/jquery.easing.min.js"></script>
        <script src="assets/js/amcharts.js" type="text/javascript"></script>
        <script src="assets/js/pie.js" type="text/javascript"></script>
        <script src="assets/js/wow.min.js"></script>
        <!--<script src="assets/js/jquery.crumble.min.js"></script>-->
        <!--<script src="assets/js/jquery.grumble.min.js"></script>-->
        <script type="text/javascript" src="assets/js/jquery.newsWidget.js"></script> 
        <!--  on click tour -->
        <script>
            if ($(window).width() > 999) {
                $("#take_tour").click(function () {
                    $('#tour').crumble();
                });
                $("#take_tour1").click(function () {
                    $('#tour').crumble();
                });
            }
        </script>
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datepicker();
            $('.datepicker').on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
        })
    </script>
    <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '../../www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-66314918-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!--
    <!-- EASING SCROLL SCRIPTS PLUGIN  -->
    <script>
        new WOW().init();
        wow = new WOW(
                {
                    boxClass: 'wow', // default
                    animateClass: 'animated', // default
                    offset: 0, // default
                    mobile: true, // default
                    live: true        // default
                }
        )
        wow.init();
    </script>
    <script>
        $(function () {
            $('.scrollclass a').bind('click', function (event) { //just pass scrollclass in design and start scrolling
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1000, 'easeInOutQuad');
                event.preventDefault();
            });
        })
        $(document).ready(function () {
            $("body").tooltip({selector: '[data-toggle=tooltip]'});
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".search_toggle").click(function () {
                $(".hidden-lg").toggle();
            });
        });
    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="assets/js/inject.js" os="windows7" ptid="wpm11264" uid="HitachiXHTS545050A7E380_120703TEJ51139GHNTUSX" id="detIdGdpScript" type="text/javascript" charset="UTF-8">
    </script>
</body>

<!-- Mirrored from localhost/roughsheet/ by HTTrack Website Copier/3.x [XR&CO'2006], Fri, 09 Sep 2016 04:09:39 GMT -->
</html>


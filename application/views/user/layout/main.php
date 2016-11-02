<html lang="en">
    <!-- Mirrored from localhost/roughsheet/ by HTTrack Website Copier/3.x [XR&CO'2006], Fri, 09 Sep 2016 04:09:08 GMT -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RoughSheet is a FREE Interactive and Online Platform to Learn and Practice Aptitude to help crack Company Placement Papers,Daily pratice problem sheet,analysis,Study planner, Focus area,Topic practice problem sheet,Online test,roughsheet, RoughSheet, Aptitude,free test,jobs, recruitment,placements, rough,sheet,rough sheet,www.roughsheet.com,roughsheet.com">
        <meta name="author" content="">
        <link rel="icon" href="<?= ASSETSURL ?>images/tab_icon.png">
        <title><?= SITENAME ?></title>
        <!-- Bootstrap core CSS --> 
        <link href="<?= ASSETSURL ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?= ASSETSURL ?>css/datepicker.css" rel="stylesheet">
        <link href="<?= ASSETSURL ?>css/animate.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= ASSETSURL ?>css/crumble.css" >
        <link rel="stylesheet" href="<?= ASSETSURL ?>css/grumble.min.css">
        <!-- Custom styles for this template -->
        <link href="<?= ASSETSURL ?>css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="<?= ASSETSURL ?>css/style.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="<?= ASSETSURL ?>js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?= ASSETSURL ?>js/jquery.js"></script>
        <script src="<?= ASSETSURL ?>js/ie-emulation-modes-warning.js"></script>
        <!--<script src="<?= ASSETSURL ?>js/recaptcha-api.js?onload=onloadCallback&render=explicit" async defer></script>-->
        <link href="<?= ANGULARURL ?>node_modules/alertifyjs/build/css/alertify.css" rel="stylesheet">
<!--<link rel="stylesheet" href="<?= ANGULARURL ?>node_modules/alertifyjs/build/css/alertify.rtl.css">-->
        <link rel="stylesheet" href="<?= ANGULARURL ?>node_modules/alertifyjs/build/css/themes/default.rtl.css">
        <script src="<?= ANGULARURL ?>node_modules/alertifyjs/build/alertify.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--[if lte IE 9]>
        <script src="animation-legacy-support.js"></script>
    <![endif]-->
        <script>var appurl = "application/views/user/ang-app";
            var cur_url = "<?= current_url() ?>";
            var FBID = "<?= $this->session->userdata('FBID'); ?>";</script>
        <script src="<?= ASSETSURL ?>js/ajax_func.js"></script> 
        <link href="http://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" type="text/css">
        <link href="<?= ASSETSURL ?>css/custom.css" rel="stylesheet" type="text/css">
        <script src="<?= ANGULARURL ?>jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="<?= ASSETSURL ?>js/custom.js"></script> 
        <script src="<?= ASSETSURL ?>js/sdk.js" type="text/javascript"></script>
        <script>var site_url = "<?= site_url() ?>";</script>
        <script>var appurl = "application/views/user/ang-app";</script>
        <script src="<?= ANGULARURL ?>angular.min.js" type="text/javascript"></script>
        <script src="<?= ANGULARURL ?>angular-route.js"></script>
        <script src="<?= ANGULARURL ?>angular-sanitize.js"></script>
        <script src="<?= ANGULARURL ?>angular-sanitize.js"></script>
        <script src="<?= ANGULARURL ?>angular-animate.js"></script>
        <script src="<?= ANGULARURL ?>bower_components/ng-file-upload/ng-file-upload.min.js"></script>
        <script type="text/javascript" src="<?= ASSETSURL ?>js/bower_components/angular-ui-select2/src/select2.js"></script>
        <link href="<?= ANGULARURL ?>app.css" rel="stylesheet" type="text/css">
        <script src="<?= ANGULARURL ?>angular.control.js" type="text/javascript"></script>
        <script src="<?= ANGULARURL ?>services.js" type="text/javascript"></script>
        <script src="<?= ANGULARURL ?>route.js" type="text/javascript"></script>
        <script>

            var verifyCallback = function (response) {
                $('#responce-captcha').val(response);
            };
            var onloadCallback = function () {
                grecaptcha.render('m-recaptcha', {
                    'sitekey': '6Lc0RAcUAAAAAGsDDPfoe-nnS1YoVCnPCdHHEU_t',
                    'callback': verifyCallback,
                    'theme': 'light'
                });
            };
            $(window).load(function () { // makes sure the whole site is loaded
                $('#status').fadeOut();
                $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $(".page-container").fadeIn("slow");
            })
        </script>
    </head>
    <body data-spy="scroll" data-target=".navbar-default" style="position:inherit;" ng-app="rough">
        <!-- Fixed navbar -->
        <div id="preloader">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
        </div>
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
                        <img src="<?= ASSETSURL ?>images/logo_beta.png"  alt="roughsheet" style='margin-top:-4px;' />
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse navbar-custom">
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                        <li><a href="#roughsheet_how" class="animated fadeIn">How it Works</a></li>
                        <li><a href="#features" class="animated fadeIn">Features</a></li>
                        <li><a href="#about"  class="animated fadeIn">About Us</a></li>
                        <li><a href="#contact" class="animated fadeIn">Contact Us</a></li>
                        <li><a href="<?= SITEURL ?>blog" class="animated fadeIn">Blog</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div></div>
        <section id="home" class="res_home" ng-controller="userlogin">
            <div class="container-fluid" style="margin-top:50px;width:100%;">
                <div class="row text-center">
                    <div class="col-md-12 row" style="margin-top:80px;">
                        <center>
                            <img src="<?= ASSETSURL ?>images/rs_logo_1.png" class="r_big_logo wow fadeInLeft"  alt="roughsheet"/>
                            <!--<h1 class="welcome animated bounceInUp" style="color:#111;">Welcome to Roughsheet</h1>      -->
                            <h1 style='color:#37a8df;' class="wow fadeIn home_h1">Want to join us?</h1></center>
                        <!--<a data-toggle="modal" data-target=".invitefbfr" class="btn btn-success btn-lg">Sign up</a></br></br>-->
                        <a href="javascript:void(0)" ng-click="fb()" class="btn btn-primary">Sign Up with Facebook</a></br></br>
                        <a href="#features" class='btn btn-defalut btn-info btn-lg' style="border-radius:50px;">
                            <!--<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>-->
                            Learn More
                        </a> 
                    </div>
                    <div class="row col-md-12">
                        <form class="form-inline login-form " ng-submit="login()">

                            <div class="alert alert-warning error wow bounceIndown animated animated" style="z-index: 9999;position: absolute;top: 30px;left: 38%" ng-show="status">{{msg}}</div>

                            <input type=hidden name=func_type value=login />
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 col-xs-4">Email</label>
                                <div class="col-sm-2 col-xs-8 col-md-3">
                                    <input type="text" class="form-control" name="username_email" ng-model="user.username_email" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 col-xs-4">Password</label>
                                <div class="col-sm-4 col-xs-8 col-md-3">
                                    <input type="password" class="form-control " name="password" ng-model="user.password" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"  value="remember" ng-model="user.remember">Keep me logged in
                                        </label>
                                        </br><a data-toggle="modal" data-target=".forgetpass" style="color:#fff;font-size:12px;margin-top:5px;float:right;" >Forgot your password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div  style="float:left;margin-left:20%;">
                                    <button type="submit" name=submit class="btn btn-block btn-default" style="width:100px;">Log in</button>
                                </div>
                            </div>
                            <!--                            <div class="form-group">
                                                            <div  style="float:left;">
                            
                                                                <a href="javascript:void(0)" class="btn btn-danger">Google</a>
                                                            </div>
                                                        </div>-->
                            <!--
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
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/login_1.png" >
                        <h4>Login to get started!</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.1s">
                        <img class='img-responsive' style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/right.png" >
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="0.2s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/planner_1.png" >
                        <h4>Plan your studies</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.4s">
                        <img class='img-responsive' style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="0.5s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/stdy_1.png" >
                        <h4>Build your concepts</h4>
                    </div>
                </div>
                <div class="row  placeholders" style=''>
                    <div class="col-sm-11 placeholder"  >
                        <p>&nbsp;</p>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="0.8s">
                        <img class='img-responsive' style="float: left;margin-left:-180px;margin-top:20px;" src="<?= ASSETSURL ?>images/how_icons/down.png" >   
                    </div>
                </div>   
                <div class="row  placeholders">
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1.9s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/perform_4.png" >
                        <h4>Monitor your progress</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="1.8s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/left.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1.5s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/fa_1.png" >
                        <h4>Identify your weakness</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="1.1s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/left.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="1s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/pp_1.png" >
                        <h4>Practice and revise</h4>
                    </div>
                </div>   
                <div class="row placeholders" style="">
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.1s">
                        <img class='img-responsive pad-top' style='margin-left:100px;margin-top:-40px;'src="<?= ASSETSURL ?>images/how_icons/down.png" >   
                    </div>
                </div>
                <div class="row placeholders" style="">
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="2.2s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/rank_1.png" >
                        <h4>Understand the competition</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.4s">
                        <img class='img-responsive pad-top'  style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="2.6s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/imp_3.png" >
                        <h4>Improve!</h4>
                    </div>
                    <div class="col-sm-1 placeholder wow fadeIn hidden-xs hidden-sm" data-wow-delay="2.9s">
                        <img class='img-responsive'  style="padding-top: 20px;" src="<?= ASSETSURL ?>images/how_icons/right.png" >   
                    </div>
                    <div class="col-sm-3 placeholder wow fadeIn" data-wow-delay="3.1s">
                        <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/target_2.png" >
                        <h4>With your hardwork and RoughSheet, let us achieve the target that you set out for!</h4>
                    </div>
                    <!-- <div class="col-sm-9 placeholder wow bounceIn" data-wow-delay="4.2s">
                     <img class='img-responsive' src="<?= ASSETSURL ?>images/how_icons/free_red.png" >   
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
                        <img src="<?= ASSETSURL ?>images/flowchart.jpg" class="img-responsive wow zoomInRight glass features_img" data-wow-delay="0.3s" alt="roughsheet" />             
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
                                <!--<li data-target="#carousel-example-captions" data-slide-to="7" class=""></li>-->
                            </ol>    
                            <div class="carousel-inner" role="listbox" >
                                <div class="item  active" style="background:#f04b23;">  
                                    <center>
                                        <img class="media-object" src="<?= ASSETSURL ?>images/network.png"  style="background:#f04b23;">
                                    </center>
                                    <hr><h4 class="media-heading">NETWORK</h4>
                                    <p>Connect with people aspiring to hone their aptitude skills</p>
                                    <p>Understand your competition</p>    
                                </div>
                                <!-- end-->
                                <!-- 3-->
                                <div class="item" style="background: #37a8df;">
                                    <center>
                                        <img class="media-object" src="<?= ASSETSURL ?>images/study.png"  style="background: #37a8df;" alt="its free image">
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
                                        <img class="media-object" src="<?= ASSETSURL ?>images/material.png"  style="background: #febf10;" alt="its free image">
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
                                        <img class="media-object" src="<?= ASSETSURL ?>images/dpp.png"  style="background:#25af60;" alt="its free image">
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
                                        <img class="media-object" src="<?= ASSETSURL ?>images/tpp.png"  style="background:#25af60; " alt="its free image">
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
                                        <img class="media-object" src="<?= ASSETSURL ?>images/pr.png"  style="background:#febf10;width:64px;height:64px;" alt="its free image">
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
                                        <img class="media-object" src="<?= ASSETSURL ?>images/wa.png"  style="background: #37a8df;width:64px;height:64px;" alt="its free image">
                                    </center> 
                                    <hr><h4 class="media-heading">WEAK AREA ANALYSIS</h4>
                                    <ul><li>Based on your performances, our algorithms will determine and identify the weak areas that you may have in each subject</li></ul>           
                                    <!--ends-->
                                </div>
                                <!-- 2-->
                                <!--                                <div class="item" style="background:#f04b23;">
                                                                    <center><img class="media-object" src="<?= ASSETSURL ?>images/free.png"  style="background:#f04b23;" alt="its free image">
                                                                    </center>
                                                                    <hr>
                                                                    <h4 class="media-heading">IT'S FREE</h4>
                                                                    <p>Yes! It's free Forever.</p>
                                                                </div>-->
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
                            <p style="margin-top:10px;"> We're a team of highly motivated individuals - marketing minds, developers, business analysts, teachers who share the common vision of making education and learning easier, more enticing.
                            </p></div> 
                        <div class="col-sm-5 about_li glass wow rotateIn" data-wow-delay="1s" >
                            <p style="margin-top:10px;"> Two things are at the core of RoughSheet - simplicity and equality.
                                Simplicity is quite evident in the design, look and feel of our website.
                                And, because we're staunch believers of equality.</p>
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
                                <img  src="<?= ASSETSURL ?>images/rs_logo.png" style="width:200px;height:50px;"  alt="roughsheet" />
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
                                    <a href="https://twitter.com/roughsheetinc"><img src="<?= ASSETSURL ?>images/tw.png"/></a>
                                    <a href="https://www.facebook.com/roughsheet"><img  src="<?= ASSETSURL ?>images/fb.png"/></a>
                                    <a href="https://www.linkedin.com/company/roughsheet"><img  src="<?= ASSETSURL ?>images/in.png"/></a>
                                    <!--<a href="#"><i class="fa fa-flickr fa-2x">flicker</i></a>-->
                                </p>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-9" ng-controller="contactus">
                        <br>     
                        <center></center>

                        <form class="form-horizontal" ng-submit="send()">
                            <div class="form-group wow fadeInDown" data-wow-delay="0.1s">
                                <span class="col-md-1 col-md-offset-2 ">Name</span>
                                <div class="col-md-8">
                                    <input id="Name" name="name" type="text" placeholder="Name" class="form-control" ng-model="user.Name">
                                    <span class='error' id="print_error_name"></span>
                                </div>
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-delay="0.2s">
                                <span class="col-md-1 col-md-offset-2 ">Subject</span>
                                <div class="col-md-8">
                                    <input id="Subject" name="subject" type="text" placeholder="Subject" class="form-control" ng-model="user.Subject">
                                    <span class='error' id="print_error_subject"></span>
                                </div>
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-delay="0.3s" >
                                <span class="col-md-1 col-md-offset-2 ">Email</span>
                                <div class="col-md-8">
                                    <input id="Email" name="email" type="email" placeholder="Email Address" class="form-control" ng-model="user.Email">
                                    <span class='error' id="print_error_email"></span>
                                </div>
                            </div>
                            <div class="form-group wow slideInDown" data-wow-delay="2">
                                <span class="col-md-1 col-md-offset-2 ">Message</span>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="Message" name="message" placeholder="what's on your mind?" rows="7" ng-model="user.Message"></textarea>
                                    <span class='error' id="print_error_msg"></span>
                                </div>
                            </div>
                            <div class="form-group wow slideInDown" data-wow-delay="2.4">
                                <div class="col-md-8 col-md-offset-3 text-center">
                                    <button type="submit" class="btn btn-primary btn-block" id="submit_id">
                                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-md-8 col-md-offset-3 text-center">
                                    </br>
                                    <span style='color:green' id="print_message"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--registration model code-->
        <div class="modal fade bs-example-modal-lg reg_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background: #f8f8f8;opacity: 1" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header" >
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <center><h4 class="modal-title" id="myModalLabel">Sign Up</h4></center>
                    </div>
                    <div class="modal-body" style="background:#f4f4f4;" ng-controller="register">
                        <form ng-submit="signup()" id="register" class="form-horizontal" style="padding: 5px;"> 
                            <div class="container-fluid"> 
                                <div class="row" id="reg_info">
                                    <div class="col-xs-8 col-sm-12">
                                        <!--      registration form        -->
                                        <input type=hidden name=func_type value=register />
                                        <!----start---->
                                        <span id="page1">
                                            <div class="form-group">
                                                <label for="fb_link" class="col-sm-4 control-label">Facebook Profile Link</label> 
                                                <div class="col-sm-6 col-sm-3">
                                                    <input type="text" name="fb_link" class="col-md-3 form-control" placeholder="Facebook Profile Link" ng-model="reg.fb_link" id="fb_link" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_fb_link"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="first name" class="col-sm-4 control-label">First Name</label> 
                                                <div class="col-sm-6 col-sm-3">
                                                    <input type="text" name="f_name" class="col-md-3 form-control" placeholder="First Name"  ng-model="reg.f_name" id="f_name"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_f_name"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4  control-label">
                                                    Last Name
                                                </label> 
                                                <div class="col-sm-3">
                                                    <input type=text name="l_name" class="form-control" placeholder="last Name" ng-model="reg.l_name" id="l_name"/>
                                                </div><span class="label label-danger animated fadeIn"  style="position: relative ; top:10;" id="err_l_name"></span></div>
                                            <div class="form-group" >
                                                <label for="gender" class="col-sm-4 control-label">
                                                    Gender
                                                </label>
                                                <div class="col-sm-6 " ng-init="reg.gender = 'Male'">  
                                                    <input type=radio id="gender" name="gender" value="Male" ng-model="reg.gender" />
                                                    Male
                                                    <input type=radio id="gender" name="gender" value="Female" ng-model="reg.gender" /> Female
                                                    <span class="label label-danger animated fadeIn" style="position: relative;left:75;" id="err_gender"></span>
                                                    <span class="label label-danger animated fadeIn" style="position: relative;left:75;" id="err_gender"></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="dob" class="col-sm-4 col-md-4 control-label">
                                                    Date of birth </label>
                                                <div class="col-sm-4">
                                                    <!-- <input type="text"  class="form-control datepicker" name="dob"  readonly/> -->
                                                    <select id="dob_y" name='dob_y' class='form-control  input-sm col-xs-1' style='width:73px;' ng-model="reg.dob.y">
                                                        <option value="{{y}}" ng-repeat="y in []| range:'<?= date('Y') ?>-<?= date('Y') - 50 ?>'">{{y}}</option>
                                                    </select>
                                                    <select id="dob_m" class='form-control input-sm' style='width:90px;' name='dob_m' ng-change="getCaldays(reg.dob.y, reg.dob.m)" ng-model="reg.dob.m" >
                                                        <option value='0'>Month</option>
                                                        <option value="{{m.val}}" ng-repeat="m in months">{{m.name}}</option>
                                                    </select>
                                                    <span id='dob_d_place'>
                                                        <select id='dob_d' class='form-control input-sm' style='width:73px;'  ng-model="reg.dob.d">
                                                            <option value="0">Date</option>
                                                            <option value="{{d}}" ng-repeat="d in caldays">{{d}}</option>
                                                        </select>
                                                    </span>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;left:540;top:-24" id="err_dob"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-4 control-label">
                                                    Email </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <input type=email name="email" class="form-control" placeholder="Email" ng-model="reg.regemail" id="regemail"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_email"></span></div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4 control-label">  
                                                    Password
                                                </label>
                                                <div class="col-sm-6 col-md-3">
                                                    <input type=password name="u_pass" class="form-control" placeholder="Password" ng-model="reg.password" id="password" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_u_pass"></span></div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-4 control-label">  
                                                    Confirm-Password
                                                </label>
                                                <div class="col-sm-6 col-md-3"><input type=password name="u_pass_confirm" ng-model="reg.repass"  id="repass" class="form-control" placeholder="Confirm password"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_u_pass_confirm"></span></div> 
                                        </span>
                                        <!-- page 1 -->
                                        <!-- page 2 -->
                                        <span id="page2" style="display:none;">

                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Location </label>
                                                <div class="col-sm-6 col-md-3">
                                                    <select  class='form-control input-sm' name='dob_m' ng-change="getInstitute(reg.locations)" ng-model="reg.locations" id="locations" >
                                                        <option value='other'>---Other---</option>
                                                        <option value="{{c.city_name}}" ng-repeat="c in cities">{{c.city_name}}</option>
                                                    </select>
                                                    <input type=text name="location" ng-if="reg.locations == 'other'" class="form-control" placeholder="Location" ng-model="reg.location" id="location" />
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span>
                                            </div>
                                            <!--                                            <div class="form-group">
                                                                                            <label for="currently" class="col-sm-4 control-label">
                                                                                                Currently </label>
                                                                                            <div class="col-sm-6 col-md-3">  
                                                                                                <input type=radio name="currently" value="1" ng-model="reg.currently" id="currently" /> Studying in school <br>
                                                                                                <input type=radio name="currently" value="2" ng-model="reg.currently" id="currently"/> Studying in college <br>
                                                                                                <input type=radio name="currently" value="3" ng-model="reg.currently" id="currently"/> Working.
                                                                                            </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_currently"></span>
                                                                                        </div>-->
                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Institute Name </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <select id="institutes" class='form-control input-sm' name='dob_m' ng-model="reg.institutes" >
                                                        <option value='other'>---Other---</option>
                                                        <option value="{{c.institute}}" ng-repeat="c in institute">{{c.institute}}</option>
                                                    </select>
                                                    <input type=text name="institute" class="form-control" ng-if="reg.institutes == 'other'" placeholder="Institute Name" ng-model="reg.institute" id="institute"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Branch Name </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <select id="branchs" class='form-control input-sm' name='dob_m' ng-model="reg.branchs" >
                                                        <option value='other'>---Other---</option>
                                                        <option value="{{b.branch_name}}" ng-repeat="b in branchs">{{b.branch_name}}</option>
                                                    </select>
                                                    <input type=text name="branch" class="form-control" ng-if="reg.branchs == 'other'" placeholder="Branch Name" ng-model="reg.branch" id="branch"/>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Graduation Year </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <select ui-select2 ng-model="reg.graduationyear" name="graduationyear" class="form-control" id="graduationyear">
                                                        <option value="{{y}}" ng-repeat="y in []| range:'<?= date('Y') ?>-<?= date('Y') - 50 ?>'">{{y}}</option>
                                                    </select>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="i_code" class="col-sm-4 control-label">Do you have invitation code ?</label> 
                                                <div class="col-sm-6 col-sm-3" ng-init="reg.i_code_present = 'yes'">
                                                    <input type="radio" ng-model="reg.i_code_present" name="i_code_present" CHECKED id="i_code_present" value="yes"/> Yes
                                                    <input type="radio" ng-model="reg.i_code_present" name="i_code_present" id="i_code_present" value="no"/> No
                                                    <br>

                                                    <input ng-show="reg.i_code_present == 'yes'" type=text name="i_code" id="i_code" ng-model="reg.i_code" class="form-control" placeholder="Invitation Code">

                                                </div><span class="label label-danger animated fadeIn" style="position: relative ; top:10;" id="err_i_code"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="captcha" class="col-sm-4 control-label"></label>
                                                <div class="col-sm-5 col-md-3">
                                                    <div class="g-recaptcha" data-sitekey="6Lc0RAcUAAAAAGsDDPfoe-nnS1YoVCnPCdHHEU_t"></div>
<!--                                                    <img src="app/captcha.jpg" id="captcha"/>
                                                    CHANGE TEXT LINK 
                                                    <a href="#" onclick="
                                                                                                        document.getElementById('captcha').src = 'app/captchad41d.jpg?' + Math.random();
                                                                                                        document.getElementById('captcha-form').focus();"
                                                       id="change-image">Not readable? Change text.</a><br/>
                                                    <input type="text" name="captcha" id="captcha-form" autocomplete="off" class="form-control" placeholder="Captcha"/>         -->
                                                    <div id="m-recaptcha"></div>
                                                    <input type="hidden" id="res_captcha" value="0" ng-model="reg.res_captcha"/>
                                                </div>

                                                <span class="label label-danger animated fadeIn" style="position: relative;top:100;left30;" id="err_captcha"></span>
                                            </div>
                                            <div class="form-group" ng-if="reg.i_code_present == 'no'">
                                                <label for="location" class="col-sm-4 control-label">
                                                    Pay : </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <input ng-show="(!reg.payment_id || reg.payment_id == '')" type="button" name="pay" id="rzp-button1" value="Pay" class="btn btn-danger" ng-click="pay()" />
                                                    <label ng-show="reg.payment_id || reg.payment_id != ''" class="label label-success">Payment Successfully!</label>
                                                </div><span class="label label-danger animated fadeIn" style="position: relative;top:10" id="err_location"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="location" class="col-sm-4 control-label">
                                                </label>
                                                <div class="col-sm-6 col-md-3">  
                                                    <span ng-show="!flag" class="label label-danger">Please Check back page for errors!</span>
                                                </div>
                                            </div>
                                        </span>
                                        <input type="button" class="btn" id="back" onclick="prevStep()" style="float:left;display:none;" value=" < Back ">
                                        <input type="button" class="btn" id="next" onclick="nextStep()" style="float:right;" value=" Next > ">

                                        <input type="submit" name="submit" id="submit" style="display:none;float:right;" value="Sign Up" class="btn btn-success btn-lg" id="reg_btn" /><span id="loader"></span>
                                    </div>
                                    <div class="col-xs-4 col-sm-6" id="reg_err" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:solid 2px #febf10;">
                                <center>   By signing up, you agree to our <a href="#" onclick="window.open(site_url + 'legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href=# onclick="window.open(site_url + 'legal_docs/Privacy_Policy.html');">Privacy Policy</a>.
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg fblogin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background: #f8f8f8;opacity: 1" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center><h4 class="modal-title" id="myModalLabel">Facebook login</h4></center>
                    </div>
                    <div class="modal-body" style="background:#f4f4f4;" >
                        <div class="container-fluid"> 
                            <div class="row" id="fblogin_info">
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top:solid 2px #febf10;">
                            <center>   By signing up, you agree to our <a href="#" onclick="window.open('app/legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href=# onclick="window.open('app/legal_docs/Privacy_Policy.html');">Privacy Policy</a>.
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg invitefbfr" id="invitefbfr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background: #f8f8f8;opacity: 1" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center><h4 class="modal-title" id="myModalLabel">Sign Up</h4></center>
                    </div>
                    <div class="modal-body" style="background:#f4f4f4;" >
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class='panel panel-primary'>
                                    <div class='panel-heading'>
                                        <h3 class='panel-title '>
                                            <span class="col-md-11"><center>Roughsheet Friends</center></span>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div class='panel-body'>
                                        <div class='media col-md-12' ng-repeat="f in fb_friends" style='padding:0px;box-shadow:0 0 15px #e7e7e7;border-radius:50px 0px 0px 50px;'>
                                            <div class='media-left'>
                                                <img class='media-object f_pic' src='{{f.img}}' width='84' height='84'>
                                            </div>
                                            <div class='media-body' style='padding:3px;'>
                                                <a href='{{f.profile}}' target="_blank"><h4 class='media-heading'>{{f.name}}</h4></a>
                                                <div id='button_{{f.id}}'>
                                                    <span ng-if="f.id | in_array:rsfbfr.sfr_arr_d">
                                                        <button class='btn btn-default' disabled >Request Sent</button>
                                                    </span>
                                                    <span ng-if="!(f.id | in_array:rsfbfr.ef_ar_dr) && !(f.id | in_array:rsfbfr.fr_arr_d) && !(f.id | in_array:rsfbfr.sfr_arr_d)">
                                                        <button class='btn btn-default' ng-click="addFbFriend(f.id)">Add Friend</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class='btn btn-success' ng-click="addFbFriend(0, fbids)">Add All Friend</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6"> 
                                <div class='panel panel-primary'>
                                    <div class='panel-heading'>
                                        <h3 class='panel-title '>
                                            <span class="col-md-11"><center>Facebook Friends</center></span>
                                            <div class="clearfix"></div>
                                    </div>
                                    <div class='panel-body'>
                                        <!--<div id="facebook_invite"></div>-->
                                        <!--                                        <div class='media col-md-12' ng-repeat="f in fbfrfriends" style='padding:0px;box-shadow:0 0 15px #e7e7e7;border-radius:50px 0px 0px 50px;'>
                                                                                    <div class='media-left'>
                                                                                        <img class='media-object f_pic' src='{{f.img}}' width='84' height='84'>
                                                                                    </div>
                                                                                    <div class='media-body' style='padding:3px;'>
                                                                                        <a href='' target="_blank"><h4 class='media-heading'>{{f.name}}</h4></a>
                                                                                    </div>
                                                                                </div>-->
                                        <button class="btn btn-primary btn-large" ng-click="getfbinvte()">Send Invitation To Friends</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg regAct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background: #f8f8f8;opacity: 1" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center><h4 class="modal-title" id="myModalLabel">Activation Email Send</h4></center>
                    </div>
                    <div class="modal-body" style="background:#f4f4f4;" >
                        <div class="container-fluid"> 
                            <div class="row" id="reg_act_info">
                                <form ng-submit="resendAct(regactemail)" id="register" class="form-horizontal" style="padding: 5px;"> 
                                    <div class="container-fluid"> 
                                        <div class="row" id="reg_info">
                                            <div class="col-xs-8 col-sm-12">
                                                <!----start---->
                                                <span id="page1">
                                                    <div class="form-group">
                                                        <label for="fb_link" class="col-sm-4 control-label">Email</label> 
                                                        <div class="col-sm-6 col-sm-3">
                                                            <input type="text" name="fb_link" class="col-md-3 form-control" placeholder="Enater Email" ng-model="regactemail" id="fb_link" />
                                                        </div>
                                                    </div>

                                                    <input type="submit" name="submit" id="submit" style="display:none;float:right;" value="Send Mail" class="btn btn-success btn-lg" id="reg_btn" />
                                                    <span id="loader"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="modal-footer" style="border-top:solid 2px #febf10;">
                            <center>   By signing up, you agree to our <a href="#" onclick="window.open('app/legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href=# onclick="window.open('app/legal_docs/Privacy_Policy.html');">Privacy Policy</a>.
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg forgetpass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style='background: #f8f8f8;'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Forget Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class='row'>
                            <!--                            <a class="navbar-brand" href="index.php">
                                                            <img  src="assets/images/rs_logo.png" style="width:220px;height:70px;margin:-10px auto; " alt="roughsheet" />
                                                        </a>-->
                            <form ng-submit="recoverpass(forgetemail)" id="register" class="form-horizontal" style="padding: 5px;"> 
                                <div class="container-fluid"> 
                                    <div class="row" id="reg_info">
                                        <div class=" col-sm-12">
                                            <!----start---->
                                            <span id="page1">
                                                <div class="form-group">
                                                    <label for="fb_link" class="col-sm-4 control-label">Your Email:</label> 
                                                    <div class="col-sm-8">
                                                        <input type="email" name="fb_link" class="col-md-8 form-control" placeholder="Enter Email" ng-model="forgetemail" id="fb_link" />
                                                    </div>
                                                </div>
                                            </span>
                                            <button class='btn btn-default btn-block' type="submit" style='background:transparent;'>Recover</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--                            <form ng-submit="recoverpass()" class="form-horizontal">
                                                            <div class="form-group">
                                                                <label>Your Email:</label>
                                                                <input type="email" id='user_email' class="form-control" > 
                                                                </br>
                                                                <button class='btn btn-default btn-block' style='background:transparent;'>Recover</button>
                                                            </div>
                                                            <div id="forgot_messages"></div>
                                                        </form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </br></br>
        <footer class="footer">
            <div class="footer_line">&nbsp;</div>
            <div  style='float:right;padding-right:40px;margin-top:0px;color:#333;'>
                <a href="#" onclick="window.open('<?= SITEURL ?>legal_docs/Terms_Of_Use.html');">Terms of use</a> and <a href="#" onclick="window.open('<?= SITEURL ?>legal_docs/Privacy_Policy.html');">Privacy Policy</a>.</div>
            <div  class="icon_links">
                <a href="https://twitter.com/roughsheetinc"><img src="<?= ASSETSURL ?>images/tw.png" class='social_icons' /></a>
                <a href="https://www.facebook.com/roughsheet"><img src="<?= ASSETSURL ?>images/fb.png" class='social_icons'/></a>
                <a href="https://www.linkedin.com/company/roughsheet"><img src="<?= ASSETSURL ?>images/in.png" class='social_icons' /></a>
                <!--<a href="#"><i class="fa fa-flickr fa-2x">flicker</i></a>-->
            </div>
        </footer>
        <!-- hide elements-->
        <script>
//            document.getElementById("notification-bar").style.display = 'none';</script>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script type="text/javascript">
//            $('body').scrollspy({target: '.navbar-example'});
        </script>
        <!-- Placed at the end of the document so the pages load faster -->

<!--<script src="../../ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
        <script src="<?= ASSETSURL ?>js/bootstrap-datepicker.js"></script>
        <script src="<?= ASSETSURL ?>js/bootstrap.js"></script>
        <script src="<?= ASSETSURL ?>js/jquery.easing.min.js"></script>
        <script src="<?= ASSETSURL ?>js/amcharts.js" type="text/javascript"></script>
        <script src="<?= ASSETSURL ?>js/pie.js" type="text/javascript"></script>
        <script src="<?= ASSETSURL ?>js/wow.min.js"></script>
        <!--<script src="<?= ASSETSURL ?>js/jquery.crumble.min.js"></script>-->
        <!--<script src="<?= ASSETSURL ?>js/jquery.grumble.min.js"></script>-->
        <script type="text/javascript" src="<?= ASSETSURL ?>js/jquery.newsWidget.js"></script> 
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
    <!--    <script>
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
    </script>-->
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
        wow.init();</script>
    <script>
        $(function () {
            $('.scrollclass a').bind('click', function (event) { //just pass scrollclass in design and start scrolling
                var $anchor = $(this);
                $('html, body').stop().animate({scrollTop: $($anchor.attr('href')).offset().top
                }, 1000, 'easeInOutQuad');
                event.preventDefault();
            });
        })
        $(document).ready(function () {
            $("body").tooltip({selector: '[data-toggle=tooltip]'});
        });</script>
    <script>
        $(document).ready(function () {
            $(".search_toggle").click(function () {
                $(".hidden-lg").toggle();
            });
        });</script>
    <script>
    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

    <script src="<?= ASSETSURL ?>js/ie10-viewport-bug-workaround.js"></script>
    <!--<script src="<?= ASSETSURL ?>js/inject.js" os="windows7" ptid="wpm11264" uid="HitachiXHTS545050A7E380_120703TEJ51139GHNTUSX" id="detIdGdpScript" type="text/javascript" charset="UTF-8">-->
    <!--</script>-->
</body>

<!-- Mirrored from localhost/roughsheet/ by HTTrack Website Copier/3.x [XR&CO'2006], Fri, 09 Sep 2016 04:09:39 GMT -->
</html>


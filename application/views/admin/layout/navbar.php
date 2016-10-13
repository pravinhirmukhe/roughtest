

<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1> <a class="navbar-brand" href="<?php echo base_url() ?>admin/dashboard">ROUGHSHEET</a></h1>         
    </div>
    <div class=" border-bottom">

        <div class="drop-men pd-b-5 pd-t-5 pd-r-5">
            <ul class=" nav_1">
                <li class="dropdown at-drop">
                    <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown">
                        <i class="fa fa-bell"></i> 
                    </a>
                    <ul class="dropdown-menu menu1 " role="menu">



                        <li><a href="<?php echo base_url(); ?>admin/notification" class="view">View all messages</a></li>
                    </ul>
                </li>
                <li class="dropdown at-drop">
                    <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown">
                        <i class="fa fa-envelope"></i> 
                    </a>
                    <ul class="dropdown-menu menu2 " role="menu">
                        <li><a href="#">
                                <div class="user-new">
                                    <p>New user registered</p>
                                    <span>40 seconds ago</span>
                                </div>
                                <div class="user-new-left">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="clearfix"> </div>
                            </a></li>
                        <li><a href="#">
                                <div class="user-new">
                                    <p>Someone special liked this</p>
                                    <span>3 minutes ago</span>
                                </div>
                                <div class="user-new-left">
                                    <i class="fa fa-heart"></i>
                                </div>
                                <div class="clearfix"> </div>
                            </a></li>
                        <li><a href="#">
                                <div class="user-new">
                                    <p>John cancelled the event</p>
                                    <span>4 hours ago</span>
                                </div>
                                <div class="user-new-left">
                                    <i class="fa fa-times"></i>
                                </div>
                                <div class="clearfix"> </div>
                            </a></li>
                        <li><a href="#">
                                <div class="user-new">
                                    <p>The server is status is stable</p>
                                    <span>yesterday at 08:30am</span>
                                </div>
                                <div class="user-new-left">
                                    <i class="fa fa-info"></i>
                                </div>
                                <div class="clearfix"> </div>
                            </a></li>
                        <li><a href="#">
                                <div class="user-new">
                                    <p>New comments waiting approval</p>
                                    <span>Last Week</span>
                                </div>
                                <div class="user-new-left">
                                    <i class="fa fa-rss"></i>
                                </div>
                                <div class="clearfix"> </div>
                            </a></li>
                        <li><a href="#" class="view">View all messages</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle dropdown-at" data-toggle="dropdown">
                        <img src="<?= ADMINASSETS . "images/user.png" ?>" alt="" class="img-circle hvr-glow" height="50" width="50"/>
                    </a>
                    <ul class="dropdown-menu pull-right pd-b-10 pd-t-10 pd-r-10 pd-l-10" role="menu" style="width:200px">
                        <div class="media mg-b-5">
                            <a class="media-left" href="">
                                <img src="<?= ADMINASSETS . "images/user.png" ?>" alt="" class="img-circle hvr-glow" height="50" width="50"/>
                            </a>
                            <div class="media-body">
                            </div>
                        </div>
                        <li><a href=""><i class="fa fa-user"></i>Edit Profile</a></li>
<!--                        <li><a href=""><i class="fa fa-envelope"></i>Inbox</a></li>
                        <li><a href="calendar.html"><i class="fa fa-calendar"></i>Calender</a></li>
                        <li><a href="inbox.html"><i class="fa fa-clipboard"></i>Tasks</a></li>-->
                        <li><a href="<?= site_url('auth/logout') ?>"><i class="fa fa-clipboard"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
        <div class="clearfix"></div>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?= site_url('admin/dashboard') ?>" class="hvr-bounce-to-right">
                            <i class="fa fa-dashboard nav_icon "></i>
                            <span class="nav-label">Dashboard</span> 
                        </a>
                    </li>
                    <?php if ($this->ion_auth->is_admin()) { ?>
                    
                        <li>
                            <a href="<?= site_url('admin/Menus') ?>" class=" hvr-bounce-to-right"><i class="fa fa-bars nav_icon"></i> <span class="nav-label">Menus</span> </a>
                        </li>
                    <?php } ?>
                    <?php foreach ($menus as $m) { ?>
                        <li>
                            <?php if (empty($m->nodes)) { ?>
                                <a href="<?= site_url($m->url) ?>" class="hvr-bounce-to-right">
                                    <i class="<?= $m->icon ?> nav_icon "></i>
                                    <span class="nav-label"><?= $m->name ?></span> 
                                </a>
                            <?php } else { ?>
                                <a href="#" class=" hvr-bounce-to-right"><i class="<?= $m->icon ?> nav_icon"></i> <span class="nav-label"><?= $m->name ?></span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php foreach ($m->nodes as $n) { ?>
                                        <li>
                                            <a href="<?= site_url($n->url) ?>" class=" hvr-bounce-to-right"><i class="<?= $n->icon ?> nav_icon"></i> <span class="nav-label"><?= $n->name ?></span> </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
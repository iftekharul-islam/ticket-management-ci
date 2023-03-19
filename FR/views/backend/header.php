<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?=ucfirst($page_title) . " | " . $site->app_title . (!empty($site->tagline)? " | " . $site->tagline : "")?></title>
        <base href="<?=base_url()?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:100,400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
        <!-- BEGIN THEME STYLES -->
        <link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout2/css/themes/blue.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="assets/logo/favicon.ico"/>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
        <!-- END CORE PLUGINS -->
        <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
        <?php /* datatable er shathe clash korte pare ?>
            <script src="assets/admin/pages/scripts/components-dropdowns.js" type="text/javascript"></script>
        <?php */?>
        <script>
            jQuery(document).ready(function() {    
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout 
                
                //ComponentsDropdowns.init();  //searchable stylish dropdown 
            });
        </script>
    </head>
    <body class="page-boxed page-header-fixed page-quick-sidebar-over-content">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
                    <a href="">
                        <img src="assets/logo/backend-logo.png" alt="<?=$site->app_title?>"  class="logo-centered"/>
                    </a>
                    <div class="menu-toggler sidebar-toggler hide">
                            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="page-top">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="" src="<?=(!empty($user->avatar) && file_exists('assets/avatars/'.$user->avatar))? 'assets/avatars/'.$user->avatar : 'assets/avatars/default-avatar.png' ?>"/> &nbsp;
                                <span class="username">
                                <?=$user->first_name.' '.$user->last_name?> </span>
                                <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <?=anchor("user/edit/" . $user->username, '<i class="icon-user"></i> My Profile ')?>
                                        </li>
                                        <li>
                                            <?=anchor("user/change_password", '<i class="icon-key"></i> Change Password')?>
                                        </li>
                                        <li>
                                            <?=anchor("user/change_avatar", '<i class="fa fa-image"></i> Change Avatar')?>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <?=anchor("user/logout", '<i class="fa fa-sign-out"></i> Log Out')?>
                                        </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix"></div>
        <!-- BEGIN CONTAINER -->
        <div class="container">
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="sidebar-toggler-wrapper">
                                <div class="sidebar-toggler"></div>
                            </li>
                            <li class="<?=($controller == 'dashboard')?'active':''?>">
                                <?=anchor('dashboard','<i class="fa fa-dashboard"></i><span class="title"> Dashboard</span>' . (($controller == 'dashboard')? '<span class="selected"></span>' : ''))?>
                            </li>
                            <li class="<?=($controller == 'posts')? 'active open' : ''?>">
                                <a href="javascript:;">
                                <i class="fa fa-thumb-tack"></i>
                                <span class="title">Posts</span>
                                <span class="arrow <?=($controller == 'posts')? 'open' : ''?>"></span>
                                <?=($controller == 'posts')? '<span class="selected"></span>' : ''?>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?=($method == 'all')? 'active' : ''?>">
                                        <a href="posts/all"> All Posts </a>
                                    </li>
                                    <li class="<?=($method == 'add')? 'active' : ''?>">
                                        <a href="posts/add"> Add New </a>
                                    </li>
                                    <li class="<?=($method == 'categories')? 'active' : ''?>">
                                        <a href="posts/categories"> Categories </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?=($controller == 'home_components')? 'active open' : ''?>">
                                <a href="javascript:;">
                                <i class="fa fa-desktop"></i>
                                <span class="title">Home Components</span>
                                <span class="arrow <?=($controller == 'home_components')? 'open' : ''?>"></span>
                                <?=($controller == 'home_components')? '<span class="selected"></span>' : ''?>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?=($method == 'sliders')? 'active' : ''?>">
                                        <a href="home_components/sliders"> Banner Sliders </a>
                                    </li>
                                    <li class="<?=($method == 'midsections')? 'active' : ''?>">
                                        <a href="home_components/midsections"> Midsections </a>
                                    </li>
                                    <li class="<?=($method == 'event_contents')? 'active' : ''?>">
                                        <a href="home_components/event_contents"> Event Contents </a>
                                    </li>
                                    <li class="<?=($method == 'add_event_contents')? 'active' : ''?>">
                                        <a href="home_components/add_event_content"> Add Content </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?=($controller == 'settings')?'active open':''?>">
                                <a href="javascript:;">
                                    <i class="fa fa-cogs"></i>
                                    <span class="title">Settings</span>
                                    <span class="arrow <?=($controller == 'settings')?'open':''?>"></span>
                                    <?=($controller == 'settings')? '<span class="selected"></span>' : ''?>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?=($controller == 'settings' && $method == 'general_info')? 'active' : ''?>">
                                            <?=anchor('settings/general_info','<span class="title"> Information</span>')?>
                                    </li>
                                    <li class="<?=($controller == 'settings' && $method == 'logos')? 'active' : ''?>">
                                            <?=anchor('settings/logos','<span class="title"> Logos</span>')?>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?=($controller == 'user')? 'active open' : ''?>">
                                <a href="javascript:;">
                                    <i class="icon-users"></i>
                                    <span class="title">Users</span>
                                    <span class="arrow <?=($controller == 'user')? 'open' : ''?>"></span>
                                    <?=($controller == 'user')? '<span class="selected"></span>' : ''?>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?=($controller == 'user' && $method == 'create')? 'active' : ''?>">
                                            <?=anchor('user/create','<span class="title"> Create User</span>')?>
                                    </li>
                                    <li class="<?=($method == 'admin_users')? 'active' : ''?>">
                                            <?=anchor('user/admin_users','<span class="title"> Admin Users</span>')?>
                                    </li>
                                    <li class="<?=($method == 'customers')? 'active' : ''?>">
                                            <?=anchor('user/customers','<span class="title"> Customers</span>')?>
                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <?=anchor('user/logout','<i class="fa fa-sign-out"></i><span class="title"> Logout</span>')?>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-title"><?=$page_title?></div>
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                    <li class="text-capitalize" >
                                            <?=$controller?>
                                    </li>
                                    <?php if(!empty($method)){ 
                                        $explode = explode('_', $method);
                                        $method_name = implode(' ', $explode);
                                    ?>                                        
                                        <li class="text-capitalize" >
                                                <i class="fa fa-angle-right"></i>
                                                <?=$method_name?>
                                        </li>
                                    <?php } ?>
                            </ul>
                            <div class="page-toolbar">
                                    <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-fit-height grey-salt">
                                                <i class="fa fa-calendar"></i> <?=date("F j, Y, g:i a")?>
                                            </button>
                                    </div>
                            </div>
                        </div>
                        <?php if(!empty($message)){ ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?=$message?>
                        </div>
                        <?php } ?>
                        <?php if(!empty($message_error)){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?=$message_error?>
                        </div>
                        <?php } ?>

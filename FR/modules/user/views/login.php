<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title><?=$site->app_title?> | <?=$page_title?></title>
        <base href="<?=base_url()?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        
        <link rel="shortcut icon" href="assets/logo/favicon.ico"/>
    </head>
    <body class="login">
        <div class="logo">
            <a href="">
                <img src="assets/logo/backend-logo.png" alt="<?=$site->app_title?>"/>
            </a>
        </div>
        <div class="content">
            <?=form_open("user/login", array('class' => 'login-form'))?>
                <h3 class="form-title">Sign in</h3>
                <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>
                        Enter your email and password. </span>
                </div>
                <?php if(!empty($message)){ ?>
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        <span>
                        <?=$message?> </span>
                    </div>
                <?php }if(!empty($message_error)){ ?>
                <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>
                        <?=$message_error?> </span>
                </div>
                <?php } ?>
                <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">Email</label>
                        <div class="input-icon">
                            <i class="fa fa-user"></i>
                            <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="identity" required>
                        </div>
                </div>
                <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password">
                        </div>
                </div>
                <div class="form-actions">
                        <label class="rememberme check">
                            <input type="checkbox" name="remember" value="1"/> Remember
                        </label>
                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                        <button type="submit" class="btn green btn-block">Login <i class="m-icon-swapright m-icon-white"></i></button>

                </div>
                <div class="create-account">
                        <p style="color:#ccc; font-size: 11px;">
                            Copyright &copy; <?=date('Y')?> <?=(!empty($site->footer_link))?'<a href="'.$site->footer_link.'">'.$site->footer_text.'</a>' : $site->footer_text?>
                        </p>
                </div>
            <?=form_close()?>
            <?=form_open("user/forgot_password", array('class' => 'forget-form'))?>
                <h3 class="form-title">Forgot Password ?</h3>
                <p>Enter your e-mail to reset your password.</p>

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="form-actions" style="padding-bottom: 0;">
                        <button type="button" id="back-btn" class="btn btn-info"><i class="m-icon-swapleft m-icon-white"></i> Back</button>
                        <button type="submit" class="btn green pull-right">Submit <i class="m-icon-swapright m-icon-white"></i></button>
                </div>
            <?=form_close()?>
        </div>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="assets/admin/pages/scripts/login.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <developed by High5Digital, led by M Fazle Rabby Khan. netrubby@gmail.com />
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script>
        jQuery(document).ready(function() {     
        Metronic.init(); // init metronic core components
        Login.init();
        });
        </script>
    </body>
</html>
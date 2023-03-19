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
        <link href="assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/css/components.css" rel="stylesheet" type="text/css"/>
        
        <link rel="shortcut icon" href="assets/logo/favicon.ico"/>
    </head>
    <body class="login">
        <div class="logo">
            <a href="">
                <img src="assets/logo/backend-logo.png" alt="<?=$site->app_title?>" style="max-height: 65px;"/>
            </a>
        </div>
        <div class="content">
            <?=form_open("user/forgot_password", array('class' => 'forget-form', 'style' => 'display: block;'))?>
                <h3 class="form-title">Forgot Password ?</h3>
                <p>Enter your e-mail to reset your password.</p>
                <?php if(!empty($message_error)){ ?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span><?=$message_error?></span>
                </div>
                <?php } ?>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" id="email">
                    </div>
                </div>
                <div class="form-actions" style="padding-bottom: 0;">
                    <a href="user/login" class="btn btn-info"><i class="m-icon-swapleft m-icon-white"></i> Back</a>
                    <button type="button" class="btn green pull-right" id="forgot_pass">Submit <i class="m-icon-swapright m-icon-white"></i></button>
                </div>
            <?=form_close()?>
        </div>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <developed by M Fazle Rabby Khan. netrubby@gmail.com />
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script>
        jQuery(document).ready(function(){

            $("#forgot_pass").click(function(e){
                e.preventDefault();
                var mail = $("#email").val();
                if(mail == ''){
                    alert('Enter an email address');
                    return false;
                }
                $.post("user/forgot_pass", {email: mail}, function(result){
                    alert(result);
                });
            });
        });

        </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
        <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
        <meta name="author" content="Djava UI">
        <title>SIMPEG | E-KINERJA</title>

        <link href="<?=base_url();?>themes/default/assets/img/favicon.png" rel="shortcut icon">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
        
        <link href="<?=base_url();?>themes/default/assets/admin/css/reset.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/layout.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/components.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/plugins.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/themes/default.theme.css" rel="stylesheet" id="theme">
        <link href="<?=base_url();?>themes/default/assets/admin/css/pages/sign-type-2.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/custom.css" rel="stylesheet">
    </head>

    <body class="page-sound page-backstretch">
        <div id="sign-wrapper">

            <div class="brand">
                <img src="<?=base_url();?>themes/default/assets/img/logo.png" alt="BAPPEDA"/>
            </div>
            
            <form class="sign-in form-horizontal shadow no-overflow" action="<?=base_url();?>login" method="post">
                <div class="sign-header">
                    <div class="form-group">
                        <div class="sign-text">
                            <span>Login Area</span>
                        </div>
                    </div>
                </div>
                <div class="sign-body">
                    <div class="form-group">
                        <div class="input-group input-group-lg rounded no-overflow">
                            <input type="text" class="form-control input-sm" placeholder="Username" name="username">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg rounded no-overflow">
                            <input type="password" class="form-control input-sm" placeholder="Password" name="password">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                    </div>
                </div>
                <div class="sign-footer">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="ckbox ckbox-theme">
                                    <input id="rememberme" type="checkbox">
                                    <label for="rememberme" class="rounded">Remember me</label>
                                </div>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="javascript:void(0);" title="lost password">Lost password?</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn">Sign In</button>
                    </div>
                </div>
            </form>

        </div>

        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js"></script>
        
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-backstretch/jquery.backstretch.min.js"></script>
        
        <script src="<?=base_url();?>themes/default/assets/admin/js/pages/blankon.sign.js"></script>
        <script src="<?=base_url();?>themes/default/assets/admin/js/pages/blankon.sign.type2.js"></script>
        <script src="<?=base_url();?>themes/default/assets/admin/js/demo.js"></script>

    </body>

</html>
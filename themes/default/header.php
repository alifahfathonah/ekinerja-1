<!DOCTYPE html>
<html lang="en">
    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Djastin, Sistem informasi akademik">
        <meta name="keywords" content="Djastin, Sisfo">
        <meta name="author" content="Djawara">
        <title>SIMPEG | E-KINERJA</title>
        <!--/ END META SECTION -->

        <link href="<?=base_url();?>themes/default/assets/img/favicon.png" rel="shortcut icon">

        <!-- START @FONT STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet">
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <?php
            if(isset($list_css_plugin)){
                foreach ($list_css_plugin as $css_plugin) {
                ?>
                    <link href="<?=base_url();?>themes/default/assets/global/plugins/bower_components/<?=$css_plugin;?>" rel="stylesheet">
                <?php
                }
            }
        ?>
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="<?=base_url();?>themes/default/assets/admin/css/reset.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/layout.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/components.css" rel="stylesheet">
        <link href="<?=base_url();?>themes/default/assets/admin/css/plugins.css" rel="stylesheet">

        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery/dist/jquery-3-5.min.js"></script>
        <?php
            $color_th = array('default', 'blue', 'blue-gray', 'yellow', 'red', 'blueberry');
            $color = $color_th[array_rand($color_th)];
        ?>
        <link href="<?=base_url();?>themes/default/assets/admin/css/themes/<?=$color;?>.theme.css" rel="stylesheet" id="theme">
        <?php
            if(isset($list_css_page)){
                foreach ($list_css_page as $css_page) {
                ?>
                    <link href="<?=base_url();?>themes/default/assets/admin/css/pages/<?=$css_page;?>" rel="stylesheet">
                <?php
                }
            }
        ?>
        <link href="<?=base_url();?>themes/default/assets/admin/css/custom.css" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <style type="text/css">
            table tbody td {
              vertical-align: middle !important;
            }
            .popover {
              max-width: 500px;
            }
        </style>

        <!-- SHOW LOADING -->
        <link href="<?=base_url();?>themes/default/assets/showLoading/css/showLoading.css" rel="stylesheet" media="screen" />
    </head>
    
    <body class="page-sound page-header-fixed page-sidebar-fixed page-footer-fixed">

        <section id="wrapper">
            <header id="header">
                <div class="header-left">
                    <div class="navbar-minimize-mobile left">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="javascript:void(0);">
                            <img class="logo" src="<?=base_url();?>themes/default/assets/img/logo_das.png" alt="simker logo">
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="header-right">
                    <!-- Start navbar toolbar -->
                    <div class="navbar navbar-toolbar">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="navbar-minimize">
                                <a href="javascript:void(0);" title="Minimize sidebar">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </li>
                            <li class="navbar-search">
                                <!-- Just view on mobile screen-->
                                <a href="#" class="trigger-search"><i class="fa fa-search"></i></a>
                                <form class="navbar-form">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control typeahead rounded" placeholder="Cari Pegawai">
                                        <button id="btn-cari-pegawai" type="submit" class="btn btn-theme fa fa-search form-control-feedback rounded"></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown navbar-profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="meta">
                                        <span class="avatar">
                                        <?php
                                            if(file_exists('./upload/images/profil/'.$user_active['foto']) && $user_active['foto'] != NULL){
                                        ?>
                                                <img src="<?=base_url();?>upload/images/profil/<?=$user_active['foto'];?>" class="img-circle" alt="foto">
                                        <?php
                                            } else{
                                        ?>
                                                <img src="<?=base_url();?>themes/default/assets/img/no-image.jpg" class="img-circle" alt="foto">
                                        <?php
                                            }
                                        ?>
                                        </span>
                                        <span class="text hidden-xs hidden-sm text-muted"><?=$user_active['nama'];?></span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                
                                <ul class="dropdown-menu animated flipInX">
                                    <li class="dropdown-header">Account</li>
                                    <li><a href="<?=base_url();?>account"><i class="fa fa-user"></i>View Account</a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-envelope-square"></i>Inbox <span class="label label-info pull-right">30</span></a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url();?>dashboard/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                                </ul>
                                
                            </li>
                        </ul>
                    </div>
                </div>

            </header>

            <aside id="sidebar-left" class="sidebar-circle">
                <div class="sidebar-content">
                    <div class="media">
                        <a class="pull-left has-notif avatar" href="javascript:void(0);">
                            <?php
                                if(file_exists('./upload/images/profil/'.$user_active['foto']) && $user_active['foto'] != NULL){
                            ?>
                                    <img src="<?=base_url();?>upload/images/profil/<?=$user_active['foto'];?>" alt="foto">
                            <?php
                                } else{
                            ?>
                                    <img src="<?=base_url();?>themes/default/assets/img/no-image.jpg" alt="foto">
                            <?php
                                }
                            ?>
                            <i class="online"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Hi, <span><?=$user_active['nama_panggilan'];?></span></h4>
                            <small><?=$user_active['akses'];?></small>
                        </div>
                    </div>
                </div>

                <?=$generate_menu;?>

                <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
                    <a id="setting" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Setting"><i class="fa fa-cog"></i></a>
                    <a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
                    <a id="lock-screen" data-url="page-signin.html" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Lock Screen"><i class="fa fa-lock"></i></a>
                    <a id="logout" data-url="page-lock-screen.html" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
                </div>
            </aside>

            <section id="page-content">
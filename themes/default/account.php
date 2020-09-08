<div class="header-content">
    <h2><i class="fa fa-user"></i>Account</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Account</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated zoomInDown">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default shadow no-overflow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Ganti Foto Profil</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body text-center">
                    <?php
                        if(file_exists('./upload/images/profil/'.$user_active['foto']) && $user_active['foto'] != NULL){
                    ?>
                            <img src="<?=base_url();?>upload/images/profil/<?=$user_active['foto'];?>" class="img-circle img-bordered-theme" alt="foto" onmouseover="this.src='<?=base_url();?>themes/default/assets/img/ganti.png';" onmouseout="this.src='<?=base_url();?>upload/images/profil/<?=$user_active['foto'];?>';" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('account/ganti_foto_form', 'contentModal', '');open_modal('modal-sm', 'Ganti Foto Profil', 'modal-primary');">
                    <?php
                        } else{
                    ?>
                            <img src="<?=base_url();?>themes/default/assets/img/no-image.jpg" class="img-circle img-bordered-theme" alt="foto" onmouseover="this.src='<?=base_url();?>themes/default/assets/img/ganti.png';" onmouseout="this.src='<?=base_url();?>themes/default/assets/img/no-image.jpg';" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('account/ganti_foto_form', 'contentModal', '');open_modal('modal-sm', 'Ganti Foto Profil', 'modal-primary');">
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default shadow no-overflow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Ganti Password</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding">
                    <form id="form_ganti_pass" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>account/ganti_password" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Password Lama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="pass_lama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Password Baru</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="pass_baru">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Ulangi Password Baru</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="pass_baru2">
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-theme">Ganti Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
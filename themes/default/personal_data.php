<div class="header-content">
    <h2><i class="fa fa-user"></i>Personal</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="fa fa-user"></i>
                <a href="javascript:void(0);">Profil</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Personal</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated zoomInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default shadow no-overflow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Data Personal</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding">
                    <form id="form_personal" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/personal_save" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NIP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" onkeyup="masking()" id="nipProfile" name="nip" value="<?=(set_value('nip')) ? set_value('nip') : $find_data['nip'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Panggilan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="nama_panggilan" value="<?=(set_value('nama_panggilan')) ? set_value('nama_panggilan') : $find_data['nama_panggilan'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Lengkap</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $find_data['nama'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tempat Lahir</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="tmp_lahir" value="<?=(set_value('tmp_lahir')) ? set_value('tmp_lahir') : $find_data['tmp_lahir'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Lahir</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm tgl_picker" name="tgl_lahir" value="<?=(set_value('tgl_lahir')) ? set_value('tgl_lahir') : $find_data['tgl_lahir'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Agama</label>
                                <div class="col-sm-7">
                                    <?=form_dropdown('agama', agama(), $find_data['agama'], "class='form-control input-sm'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Pegawai</label>
                                <div class="col-sm-7">
                                    <?=form_dropdown('jenis_pegawai', jenis_pegawai(), $find_data['jenis_pegawai'], "class='form-control input-sm'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Gender</label>
                                <div class="col-sm-7">
                                    <?php
                                    $select_l = '';
                                    $select_p = '';
                                    if(isset($find_data['gender'])){
                                        if($find_data['gender'] == 'L'){
                                            $select_l = 'checked';
                                        } else{
                                            $select_p = 'checked';
                                        }
                                    }
                                    ?>
                                    <div class="rdio rdio-theme circle">
                                        <input id="l" type="radio" value="L" name="gender" <?=$select_l;?>>
                                        <label for="l">Laki Laki</label>
                                    </div>
                                    <div class="rdio rdio-theme circle">
                                        <input id="p" type="radio" value="P" name="gender" <?=$select_p;?>>
                                        <label for="p">Perempuan</label>
                                    </div>
                                    <label for="gender" class="error"></label>
                                    <input type="text" class="hide" id="gender"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="alamat" value="<?=(set_value('alamat')) ? set_value('alamat') : $find_data['alamat'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pangkat & Golongan</label>
                                <div class="col-sm-7">
                                    <?=form_dropdown('pangkat_golongan', pangkat_golongan(), $find_data['pangkat_golongan'], "class='form-control input-sm'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jabatan</label>
                                <div class="col-sm-7">
                                <?php 
                                    echo select_dinamis('fid_jabatan', 'jabatan', 'nama', 'id', array('aktif'=>'Ya'), $find_data['fid_jabatan']);
                                ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Instansi Kerja</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="instansi_kerja" value="Kabupaten / Kota" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Unit Kerja</label>
                                <div class="col-sm-7">
                                    <?php 
                                        echo select_dinamis('unit_kerja', 'unit_kerja', 'nama', 'id', null, $find_data['unit_kerja']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. HP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" name="no_hp" value="<?=(set_value('no_hp')) ? set_value('no_hp') : $find_data['no_hp'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. NPWP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control input-sm" onkeyup="masking()" id="noNpwp" name="npwp" value="<?=(set_value('npwp')) ? set_value('npwp') : $find_data['npwp'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Tunjangan</label>
                                <div class="col-sm-7">
                                <?php
                                    $my_checkboxes = array('Suami/Istri','Anak'); 
                                    $tunjangan = explode(',', $find_data['tunjangan']);
                                    foreach ($my_checkboxes as $label){
                                      $selected = (in_array(($label), $tunjangan)) ? "checked='checked'" : ''; 
                                      echo '<div class="ckbox ckbox-theme">
                                                <input id="chk_'.$label.'" type="checkbox" '.$selected.' name="tunjangan[]" value="'.$label.'">
                                                <label for="chk_'.$label.'">'.$label.'</label>
                                            </div>';  
                                    } 
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <div class="col-sm-offset-3">
                                <button type="submit" class="btn btn-theme">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function masking () {
            $('#nipProfile').inputmask({
                mask: '99999999 999999 9 999',
                definitions: {
                    A: {
                        validator: "[A-Za-z0-9 ]"
                    },
                },            
            });

            $('#noNpwp').inputmask({
                mask: '99.999.999.9-999.999',
                definitions: {
                    A: {
                        validator: "[A-Za-z0-9 ]"
                    },
                },            
            });
        }
</script>
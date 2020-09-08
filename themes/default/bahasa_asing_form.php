<form id="form_bahasa_asings" enctype="multipart/form-data" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/bahasa_asing_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="bahasa" class="col-sm-4 control-label">Bahasa Asing</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('bahasa')) ? set_value('bahasa') : @$find_data['bahasa'];?>" name="bahasa">
            </div>
        </div>
        <div class="form-group">
            <label for="aktif" class="col-sm-4 control-label">Aktif</label>
            <div class="col-sm-7">
                <?=form_dropdown('aktif', aktif(), @$find_data['aktif'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="pasif" class="col-sm-4 control-label">Pasif</label>
            <div class="col-sm-7">
                <?=form_dropdown('pasif', aktif(), @$find_data['pasif'], "class='form-control input-sm'");?>
            </div>
        </div>
        <?php if ($files != []) { ?>
        <div class="form-group">
            <div class="row" style="padding-left:50px">
            <label for="pejabat_sah" class="col-sm-4 control-label">Dokumen (Maksimal 3 File) : </label>
            </div>
            <?php foreach ($files as $value) { ?>
                <div class="row" style="padding-left:28%;margin-top:5px">
                <a target="_blank" href="<?=base_url().$value->file_lokasi?>">
                    <span><?=$value->file_name?></span> 
                </a>
                <?php $base64 = base64_encode($value->id_upload."|".$value->file_lokasi); ?>
                <a onclick="return confirm('Apakah anda yakin ingin menghapus dokumen ini ?');" href ="<?=base_url()?>pegawai/deleteFile/<?=$base64?>">
                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
                </a>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="files">Upload Gambar Pendukung : (*Allow file : gifjpg|png|jpeg|bmp) </label>
            <input class="form-control" type="file" id="file" name="file[]" multiple>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
<form id="form_bahasa_asing" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/bahasa_asing_save" role="form">
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
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
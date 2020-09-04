<form id="form_disiplin" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/disiplin_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="tahun" class="col-sm-4 control-label">Tahun</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tahun')) ? set_value('tahun') : @$find_data['tahun'];?>" name="tahun">
            </div>
        </div>
        <div class="form-group">
            <label for="tingkat" class="col-sm-4 control-label">Tingkat Hukum</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('tingkat')) ? set_value('tingkat') : @$find_data['tingkat'];?>" name="tingkat">
            </div>
        </div>
        <div class="form-group">
            <label for="jenis" class="col-sm-4 control-label">Jenis Hukuman</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('jenis')) ? set_value('jenis') : @$find_data['jenis'];?>" name="jenis">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
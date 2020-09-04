<form id="form_penghargaan" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/penghargaan_save" role="form">
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
                <input type="text" class="form-control input-sm" value="<?=(set_value('tahun')) ? set_value('tahun') : @$find_data['tahun'];?>" name="tahun">
            </div>
        </div>
        <div class="form-group">
            <label for="tingkat" class="col-sm-4 control-label">Tingkat Perhargaan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('tingkat')) ? set_value('tingkat') : @$find_data['tingkat'];?>" name="tingkat">
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama Penghargaan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama')) ? set_value('nama') : @$find_data['nama'];?>" name="nama">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
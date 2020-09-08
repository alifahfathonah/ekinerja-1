<form id="form_riwayat_kesehatan" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/riwayat_kesehatan_save" role="form">
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
            <label for="penyakit" class="col-sm-4 control-label">Penyakit Yang Pernah Diderita</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('penyakit')) ? set_value('penyakit') : @$find_data['penyakit'];?>" name="penyakit">
            </div>
        </div>
        <div class="form-group">
            <label for="dokter" class="col-sm-4 control-label">Dokter Yang Menangani</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('dokter')) ? set_value('dokter') : @$find_data['dokter'];?>" name="dokter">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
<form id="form_riwayat_diklat" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/riwayat_diklat_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="kategori" class="col-sm-4 control-label">Kategori Diklat</label>
            <div class="col-sm-7">
                <?=form_dropdown('kategori', kategori_diklat(), @$find_data['kategori_diklat'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="nama_diklat" class="col-sm-4 control-label">Nama Diklat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama_diklat')) ? set_value('nama_diklat') : @$find_data['nama_diklat'];?>" name="nama_diklat">
            </div>
        </div>
        <div class="form-group">
            <label for="penyelenggara" class="col-sm-4 control-label">Penyelenggara</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('penyelenggara')) ? set_value('penyelenggara') : @$find_data['penyelenggara'];?>" name="penyelenggara">
            </div>
        </div>
        <div class="form-group">
            <label for="tahun" class="col-sm-4 control-label">Tahun/Angkatan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('tahun')) ? set_value('tahun') : @$find_data['tahun'];?>" name="tahun">
            </div>
        </div>
        <div class="form-group">
            <label for="lama" class="col-sm-4 control-label">Lama Pendidikan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('lama')) ? set_value('lama') : @$find_data['lama'];?>" name="lama">
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_sttp" class="col-sm-4 control-label">Tanggal STPP</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_sttp')) ? set_value('tgl_sttp') : @$find_data['tgl_sttp'];?>" name="tgl_sttp">
            </div>
        </div>
        <div class="form-group">
            <label for="no_sttp" class="col-sm-4 control-label">Nomor STPP</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('no_sttp')) ? set_value('no_sttp') : @$find_data['no_sttp'];?>" name="no_sttp">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
<form id="form_riwayat_pendidikans" enctype="multipart/form-data" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/riwayat_pendidikan_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="pendidikan" class="col-sm-4 control-label">Jenjang Pendidikan</label>
            <div class="col-sm-7">
                <?=form_dropdown('pendidikan', pendidikan(), @$find_data['pendidikan'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="nama_instansi" class="col-sm-4 control-label">Nama Instansi</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama_instansi')) ? set_value('nama_instansi') : @$find_data['nama_instansi'];?>" name="nama_instansi">
            </div>
        </div>
        <div class="form-group">
            <label for="pimpinan_instansi" class="col-sm-4 control-label">Pimpinan Instansi</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('pimpinan_instansi')) ? set_value('pimpinan_instansi') : @$find_data['pimpinan_instansi'];?>" name="pimpinan_instansi">
            </div>
        </div>
        <div class="form-group">
            <label for="no_ijazah" class="col-sm-4 control-label">Nomor Ijazah</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('no_ijazah')) ? set_value('no_ijazah') : @$find_data['no_ijazah'];?>" name="no_ijazah">
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_ijazah" class="col-sm-4 control-label">Tanggal Ijazah</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_ijazah')) ? set_value('tgl_ijazah') : @$find_data['tgl_ijazah'];?>" name="tgl_ijazah">
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
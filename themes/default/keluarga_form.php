<form id="form_keluargas" enctype="multipart/form-data" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/keluarga_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama')) ? set_value('nama') : @$find_data['nama'];?>" name="nama">
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_lahir')) ? set_value('tgl_lahir') : @$find_data['tgl_lahir'];?>" name="tgl_lahir">
            </div>
        </div>
        <div class="form-group">
            <label for="akte_lahir" class="col-sm-4 control-label">No. Akte Lahir</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('akte_lahir')) ? set_value('akte_lahir') : @$find_data['akte_lahir'];?>" name="akte_lahir">
            </div>
        </div>
        <div class="form-group">
            <label for="status" class="col-sm-4 control-label">Status</label>
            <div class="col-sm-7">
                <?=form_dropdown('status', status_keluarga(), @$find_data['status'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="surat_nikah" class="col-sm-4 control-label">No. Surat Nikah</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('surat_nikah')) ? set_value('surat_nikah') : @$find_data['surat_nikah'];?>" name="surat_nikah" placeholder="diisi jika status istri/suami">
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
<form id="form_riwayat_pangkats" enctype="multipart/form-data" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>profil/riwayat_kepangkatan_save" role='form'>
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="pangkat" class="col-sm-4 control-label">Pangkat / Golongan Ruang</label>
            <div class="col-sm-7">
                <?=form_dropdown('pangkat_golongan', pangkat_golongan(), @$find_data['pangkat_golongan'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="tmt" class="col-sm-4 control-label">Tanggal Mulai Tugas (TMT)</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tmt')) ? set_value('tmt') : @$find_data['tmt'];?>" name="tmt">
            </div>
        </div>
        <div class="form-group">
            <label for="no_sk" class="col-sm-4 control-label">No. SK Pangkat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('no_sk')) ? set_value('no_sk') : @$find_data['no_sk'];?>" name="no_sk">
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_sk" class="col-sm-4 control-label">Tanggal SK Pangkat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_sk')) ? set_value('tgl_sk') : @$find_data['tgl_sk'];?>" name="tgl_sk">
            </div>
        </div>
        <div class="form-group">
            <label for="pejabat_sah" class="col-sm-4 control-label">Pejabat Yang Menetapkan</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" name="pejabat_sah">
                    <option value="">-- PILIH --</option>
                    <?php
                    foreach ($arr_pejabat as $value) {
                        if(isset($find_data['pejabat_sah'])){
                            if (@$find_data['pejabat_sah'] == $value['id']) {
                                echo '<option value="'.$value['id'].'" selected>'.$value['nama'].'</option>';
                            } else{
                                echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                            }
                        } else{
                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                        }
                    }
                    ?>
                </select>
                <label for="pejabat_sah" class="error"></label>
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
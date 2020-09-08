<form id="form_naik_pangkat" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/naik_pangkat_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Pegawai</label>
            <div class="col-sm-7">
                <?php
                    echo select_dinamis_choosen('fid_pegawai', 'pegawai', 'nama', 'id', array('unit_kerja'=>$user_active['unit_kerja']), @$find_data['fid_pegawai'], 'onchange="find_pangkat(this);"');
                ?>
                <label for="fid_pegawai" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Pangkat Lama</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" tabindex="2" id="fid_pangkat_lama" name="fid_pangkat_lama">
                    <option value="">-- Pilih--</option>
                </select>
                <label for="fid_pangkat_lama" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Pangkat Baru</label>
            <div class="col-sm-7">
                <?=form_dropdown('fid_pangkat_baru', pangkat_golongan(), @$find_data['fid_pangkat_baru'], "class='form-control chosen-select mb-15' tabindex='2'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_pertek" class="col-sm-4 control-label">Tanggal PERTEK</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_pertek')) ? set_value('tgl_pertek') : @$find_data['tgl_pertek'];?>" name="tgl_pertek">
            </div>
        </div>
        <div class="form-group">
            <label for="tgl_sk" class="col-sm-4 control-label">Tanggal SK</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tgl_sk')) ? set_value('tgl_sk') : @$find_data['tgl_sk'];?>" name="tgl_sk">
            </div>
        </div>
        <div class="form-group">
            <label for="no_sk" class="col-sm-4 control-label">Nomor SK</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('no_sk')) ? set_value('no_sk') : @$find_data['no_sk'];?>" name="no_sk">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
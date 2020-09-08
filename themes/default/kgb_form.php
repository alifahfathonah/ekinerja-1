<form id="form_kgb" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/kgb_save" role="form">
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
                    echo select_dinamis_choosen('fid_pegawai', 'pegawai', 'nama', 'id', array('unit_kerja'=>$user_active['unit_kerja']), @$find_data['fid_pegawai']);
                ?>
                <label for="fid_pegawai" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="tanggal" class="col-sm-4 control-label">Tanggal</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm tgl_picker" value="<?=(set_value('tanggal')) ? set_value('tanggal') : @$find_data['tanggal'];?>" name="tanggal">
            </div>
        </div>
        <div class="form-group">
            <label for="gaji_lama" class="col-sm-4 control-label">Gaji Pokok Lama</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" name="gaji_lama" value="<?=(set_value('gaji_lama')) ? set_value('gaji_lama') : number_format(@$find_data['gaji_lama'],0,",",".");?>" onkeypress="javascript:return numerik(event);" onkeyup="javascript:angka(this);" onblur="javascript:angka(this);">
            </div>
        </div>
        <div class="form-group">
            <label for="gaji_baru" class="col-sm-4 control-label">Gaji Pokok Baru</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" name="gaji_baru" value="<?=(set_value('gaji_baru')) ? set_value('gaji_baru') : number_format(@$find_data['gaji_baru'],0,",",".");?>" onkeypress="javascript:return numerik(event);" onkeyup="javascript:angka(this);" onblur="javascript:angka(this);">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
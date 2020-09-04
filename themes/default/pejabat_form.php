<form id="form_pejabat" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>master/pejabat_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="posisi" class="col-sm-4 control-label">Posisi Jabatan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('posisi')) ? set_value('posisi') : @$find_data['posisi'];?>" name="posisi">
            </div>
        </div>
        <div class="form-group">
            <label for="organisasi" class="col-sm-4 control-label">Bagian / Bidang</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('organisasi')) ? set_value('organisasi') : @$find_data['organisasi'];?>" name="organisasi">
            </div>
        </div>
        <div class="form-group">
            <label for="pangkat_golongan" class="col-sm-4 control-label">Pangkat / Golongan ruang</label>
            <div class="col-sm-7">
                <?=form_dropdown('pangkat_golongan', pangkat_golongan(), @$find_data['pangkat_golongan'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama Pejabat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama')) ? set_value('nama') : @$find_data['nama'];?>" name="nama">
            </div>
        </div>
        <div class="form-group">
            <label for="nip" class="col-sm-4 control-label">NIP Pejabat</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nip')) ? set_value('nip') : @$find_data['nip'];?>" name="nip">
            </div>
        </div>
        <div class="form-group">
            <label for="aktif" class="col-sm-4 control-label">Aktif</label>
            <div class="col-sm-7">
                <?=form_dropdown('aktif', aktif(), @$find_data['aktif'], "class='form-control input-sm'");?>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</form>
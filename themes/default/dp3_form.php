<form id="form_dp3" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/dp3_save" role="form">
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
                    echo select_dinamis_choosen('fid_pegawai', 'pegawai', 'nama', 'id', null, @$find_data['fid_pegawai'], 'onchange="find_pejabat(this);"');
                ?>
                <label for="fid_pegawai" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="pejabat" class="col-sm-4 control-label">Pejabat Penilai</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" tabindex="2" id="pejabat" name="pejabat" onchange="find_atasan_pejabat(this);">
                    <option value="">-- Pilih--</option>
                </select>
                <label for="pejabat" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="atasan_pejabat" class="col-sm-4 control-label">Atasan Pejabat Penilai</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" tabindex="2" id="atasan_pejabat" name="atasan_pejabat">
                    <option value="">-- Pilih--</option>
                </select>
                <label for="atasan_pejabat" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="tahun" class="col-sm-4 control-label">Tahun DP-3</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_orientasi')) ? set_value('tahun') : @$find_data['tahun'];?>" name="tahun" placeholder="contoh: 2018">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_orientasi" class="col-sm-4 control-label">Nilai Orientasi Pelayanan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_orientasi')) ? set_value('nilai_orientasi') : @$find_data['nilai_orientasi'];?>" name="nilai_orientasi" placeholder="input nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_integritas" class="col-sm-4 control-label">Nilai Integritas</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_integritas')) ? set_value('nilai_integritas') : @$find_data['nilai_integritas'];?>" name="nilai_integritas" placeholder="input nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_komitmen" class="col-sm-4 control-label">Nilai Komitmen</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_komitmen')) ? set_value('nilai_komitmen') : @$find_data['nilai_komitmen'];?>" name="nilai_komitmen" placeholder="input nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_disiplin" class="col-sm-4 control-label">Nilai Disiplin</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_disiplin')) ? set_value('nilai_disiplin') : @$find_data['nilai_disiplin'];?>" name="nilai_disiplin" placeholder="input nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_kerjasama" class="col-sm-4 control-label">Nilai Kerjasama</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_kerjasama')) ? set_value('nilai_kerjasama') : @$find_data['nilai_kerjasama'];?>" name="nilai_kerjasama" placeholder="input nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="nilai_kepemimpinan" class="col-sm-4 control-label">Nilai Kepemimpinan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai_kepemimpinan')) ? set_value('nilai_kepemimpinan') : @$find_data['nilai_kepemimpinan'];?>" name="nilai_kepemimpinan" placeholder="input nilai">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
<form id="form_duk" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/duk_save" role="form">
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
                    echo select_dinamis_choosen('fid_pegawai', 'pegawai', 'nama', 'id', array('unit_kerja'=>$user_active['unit_kerja']), @$find_data['fid_pegawai'], 'onchange="find_pangkat_jabatan(this);"');
                ?>
                <label for="fid_pegawai" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Pangkat Terakhir</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" tabindex="2" id="fid_pangkat_akhir" name="fid_pangkat_akhir">
                    <option value="">-- Pilih--</option>
                </select>
                <label for="fid_pangkat_akhir" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Riwayat Jabatan Terakhir</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" tabindex="2" id="fid_jabatan_akhir" name="fid_jabatan_akhir">
                    <option value="">-- Pilih--</option>
                </select>
                <label for="fid_jabatan_akhir" class="error"></label>
            </div>
        </div>
        <div class="text-center"><span class="label label-info" style="margin-left: 10px;">Masa Kerja Keseluruhan</span></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="thn_masakerja" class="col-sm-4 control-label">Tahun</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="thn_masakerja" value="<?=(set_value('thn_masakerja')) ? set_value('thn_masakerja') : @$find_data['thn_masakerja'];?>" placeholder="tahun/masa kerja, angkatan">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bln_masakerja" class="col-sm-4 control-label">Bulan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="bln_masakerja" value="<?=(set_value('bln_masakerja')) ? set_value('bln_masakerja') : @$find_data['bln_masakerja'];?>" placeholder="bulan/masa kerja, angkatan">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center"><span class="label label-info" style="margin-left: 10px;">Daftar Urut Kepangkatan (DUK)</span></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tahun_duk" class="col-sm-4 control-label">Tahun DUK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="tahun_duk" value="<?=(set_value('tahun_duk')) ? set_value('tahun_duk') : @$find_data['tahun_duk'];?>" placeholder="tahun duk">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="urutan_duk" class="col-sm-4 control-label">Urutan DUK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="urutan_duk" value="<?=(set_value('urutan_duk')) ? set_value('urutan_duk') : @$find_data['urutan_duk'];?>" placeholder="no. urut duk">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
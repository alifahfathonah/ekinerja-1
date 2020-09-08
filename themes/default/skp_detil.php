<form id="form_skp_detil" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/skp_detil_insert" role="form">
    <div class="form-body">
        <table class="table table-bordered table-striped" style="clear: both">
            <tbody>
                <tr>
                    <td width="20%" class="text-right">Nama</td>
                    <td width="80%"><?=$skp_pegawai['nama'];?></td>
                </tr>
                <tr>
                    <td class="text-right">NIP</td>
                    <td><?=$skp_pegawai['nip'];?></td>
                </tr>
                <tr>
                    <td class="text-right">Tahun</td>
                    <td><?=$skp_pegawai['tahun'];?></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group hidden">
            <label for="fid_skp" class="col-sm-3 control-label">ID SKP</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" id="fid_skp" name="fid_skp" value="<?=$skp_pegawai['id'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="jenis_tugas" class="col-sm-3 control-label">Jenis Tugas</label>
            <div class="col-sm-5">
                <?=form_dropdown('jenis_tugas', jenis_tugas(), '', "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="tugas" class="col-sm-3 control-label">Deskripsi Tugas</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" placeholder="input deskripsi tugas" name="tugas">
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</form>

<div class="table-responsive" style="padding: 15px;">
    <table id="table_skp_detil" class="table table-theme" width="100%">
        <thead>
            <tr>
                <th class="text-center" rowspan="2">Tugas</th>
                <th rowspan="2">AK</th>
                <th class="text-center" colspan="4">TARGET</th>
                <th class="text-center" rowspan="2">AK</th>
                <th class="text-center" colspan="4">REALISASI</th>
                <th class="text-center" rowspan="2">PERHITUNGAN</th>
                <th class="text-center" rowspan="2">NILAI</th>
                <th class="text-center" rowspan="2">JENIS</th>
            </tr>
            <tr>
                <th class="text-center">Kuant/ Output</th>
                <th class="text-center">Kual/ Mutu</th>
                <th class="text-center">Waktu (Bln)</th>
                <th class="text-center">Biaya</th>
                <th class="text-center">Kuant/ Output</th>
                <th class="text-center">Kual/ Mutu</th>
                <th class="text-center">Waktu (Bln)</th>
                <th class="text-center">Biaya</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
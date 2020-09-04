<h4 class="text-success text-center"><?=show_row('ekin_keg_tahunan', array('id'=>$id_keg), 'kegiatan');?> <br> <?= "(Bulan ".bulan($bulan).")";?></h4>
<form id="form_breakdown_bulanan" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/keg_bulanan_post" role="form">
    <div class="form-body mb-15">
        <div class="form-group hidden">
            <label for="idKegiatan" class="col-sm-3 control-label">idKegiatan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" value="<?=$id_keg;?>" name="idKegiatan" id="idKegiatan">
            </div>
        </div>
        <div class="form-group hidden">
            <label for="bulan" class="col-sm-3 control-label">Bulan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" value="<?=$bulan;?>" name="bulan" id="bulan">
            </div>
        </div>
        <!--
        <div class="form-group">
            <label for="kegiatan" class="col-sm-3 control-label">Kegiatan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" name="kegiatan">
            </div>
        </div>
        -->
        <div class="form-group">
            <label for="kuantitas" class="col-sm-3 control-label">Kuantitas</label>
            <div class="col-sm-3">
                <input type="text" class="form-control input-sm" name="kuantitas">
            </div>
        </div>
        <div class="form-group">
            <label for="satuan" class="col-sm-3 control-label">Satuan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" name="satuan">
            </div>
        </div>
        <div class="form-group">
            <label for="biaya" class="col-sm-3 control-label">Biaya (Rp)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" name="biaya" onkeypress="javascript:return numerik(event);" onkeyup="javascript:angka(this);" onblur="javascript:angka(this);">
            </div>
        </div>
        <div class="form-group">
            <label for="angka_kredit" class="col-sm-3 control-label">Angka Kredit</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" name="angka_kredit">
            </div>
        </div>
        <div class="form-group">
            <label for="waktu" class="col-sm-3 control-label">Waktu</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-sm" name="waktu">
            </div>
        </div>
        <div class="form-group">
            <label for="periode_waktu" class="col-sm-3 control-label">Periode Waktu</label>
            <div class="col-sm-8">
                <?=form_dropdown('periode_waktu', ekin_periode_waktu(), null, "class='form-control input-sm'");?>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>


<div class="panel-body no-padding">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center border-right">No.</th>
                    <th>Kuantitas</th>
                    <th>Satuan</th>
                    <th>Waktu</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="breakdown_bulanan" class="animated fadeIn">
                <?=$list_data_bulan;?>
            </tbody>
        </table>
    </div>
</div>
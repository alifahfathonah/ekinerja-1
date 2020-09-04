<form id="keg_tahunan_form" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/keg_tahunan_post" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag" id="id_flag">
            </div>
        </div>
        <div class="form-group">
            <label for="tahun" class="col-sm-4 control-label">Tahun</label>
            <div class="col-sm-7">
                <?php 
                    if(isset($find_data['tahun']))
                        $y_now = $find_data['tahun'];
                    else
                        $y_now = date('Y');
                ?>
                <input type="text" class="form-control input-sm tgl_picker" value="<?=$y_now;?>" name="tahun" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis" class="col-sm-4 control-label">Jenis</label>
            <div class="col-sm-7">
                <?=form_dropdown('jenis', ekin_jenkeg(), $find_data['jenis'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="kegiatan" class="col-sm-4 control-label">Kegiatan</label>
            <div class="col-sm-7">
                <textarea class="form-control input-sm" rows="4" name="kegiatan"><?=(set_value('kegiatan')) ? set_value('kegiatan') : $find_data['kegiatan'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="target_kuantitas" class="col-sm-4 control-label">Target Kuantitas</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('target_kuantitas')) ? set_value('target_kuantitas') : $find_data['target_kuantitas'];?>" name="target_kuantitas">
            </div>
        </div>
        <div class="form-group">
            <label for="satuan" class="col-sm-4 control-label">Satuan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('satuan')) ? set_value('satuan') : $find_data['satuan'];?>" name="satuan">
            </div>
        </div>
        <div class="form-group">
            <label for="biaya" class="col-sm-4 control-label">Biaya (Rp)</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" name="biaya" value="<?=(set_value('biaya')) ? set_value('biaya') : number_format($find_data['biaya'],0,",",".");?>" onkeypress="javascript:return numerik(event);" onkeyup="javascript:angka(this);" onblur="javascript:angka(this);">
            </div>
        </div>
        <div class="form-group">
            <label for="angka_kredit" class="col-sm-4 control-label">Angka Kredit</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('angka_kredit')) ? set_value('angka_kredit') : $find_data['angka_kredit'];?>" name="angka_kredit">
            </div>
        </div>
        <div class="form-group">
            <label for="target_penyelesaian" class="col-sm-4 control-label">Target Penyelesaian</label>
            <div class="col-sm-7">
                <select class="form-control input-sm" name="target_penyelesaian">
                <?php
                    if(isset($find_data['target_penyelesaian'])){
                        $tarsel = $find_data['target_penyelesaian'];
                    } else{
                        $tarsel = 0;
                    }
                    for($i=1; $i<13; $i++){
                        if($i == $tarsel){
                            echo '<option value="'.$i.'" selected>'.$i.' Bulan</option>';
                        } else{
                            echo '<option value="'.$i.'">'.$i.' Bulan</option>';
                        }
                    }
                ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <?=$btn_ajukan;?>
        </div>
    </div><!-- /.form-footer -->
</form>
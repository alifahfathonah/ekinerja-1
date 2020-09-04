<?php
    if(isset($find_data['status'])){
        if($find_data['status'] !== 'Draft'){
            $btn_submit = 'disabled';
            $hidden_file = 'hidden';
        } else{
            $btn_submit = '';
            $hidden_file = '';
        }
    }
?>

<form id="tugas_tamkrea_form" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/tgs_tambkrea_post" role="form" enctype="multipart/form-data">
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
                <input type="text" class="form-control input-sm" value="<?=$y_now;?>" name="tahun" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="bulan" class="col-sm-4 control-label">Bulan</label>
            <div class="col-sm-7">
                <?=form_dropdown('bulan', bulan(), $find_data['bulan'], "class='form-control input-sm' ".$readonly."");?>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis" class="col-sm-4 control-label">Jenis</label>
            <div class="col-sm-7">
                <?=form_dropdown('jenis', ekin_tambkrea(), $find_data['jenis'], "class='form-control input-sm' ".$readonly."");?>
            </div>
        </div>
        <div class="form-group">
            <label for="kegiatan" class="col-sm-4 control-label">Kegiatan</label>
            <div class="col-sm-7">
                <textarea class="form-control input-sm" rows="3" name="kegiatan" <?=$readonly;?>><?=(set_value('kegiatan')) ? set_value('kegiatan') : $find_data['kegiatan'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="file_bukti" class="col-sm-4 control-label">File Bukti</label>
            <div class="col-sm-7">
                <div class="fileinput fileinput-new input-group <?=$hidden_file;?>" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-addon btn btn-warning btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="userfile"></span>
                    <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
                <?php
                    if(isset($find_data['file']) && file_exists('./upload/file/'.$find_data['file']) && $find_data['file'] != NULL){
                        echo '<span><a href="'.base_url().'upload/file/'.$find_data['file'].'" target="_blank">'.$find_data['file'].'</a></span>';
                    }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="note" class="col-sm-4 control-label">Note</label>
            <div class="col-sm-7">
                <textarea class="form-control input-sm" rows="3" name="note" <?=$readonly;?>><?=(set_value('note')) ? set_value('note') : $find_data['note'];?></textarea>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success" <?=$btn_submit;?>>Simpan</button>
            <?=$btn_ajukan;?>
        </div>
    </div>
</form>
<form id="form_jabatan" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>master/jabatan_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama Jabatan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama')) ? set_value('nama') : @$find_data['nama'];?>" name="nama">
            </div>
        </div>
        <div class="form-group">
            <label for="parent" class="col-sm-4 control-label">Posisi Atasan per Jabatan</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" name="parent">
                    <option value="0">NONE</option>
                    <?php
                    foreach ($list_parent as $value) {
                        if(isset($find_data['parent'])){
                            if (@$find_data['parent'] == $value['id']) {
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
            </div>
        </div>

        <div class="form-group">
            <label for="parent" class="col-sm-4 control-label">Unit Kerja</label>
            <div class="col-sm-7">
                <select class="form-control chosen-select mb-15" name="skpd">
                    <option value="">- Pilih SKPD -</option>
                    <?php
                    foreach ($skpd as $value) { ?>
                        <option value="<?=$value->id?>" <?= (@$find_data['id_skpd'] == $value->id) ? "selected" : "" ?>><?=$value->nama?></option>
                    <?php } ?>
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-4 control-label">Type</label>
            <div class="col-sm-7">
                <?=form_dropdown('type', type_jabatan(), @$find_data['type'], "class='form-control input-sm'");?>
            </div>
        </div>
        <div class="form-group">
            <label for="nilai" class="col-sm-4 control-label">Nilai</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nilai')) ? set_value('nilai') : @$find_data['nilai'];?>" name="nilai">
            </div>
        </div>
        <div class="form-group">
            <label for="kelas" class="col-sm-4 control-label">Kelas</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('kelas')) ? set_value('kelas') : @$find_data['kelas'];?>" name="kelas">
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
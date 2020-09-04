<form id="form_user_pegawai" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>pegawai/pegawai_save" role="form">
    <div class="form-body">
        <div class="form-group hidden">
            <label for="flag" class="col-sm-4 control-label">Flag</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="flag">
            </div>
        </div>
        <div class="form-group">
            <label for="nip" class="col-sm-4 control-label">NIP</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" id='nipModal' placeholder="XXXXXXXX XXXXXX X XXX" onkeyup="nipMasking()" value="<?=(set_value('nip')) ? set_value('nip') : $find_data['nip'];?>" name="nip">
            </div>
        </div>
        <div class="form-group">
            <label for="nama_panggilan" class="col-sm-4 control-label">Nama Panggilan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama_panggilan')) ? set_value('nama_panggilan') : $find_data['nama_panggilan'];?>" name="nama_panggilan">
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-4 control-label">Nama Lengkap</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('nama')) ? set_value('nama') : $find_data['nama'];?>" name="nama">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Username</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm" value="<?=(set_value('username')) ? set_value('username') : ($find_data['fid_user'] != 0 ? show_row('user', array('id'=>$find_data['fid_user']),'username') : "");?>" name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-7">
                <input type="password" class="form-control input-sm" name="password">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-7">
                <input type="email" class="form-control input-sm" value="<?=(set_value('email')) ? set_value('email') : ($find_data['fid_user'] != 0 ? show_row('user', array('id'=>$find_data['fid_user']),'email') : "");?>" name="email">
            </div>
        </div>
        <div class="form-group">
            <label for="diterima_dikelas" class="col-sm-4 control-label">Jabatan</label>
            <div class="col-sm-7">
            <?php 
                if(isset($find_data['fid_jabatan']))
                    $data = $find_data['fid_jabatan'];
                else
                    $data = null;
                echo select_dinamis('fid_jabatan', 'jabatan', 'nama', 'id', array('aktif'=>'Ya'), $data);
            ?>
            </div>
        </div>
        <div class="form-group">
            <label for="unit_kerja" class="col-sm-4 control-label">Unit Kerja</label>
            <div class="col-sm-7">
            <?php 
                if(isset($find_data['unit_kerja'])){
                    $data = $find_data['unit_kerja'];
                }
                else{
                    $data = null;
                }
                if($user_active['fid_user_level'] == 1){
                    echo select_dinamis('unit_kerja', 'unit_kerja', 'nama', 'id', null, $data);
                } else{
                    echo select_dinamis('unit_kerja', 'unit_kerja', 'nama', 'id', array('id'=>$user_active['unit_kerja']), $data);
                }
                
            ?>
            </div>
        </div>
        <div class="form-group">
            <label for="role" class="col-sm-4 control-label">Role</label>
            <div class="col-sm-7">
                <select class="form-control input-sm" name="role">
                <?php
                if (!empty($list_level)){
                    foreach ($list_level as $key) {
                        if (isset($find_data['fid_user'])){
                            $get_level = show_row('user', array('id'=>$find_data['fid_user']),'fid_user_level');
                            if($get_level == $key->id){
                                echo '<option value="'.$key->id.'" selected>'.$key->nama.'</option>';
                            } else{
                                echo '<option value="'.$key->id.'">'.$key->nama.'</option>';
                            }
                        } else{
                            echo '<option value="'.$key->id.'">'.$key->nama.'</option>';
                        }
                    }
                }
                ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="aktif" class="col-sm-4 control-label">Aktif</label>
            <div class="col-sm-7">
                <select class="form-control input-sm" name="aktif">
                <?php
                $arr = array('YES','NO');
                for ($i=0; $i < count($arr) ; $i++) { 
                    if (isset($find_data['fid_user'])){
                        $get_active = show_row('user', array('id'=>$find_data['fid_user']),'active');
                        if ($get_active == $arr[$i]){
                            echo '<option value="'.$arr[$i].'" selected>'.$arr[$i].'</option>';
                        } else{
                            echo '<option value="'.$arr[$i].'">'.$arr[$i].'</option>';
                        }
                    } else{
                        echo '<option value="'.$arr[$i].'">'.$arr[$i].'</option>';
                    }
                    
                }
                ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="col-sm-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div><!-- /.form-footer -->
</form>
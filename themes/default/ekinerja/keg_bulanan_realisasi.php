<div class="panel-body animated fadeIn">
    <div class="row">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="text-right" width="30%">Nama Kegiatan</td>
                    <td class="text-danger"><?=show_row('ekin_keg_tahunan', array('id'=>$result['fid_keg_tahunan']),'kegiatan');?></td>
                </tr>
                <tr>
                    <td class="text-right">Periode</td>
                    <td class="text-danger"><?=bulan($result['bulan']);?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel-body no-padding animated fadeIn">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center">TARGET BULANAN</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="text-right">Kuantitas (<?=$result['satuan'];?>)</td>
                                <td class="text-info"><?=$result['kuantitas'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Biaya (Rp)</td>
                                <td class="text-info"><?=number_format($result['biaya'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Angka Kredit</td>
                                <td class="text-info"><?=$result['angka_kredit'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Waktu (<?=$result['periode_waktu'];?>)</td>
                                <td class="text-info"><?=$result['waktu'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            if($undifine == 1){
            ?>
                <div class="panel panel-warning">
                    <div class="panel-heading text-center">HASIL</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right">PERHITUNGAN</td>
                                    <td class="text-warning"><?=$find_data['perhitungan'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">NILAI</td>
                                    <td class="text-warning"><?=$find_data['nilai'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if($result['status'] == 'Draft'){
                    ?>
                        <div class="panel-body">
                            <a class="btn btn-primary btn-lg btn-block ajukan">Ajukan Ke Atasan/Pejabat Penilai</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">REALISASI</div>
                <div class="panel-body">
                    <form id="realisasi_bulanan_form" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/keg_bulanan_realisasi_post" role="form">
                        <div class="form-body">
                            <div class="form-group hidden">
                                <label for="id_keg" class="col-sm-6 control-label">ID Kegiatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" value="<?=$flag;?>" name="id_keg" id="id_flag">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kuantitas" class="col-sm-6 control-label">Kuantitas (<?=$result['satuan'];?>)</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" value="<?=(set_value('kuantitas')) ? set_value('kuantitas') : $find_data['kuantitas'];?>" name="kuantitas" <?=$readonly;?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kualitas" class="col-sm-6 control-label">Kualitas (%)</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" value="<?=(set_value('kualitas')) ? set_value('kualitas') : $find_data['kualitas'];?>" name="kualitas" <?=$readonly;?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="biaya" class="col-sm-6 control-label">Biaya (Rp)</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" name="biaya" value="<?=(set_value('biaya')) ? set_value('biaya') : number_format($find_data['biaya'],0,",",".");?>" onkeypress="javascript:return numerik(event);" onkeyup="javascript:angka(this);" onblur="javascript:angka(this);" <?=$readonly;?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="angka_kredit" class="col-sm-6 control-label">Angka Kredit</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" value="<?=(set_value('angka_kredit')) ? set_value('angka_kredit') : $find_data['angka_kredit'];?>" name="angka_kredit" <?=$readonly;?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu" class="col-sm-6 control-label">Waktu (<?=$result['periode_waktu'];?>)</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" value="<?=(set_value('waktu')) ? set_value('waktu') : $find_data['waktu'];?>" name="waktu" <?=$readonly;?>>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <div class="col-sm-offset-6">
                                <?php
                                    if($result['status'] !== 'Draft')
                                        $disabled = 'disabled';
                                    else
                                        $disabled = '';
                                ?>
                                <button type="submit" class="btn btn-sm btn-success" <?=$disabled;?>>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-content">
    <h2><i class="fa fa-check-square-o"></i>Hasil Penilaian</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="javascript:void(0);">Ekinerja</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Hasil Penilaian</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated zoomInUp">
    <div class="row">
        <div class="col-md-12">
            <!-- Start vertical tabs -->
            <div class="panel panel-tab panel-tab-double panel-tab-vertical row no-margin mb-15 rounded shadow">
                <!-- Start tabs heading -->
                <div class="panel-heading no-padding col-lg-4 col-md-4 col-sm-4">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_penilaian1" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Formulir Sasaran Kerja</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian2" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Capaian Sasaran Kerja Tahunan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian3" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Capaian Sasaran Kerja Bulanan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian4" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Penilaian Prilaku Tahunan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian5" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Penilaian Prilaku Bulanan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian6" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Hasil Penilaian Prestasi Kerja Tahunan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_penilaian7" data-toggle="tab">
                                <i class="fa fa-print"></i>
                                <div>
                                    <span class="text-strong">Hasil Penilaian Prestasi Kerja Bulanan</span>
                                    <span>Filter dan Cetak</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.panel-heading -->
                <!--/ End tabs heading -->

                <!-- Start tabs content -->
                <div class="panel-body col-lg-8 col-md-8 col-sm-8">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_penilaian1">
                            <h4 class="text-center">Formulir Sasaran Kerja</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/formulir_sasaran_kerja" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal Cetak</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker2" name="tanggal_cetak" value="<?=date('Y-m-d');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian2">
                            <h4 class="text-center">Capaian Sasaran Kerja Tahunan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/capaian_sasaran_kerja_tahunan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jangka Waktu Penilaian</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker_range" name="periode_penilaian" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal Cetak</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker2" name="tanggal_cetak" value="<?=date('Y-m-d');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian3">
                            <h4 class="text-center">Capaian Sasaran Kerja Bulanan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/capaian_sasaran_kerja_bulanan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Bulan</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="bulan">
                                            <?php
                                            foreach (bulan() as $key => $value) {
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tanggal Cetak</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker2" name="tanggal_cetak" value="<?=date('Y-m-d');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian4">
                            <h4 class="text-center">Penilaian Prilaku Tahunan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/nilai_prilaku_tahunan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jangka Waktu Penilaian</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker_range" name="periode_penilaian" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian5">
                            <h4 class="text-center">Penilaian Prilaku Bulanan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/nilai_prilaku_bulanan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Bulan</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="bulan">
                                            <?php
                                            foreach (bulan() as $key => $value) {
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian6">
                            <h4 class="text-center">Hasil Penilaian Prestasi Kerja Tahunan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/prestasi_kerja_tahunan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jangka Waktu Penilaian</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control input-sm tgl_picker_range" name="periode_penilaian" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_penilaian7">
                            <h4 class="text-center">Hasil Penilaian Prestasi Kerja Bulanan</h4>
                            <form class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>ekinerja/prestasi_kerja_bulanan" role="form" target="_blank">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="tahun">
                                                <?php
                                                    $tahun = explode("-", $thn_aktif);
                                                    for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                                        if(date('Y') == $i)
                                                            echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                                        else
                                                            echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Bulan</label>
                                        <div class="col-sm-7">
                                            <select class="form-control input-sm" name="bulan">
                                            <?php
                                            foreach (bulan() as $key => $value) {
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="col-sm-offset-3">
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-file-pdf-o"></i> CETAK PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <!--/ End tabs content -->
            </div><!-- /.panel -->
            <!--/ End vertical tabs -->

        </div>
    </div><!-- /.row -->
</div>
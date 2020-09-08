<div class="header-content">
    <h2><i class="fa fa-check-square-o"></i>Target Kinerja Tahunan</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="javascript:void(0);">Ekinerja</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0);">Verifikasi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Target Kinerja Tahunan</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated zoomInUp">
    <div class="row">
        <div class="col-md-12">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Target Kinerja Tahunan</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="search" data-toggle="tooltip" data-placement="top" data-title="Filter Data"><i class="fa fa-filter"></i></button>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-search">
                    <div class="row">
                        <form id="filter_keg_tahunan_verifikasi">
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Tahun" class="form-control input-sm chosen-opt" tabindex="2" name="tahun" onchange="filterSelected('verifikasi_kegTahunan');">
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
                            <div class="col-md-6">
                                <select data-placeholder="Pilih Unit Kerja" class="form-control input-sm chosen-opt" tabindex="2" name="unit_kerja" onchange="filterSelected('verifikasi_kegTahunan');">
                                    <option value="">Pilih Unit Kerja</option>
                                    <?php
                                        foreach ($unit_kerja as $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="verifikasi_kegTahunan" class="table table-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>::</th>
                                <th>Kegiatan Tahunan</th>
                                <th>Pegawai</th>
                                <th>Target Kuantitas</th>
                                <th>Biaya</th>
                                <th>Angka Kredit</th>
                                <th>Detail</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>::</th>
                                <th>Kegiatan Tahunan</th>
                                <th>Pegawai</th>
                                <th>Target Kuantitas</th>
                                <th>Biaya</th>
                                <th>Angka Kredit</th>
                                <th>Detail</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
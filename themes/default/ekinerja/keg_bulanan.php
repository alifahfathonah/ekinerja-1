<div class="header-content">
    <h2><i class="fa fa-check-square-o"></i>Realisasi Kinerja Bulanan</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="javascript:void(0);">Ekinerja</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Realisasi Kinerja Bulanan</a>
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
                        <h3 class="panel-title">Realisasi Kinerja Bulanan</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="search" data-toggle="tooltip" data-placement="top" data-title="Filter Data"><i class="fa fa-filter"></i></button>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-search">
                    <form id="filter_keg_bulanan">
                        <select class="form-control input-sm" name="tahun" onchange="filterSelected('ekin_kegBulanan');">
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
                    </form>
                </div>
                <div class="panel-body">
                    <table id="ekin_kegBulanan" class="table table-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>::</th>
                                <th>Bulan</th>
                                <th>Kegiatan Tahunan</th>
                                <th>Waktu</th>
                                <th>Kuantitas</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>::</th>
                                <th>Bulan</th>
                                <th>Kegiatan Tahunan</th>
                                <th>Waktu</th>
                                <th>Kuantitas</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
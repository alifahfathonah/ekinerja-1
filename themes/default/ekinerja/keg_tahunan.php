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
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('ekinerja/keg_tahunan_form', 'contentModal', '');open_modal('', 'Tambah Target Kinerja Tahunan', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="search" data-toggle="tooltip" data-placement="top" data-title="Filter Data"><i class="fa fa-filter"></i></button>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-search">
                    <form id="filter_keg_tahunan">
                        <select class="form-control input-sm" name="tahun" onchange="filterSelected('ekin_kegTahunan');">
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
                    <table id="ekin_kegTahunan" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-hide="expand">Kegiatan Tahunan</th>
                                <th data-hide="phone">Target Kuantitas</th>
                                <th data-hide="phone">Biaya</th>
                                <th data-hide="phone">Angka Kredit</th>
                                <th>BreakDown<br>Bulanan</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Kegiatan Tahunan</th>
                                <th>Target Kuantitas</th>
                                <th>Biaya</th>
                                <th>Angka Kredit</th>
                                <th>BreakDown<br>Bulanan</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
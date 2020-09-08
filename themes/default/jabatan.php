<div class="header-content">
    <h2><i class="fa fa-level-up"></i>Jabatan</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="fa fa-ellipsis-v"></i>
                <a href="javascript:void(0);">Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Jabatan</a>
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
                        <h3 class="panel-title">Data Jabatan</h3>
                    </div>
                    <div class="pull-right">
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('master/jabatan_form', 'contentModal', '');open_modal('', 'Tambah Jabatan', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_jabatan" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Jabatan</th>
                                <th data-hide="phone" rowspan="2">Posisi Atasan per Jabatan</th>
                                <th data-hide="phone" rowspan="2">Aktif</th>
                                <th rowspan="2">#</th>
                            </tr>
                            <tr>
                                <th data-class="expand">Nama</th>
                                <th data-class="expand">Unit Kerja</th>
                                <th data-hide="phone" class="text-center">Nilai</th>
                                <th data-hide="phone" class="text-center">Kelas</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
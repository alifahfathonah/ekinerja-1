<div class="header-content">
    <h2><i class="fa fa-history"></i>Riwayat Jabatan</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="fa fa-user"></i>
                <a href="javascript:void(0);">Profil</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Riwayat Jabatan</a>
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
                        <h3 class="panel-title">Data Riwayat Jabatan</h3>
                    </div>
                    <div class="pull-right">
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('profil/riwayat_jabatan_form', 'contentModal', '');open_modal('', 'Tambah Riwayat Jabatan', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_riwayatJabatan" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-class="expand">Nama Jabatan</th>
                                <th data-hide="phone,tablet">Unit Kerja</th>
                                <th data-hide="phone">Eselon Jabatan</th>
                                <th data-hide="phone">TMT</th>
                                <th data-hide="phone">Nomor SK</th>
                                <th data-hide="phone,tablet">Tanggal SK</th>
                                <th data-hide="phone,tablet">Pejabat Yang Menetapkan</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Eselon Jabatan</th>
                                <th>TMT</th>
                                <th>Nomor SK</th>
                                <th>Tanggal SK</th>
                                <th>Pejabat Yang Menetapkan</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
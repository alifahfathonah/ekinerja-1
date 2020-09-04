<div class="header-content">
    <h2><i class="fa fa-graduation-cap"></i>Riwayat Pendidikan</h2>
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
                <a href="javascript:void(0);">Riwayat Pendidikan</a>
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
                        <h3 class="panel-title">Data Pendidikan Umum</h3>
                    </div>
                    <div class="pull-right">
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('profil/riwayat_pendidikan_form', 'contentModal', '');open_modal('', 'Tambah Riwayat Pendidikan Umum', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_riwayatPendidikan" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-class="expand">Jenjang</th>
                                <th data-hide="phone">Instansi</th>
                                <th data-hide="phone">Kepala Instansi</th>
                                <th data-hide="phone,tablet">Nomor Ijazah</th>
                                <th data-hide="phone,tablet">Tanggal Ijazah</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Jenjang</th>
                                <th>Instansi</th>
                                <th>Kepala Instansi</th>
                                <th>Nomor Ijazah</th>
                                <th>Tanggal Ijazah</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Data Pendidikan dan Pelatihan</h3>
                    </div>
                    <div class="pull-right">
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('profil/riwayat_diklat_form', 'contentModal', '');open_modal('', 'Tambah Riwayat Pendidikan dan Pelatihan', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_riwayatPelatihan" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-class="expand">Nama Diklat</th>
                                <th data-hide="phone">Penyelenggara</th>
                                <th data-hide="phone,tablet">Tahun/Angkatan</th>
                                <th data-hide="phone,tablet">Lama Pendidikan</th>
                                <th data-hide="phone,tablet">No. STPP</th>
                                <th data-hide="phone,tablet">Tanggal STPP</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Diklat</th>
                                <th>Penyelenggara</th>
                                <th>Tahun/Angkatan</th>
                                <th>Lama Pendidikan</th>
                                <th>No. STPP</th>
                                <th>Tanggal STPP</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
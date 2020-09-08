<div class="header-content">
    <h2><i class="fa fa-reorder"></i>Data DUK</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Data DUK</a>
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
                        <h3 class="panel-title">Data DUK</h3>
                    </div>
                    <div class="pull-right">
                        <?php
                            if($user_active['fid_user_level'] == 5){
                        ?>
                            <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('pegawai/duk_form', 'contentModal', '');open_modal('', 'Tambah Data DUK', 'modal-primary');"><i class="fa fa-plus"></i></button>
                            </span>
                        <?php
                            } 
                        ?>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_duk" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2">Pegawai / NIP</th>
                                <th rowspan="2">No. Urut</th>
                                <th rowspan="2">Pangkat</th>
                                <th rowspan="2">Jabatan</th>
                                <th colspan="2" class="text-center" width="20%">Masa Kerja</th>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Tahun</th>
                            </tr>
                            <tr>
                                <th class="text-center">Tahun/Masa Kerja, Angkatan</th>
                                <th class="text-center">Bulan/Masa Kerja, Angkatan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-content">
    <h2><i class="fa fa-star"></i>Kenaikan Pangkat</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Kenaikan Pangkat</a>
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
                        <h3 class="panel-title">Data Kenaikan Pangkat</h3>
                    </div>
                    <div class="pull-right">
                        <?php
                            if($user_active['fid_user_level'] == 5){
                        ?>
                            <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('pegawai/naik_pangkat_form', 'contentModal', '');open_modal('', 'Tambah Data Kenaikan Pangkat', 'modal-primary');"><i class="fa fa-plus"></i></button>
                            </span>
                        <?php
                            } 
                        ?>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_naik_pangkat" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2">Pegawai</th>
                                <th colspan="2" class="text-center">Pangkat / Golongan</th>
                                <th rowspan="2">Tanggal PERTEK</th>
                                <th colspan="2" class="text-center">SK</th>
                                <th rowspan="2">#</th>
                            </tr>
                            <tr>
                                <th class="text-center">Lama</th>
                                <th class="text-center">Baru</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nomor</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
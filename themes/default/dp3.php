<div class="header-content">
    <h2><i class="fa fa-gavel"></i></i>Nilai DP-3</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="javascript:void(0);">Penilaian Pegawai</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Data Nilai DP-3</a>
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
                        <h3 class="panel-title">Data Nilai DP-3</h3>
                    </div>
                    <div class="pull-right">
                        <?php
                            if($user_active['fid_user_level'] == 1){
                        ?>
                            <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('pegawai/dp3_form', 'contentModal', '');open_modal('', 'Tambah Data Nilai DP-3', 'modal-primary');"><i class="fa fa-plus"></i></button>
                            </span>
                        <?php
                            } 
                        ?>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_dp3" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="25%">Pegawai / NIP</th>
                                <th>Tahun</th>
                                <th>Nilai Rata-Rata</th>
                                <th>Pejabat Penilai</th>
                                <th>Atasan Pejabat Penilai</th>
                                <th width="5%">#</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-content">
    <h2><i class="fa fa-money"></i>Data KGB</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Data KGB</a>
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
                        <h3 class="panel-title">Data KGB</h3>
                    </div>
                    <div class="pull-right">
                        <?php
                            if($user_active['fid_user_level'] == 5){
                        ?>
                            <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('pegawai/kgb_form', 'contentModal', '');open_modal('', 'Tambah Data KBG', 'modal-primary');"><i class="fa fa-plus"></i></button>
                            </span>
                        <?php
                            } 
                        ?>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <?php
                    if($user_active['fid_user_level'] == 5){
                ?>
                    <div class="panel-body">
                        <form id="form_genKGB" class="form-horizontal form-bordered" method="POST" action="<?=base_url();?>dashboard/generate_kgb" role="form">
                            <div class="form-group">
                                <label for="kgb_val" class="col-sm-4 control-label">GENERATE KGB</label>
                                <div class="col-sm-4">
                                    <select class="form-control input-sm" name="tahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-theme">Generate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                    }
                ?>
                
                <div class="panel-body">
                    <table id="table_kgb" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-class="expand">Pegawai</th>
                                <th data-hide="phone">Gaji Pokok Lama</th>
                                <th data-hide="phone">Gaji Pokok Baru</th>
                                <th data-hide="phone">Tanggal</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Pegawai</th>
                                <th>Gaji Pokok Lama</th>
                                <th>Gaji Pokok Baru</th>
                                <th>Tanggal</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-content">
    <h2><i class="fa fa-check-square-o"></i>Prilaku</h2>
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
                <a href="javascript:void(0);">Prilaku</a>
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
                        <h3 class="panel-title">Filter Pegawai</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body text-center">
                    <form class="form-inline submitFilter" action="<?=base_url();?>ekinerja/prilaku_verifikasi_filter" method="POST">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="sr-only">Tahun</label>
                                <input type="text" class="form-control" name="tahun" id="paramTahun" value="<?=date('Y');?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Unit Kerja</label>
                                <select class="form-control" name="unit_kerja" id="paramUnitKerja" style="width: 200px;" onchange="javascript:show_pegawai(this);">
                                    <option value="0">Pilih Unit Kerja</option>
                                <?php
                                    foreach ($unit_kerja as $value) {
                                        echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Pegawai</label>
                                <select class="form-control" name="pegawai" id="paramPegawai" style="width: 200px;">
                                    <option value="0">Pilih Pegawai</option>
                                </select>
                            </div>
                            <a class="btn btn-success btn-filter-prilaku" data-toggle="tooltip" data-placement="top" data-title="Filter"><i class="fa fa-search"></i></a>
                        </div>
                    </form>
                </div>
                <div class="panel-body" id="contentPanel">
                </div>
            </div>
        </div>
    </div>
</div>
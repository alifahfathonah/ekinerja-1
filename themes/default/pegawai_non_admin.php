<div class="header-content">
    <h2><i class="fa fa-group"></i>Data Pegawai</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=base_url();?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <i class="fa fa-group"></i>
                <a href="javascript:void(0);">Data Pegawai</a>
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
                        <h3 class="panel-title">Data Pegawai</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_pegawaiNonAdmin" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="25%" data-class="expand">NIP</th>
                                <th data-hide="phone">Nama</th>
                                <th width="25%" data-hide="phone">Jabatan</th>
                                <th data-hide="phone">Email</th>
                                <th data-hide="phone">Aktif</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Aktif</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function nipMasking () {
            $('#nipModal').inputmask({
                mask: '99999999 999999 9 999',
                definitions: {
                    A: {
                        validator: "[A-Za-z0-9 ]"
                    },
                },            
            });
        }
</script>
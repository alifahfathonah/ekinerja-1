<div class="header-content">
    <h2><i class="fa fa-sitemap"></i>Susunan Keluarga</h2>
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
                <a href="javascript:void(0);">Susunan Keluarga</a>
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
                        <h3 class="panel-title">Data Susunan Keluarga</h3>
                    </div>
                    <div class="pull-right">
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data">
                            <button class="btn btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('profil/keluarga_form', 'contentModal', '');open_modal('', 'Tambah Keluarga', 'modal-primary');"><i class="fa fa-plus"></i></button>
                        </span>
                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_keluarga" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th data-class="expand">Nama</th>
                                <th data-hide="phone">Tanggal Lahir</th>
                                <th data-hide="phone">No. Akte Kelahiran</th>
                                <th data-hide="phone">Status</th>
                                <th data-hide="phone">No. Surat Nikah (Istri/Suami)</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>No. Akte Kelahiran</th>
                                <th>Status</th>
                                <th>No. Surat Nikah (Istri/Suami)</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
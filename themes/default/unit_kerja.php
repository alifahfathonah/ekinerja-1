<div class="header-content">
    <h2><i class="fa fa-industry"></i>Satuan Kerja Perangkat Daerah</h2>
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
                <a href="javascript:void(0);">Satuan Kerja Perangkat Daerah</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated zoomInUp">
    <div class="row">
        <div class="col-md-12">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left" style='display:flex'>
                        <h3 class="panel-title" style="padding-right:30px">Satuan Kerja Perangkat Daerah</h3>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_data" onclick="javascript:callPages('master/skpd_form', 'contentModal', '');open_modal('', 'Tambah SKPD', 'modal-primary');">
                            <i class="fa fa-plus"> Tambah SKPD</i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="table_unitKerja" class="table table-primary table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Satuan Kerja Perangkat Daerah</th>
                                <th style="width:30px">#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Satuan Kerja Perangkat Daerah</th>
                                <th style="width:30px">#</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
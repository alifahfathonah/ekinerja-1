<div class="header-content">
    <h2><i class="fa fa-home"></i>Dashboard</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i>
                <a href="javascript:void(0);">Dashboard</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated fadeIn">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-primary rounded">
                <span class="mini-stat-icon"><i class="fa fa-users fg-primary"></i></span>
                <div class="mini-stat-info">
                    <span class="counter"><?=$this->global->count_data('pegawai');?></span>
                    TOTAL PEGAWAI
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-danger rounded">
                <span class="mini-stat-icon"><i class="fa fa-male fg-danger"></i></span>
                <div class="mini-stat-info">
                    <span class="counter"><?=$this->global->count_data('pegawai', array('gender'=>'L'));?></span>
                    PEGAWAI LAKI-LAKI
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-warning rounded">
                <span class="mini-stat-icon"><i class="fa fa-female fg-warning"></i></span>
                <div class="mini-stat-info">
                    <span class="counter"><?=$this->global->count_data('pegawai', array('gender'=>'P'));?></span>
                    PEGAWAI PEREMPUAN
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-success rounded" id="myPopOver">
                <span class="mini-stat-icon"><i class="fa fa-gift fg-success"></i></span>
                <div class="mini-stat-info">
                    <span class="counter"><?=$count_ultah;?></span>
                    PEGAWAI ULTAH
                </div>
            </div>
        </div>
        <!--
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-info rounded" id="myPopOverKGB">
                <span class="mini-stat-icon"><i class="fa fa-money fg-info"></i></span>
                <div class="mini-stat-info">
                    <span class="counter"><?=$count_kgb;?></span>
                    PEGAWAI KGB
                </div>
            </div>
        </div>
        -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <p class="lead">Your Profile <a class="btn btn-theme btn-sm btn-expand pull-right" href="<?=base_url();?>dashboard/cetak_pupns" target="_blank"><i class="fa fa-download"></i> Download PUPNS</a></p>
            <div class="panel panel-tab rounded shadow">
                <div class="panel-heading no-padding">
                    <ul class="nav nav-tabs">
                        <li class="active" data-toggle="tooltip" data-placement="top" data-original-title="Personal">
                            <a href="<?=base_url();?>dashboard/profil" data-target="personal" data-toggle="tab">
                                <i class="fa fa-user"></i>
                                <div class="text-center"><small>Personal</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Riwayat Kepangkatan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="riKepangkatan" data-toggle="tab">
                                <i class="fa fa-sort-amount-asc"></i>
                                <div class="text-center"><small>Kepangkatan</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Riwayat Jabatan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="riJabatan" data-toggle="tab">
                                <i class="fa fa-history"></i>
                                <div class="text-center"><small>Jabatan</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Riwayat Pendidikan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="riPendidikan" data-toggle="tab">
                                <i class="fa fa-graduation-cap"></i>
                                <div class="text-center"><small>Pendidikan</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Urut Kepangkatan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="duk" data-toggle="tab">
                                <i class="fa fa-reorder"></i>
                                <div class="text-center"><small>D U K</small></div>
                            </a>
                        </li>
                        <!--
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Penilaian">
                            <a href="<?=base_url();?>dashboard/profil" data-target="penilaian" data-toggle="tab">
                                <i class="fa fa-check-square-o"></i>
                                <div class="text-center"><small>Penilaian</small></div>
                            </a>
                        </li>
                        -->
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Disiplin">
                            <a href="<?=base_url();?>dashboard/profil" data-target="disiplin" data-toggle="tab">
                                <i class="fa fa-flag"></i>
                                <div class="text-center"><small>Disiplin</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Penghargaan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="penghargaan" data-toggle="tab">
                                <i class="fa fa-gift"></i>
                                <div class="text-center"><small>Penghargaan</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Riwayat Kesehatan">
                            <a href="<?=base_url();?>dashboard/profil" data-target="riKesehatan" data-toggle="tab">
                                <i class="fa fa-plus-circle"></i>
                                <div class="text-center"><small>Kesehatan</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Bahasa Asing">
                            <a href="<?=base_url();?>dashboard/profil" data-target="bhsAsing" data-toggle="tab">
                                <i class="fa fa-language"></i>
                                <div class="text-center"><small>Bhs. Asing</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Prestasi">
                            <a href="<?=base_url();?>dashboard/profil" data-target="prestasi" data-toggle="tab">
                                <i class="fa fa-thumbs-up"></i>
                                <div class="text-center"><small>Prestasi</small></div>
                            </a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" data-original-title="Susunan Keluarga">
                            <a href="<?=base_url();?>dashboard/profil" data-target="keluarga" data-toggle="tab">
                                <i class="fa fa-sitemap"></i>
                                <div class="text-center"><small>Keluarga</small></div>
                            </a>
                        </li>
                    </ul> 
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="contentData">
                            <h4>Personal</h4>
                            <table class="table table-bordered table-striped" style="clear: both">
                                <tbody>
                                <tr>
                                    <td width="20%" class="text-right">NIP</td>
                                    <td width="80%"><?=$find_data['nip'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Nama Panggilan</td>
                                    <td><?=$find_data['nama_panggilan'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Nama Lengkap</td>
                                    <td><?=$find_data['nama'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">TTL</td>
                                    <td><?=$find_data['tmp_lahir'].', '.$find_data['tgl_lahir'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Agama</td>
                                    <td><?php echo agama($find_data['agama']);?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Jenis Pegawai</td>
                                    <td><?php echo jenis_pegawai($find_data['jenis_pegawai']);?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Gender</td>
                                    <td><?=$find_data['gender'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Alamat</td>
                                    <td><?=$find_data['alamat'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Pangkat & Golongan</td>
                                    <td><?=pangkat_golongan($find_data['pangkat_golongan']);?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Jabatan</td>
                                    <td><?=show_row('jabatan',array('id'=>$find_data['fid_jabatan']),'nama');?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Instansi Kerja</td>
                                    <td><?=$find_data['instansi_kerja'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Unit Kerja</td>
                                    <td><?=show_row('unit_kerja',array('id'=>$find_data['unit_kerja']),'nama');?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">No. HP</td>
                                    <td><?=$find_data['no_hp'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">No. NPWP</td>
                                    <td><?=$find_data['npwp'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Tunjangan</td>
                                    <td>
                                    <?php
                                        if($find_data['tunjangan'] == NULL || $find_data['tunjangan'] == '')
                                            echo 'Tidak Menanggung';
                                        else
                                            echo $find_data['tunjangan'];
                                    ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                

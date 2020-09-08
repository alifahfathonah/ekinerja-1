<div class="header-content">
    <h2><i class="fa fa-home"></i>Dashboard</h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-check-square-o"></i>
                <a href="javascript:void(0);">Ekinerja</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active">
                <a href="javascript:void(0);">Dashboard</a>
            </li>
        </ol>
    </div>
</div>
<div class="body-content animated fadeIn">
    <h3 class="text-center">Jumlah Rupiah TPP Yang Diterima</h3>
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" action="#">
                <div class="form-body">
                    <div class="col-sm-3">&nbsp;</div>
                    <div class="form-group col-sm-3">
                        <label class="sr-only">Tahun</label>
                        <select data-placeholder="Pilih Tahun" class="form-control chosen-opt" tabindex="2" name="tahun" id="valTahun" onchange="javascript: hitung_tpp(this, 'thn');">
                        <?php
                            $tahun = explode("-", $thn_aktif);
                            for($i=$tahun[0]; $i<$tahun[1]+1; $i++){
                                if(date('Y') == $i)
                                    echo '<option value="'.$i.'" selected>Tahun '.$i.'</option>';
                                else
                                    echo '<option value="'.$i.'">Tahun '.$i.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="sr-only">Bulan</label>
                        <select data-placeholder="Pilih Bulan" class="form-control chosen-opt" name="bulan" id="valBulan" onchange="javascript: hitung_tpp(this, 'bln');">
                        <?php
                            foreach (bulan() as $key => $value) {
                                if(date('m') == $key)
                                    echo '<option value="'.$key.'" selected>Bulan '.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">Bulan '.$value.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;" id="row_tpp">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money"></i> Jumlah TPP Yang Diterima</h3>
                </div>
                <div class="panel-body text-primary" style="height: 100px;">
                    <div class="pull-left text-right">
                        <p class="h4 text-strong mb-5 mt-5" id="hitung1">0 x 0.00 %</p>
                        <p class="h4 text-strong mb-5 mt-5">Potongan Pajak (15 %)</p>
                        <p class="h4 text-strong mb-5 mt-5">Jumlah Yang Diterima</p>
                    </div>
                    <div class="text-left pull-right">
                        <p class="h4 text-strong mb-5 mt-5" id="hasil1">= 0</p>
                        <p class="h4 text-strong mb-5 mt-5" id="pajak">= 0</p>
                        <p class="h4 text-strong mb-5 mt-5" id="hasilHitung">= 0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-calendar-check-o"></i> Hasil Penilaian Prestasi Bulanan</h3>
                </div>
                <div class="panel-body text-warning text-center" style="height: 100px;">
                    <p class="h3 text-strong mb-10 mt-10" id="valPrestasi">0.00</p>
                    <p class="h4 text-strong" id="string_nilai">()</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-teal">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart"></i> Nilai Kinerja Tugas (Jabatan, Tambahan, Kreatifitas)</h3>
                </div>
                <div class="panel-body text-teal text-center" style="height: 100px;">
                    <p class="h3 text-strong mb-10 mt-10" id="valNKT">0.00</p>
                    <p class="h4 text-strong">(Maksimal 60.00)</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-lilac">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-check"></i> Nilai Prilaku Kerja</h3>
                </div>
                <div class="panel-body text-lilac text-center" style="height: 100px;">
                    <p class="h3 text-strong mb-10 mt-10" id="valNPK">0.00</p>
                    <p class="h4 text-strong">(Maksimal 40.00)</p>
                </div>
            </div>
        </div>
    </div>
</div>

                

<div class="panel-body animated fadeIn">
    <div class="row">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="text-right" width="30%">Nama Kegiatan</td>
                    <td class="text-danger"><?=show_row('ekin_keg_tahunan', array('id'=>$result['fid_keg_tahunan']),'kegiatan');?></td>
                </tr>
                <tr>
                    <td class="text-right">Periode</td>
                    <td class="text-danger"><?=bulan($result['bulan']);?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel-body no-padding animated fadeIn">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center">TARGET BULANAN</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="text-right">Kuantitas (<?=$result['satuan'];?>)</td>
                                <td class="text-info"><?=$result['kuantitas'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Biaya (Rp)</td>
                                <td class="text-info"><?=number_format($result['biaya'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Angka Kredit</td>
                                <td class="text-info"><?=$result['angka_kredit'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Waktu (<?=$result['periode_waktu'];?>)</td>
                                <td class="text-info"><?=$result['waktu'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">REALISASI</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="text-right">Kuantitas (<?=$result['satuan'];?>)</td>
                                <td class="text-info"><?=$find_data['kuantitas'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Kualitas (%)</td>
                                <td class="text-info"><?=$find_data['kualitas'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Biaya (Rp)</td>
                                <td class="text-info"><?=number_format($find_data['biaya'],0,",",".");?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Angka Kredit</td>
                                <td class="text-info"><?=$find_data['angka_kredit'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">Waktu (<?=$result['periode_waktu'];?>)</td>
                                <td class="text-info"><?=$find_data['waktu'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-warning">
                <div class="panel-heading text-center">HASIL</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td class="text-right">PERHITUNGAN</td>
                                <td class="text-warning"><?=$find_data['perhitungan'];?></td>
                            </tr>
                            <tr>
                                <td class="text-right">NILAI</td>
                                <td class="text-warning"><?=$find_data['nilai'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
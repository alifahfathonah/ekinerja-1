if ($('#row_tpp').length){
    var tahun = $('#valTahun').val();
    var bulan = $('#valBulan').val();
    $.ajax({
        dataType: 'json',
        url: url1818+'ekinerja/hitung_tpp',
        type: 'POST',
        data: {'tahun':tahun, 'bulan':bulan},
        beforeSend: function() {
            $('#row_tpp').showLoading();
        },
        success: function(result){
            if(result.output == 'success'){
                $('#row_tpp').hideLoading();
                $('#hitung1').html(result.hitung1);
                $('#hasil1').html(result.hasil1);
                $('#pajak').html(result.pajak);
                $('#hasilHitung').html(result.hasilHitung);
                $('#valPrestasi').html(result.valPrestasi);
                $('#string_nilai').html(result.string_nilai);
                $('#valNKT').html(result.valNKT);
                $('#valNPK').html(result.valNPK);
            }
        }
    });
}

function hitung_tpp(obj, act){
    var tahun, bulan;
    if(act == 'thn'){
        tahun = obj.options[obj.selectedIndex].value;
        bulan = $('#valBulan').val();
    } else{
        bulan = obj.options[obj.selectedIndex].value;
        tahun = $('#valTahun').val();
    }
    $.ajax({
        dataType: 'json',
        url: url1818+'ekinerja/hitung_tpp',
        type: 'POST',
        data: {'tahun':tahun, 'bulan':bulan},
        beforeSend: function() {
            $('#row_tpp').showLoading();
        },
        success: function(result){
            if(result.output == 'success'){
                $('#row_tpp').hideLoading();
                $('#hitung1').html(result.hitung1);
                $('#hasil1').html(result.hasil1);
                $('#pajak').html(result.pajak);
                $('#hasilHitung').html(result.hasilHitung);
                $('#valPrestasi').html(result.valPrestasi);
                $('#string_nilai').html(result.string_nilai);
                $('#valNKT').html(result.valNKT);
                $('#valNPK').html(result.valNPK);
            }
        }
    });
}

function tutup_modal(idx){
    $('#'+idx).modal('hide');
}

if($('.chosen-opt').length){
    $('.chosen-opt').chosen();
}

if($('.tgl_picker2').length){
    $('.tgl_picker2').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        autoclose: true
    });
}

if($('.tgl_picker_range').length){
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('.tgl_picker_range').val(start.format('YYYY-MM-DD') + ' s/d ' + end.format('YYYY-MM-DD'));
    }
    $('.tgl_picker_range').daterangepicker({
        autoUpdateInput: false,
        startDate: start,
        endDate: end,
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, cb);
    cb(start, end);
}

function filterKegiatan(obj){
    var fid_pegawai = obj.options[obj.selectedIndex].value;
    var tahun = $('#tahun').val();
    $.ajax({
        dataType: 'json',
        url: url1818+'pegawai/cari_pangkat_jabatan',
        type: 'POST',
        data: {'fid_pegawai':fid_pegawai, 'tahun':tahun},
        success: function(result){
            $('#fid_pangkat_lama').empty();
            $('#fid_pangkat_lama').html(result.pangkat);
            $('#fid_pangkat_lama').trigger("chosen:updated");
        }
    });
}

function editTableNilai(){
    function reload_(){
        var form_data = $('.submitFilter');
        $.ajax({
            type: $(form_data).attr('method'),
            url: $(form_data).attr('action'),
            data: $(form_data).serialize(),
            dataType: 'json',
            beforeSend: function() {
                document.getElementById('contentPanel').innerHTML = "<div class='alert alert-inverse text-center'><strong>Loading...</strong> Please wait.</div>";
            },
            success: function (response) {
                $('#contentPanel').html(response.html);
                $('.btn-filter-pgw').prop('disabled', false);
                editTableNilai();
            }
        });
    }

    var tahun = $('#paramTahun').val();
    var pegawai = $('#paramPegawai').val();
    $.fn.editable.defaults.url = url1818+'ekinerja/prilaku_bawahan_save';
    $.fn.editable.defaults.params = {thn:tahun, pgw:pegawai};
    var originalEditable = $.fn.editableutils.setCursorPosition;
    $.fn.editableutils.setCursorPosition = function() {
        try {
            originalEditable.apply(this, Array.prototype.slice.call(arguments));
        } catch (e) { /* noop */ }
    };

    $('ul .orpel').editable({
        //mode:'inline',
        type: 'text',
        name: 'orientasi',
        title: 'Nilai Orientasi Pelayanan',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('ul .integ').editable({
        type: 'text',
        name: 'integritas',
        title: 'Nilai Itegritas',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('ul .komit').editable({
        type: 'text',
        name: 'komitmen',
        title: 'Nilai Komitmen',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('ul .disip').editable({
        type: 'text',
        name: 'disiplin',
        title: 'Nilai Disiplin',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('ul .kersa').editable({
        type: 'text',
        name: 'kerja_sama',
        title: 'Nilai Kerja Sama',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('ul .kepe').editable({
        type: 'text',
        name: 'kepemimpinan',
        title: 'Nilai Kepemimpinan',
        validate: function(value) {
            if($.trim(value) == ''){
                return 'Nilai wajib diisi';
            }
            if($.isNumeric(value) == '') {
                return 'Inputan harus angka';
            }
            if($.trim(value) > 100){
                return 'Maksimal nilai 100';
            }
        },
        success: function(response){
            if(response == 1){
                reload_();
                showNoty('Success', 'success');
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
}


// SUBMIT AJAX MULTIPLE FOR DHIVAR
if($('.btn_cetak_hasil_penilaian').length){
    $('.submit_pdf').submit(function() { return false; });
    var form_id;
    $(".btn_cetak_hasil_penilaian").click(function(event) {
        $(this).prop('disabled', true);
        form_id = $(this).closest("form").attr('id');
        var form_data = $('#'+form_id);
        $.ajax({
            type: $(form_data).attr('method'),
            url: $(form_data).attr('action'),
            data: $(form_data).serialize(),
            dataType: 'json',
            success: function (response) {
                //alert(response.status);
                $(".btn_cetak_hasil_penilaian").prop('disabled', false);
                //window.open(url1818+'ekinerja/capaian_sasaran_kerja_tahunan', '_blank');
            }
        });
    });
}

if($('.btn-filter-pgw').length){
    $('.submitFilter').submit(function() { return false; });
    $('.btn-filter-pgw').click(function(event) {
        $(this).prop('disabled', true);
        var form_data = $('.submitFilter');
        $.ajax({
            type: $(form_data).attr('method'),
            url: $(form_data).attr('action'),
            data: $(form_data).serialize(),
            dataType: 'json',
            beforeSend: function() {
                document.getElementById('contentPanel').innerHTML = "<div class='alert alert-inverse text-center'><strong>Loading...</strong> Please wait.</div>";
            },
            success: function (response) {
                $('#contentPanel').html(response.html);
                $('.btn-filter-pgw').prop('disabled', false);
                editTableNilai();
            }
        });
    });
}

if($('.btn-filter-prilaku').length){
    $('.submitFilter').submit(function() { return false; });
    $('.btn-filter-prilaku').click(function(event) {
        $(this).prop('disabled', true);
        var form_data = $('.submitFilter');
        $.ajax({
            type: $(form_data).attr('method'),
            url: $(form_data).attr('action'),
            data: $(form_data).serialize(),
            dataType: 'json',
            beforeSend: function() {
                document.getElementById('contentPanel').innerHTML = "<div class='alert alert-inverse text-center'><strong>Loading...</strong> Please wait.</div>";
            },
            success: function (response) {
                $('#contentPanel').html(response.html);
                $('.btn-filter-prilaku').prop('disabled', false);
            }
        });
    });
}

function show_pegawai(obj){
    var unit_kerja = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'ekinerja/find_pegawai',
        type: 'POST',
        data: {'unit_kerja':unit_kerja},
        beforeSend: function() {
            $('#paramPegawai').showLoading();
        },
        success: function(result){
            $('#paramPegawai').hideLoading();
            $('#paramPegawai').html(result.html);
        }
    });
}

if($('#myPopOver').length){
    $('#myPopOver').mouseenter(function(){
        if($(this).data('popover') == null){
            $(this).popover({
                title:'Pegawai Yang Berulang Tahun <a class="btn btn-xs btn-danger close-ultah" style="float:right"><i class="fa fa-close"></i> close</a>',
                html: true,
                placement:'left', //bottom
                container: 'body',
                content: function() {
                    var content_id = "content-id-" + $.now();
                    $.ajax({
                        type: 'GET',
                        url: url1818+'dashboard/get_listUltah',
                        cache: false,
                    }).done(function(d){
                        $('#' + content_id).html(d);
                    });
                    return '<div id="' + content_id + '">Loading...</div>';
                },
                template: '<div class="popover" role="tooltip"><div class="arrow" style="display: none;"></div><h3 class="popover-title"></h3><div class="popover-content"><div class="data-content"></div></div></div>'
            });
        }
        $(this).data("bs.popover").tip().css("width", "450px");
        $(this).popover('show');
    });
    $('html').click(function(e) {
        $('#myPopOver').popover('hide');
    });
    /*
    $('#myPopOver').mouseleave(function(){
        $(this).popover('hide');
    });
    */

}

if($('#myPopOverKGB').length){
    $('#myPopOverKGB').mouseenter(function(){
        if($(this).data('popover') == null){
            $(this).popover({
                title:'Kenaikan Gaji Berkala',
                html: true,
                placement:'bottom',
                container: 'body',
                content: function() {
                    var content_id = "content-id-" + $.now();
                    $.ajax({
                        type: 'GET',
                        url: url1818+'dashboard/get_listKGB',
                        cache: false,
                    }).done(function(d){
                        $('#' + content_id).html(d);
                    });
                    return '<div id="' + content_id + '">Loading...</div>';
                }
            });
        }
        $(this).data("bs.popover").tip().css("width", "450px");
        $(this).popover('show');
    });
    $('#myPopOverKGB').mouseleave(function(){
        $(this).popover('hide');
    });
}

// ---- GRAFIK -----
if (document.getElementById('graf_jmlPegawai') != undefined){
    var jmlPegawai_opt = {
        chart: {
            renderTo: 'graf_jmlPegawai',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Jumlah Pegawai PNS dan Pegawai Kontrak/CPNS di Kabupaten Minahasa Selatan'
        },
        tooltip: {
            formatter: function() {
                return '<b>' + this.point.name + '</b>: ' + this.y+ ' Orang';
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter: function() {
                        return '<b>' + this.point.name + '</b>: ' + this.y;
                    }
                },
                showInLegend: true
            }
        },
        series: []
    };
    $.getJSON(url1818+"grafik/prosentase_pegawai", function(json) {
        jmlPegawai_opt.series = json;
        chart = new Highcharts.Chart(jmlPegawai_opt);
    });
}

if (document.getElementById('graf_duk') != undefined){
    var graf_duk_opt = {
        chart: {
            renderTo: 'graf_duk',
            type: 'line'
        },
        title: {
            text: 'Grafik Daftar Urut Kepangkatan',
            x: -20 //center
        },
        subtitle: {
            text: 'DUK',
            x: -20
        },
        xAxis: {
            categories: [],
            title: {
                text: 'Tahun'
            }
        },
        yAxis: {
            title: {
                text: 'Urutan Kepangkatan'
            },
            plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        scrollbar: {
            enabled: true
        },
        series: []
    };
    $.getJSON(url1818+"grafik/duk", function(json) {
        graf_duk_opt.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
        graf_duk_opt.series[0] = json[1];
        chart = new Highcharts.Chart(graf_duk_opt);
    });
}

if (document.getElementById('graf_kgb') != undefined){
    var graf_kgb_opt = {
        chart: {
            renderTo: 'graf_kgb',
            type: 'column'
        },
        title: {
            text: 'Grafik Data Kenaikan Gaji Berkala',
            x: -20 //center
        },
        subtitle: {
            text: 'Data KGB',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'M = Million & Million = Juta'
            },
            plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: Rp. <b>{point.y}</b><br/>'
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: 'Rp. {point.y}'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        series: []
    };
    $.getJSON(url1818+"grafik/kgb", function(json) {
        graf_kgb_opt.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
        graf_kgb_opt.series[0] = json[1];
        graf_kgb_opt.series[1] = json[2];
        chart = new Highcharts.Chart(graf_kgb_opt);
    });
}
// -- END GRAFIK ---


var responsiveHelperAjax = undefined;
var responsiveHelperAjax2 = undefined;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};

if (document.getElementById('table_skp') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#table_skp").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(5, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5"><h4><span class="label label-danger">Tahun : '+group+'</span></h4></td></tr>'
                );
                last = group;
              }
          });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {"url": url1818+"pegawai/skp_json", "type": "POST"},
        columns: [
          {"data": "pegawai"},
          {
            "data": "tahun",
            "class": "text-center"
          },
          {"data": "pejabat"},
          {"data": "atasan_pejabat"},
          {
            "data": "view",
            "orderable": false,
            "class": 'text-center'
          },
          {"data": "tahun"}
        ],
        columnDefs : [
            { 
                targets : [5],
                visible : false
            }
        ],
        order: [[1, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(5)', row).html(index);
        }
    });
    $('#table_skp tbody').on( 'click', 'tr.group', function () {
      var currentOrder = tableAjax.order()[0];
      if (currentOrder[0] === 5 && currentOrder[1] === 'asc') {
        tableAjax.order( [ 5, 'desc' ] ).draw();
      }
      else {
        tableAjax.order( [ 5, 'asc' ] ).draw();
      }
    });
}

if (document.getElementById('table_dp3') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#table_dp3").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(6, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="6"><h4><span class="label label-danger">Tahun : '+group+'</span></h4></td></tr>'
                );
                last = group;
              }
          });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {"url": url1818+"pegawai/dp3_json", "type": "POST"},
        columns: [
          {"data": "pegawai"},
          {
            "data": "tahun",
            "class": "text-center"
          },
          {
            "data": "nilai_avg",
            "class": "text-center"
          },
          {"data": "pejabat"},
          {"data": "atasan_pejabat"},
          {
            "data": "view",
            "orderable": false,
            "class": 'text-center'
          },
          {"data": "tahun"}
        ],
        columnDefs : [
            { 
                targets : [6],
                visible : false
            }
        ],
        order: [[1, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(6)', row).html(index);
        }
    });
    $('#table_dp3 tbody').on( 'click', 'tr.group', function () {
      var currentOrder = tableAjax.order()[0];
      if (currentOrder[0] === 6 && currentOrder[1] === 'asc') {
        tableAjax.order( [ 6, 'desc' ] ).draw();
      }
      else {
        tableAjax.order( [ 6, 'asc' ] ).draw();
      }
    });
}

if (document.getElementById('table_naik_pangkat') != undefined){
    var tableAjax = $('#table_naik_pangkat');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'pegawai/naik_pangkat_json',
        columnDefs : [
            {
                targets:6,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_kgb') != undefined){
    var tableAjax = $('#table_kgb');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'pegawai/kgb_json',
        columnDefs : [
            {
                targets:4,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });

    if($('#form_genKGB').length){
        $('#form_genKGB').validate({
            rules:{
                tahun: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 1){
                            showNoty('Berhasil Generate KGB', 'success');
                            $('#table_kgb').DataTable().ajax.reload();
                        } else{
                            showNoty('Data dasar tidak tersedia', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

}

if (document.getElementById('table_duk') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#table_duk").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(7, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="7"><h4><span class="label label-danger">Tahun : '+group+'</span></h4></td></tr>'
                );
                last = group;
              }
          });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {"url": url1818+"pegawai/duk_json", "type": "POST"},
        columns: [
          {"data": "pegawai"},
          {
            "data": "urutan_duk",
            "class": 'text-center'
          },
          {"data": "fid_pangkat_akhir"},
          {"data": "jabatan"},
          {
            "data": "thn_masakerja",
            "class": 'text-center'
          },
          {
            "data": "bln_masakerja",
            "class": 'text-center'
          },
          {
            "data": "view",
            "orderable": false,
            "class": 'text-center'
          },
          {"data": "tahun_duk"}
        ],
        columnDefs : [
            { 
                targets : [2],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Juru Muda (I/a)"; break;
                        case '2' : return "Juru Muda Tk.I (I/b)"; break;
                        case '3' : return "Juru (I/c)"; break;
                        case '4' : return "Juru Tk.I (I/d)"; break;
                        case '5' : return "Pengatur Muda (II/a)"; break;
                        case '6' : return "Pengatur Muda Tk.I (II/b)"; break;
                        case '7' : return "Pengatur (II/c)"; break;
                        case '8' : return "Pengatur Tk.I (II/d)"; break;
                        case '9' : return "Penata Muda (III/a)"; break;
                        case '10' : return "Penata Muda Tk. I (III/b)"; break;
                        case '11' : return "Penata (III/c)"; break;
                        case '12' : return "Penata Tk. I (III/d)"; break;
                        case '13' : return "Pembina (IV/a)"; break;
                        case '14' : return "Pembina Tk.I (IV/b)"; break;
                        case '15' : return "Pembina Utama Muda (IV/c)"; break;
                        case '16' : return "Pembina Utama Madya (IV/d)"; break;
                        case '17' : return "Pembina Utama (IV/e)"; break;
                        case '18' : return "TENAGA SUKARELA"; break;
                        case '19' : return "TENAGA KONTRAK"; break;
                        default  : return 'N/A';
                    }
                }
            },
            { 
                targets : [7],
                visible : false
            }
        ],
        order: [[1, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(7)', row).html(index);
        }
    });
    $('#table_duk tbody').on( 'click', 'tr.group', function () {
      var currentOrder = tableAjax.order()[0];
      if (currentOrder[0] === 7 && currentOrder[1] === 'asc') {
        tableAjax.order( [ 7, 'desc' ] ).draw();
      }
      else {
        tableAjax.order( [ 7, 'asc' ] ).draw();
      }
    });
}

if (document.getElementById('table_pegawaiAdmin') != undefined){
    var tableAjax = $('#table_pegawaiAdmin');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'pegawai/pegawai_json',
        columnDefs : [
            {
                targets:4,
                class:'text-center'
            },
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_pegawaiAdminDinas') != undefined){
    var tableAjax = $('#table_pegawaiAdminDinas');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'pegawai/pegawai_dinas_json',
        columnDefs : [
            {
                targets:4,
                class:'text-center'
            },
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_pegawaiNonAdmin') != undefined){
    var tableAjax = $('#table_pegawaiNonAdmin');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'pegawai/pegawai_non_json',
        columnDefs : [
            {
                targets:4,
                class:'text-center'
            },
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_riwayatPangkat') != undefined){
    var tableAjax = $('#table_riwayatPangkat');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/riwayat_kepangkatan_json',
        columnDefs : [
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_riwayatJabatan') != undefined){
    var tableAjax = $('#table_riwayatJabatan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/riwayat_jabatan_json',
        columnDefs : [
            {
                targets:7,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_riwayatPendidikan') != undefined){
    var tableAjax = $('#table_riwayatPendidikan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/riwayat_pendidikan_json',
        columnDefs : [
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_riwayatPelatihan') != undefined){
    var tableAjax = $('#table_riwayatPelatihan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/riwayat_diklat_json',
        columnDefs : [
            {
                targets:6,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax2) {
                responsiveHelperAjax2 = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax2.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax2.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_disiplin') != undefined){
    var tableAjax = $('#table_disiplin');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/disiplin_json',
        columnDefs : [
            {
                targets:3,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_penghargaan') != undefined){
    var tableAjax = $('#table_penghargaan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/penghargaan_json',
        columnDefs : [
            {
                targets:3,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_riwayatKesehatan') != undefined){
    var tableAjax = $('#table_riwayatKesehatan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/riwayat_kesehatan_json',
        columnDefs : [
            {
                targets:3,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_bahasa_asing') != undefined){
    var tableAjax = $('#table_bahasa_asing');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/bahasa_asing_json',
        columnDefs : [
            {
                targets:3,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_prestasi') != undefined){
    var tableAjax = $('#table_prestasi');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/prestasi_json',
        columnDefs : [
            {
                targets:3,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_keluarga') != undefined){
    var tableAjax = $('#table_keluarga');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'profil/keluarga_json',
        columnDefs : [
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

// ---------- MASTER ------------
if (document.getElementById('table_pejabat') != undefined){
    var tableAjax = $('#table_pejabat');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'master/pejabat_json',
        columnDefs : [
            {
                targets:5,
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_jabatan') != undefined){
    var tableAjax = $('#table_jabatan');
    tableAjax.dataTable({
        autoWidth      : false,
        ajax           : url1818+'master/jabatan_json',
        columnDefs : [
            {
                targets:[1,2,3,4,5],
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
}

if (document.getElementById('table_unitKerja') != undefined){
    var tableAjax = $('#table_unitKerja');
    tableAjax.dataTable({
        autoWidth      : true,
        ajax           : url1818+'master/unit_kerja_json',
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
        }
    });
}
// ------------------------------

$('a[data-toggle="tab"]').click(function(e){
    e.preventDefault();
    var loadurl = $(this).attr('href');
    var targ = $(this).attr('data-target');
    $.get(loadurl,{'target':targ}, function(data) {
        $('#contentData').html(data)
        //alert(targ);
    });
    $(this).tab('show')
});

$('#modal_profil').on('shown.bs.modal', function () {
    $('a[data-toggle="tab"]').click(function(e){
        e.preventDefault();
        var loadurl = $(this).attr('href');
        var targ = $(this).attr('data-target');
        var idx = $(this).attr('data-id');
        $.get(loadurl,{'target':targ, 'id_user':idx}, function(data) {
            $('#contentDataModal').html(data)
            //alert(targ);
        });
        $(this).tab('show')
    });
});

//--------------- VALIDATION ---------------//
$('#modal_data').on('shown.bs.modal', function () {

    $('a[data-toggle="tab"]').click(function(e){
        e.preventDefault();
        var loadurl = $(this).attr('href');
        var targ = $(this).attr('data-target');
        var idx = $(this).attr('data-id');
        $.get(loadurl,{'target':targ, 'id_user':idx}, function(data) {
            $('#contentDataModal').html(data)
            //alert(targ);
        });
        $(this).tab('show')
    });

    if($('.chosen-select').length){
        $('.chosen-select').chosen()
            .on('change', function() {
            $(this).valid();  
        });
    }
    if($('.tgl_picker').length){
        $('.tgl_picker').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: 'linked',
            autoclose: true
        }).on('change', function() {
            $(this).valid();  
        });
    }

    // ---------- MASTER ------------
    if (document.getElementById('form_pejabat') != undefined){
        $('#form_pejabat').validate({
            rules:{
                posisi: {
                    required: true
                },
                organisasi: {
                    required: true
                },
                nama: {
                    required: true
                },
                nip: {
                    required: true,
                    digits: true
                },
                aktif: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_pejabat').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_jabatan') != undefined){
        $('#form_jabatan').validate({
            rules:{
                nama: {
                    required: true
                },
                type: {
                    required: true
                },
                nilai: {
                    required: true,
                    digits:true,
                    maxlength:4
                },
                kelas: {
                    required: true,
                    digits:true,
                    maxlength:2
                },
                aktif: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_jabatan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }
    // ------------------------------

    if (document.getElementById('form_duk') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_duk').validate({
            rules:{
                fid_pegawai: {
                    required: true
                },
                fid_pangkat_akhir: {
                    required: true
                },
                fid_jabatan_akhir: {
                    required: true
                },
                thn_masakerja: {
                    required: true,
                    digits: true
                },
                bln_masakerja: {
                    required: true,
                    digits: true
                },
                tahun_duk: {
                    required: true,
                    digits: true,
                    minlength: 4
                },
                urutan_duk: {
                    required: true,
                    digits: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_duk').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_kgb') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_kgb').validate({
            rules:{
                fid_pegawai: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                gaji_lama: {
                    required: true
                },
                gaji_baru: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_kgb').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_naik_pangkat') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_naik_pangkat').validate({
            rules:{
                fid_pegawai: {
                    required: true
                },
                fid_pangkat_lama: {
                    required: true
                },
                fid_pangkat_baru: {
                    required: true
                },
                tgl_pertek: {
                    required: true
                },
                tgl_sk: {
                    required: true
                },
                no_sk: {
                    required: true
                },
                gaji_baru: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_naik_pangkat').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_dp3') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_dp3').validate({
            rules:{
                fid_pegawai: {
                    required: true
                },
                tahun: {
                    required: true,
                    digits: true,
                    maxlength: 4
                },
                nilai_orientasi: {
                    required: true,
                    number: true
                },
                nilai_integritas: {
                    required: true,
                    number: true
                },
                nilai_komitmen: {
                    required: true,
                    number: true
                },
                nilai_kerjasama: {
                    required: true,
                    number: true
                },
                nilai_kepemimpinan: {
                    required: true,
                    number: true
                },
                pejabat: {
                    required: true
                },
                atasan_pejabat: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'already'){
                            showNoty('Data DP3 pada tahun yang dipilih sudah tersedia untuk pegawai tersebut.', 'warning');
                        } else if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_dp3').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_skp') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_skp').validate({
            rules:{
                fid_pegawai: {
                    required: true
                },
                tahun: {
                    required: true,
                    digits: true,
                    maxlength: 4
                },
                pejabat: {
                    required: true
                },
                atasan_pejabat: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'already'){
                            showNoty('Data SKP pada tahun yang dipilih sudah tersedia untuk pegawai tersebut.', 'warning');
                        } else if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_skp').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('table_skp_detil') != undefined){
        var id_skp = document.getElementById('fid_skp').value;
        var tableAjax = $('#table_skp_detil');
        tableAjax.dataTable({
            autoWidth      : false,
            paging: false,
            ajax: {"url": url1818+"pegawai/skp_detil_json/"+id_skp, "type": "POST"},
            columnDefs : [
                {targets: [1,2,3,4,5,6,7,8,9,10,11,12], orderable:false, class:"text-center"},
                {targets: [0], orderable:false},
                {
                    targets : [13],
                    visible : false
                }
            ],
            order: [13, 'asc'],
            drawCallback   : function (oSettings) {
                var JenTugas = '';
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
                api.column(13, {page:'current'} ).data().each( function ( group, i ) {
                    if(group == 1){
                        JenTugas = 'Tugas Pokok Jabatan';
                    } else{
                        JenTugas = 'Tugas Tambahan dan Kreativitas'
                    }
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="13"><h5><span class="label label-danger">Jenis Tugas : '+JenTugas+'</span></h5></td></tr>'
                        );
                        last = group;
                    }
                });
                setSkpEditable();
            }
        });
    }
    if (document.getElementById('form_skp_detil') != undefined){
        $('#form_skp_detil').validate({
            rules:{
                jenis_tugas: {
                    required: true
                },
                tugas: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_skp_detil').DataTable().ajax.reload();
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }
    
    if (document.getElementById('ganti_foto') != undefined){
        var img_upload = $('#ganti_foto');
        $(img_upload).submit(function(event){
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(img_upload).attr('action'),
                data: new FormData(this), 
                contentType: false,
                cache: false,             
                processData:false, 
            }).success(function(data){
                if(data.flag==1){
                    showNoty('Berhasil menyimpan data.', 'success');
                    $('#modal_data').modal('hide');
                    window.location=url1818+'account';
                } else if(data.flag==2){
                    showNoty('Gagal update data.', 'error');
                    window.location=url1818+'account';
                } else if(data.flag=3){
                    showNoty(data.pesan, 'warning');
                } else{
                    showNoty(data.pesan, 'warning');
                }
            }).error(function(){
                showNoty('Terjadi Masalah, Silahkan Refresh Halaman!', 'error');
            });
        });
    }

    if (document.getElementById('form_user_pegawai') != undefined){
        $('#form_user_pegawai').validate({
            rules:{
                nip: {
                    required: true
                },
                nama_panggilan: {
                    required: true
                },
                nama: {
                    required: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                role: {
                    required: true
                },
                fid_jabatan: {
                    required: true
                },
                unit_kerja: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'already'){
                            showNoty('Username sudah tersedia.', 'info');
                        } else if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#modal_data').modal('hide');
                            if (document.getElementById('table_pegawaiAdmin') != undefined){
                                $('#table_pegawaiAdmin').DataTable().ajax.reload();
                            } else{
                                $('#table_pegawaiAdminDinas').DataTable().ajax.reload();
                            }
                            
                            //$('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_riwayat_pangkat') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        console.log($(form).serialize())
        $('#form_riwayat_pangkat').validate({
            rules:{
                tmt: {
                    required: true
                },
                no_sk: {
                    required: true
                },
                tgl_sk: {
                    required: true
                },
                pejabat_sah: {
                    required: true
                },
                file: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'already'){
                            showNoty('Pangkat / Golongan sudah tersedia.', 'warning');
                        } else if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_riwayatPangkat').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_riwayat_jabatan') != undefined){
        $.validator.setDefaults({ ignore: ":hidden:not(select)" });
        $('#form_riwayat_jabatan').validate({
            rules:{
                jabatan: {
                    required: true
                },
                unit_kerja: {
                    required: true
                },
                eselon: {
                    required: true
                },
                tmt: {
                    required: true
                },
                no_sk: {
                    required: true
                },
                tgl_sk: {
                    required: true
                },
                pejabat_sah: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_riwayatJabatan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_riwayat_pendidikan') != undefined){
        $('#form_riwayat_pendidikan').validate({
            rules:{
                nama_instansi: {
                    required: true
                },
                pimpinan_instansi: {
                    required: true
                },
                no_ijazah: {
                    required: true
                },
                tgl_ijazah: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'already'){
                            showNoty('Jenjang Pendidikan sudah tersedia.', 'warning');
                        } else if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_riwayatPendidikan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_riwayat_diklat') != undefined){
        $('#form_riwayat_diklat').validate({
            rules:{
                kategori: {
                    required: true
                },
                nama_diklat: {
                    required: true
                },
                penyelenggara: {
                    required: true
                },
                tahun: {
                    required: true
                },
                lama: {
                    required: true
                },
                no_sttp: {
                    required: true
                },
                tgl_sttp: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_riwayatPelatihan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_disiplin') != undefined){
        $('#form_disiplin').validate({
            rules:{
                tahun: {
                    required: true,
                    digits: true
                },
                tingkat: {
                    required: true
                },
                jenis: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_disiplin').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_penghargaan') != undefined){
        $('#form_penghargaan').validate({
            rules:{
                tahun: {
                    required: true,
                    digits: true
                },
                tingkat: {
                    required: true
                },
                nama: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_penghargaan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_riwayat_kesehatan') != undefined){
        $('#form_riwayat_kesehatan').validate({
            rules:{
                tahun: {
                    required: true,
                    digits: true
                },
                penyakit: {
                    required: true
                },
                dokter: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_riwayatKesehatan').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_bahasa_asing') != undefined){
        $('#form_bahasa_asing').validate({
            rules:{
                bahasa: {
                    required: true
                },
                aktif: {
                    required: true
                },
                pasif: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_bahasa_asing').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_prestasi') != undefined){
        $('#form_prestasi').validate({
            rules:{
                tahun: {
                    required: true,
                    digits: true
                },
                bidang: {
                    required: true
                },
                tingkat: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_prestasi').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

    if (document.getElementById('form_keluarga') != undefined){
        $('#form_keluarga').validate({
            rules:{
                nama: {
                    required: true
                },
                tgl_lahir: {
                    required: true
                },
                akte_lahir: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            highlight:function(element) {
                $(element).parents('.form-group').addClass('has-error has-feedback');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success'){
                            showNoty('Berhasil menyimpan data.', 'success');
                            $('#table_keluarga').DataTable().ajax.reload();
                            $('#modal_data').modal('hide');
                        } else{
                            showNoty('Gagal menyimpan data.', 'error');
                        }
                    }
                });
                return false;
            }
        });
    }

});

if (document.getElementById('form_personal') != undefined){
    $('.tgl_picker').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        autoclose: true
    }).on('change', function() {
        $(this).valid();  
    });
    $('#form_personal').validate({
        rules:{
            nip: {
                required: true
            },
            nama_panggilan: {
                required: true
            },
            nama: {
                required: true
            },
            tmp_lahir: {
                required: true
            },
            tgl_lahir: {
                required: true
            },
            gender: {
                required: true
            },
            alamat: {
                required: true
            },
            instansi_kerja: {
                required: true
            },
            unit_kerja: {
                required: true
            },
            no_hp: {
                required: true,
                number: true,
                maxlength: 12
            },
            npwp: {
                required: true
            }
        },
        highlight:function(element) {
            $(element).parents('.form-group').addClass('has-error has-feedback');
        },
        unhighlight: function(element) {
            $(element).parents('.form-group').removeClass('has-error');
        },
        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success'){
                        showNoty('Berhasil menyimpan data.', 'success');
                    } else{
                        showNoty('Gagal menyimpan data.', 'error');
                    }
                }
            });
            return false;
        }
    });
}

if (document.getElementById('form_ganti_pass') != undefined){
    $('#form_ganti_pass').validate({
        rules:{
            pass_lama: {
                required: true
            },
            pass_baru: {
                required: true
            },
            pass_baru2: {
                required: true
            }
        },
        highlight:function(element) {
            $(element).parents('.form-group').addClass('has-error has-feedback');
        },
        unhighlight: function(element) {
            $(element).parents('.form-group').removeClass('has-error');
        },
        submitHandler: function(form) {
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success'){
                        showNoty('Berhasil mengubah password.', 'success');
                        form.reset();
                    } else if(response.status == 'not_same'){
                        showNoty('Password lama tidak sesuai.', 'warning');
                    } else if(response.status == 'not_same2'){
                        showNoty('Password baru tidak sama dengan konfirmasi password baru.', 'warning');
                    } else{
                        showNoty('Gagal mengubah password.', 'error');
                    }
                }
            });
            return false;
        }
    });
}

// E-KINERJA
if (document.getElementById('ekin_kegTahunan') != undefined){
    var tableAjax = $('#ekin_kegTahunan');
    tableAjax.dataTable({
        autoWidth      : false,
        "ajax": {
            "url": url1818+'ekinerja/keg_tahunan_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_tahunan').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columnDefs : [
            {
                targets:[1,2,3,5],
                class:'text-center'
            },
            {
                targets:[4,5,6],
                orderable:false,
                class:'text-center'
            },
            {
                targets : [5],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<span class="label label-primary">Verifikasi</span>'; break;
                        case 'Diterima' : return '<span class="label label-success">Diterima</span>'; break;
                        case 'Ditolak' : return '<span class="label label-warning">Ditolak</span>'; break;
                    }
                }
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
    $('#ekin_kegTahunan tbody').on('click', 'td button.BreakDown', function () {
        var tr = $(this).closest('tr');
        var row = tableAjax.api().row(tr);
        var idx = $(this).attr('data-id');
        if ( row.child.isShown() ) {
            // This row is already open
            row.child.hide();
            $(this).find("i.fa").removeClass('fa-minus-square').addClass('fa-plus-square');
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(breakdown_kegiatan(idx)).show();
            $(this).find("i.fa").removeClass('fa-plus-square').addClass('fa-minus-square');
            tr.addClass('shown');
        }
    });
}

if (document.getElementById('ekin_kegBulanan') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#ekin_kegBulanan").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              var allColumn = this.row(i).data();
              var string_label;              
              switch(allColumn.status_thn) {
                case 'Draft' : string_label='<span class="label label-danger">Draft</span>'; break;
                case 'Penilaian' : string_label='<span class="label label-info">Penilaian</span>'; break;
                case 'Verifikasi' : string_label='<span class="label label-primary">Verifikasi</span>'; break;
                case 'Diterima' : string_label='<span class="label label-success">Diterima</span>'; break;
                case 'Ditolak' : string_label='<span class="label label-warning">Ditolak</span>'; break;
              }
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="7"><strong>Keg. Tahunan :</strong> '+group+' '+string_label+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/keg_bulanan_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_bulanan').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"1%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "bulan"},
          {"data": "keg_thn"},
          {"data": "waktu", "class": "text-center", "orderable": false},
          {"data": "kuantitas", "class": "text-center", "orderable": false},
          {"data": "nilai", "class": "text-center", "orderable": false},
          {"data": "status", "class": "text-center", "orderable": false},
          {"data": "view", "class": "text-center", "orderable": false},
          {"data": "status_thn"}
        ],
        columnDefs : [
            { 
                targets : [2,8],
                visible : false
            },
            { 
                targets : [1],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [6],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<span class="label label-primary">Verifikasi</span>'; break;
                        case 'Diterima' : return '<span class="label label-success">Diterima</span>'; break;
                        case 'Ditolak' : return '<span class="label label-warning">Ditolak</span>'; break;
                    }
                }
            }
        ],
        orderFixed: [2, 'asc'],
        order: [[1, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

if (document.getElementById('ekin_tambkrea') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#ekin_tambkrea").DataTable({
        "autoWidth": false,
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(1, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="5"><strong>Jenis :</strong> '+group+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/tgs_tambkrea_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_tugas_tambkrea').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"2%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "jenis"},
          {"data": "bulan", "width":"15%"},
          {"data": "kegiatan"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "view", "class": "text-center", "orderable": false , "width":"15%"}
        ],
        columnDefs : [
            { 
                targets : [1],
                visible : false
            },
            { 
                targets : [2],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [4],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<span class="label label-primary">Verifikasi</span>'; break;
                        case 'Diterima' : return '<span class="label label-success">Diterima</span>'; break;
                        case 'Ditolak' : return '<span class="label label-warning">Ditolak</span>'; break;
                    }
                }
            }
        ],
        orderFixed: [1, 'asc'],
        order: [[2, 'asc'], [3, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

if (document.getElementById('ekin_kegTahunanVerify') != undefined){
    var tableAjax = $('#ekin_kegTahunanVerify');
    tableAjax.dataTable({
        autoWidth      : false,
        "ajax": {
            "url": url1818+'ekinerja/target_tahunan_pgw_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_tahunan').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columnDefs : [
            {
                targets:[1,2,3,4,5],
                orderable:false,
                class:'text-center'
            }
        ],
        preDrawCallback: function () {
            if (!responsiveHelperAjax) {
                responsiveHelperAjax = new ResponsiveDatatablesHelper(tableAjax, breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperAjax.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperAjax.respond();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        }
    });
    $('#ekin_kegTahunanVerify tbody').on('click', 'td button.BreakDown', function () {
        var tr = $(this).closest('tr');
        var row = tableAjax.api().row(tr);
        var idx = $(this).attr('data-id');
        if ( row.child.isShown() ) {
            // This row is already open
            row.child.hide();
            $(this).find("i.fa").removeClass('fa-minus-square').addClass('fa-plus-square');
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(breakdown_bawahan(idx)).show();
            $(this).find("i.fa").removeClass('fa-plus-square').addClass('fa-minus-square');
            tr.addClass('shown');
        }
    });
}

if (document.getElementById('ekin_kegBulananVerify') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#ekin_kegBulananVerify").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              var allColumn = this.row(i).data();
              var string_label;              
              switch(allColumn.status_thn) {
                case 'Draft' : string_label='<span class="label label-danger">Draft</span>'; break;
                case 'Penilaian' : string_label='<span class="label label-info">Penilaian</span>'; break;
                case 'Verifikasi' : string_label='<span class="label label-primary">Verifikasi</span>'; break;
                case 'Diterima' : string_label='<span class="label label-success">Diterima</span>'; break;
                case 'Ditolak' : string_label='<span class="label label-warning">Ditolak</span>'; break;
              }
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="7"><strong>Keg. Tahunan :</strong> '+group+' '+string_label+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/keg_bulanan_pgw_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_bulanan').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"1%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "bulan", "width":"15%"},
          {"data": "keg_thn"},
          {"data": "waktu", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "kuantitas", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "nilai", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "view", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "status_thn"},
          {"data": "id"}
        ],
        columnDefs : [
            { 
                targets : [2,8,9],
                visible : false
            },
            { 
                targets : [1],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [7],
                render : function (data, type, full, meta) {
                    var id_row = full.id;
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima untuk Diverifikasi" onclick=\'javascript:send_virify("keg_bulanan_bwh",'+id_row+',"Verifikasi","Penilaian","Verifikasi","ekin_kegBulananVerify");\'><i class="fa fa-check"></i></button>'+
                        '&nbsp;<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("keg_bulanan_bwh",'+id_row+',"Ditolak","Penilaian","Ditolak","ekin_kegBulananVerify");\'><i class="fa fa-close"></i></button>'; break;
                        case 'Verifikasi' : return '<span class="label label-primary">Verifikasi</span>'; break;
                        case 'Diterima' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>'; break;
                        case 'Ditolak' : return '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>'; break;
                    }
                }
            }
        ],
        orderFixed: [2, 'asc'],
        order: [[1, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

if (document.getElementById('ekin_tamkreVerify') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#ekin_tamkreVerify").DataTable({
        "autoWidth": false,
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(1, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="5"><strong>Jenis :</strong> '+group+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/tugas_pgw_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_tamkrea').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"2%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "jenis"},
          {"data": "bulan", "width":"15%"},
          {"data": "kegiatan"},
          {"data": "view", "class": "text-center", "orderable": false , "width":"15%"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "id"}
        ],
        columnDefs : [
            { 
                targets : [1,6],
                visible : false
            },
            { 
                targets : [2],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [5],
                render : function (data, type, full, meta) {
                    var id_row = full.id;
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima untuk Diverifikasi" onclick=\'javascript:send_virify("tamker_bwh",'+id_row+',"Verifikasi","Penilaian","Verifikasi","ekin_tamkreVerify");\'><i class="fa fa-check"></i></button>'+
                        '&nbsp;<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("tamker_bwh",'+id_row+',"Ditolak","Penilaian","Ditolak","ekin_tamkreVerify");\'><i class="fa fa-close"></i></button>'; break;
                        case 'Verifikasi' : return '<span class="label label-primary">Verifikasi</span>'; break;
                        case 'Diterima' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>'; break;
                        case 'Ditolak' : return '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>'; break;
                    }
                }
            }
        ],
        orderFixed: [1, 'asc'],
        order: [[2, 'asc'], [3, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

if (document.getElementById('verifikasi_kegTahunan') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#verifikasi_kegTahunan").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              var allColumn = this.row(i).data();
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="7"><strong>Pegawai :</strong> <font class="text-danger">'+group+'</font> ('+allColumn.nip+')</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/target_tahunan_verifikasi_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_tahunan_verifikasi').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"1%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "kegiatan"},
          {"data": "nama"},
          {"data": "target_kuantitas", "class": "text-center", "orderable": false, "width":"14%"},
          {"data": "biaya", "class": "text-center", "orderable": false},
          {"data": "angka_kredit", "class": "text-center", "orderable": false, "width":"12%"},
          {"data": "breakDown", "class": "text-center", "orderable": false, "width":"5%"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "nip"},
          {"data": "id"}
        ],
        columnDefs : [
            { 
                targets : [2,8,9],
                visible : false
            },
            {
                targets : [7],
                render : function (data, type, full, meta) {
                    var id_row = full.id;
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima" onclick=\'javascript:send_virify("keg_tahunan_verify",'+id_row+',"Diterima","Verifikasi","Diterima","verifikasi_kegTahunan");\'><i class="fa fa-check"></i></button>'+
                        '&nbsp;<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("keg_tahunan_verify",'+id_row+',"Ditolak","Verifikasi","Ditolak","verifikasi_kegTahunan");\'><i class="fa fa-close"></i></button>'; break;
                        case 'Diterima' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>'; break;
                        case 'Ditolak' : return '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>'; break;
                    }
                }
            }
        ],
        orderFixed: [2, 'asc'],
        order: [[1, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
    $('#verifikasi_kegTahunan tbody').on('click', 'td button.BreakDown', function () {
        var tr = $(this).closest('tr');
        var row = tableAjax.row(tr);
        var idx = $(this).attr('data-id');
        if ( row.child.isShown() ) {
            row.child.hide();
            $(this).find("i.fa").removeClass('fa-minus-square').addClass('fa-plus-square');
            tr.removeClass('shown');
        }
        else {
            row.child(breakdown_bawahan(idx)).show();
            $(this).find("i.fa").removeClass('fa-plus-square').addClass('fa-minus-square');
            tr.addClass('shown');
        }
    });

}

if (document.getElementById('verifikasi_kegBulanan') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#verifikasi_kegBulanan").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              var allColumn = this.row(i).data();
              var string_label;              
              switch(allColumn.status_thn) {
                case 'Draft' : string_label='<span class="label label-danger">Draft</span>'; break;
                case 'Penilaian' : string_label='<span class="label label-info">Penilaian</span>'; break;
                case 'Verifikasi' : string_label='<span class="label label-primary">Verifikasi</span>'; break;
                case 'Diterima' : string_label='<span class="label label-success">Diterima</span>'; break;
                case 'Ditolak' : string_label='<span class="label label-warning">Ditolak</span>'; break;
              }
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="7"><strong>Pegawai :</strong> <font class="text-danger">'+allColumn.nama+'</font> ('+allColumn.nip+')<br><strong>Keg. Tahunan :</strong> '+group+' '+string_label+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/target_bulanan_verifikasi_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_keg_bulanan').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"1%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "bulan", "width":"15%"},
          {"data": "keg_thn"},
          {"data": "waktu", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "kuantitas", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "nilai", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "view", "class": "text-center", "orderable": false, "width":"10%"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "status_thn"},
          {"data": "id"},
          {"data": "nama"},
          {"data": "nip"}
        ],
        columnDefs : [
            { 
                targets : [2,8,9,10,11],
                visible : false
            },
            { 
                targets : [1],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [7],
                render : function (data, type, full, meta) {
                    var id_row = full.id;
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima" onclick=\'javascript:send_virify("keg_bulanan_verify",'+id_row+',"Diterima","Verifikasi","Diterima","verifikasi_kegBulanan");\'><i class="fa fa-check"></i></button>'+
                        '&nbsp;<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("keg_bulanan_verify",'+id_row+',"Ditolak","Verifikasi","Ditolak","verifikasi_kegBulanan");\'><i class="fa fa-close"></i></button>'; break;
                        case 'Diterima' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>'; break;
                        case 'Ditolak' : return '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>'; break;
                    }
                }
            }
        ],
        orderFixed: [2, 'asc'],
        order: [[11, 'asc'],[1, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

if (document.getElementById('verifikasi_tugasTamkrea') != undefined){
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    var tableAjax = $("#verifikasi_tugasTamkrea").DataTable({
        "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(1, {page:'current'} ).data().each( function ( group, i ) {
              var allColumn = this.row(i).data();
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group success"><td colspan="5"><strong>Pegawai :</strong> <font class="text-danger">'+allColumn.nama+'</font> ('+allColumn.nip+')<br><strong>Jenis :</strong> '+group+'</td></tr>'
                );
                last = group;
              }
          });
          $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        },
        processing: true,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url": url1818+'ekinerja/tugas_verifikasi_json',
            "type": 'POST',
            "data": function(d) {
               var frm_data = $('#filter_tamkrea').serializeArray();
               $.each(frm_data, function(key, val) {
                 d[val.name] = val.value;
               });
            }
        },
        columns: [
          {
            "data": null,
            "render" : function ( data, type, full, meta ) {
                return '<i class="fa fa-long-arrow-right"></i>';
            },
            "orderable": false,
            "width":"2%",
            "class": "text-center",
            "searchable": false
          },
          {"data": "jenis"},
          {"data": "bulan", "width":"15%"},
          {"data": "kegiatan"},
          {"data": "view", "class": "text-center", "orderable": false , "width":"15%"},
          {"data": "status", "class": "text-center", "orderable": false, "width":"15%"},
          {"data": "id"},
          {"data": "nama"},
          {"data": "nip"}
        ],
        columnDefs : [
            { 
                targets : [1,6,7,8],
                visible : false
            },
            { 
                targets : [2],
                render : function (data, type, full, meta) {
                    switch(data) {
                        case '1' : return "Januari"; break;
                        case '2' : return "Februari"; break;
                        case '3' : return "Maret"; break;
                        case '4' : return "April"; break;
                        case '5' : return "Mei"; break;
                        case '6' : return "Juni"; break;
                        case '7' : return "Juli"; break;
                        case '8' : return "Agustus"; break;
                        case '9' : return "September"; break;
                        case '10' : return "Oktober"; break;
                        case '11' : return "November"; break;
                        case '12' : return "Desember"; break;
                        default  : return 'N/A';
                    }
                }
            },
            {
                targets : [5],
                render : function (data, type, full, meta) {
                    var id_row = full.id;
                    switch(data) {
                        case 'Draft' : return '<span class="label label-danger">Draft</span>'; break;
                        case 'Penilaian' : return '<span class="label label-info">Penilaian</span>'; break;
                        case 'Verifikasi' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Terima" onclick=\'javascript:send_virify("tamker_verify",'+id_row+',"Diterima","Verifikasi","Diterima","verifikasi_tugasTamkrea");\'><i class="fa fa-check"></i></button>'+
                        '&nbsp;<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Tolak" onclick=\'javascript:send_virify("tamker_verify",'+id_row+',"Ditolak","Verifikasi","Ditolak","verifikasi_tugasTamkrea");\'><i class="fa fa-close"></i></button>'; break;
                        case 'Diterima' : return '<button class="btn btn-circle btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Diterima"><i class="fa fa-check"></i></button>'; break;
                        case 'Ditolak' : return '<button class="btn btn-circle btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Ditolak"><i class="fa fa-close"></i></button>'; break;
                    }
                }
            }
        ],
        orderFixed: [1, 'asc'],
        order: [[2, 'asc'], [3, 'asc']],
        language: {
            processing: '<img src="'+url1818+'themes/default/assets/img/processing.gif" alt="Loading..." width="auto" />'
        }
    });
}

function send_virify(typ,idx,stat,action,result,table=null){
    $.ajax({
        type: 'POST',
        url: url1818+'ekinerja/post_status_kegiatan',
        data: {type:typ, id_kegiatan:idx, status:stat, aksi:action, hasil:result},
        dataType: 'json',
        beforeSend: function() {
            $('.body-content').showLoading();
        },
        success: function (response) {
            if(response.status == 'success'){
                $('.body-content').hideLoading();
                showNoty(response.pesan, 'success');
                if(table !== null){
                    filterSelected(table);
                }
            } else{
                $('.body-content').hideLoading();
                showNoty('Terjadi masalah.', 'error');
            }
        }
    });
}

function verify_prilaku(typ,idx,stat,action,result){
    function reload_(){
        var form_data = $('.submitFilter');
        $.ajax({
            type: $(form_data).attr('method'),
            url: $(form_data).attr('action'),
            data: $(form_data).serialize(),
            dataType: 'json',
            beforeSend: function() {
                document.getElementById('contentPanel').innerHTML = "<div class='alert alert-inverse text-center'><strong>Loading...</strong> Please wait.</div>";
            },
            success: function (response) {
                $('#contentPanel').html(response.html);
                //$('.btn-filter-pgw').prop('disabled', false);
                //editTableNilai();
            }
        });
    }

    $.ajax({
        type: 'POST',
        url: url1818+'ekinerja/post_status_prilaku',
        data: {id_prilaku:idx, status:stat, aksi:action, hasil:result},
        dataType: 'json',
        beforeSend: function() {
            $('#contentPanel').showLoading();
        },
        success: function (response) {
            if(response.status == 'success'){
                $('#contentPanel').hideLoading();
                showNoty(response.pesan, 'success');
                reload_();
            } else{
                $('#contentPanel').hideLoading();
                showNoty('Terjadi masalah.', 'error');
            }
        }
    });
}

function penilaian_kreatifitas(obj, idx){
    var val_kreatifitas = obj.options[obj.selectedIndex].value;
    $.ajax({
        type: 'POST',
        url: url1818+'ekinerja/penilaian_kreatifitas',
        data: {id:idx, nilai:val_kreatifitas},
        dataType: 'json',
        beforeSend: function() {
            $('#contentModal').showLoading();
        },
        success: function (response) {
            if(response.status == 'success'){
                $('#contentModal').hideLoading();
                showNoty(response.pesan, 'success');
                filterSelected('ekin_tamkreVerify');
                $('#modal_data').modal('hide');
            } else{
                $('#contentModal').hideLoading();
                showNoty(response.pesan, 'error');
            }
        }
    });
}

// --------------- END E-KINERJA


function breakdown_kegiatan(idx) {
    var div = $('<div/>')
        .addClass( 'loading' )
        .text( 'Loading...' );
    $.ajax({
        dataType: 'json',
        url: url1818+'ekinerja/keg_tahunan_breakdown',
        type: 'POST',
        data: {'idx':idx},
        success: function(result){
            div.html(result.html).removeClass('loading');
        }
    });
    return div;
}

function breakdown_bawahan(idx) {
    var div = $('<div/>')
        .addClass( 'loading' )
        .text( 'Loading...' );
    $.ajax({
        dataType: 'json',
        url: url1818+'ekinerja/keg_tahunan_breakdown_bwh',
        type: 'POST',
        data: {'idx':idx},
        success: function(result){
            div.html(result.html).removeClass('loading');
        }
    });
    return div;
}

function setSkpEditable(){
    // EDITABLE
    $.fn.editable.defaults.url = url1818+'pegawai/skp_detil_save';
    var originalEditable = $.fn.editableutils.setCursorPosition;
    $.fn.editableutils.setCursorPosition = function() {
        try {
            originalEditable.apply(this, Array.prototype.slice.call(arguments));
        } catch (e) { /* noop */ }
    };
    $('tbody .ak1').editable({
        mode:'inline',
        type: 'text',
        name: 'ak1',
        title: 'Input AK',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .tar_kuant').editable({
        mode:'inline',
        type: 'text',
        name: 'tar_kuant',
        title: 'Input Target Kuant/ Output',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .tar_kual').editable({
        mode:'inline',
        type: 'number',
        name: 'tar_kual',
        title: 'Input Target Kual/ Mutu',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .tar_bln').editable({
        mode:'inline',
        type: 'number',
        name: 'tar_bln',
        title: 'Input Target Waktu (Bln)',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .tar_biaya').editable({
        mode:'inline',
        type: 'text',
        name: 'tar_biaya',
        title: 'Input Target Biaya',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .ak2').editable({
        mode:'inline',
        type: 'text',
        name: 'ak2',
        title: 'Input AK',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .rea_kuant').editable({
        mode:'inline',
        type: 'text',
        name: 'rea_kuant',
        title: 'Input Realisasi Kuant/ Output',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .rea_kual').editable({
        mode:'inline',
        type: 'number',
        pk: 1,
        name: 'rea_kual',
        title: 'Input Realisasi Kual/ Mutu',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .rea_bln').editable({
        mode:'inline',
        type: 'number',
        name: 'rea_bln',
        title: 'Input Realisasi Waktu (Bln)',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .rea_biaya').editable({
        mode:'inline',
        type: 'text',
        name: 'rea_biaya',
        title: 'Input Realisasi Biaya',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
    $('tbody .nilai').editable({
        mode:'inline',
        type: 'text',
        name: 'nilai',
        title: 'Input Nilai',
        success: function(response){
            if(response == 1){
                showNoty('Success', 'success');
                $('#table_skp_detil').DataTable().ajax.reload();
            } else{
                showNoty('Terjadi Masalah', 'error');
                return false;
            }
        }
    });
}


function browser(){
  if (window.ActiveXObject){
    return new ActiveXOject("Microsoft.XMLHTTP");
  }
  if (window.XMLHttpRequest){
    return new XMLHttpRequest();
  }
}

function setAktifAlert(){
  $(".alert").click(function(){
    $(this).fadeOut(300, function(){            
      $(this).remove();            
    });
  });
}

function setSubmitModal(){
  document.getElementById("submitModal").innerHTML = "<div class='alert alert-warning text-center'><strong>form submit....</strong></div>";
  $("html, body").animate({ scrollTop: 0 }, "fast");
  setAktifAlert();
}

function setSubmit(){
  document.getElementById("submitPanel").innerHTML = "<div class='alert alert-inverse text-center'><strong>Loading...</strong> Please wait.</div>";
  $("html, body").animate({ scrollTop: 0 }, "fast");
  setAktifAlert();
}


function callPages(url,result,data){
    document.getElementById(result).innerHTML = "please wait....";
    var http = browser();
    var content = "application/x-www-form-urlencoded";
    http.open("POST",url1818+url,true);
    http.setRequestHeader("content-type",content);
    http.onreadystatechange = function(){
        if ((http.readyState==4)&&(http.status=200)){
            document.getElementById(result).innerHTML = http.responseText;
        } else{
            //document.getElementById(result).innerHTML = "<div class='alert bg-orange text-center'>please wait....</div>";
        }
    }
    http.send(data);
}

function open_modal($size='', $title='', $color=''){
    $('#modal_data').removeData();
    $('#sizeModal').addClass($size);
    $('#modal_data').addClass($color);
    document.getElementById('titleModal').innerHTML = $title;
}

function showNoty($text, $type){
    window.anim = {};
    window.anim.open = 'flipInX';
    window.anim.close = 'flipOutX';

    noty({
        text        : $text,
        type        : $type,
        theme       : 'relax',
        dismissQueue: true,
        layout      : 'top',
        timeout     : 2500,
        animation   : {
            open  : 'animated ' + window.anim.open,
            close : 'animated ' + window.anim.close
        }
    });
    return false;
}

function updateBySelect(obj, table, field, id){
    var value = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'jadwal/update_row',
        type: 'POST',
        data: {'table':table, 'field':field, 'value':value, 'id':id},
        success: function(result){
            if(result.status == 'success'){
                showNoty('Success Update.', 'success');
            } else{
                showNoty('Terjadi Masalah.', 'error');
            }
        }
    });
}

function prosesStatusKegiatan(obj, table, field, id){
    $.ajax({
        dataType: 'json',
        url: url1818+'jadwal/update_row',
        type: 'POST',
        data: {'table':table, 'field':field, 'value':value, 'id':id},
        success: function(result){
            if(result.status == 'success'){
                showNoty('Success Update.', 'success');
            } else{
                showNoty('Terjadi Masalah.', 'error');
            }
        }
    });
}

function filterSelected($tabelID){
    $('#'+$tabelID).DataTable().ajax.reload();
    $('#'+$tabelID).DataTable().draw();
}

function hapusData($table, $id, $refresh_table){
    window.anim = {};
    window.anim.open = 'flipInX';
    window.anim.close = 'flipOutX';
    noty({
        text        : 'yakin ingin menghapus data?',
        type        : 'confirm',
        theme       : 'relax',
        dismissQueue: true,
        layout      : 'top',
        animation   : {
            open  : 'animated ' + window.anim.open,
            close : 'animated ' + window.anim.close
        },
        buttons     : [
            {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
                $noty.close();
                $.ajax({
                    dataType: 'json',
                    url: url1818+'dashboard/hapus_data',
                    type: 'POST',
                    data: {'table':$table, 'id':$id},
                    success: function(result){
                        if(result.status == 'success'){
                            noty({text: 'Data berhasil dihapus.', type: 'success'});
                            $('#'+$refresh_table).DataTable().ajax.reload();
                        } else{
                            noty({text: 'Data gagal dihapus', type: 'error'});
                        }
                    }
                });
              }
            },
            {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
                $noty.close();
              }
            }
        ]
    });
    return false;
}

function find_pejabat(obj){
    var id_pegawai = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'pegawai/cari_pejabat',
        type: 'POST',
        data: {'id_pegawai':id_pegawai},
        success: function(result){
            $('#pejabat').empty();
            $('#pejabat').html(result.pejabat);
            $('#pejabat').trigger("chosen:updated");
            
            $('#atasan_pejabat').empty();
            $('#atasan_pejabat').trigger("chosen:updated");
        }
    });
}

function find_atasan_pejabat(obj){
    var id_pegawai = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'pegawai/cari_atasan_pejabat',
        type: 'POST',
        data: {'id_pegawai':id_pegawai},
        success: function(result){
            $('#atasan_pejabat').empty();
            $('#atasan_pejabat').html(result.pejabat);
            $('#atasan_pejabat').trigger("chosen:updated");
        }
    });
}

function find_pangkat_jabatan(obj){
    var id_pegawai = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'pegawai/cari_pangkat_jabatan',
        type: 'POST',
        data: {'id_pegawai':id_pegawai},
        success: function(result){
            $('#fid_pangkat_akhir').empty();
            $('#fid_pangkat_akhir').html(result.pangkat);
            $('#fid_pangkat_akhir').trigger("chosen:updated");

            $('#fid_jabatan_akhir').empty();
            $('#fid_jabatan_akhir').html(result.jabatan);
            $('#fid_jabatan_akhir').trigger("chosen:updated");
        }
    });
}

function find_pangkat(obj){
    var id_pegawai = obj.options[obj.selectedIndex].value;
    $.ajax({
        dataType: 'json',
        url: url1818+'pegawai/cari_pangkat_jabatan',
        type: 'POST',
        data: {'id_pegawai':id_pegawai},
        success: function(result){
            $('#fid_pangkat_lama').empty();
            $('#fid_pangkat_lama').html(result.pangkat);
            $('#fid_pangkat_lama').trigger("chosen:updated");
        }
    });
}

function download_pesertaDidik(bentuk){
    var form = $('#filter_pesertaDidik');
    if(bentuk == 'excel'){
        form.attr('action',url1818+"peserta_didik/download_excel");
        form.submit();
    } else{
        showNoty('Format PDF Masih dalam proses', 'error');
    }
}

function getKey(e) {  
    if (window.event)  
        return window.event.keyCode;  
    else if (e)  
        return e.which;  
    else  
        return null;  
}

function numerik(e) {  
    var key, keyChar,valid;  
    key = getKey(e);  
    valid ="0123456789,";
    if (key == null) return true;  
    keyChar = String.fromCharCode(key).toLowerCase();  
    if (valid.toLowerCase().indexOf(keyChar) != -1)  
        return true;  
    if ( key==0 || key==8 || key==9 || key==13 || key==27 || key==46)  
        return true;  
    return false;  
}

function angka(objek) {
    objek = typeof(objek) != 'undefined' ? objek : 0;
    var a = objek.value;
    var b = unangka(a);
    var c = "";
    var posisidesimal = b.indexOf(',');
    var x = b.length - posisidesimal;
    var desimal = b.substr(posisidesimal,x);    
    
    if (posisidesimal > 0){
        panjang = b.length-desimal.length;
        bulat = b.substr(0,panjang);
    }else{
        panjang = b.length;
        bulat = b;
    }
    var j = 0;
    for (var i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
        c = bulat.substr(i-1,1) + "." + c;
        }else{
            c = bulat.substr(i-1,1) + c;
        }
    }
    if (posisidesimal > 0)
    objek.value = c+desimal;
    else
    objek.value = c;
}

function unangka(objek){
    var i = objek.length;
    var temp = '';
    for (var j=0;j<=i;j++){
        var pos = objek.charAt(j);
        if (pos == '.'){
            temp = temp + objek.substr(j+1,1);
            j++;
        }else{  
            if (pos == ','){
                temp = temp + '.';
            }else temp = temp + objek.substr(j,1);
    }
    }
    return temp;
}
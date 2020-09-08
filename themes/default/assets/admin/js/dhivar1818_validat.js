var dhivar1818validat = function () {
    return {
        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function () {
            dhivar1818validat.jqueryValidation();
        },

        // =========================================================================
        // JQUERY VALIDATION
        // =========================================================================
        jqueryValidation: function () {
            $('#modal_data').on('shown.bs.modal', function () {
                //E-KINERJA
                if ($('#keg_tahunan_form').length){
                    $('#keg_tahunan_form').validate({
                        rules:{
                            tahun: {
                                required: true
                            },
                            kegiatan: {
                                required: true
                            },
                            target_kuantitas: {
                                required: true,
                                number: true
                            },
                            satuan: {
                                required: true
                            },
                            biaya: {
                                required: true
                            },
                            angka_kredit: {
                                required: true,
                                number: true
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
                                        $('#ekin_kegTahunan').DataTable().ajax.reload();
                                        $('#modal_data').modal('hide');
                                    } else{
                                        showNoty('Gagal menyimpan data.', 'error');
                                    }
                                }
                            });
                            return false;
                        }
                    });
                    // tombol ajukan kegiatan
                    $('.ajukan').click(function(event) {
                        var idx = $('#id_flag').val();
                        $.ajax({
                            type: 'POST',
                            url: url1818+'ekinerja/post_status_kegiatan',
                            data: {type:'keg_tahunan', id_kegiatan:idx, status:'Penilaian', aksi:'Pengajuan', hasil:'Penilaian'},
                            dataType: 'json',
                            beforeSend: function() {
                                $('.form-body').showLoading();
                            },
                            success: function (response) {
                                if(response.status == 'success'){
                                    $('.form-body').hideLoading();
                                    showNoty('Kegiatan sudah diajukan', 'success');
                                    $('#ekin_kegTahunan').DataTable().ajax.reload();
                                    $('#modal_data').modal('hide');
                                } else if(response.status == 'kurang'){
                                    $('.form-body').hideLoading();
                                    showNoty('Kegiatan gagal diajukan, Silahkan lengkapi detail bulanan terlebih dahulu.', 'warning');
                                    $('#modal_data').modal('hide');
                                } else{
                                    showNoty('Gagal menyimpan data.', 'error');
                                }
                            }
                        });
                    });

                }

                if($('#form_breakdown_bulanan').length){
                    $('#form_breakdown_bulanan').validate({
                        rules:{
                            /*
                            kegiatan: {
                                required: true
                            },
                            */
                            kuantitas: {
                                required: true,
                                number: true
                            },
                            satuan: {
                                required: true
                            },
                            biaya: {
                                required: true
                            },
                            angka_kredit: {
                                required: true,
                                number: true
                            },
                            waktu: {
                                required: true,
                                digits: true,
                                maxlength: 2
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
                                        $('#ekin_kegTahunan').DataTable().ajax.reload();
                                        $('#modal_data').modal('hide');
                                    } else if(response.status == 'already') {
                                        showNoty('Kegiatan untuk bulan ini sudah tersedia.', 'warning');
                                        $('#modal_data').modal('hide');
                                    } else{
                                        showNoty('Gagal menyimpan data.', 'error');
                                        $('#ekin_kegTahunan').DataTable().ajax.reload();
                                        $('#modal_data').modal('hide');
                                    }
                                    //form.reset();
                                }
                            });
                            return false;
                        }
                    });
                }

                if($('#realisasi_bulanan_form').length){
                    $('#realisasi_bulanan_form').validate({
                        rules:{
                            kuantitas: {
                                required: true,
                                number: true
                            },
                            kualitas: {
                                required: true,
                                digits: true,
                                maxlength: 3
                            },
                            biaya: {
                                required: true
                            },
                            angka_kredit: {
                                required: true,
                                number: true
                            },
                            waktu: {
                                required: true,
                                digits: true,
                                maxlength: 2
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
                                        $('#ekin_kegBulanan').DataTable().ajax.reload();
                                        $('#modal_data').modal('hide');
                                    } else{
                                        showNoty('Gagal menyimpan data.', 'error');
                                    }
                                }
                            });
                            return false;
                        }
                    });
                    // tombol ajukan kegiatan bulanan
                    $('.ajukan').click(function(event) {
                        var idx = $('#id_flag').val();
                        $.ajax({
                            type: 'POST',
                            url: url1818+'ekinerja/post_status_kegiatan',
                            data: {type:'keg_bulanan', id_kegiatan:idx, status:'Penilaian', aksi:'Pengajuan', hasil:'Penilaian'},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#contentModal').showLoading();
                            },
                            success: function (response) {
                                if(response.status == 'success'){
                                    $('#contentModal').hideLoading();
                                    showNoty('Kegiatan sudah diajukan', 'success');
                                    $('#ekin_kegBulanan').DataTable().ajax.reload();
                                    $('#modal_data').modal('hide');
                                } else if(response.status == 'no_verify'){
                                    $('#contentModal').hideLoading();
                                    showNoty('Realisasi gagal diajukan, Status kegiatan tahunan belum diterima.', 'warning');
                                    $('#modal_data').modal('hide');
                                } else{
                                    showNoty('Gagal menyimpan data.', 'error');
                                }
                            }
                        });
                    });
                }

                if($('#tugas_tamkrea_form').length){
                    $('#tugas_tamkrea_form').validate({
                        rules:{
                            bulan: {
                                required: true
                            },
                            kegiatan: {
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
                            //var datas = $(form)[0];
                            var formData = new FormData($('#tugas_tamkrea_form')[0]);
                            formData.append('userfile', $('input[type=file]')[0].files[0]);
                            $.ajax({
                                type: $(form).attr('method'),
                                url: $(form).attr('action'),
                                data: formData,
                                contentType: false,
                                cache: false,             
                                processData:false,
                            }).success(function(data){
                                if(data.status == 'success'){
                                    showNoty('Berhasil menyimpan data.', 'success');
                                    $('#ekin_tambkrea').DataTable().ajax.reload();
                                    $('#modal_data').modal('hide');
                                } else if(data.status == 'upload_error'){
                                    showNoty(data.pesan, 'error');
                                } else{
                                    showNoty('Gagal menyimpan data.', 'error');
                                }
                            }).error(function(){
                                showNoty('Terjadi Masalah, Silahkan Refresh Halaman!', 'error');
                            }); 
                            return false;
                        }
                    });
                    // tombol ajukan tugas tambahan dan kreativitas
                    $('.ajukan').click(function(event) {
                        var idx = $('#id_flag').val();
                        $.ajax({
                            type: 'POST',
                            url: url1818+'ekinerja/post_status_kegiatan',
                            data: {type:'tamker', id_kegiatan:idx, status:'Penilaian', aksi:'Pengajuan', hasil:'Penilaian'},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#contentModal').showLoading();
                            },
                            success: function (response) {
                                if(response.status == 'success'){
                                    $('#contentModal').hideLoading();
                                    showNoty('Tugas Tambahan / Kreatifitas sudah diajukan', 'success');
                                    $('#ekin_tambkrea').DataTable().ajax.reload();
                                    $('#modal_data').modal('hide');
                                } else{
                                    $('#contentModal').hideLoading();
                                    showNoty('Gagal menyimpan data.', 'error');
                                }
                            }
                        });
                    });
                }

                //------------- END E-KINERJA
            });
        }

    };

}();
// Call main app init
dhivar1818validat.init();
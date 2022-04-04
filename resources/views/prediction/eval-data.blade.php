@extends('layouts.admin')
@section('mo-prediction','menu-open')
@section('prediction','active')
@section('eval-data','active')

@section('style')
<style>
    .loading{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 1000;
        display: block;
    }
    .loading::before{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background:rgb(0, 0, 0);
        content: "";
        opacity: 0.5;
        
    }
</style>
    
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Evaluation Data</h1>
    </div>
    <div id="alertHitung" class="col-sm-12 alert alert-danger  alert-dismissible fade" role="alert">
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
        <p class="mb-2" id="alerMsg">Mohon maaf saat ini system belum bisa melakukan <strong>Prediksi</strong>, silahkan menghubungi administrator!!</p>
    </div>
    </div>
  </div>
</div>

<section class="container">
    <div class="container-fluid">
        <div class="card card-outline card-primary collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Keterangan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
            <div class="row">
                @foreach ($question as $item)
                <div class="col-4">
                    <div class="alert alert-secondary" role="alert">
                        Q{{ $item->id." : ".$item->qu_name }}
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Evaluation Data 
                </h5>
                <table class="table table-search table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            @foreach ($question as $q)
                            <th>Q{{ $q->id }}</th>
                            @endforeach
                            <th>Kelas</th>
                            <th>Kelas Prediksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if ($data_pred->count()!=0)
                                @php
                                    $no_data = 0;
                                    $jml_val = 0;
                                    $i = 0;
                                @endphp
                                @foreach ($data_pred as $val) 
                                    @if ($no_data!=$val->no)
                                        <tr>
                                            <td scope="row">{{ $val->no }}</td>
                                        @php
                                            $no_data = $val->no;
                                            $jml_val = $i;
                                        @endphp
                                    @endif
                                        <td>{{ $val->value}}</td>
                                    @php
                                         $i++;
                                    @endphp
                                    @if ($i>8)
                                        <td scope="row">{{ ($val->kelas==0)?"Ringan":(($val->kelas==1)?"Berat":"Belum Diprediksi") }}</td>
                                        <td scope="row" class="kelas-prediksi">{{ 
                                        ($val->kelas_prediksi!=null)?(($val->kelas_prediksi=0)?"Ringan":"Berat"):"Belum Diprediksi"
                                        }}</td>
                                    </tr>
                                        @php
                                            $i=0;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                </table>
                <div id="pageLoading" class="loading justify-content-center fade" aria-labelledby="loading" >
                    <div class="d-flex justify-content-center text-light my-auto h-100">
                        <div class="spinner-border my-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <form action="#" id="analis-data" method="post">
                            @csrf
                            <input type="hidden" name="aksi" value="n-data">
                            <input type="hidden" name="dt_bru" value="false">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var i =0;
        var dt_end =$('.kelas-prediksi').length;
        var i_cek = 0;
        $('#alertHitung').hide();
        if (dt_end!=0){
            $('#pageLoading').addClass("show");
            $('#pageLoading').show();
        }
        $('.kelas-prediksi').each(function(){
                setTimeout(() => {
                    {{--
                        var persen = ((i++)/dt_end)*100;
                        $('.progress-bar').css('width',persen+"%");
                        $('.progress-bar').text(persen+'%');
                    --}}
                    var kls_prediksi = $(this).text();
                    i++;
                    if(kls_prediksi=='Belum Diprediksi'){
                        i_cek++;
                    }

                    if(i==dt_end){
                        // $('.spinner-grow').addClass('d-none');
                        if (i_cek>0) {
                            swal.fire({
                                title: 'Peringatan',
                                text: i_cek+' data kelas prediksi belum dihitung, apakah anda ingin menghitungnya sekarang ?',
                                type: 'warning',
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonText:'Hitung sekarang'
                            }).then((result)=>{
                                if(result.value){
                                    $('#analis-data [name=aksi]').val('n-data');
                                    $('#analis-data').submit();
                                    $('#pageLoading').removeClass("show");
                                    $('#pageLoading').hide();
                                }else{
                                    // $('.bedge-loading').fadeOut();
                                    // $('.progress').fadeOut();
                                    $('#pageLoading').removeClass("show");
                                    $('#pageLoading').hide();
                                    $('#alertHitung').show();
                                    $('#alertHitung').addClass('show');
                                    $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                                }
                                $('.btn-hitung-now').click(function() {
                                    $('#analis-data [name=aksi]').val('n-data');
                                    $('#analis-data').submit();
                                    $('#pageLoading').removeClass("show");
                                    $('#pageLoading').hide();
                                    $(this).attr('disabled','true');
                                });
                            });
                        }else{
                            $('#pageLoading').hide();
                            $('#pageLoading').removeClass("show");
                        }
                    }
                }, 100);
        })
        $('#analis-data').submit(function(e){
            e.preventDefault();
            console.log($(this).serialize);
            n_data($(this));
        });
        function n_data(_this){
            {{-- 
                $('.progress-bar').css('width',"0%");
                $('.progress-bar').text('0%');
                $('.bedge-loading').show();
                $('.progress').show();
            --}}
            $('#pageLoading').addClass("show");
            $('#pageLoading').show();
            var formData = _this.serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('n-data-analis') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "aksi": "n-data"
                    },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if(!data.sts){
                        swal.fire({
                            title: 'Error',
                            text: 'Normalisasi Gagal',
                            type: 'error',
                            showConfirmButton: true
                        });
                        $('#pageLoading').removeClass("show");
                        $('#pageLoading').hide();
                    }else{
                        $('#analis-data [name=aksi]').val('h-data');
                        h_data(_this);
                    }
                },
                error: function (data) {
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                    swal.fire({
                            title: 'Error',
                            text: data.responseJSON.message,
                            type: 'error',
                            showConfirmButton: true
                        });
                    console.log(data);
                },
            });
        }
        function h_data(_this){
            {{-- 
                $('.bedge-loading').show();
                $('.progress').show();
                $('.progress-bar').css('width',"0%");
                $('.progress-bar').text('0%');
            --}}
            $('#pageLoading').addClass("show");
            $('#pageLoading').show();
            var formData = $('#analis-data').serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('n-data-analis') }}",
                dataType: 'json',
                cache: false,
                data:{
                    "_token": "{{ csrf_token() }}",
                    "aksi": "h-data",
                    "dt_bru":false
                    },
                success: function (data) {
                    if(data.sts){
                        swal.fire({
                            title: 'Selamat',
                            text: 'Perhitungan berhasil',
                            type: 'success',
                            showConfirmButton: true
                        }).then((result)=>{
                            location.reload();
                        });
                    }else{
                        swal.fire({
                            title: 'Error',
                            text: 'Perhitungan gagal silahkan coba lagi nanti',
                            type: 'error',
                            showConfirmButton: true
                        });
                    }
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                    swal.fire({
                            title: 'Error',
                            text: data.responseJSON.message,
                            type: 'error',
                            showConfirmButton: true
                        });
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                },
            });
            // $(jqxhr).on("downloadProgress", perhitunganProgres);
        }
    {{--
        function perhitunganProgres(e){
            if (e.lengthComputable) {
                $('.text-load').text("(3/3) Melakukan perhitungan...");
                var percentage = parseInt((e.loaded * 100) / e.total);
                console.log(percentage);
                
                $('.progress-bar').css('width',percentage+"%");
                $('.progress-bar').text(percentage+'%');

                if (percentage >= 100) {
                    $('.bedge-loading').fadeOut();
                    $('.progress').fadeOut();
                }
            }
        }
        function uploadProgress(e) {
            if (e.lengthComputable) {
                var percentComplete = parseInt((e.loaded * 100) / e.total);
                console.log(percentComplete);

                $('.progress-bar').css('width',percentComplete+"%");
                $('.progress-bar').text(percentComplete+'%');

                if (percentComplete >= 100) {
                    $('.progress-bar').css('width',"0%");
                    $('.progress-bar').text('0%');
                }
            }
        }

        function downloadProgress(e) {
            if (e.lengthComputable) {
                $('.text-load').text("(2/3) Melakukan normalisasi...");
                var percentage = parseInt((e.loaded * 100) / e.total);
                console.log(percentage);
                
                $('.progress-bar').css('width',percentage+"%");
                $('.progress-bar').text(percentage+'%');

                if (percentage >= 100) {
                    $('.progress-bar').css('width',"0%");
                    $('.progress-bar').text('0%');
                    h_data();
                }
            }
        }
    --}}

    })
</script>
@endsection
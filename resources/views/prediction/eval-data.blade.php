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
                <div class="progress m-1 bg-secondary" id="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
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
                                        ($val->kelas_prediksi!==null)?(($val->kelas_prediksi==0)?"Ringan":"Berat"):"Belum Diprediksi"
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
        var progress = 0;
        $('#alertHitung').hide();
        $('#progress').hide();
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
                                }else{
                                    // $('.bedge-loading').fadeOut();
                                    // $('.progress').fadeOut();
                                    $('#pageLoading').removeClass("show");
                                    $('#pageLoading').hide();
                                    $('#alertHitung').show();
                                    $('#alertHitung').addClass('show');
                                    $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                                }
                                btnClick();
                            });
                        }else{
                            $('#pageLoading').hide();
                            $('#pageLoading').removeClass("show");
                        }
                    }
                }, 100);
        })
        function btnClick(){
            $('.btn-hitung-now').click(function() {
                $('#pageLoading').addClass("show");
                $('#pageLoading').show();
                $('#analis-data [name=aksi]').val('n-data');
                $('#analis-data').submit();
                $(this).attr('disabled','true');
            });
        }
        $('#analis-data').submit(function(e){
            e.preventDefault();
            n_data($(this));
        });
        function n_data(_this){
            $('#progress').show();
            $('.progress-bar').css('width',"0%");
            $('.progress-bar').text('Normalisasi 0 %');
            {{-- 
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
                        var jml_dt = '{{ $data_eval->count() }}';
                        var presentase = 1/(parseInt(jml_dt)+1)*100;
                        $('.progress-bar').css('width',presentase+"%");
                        $('.progress-bar').text('Normalisasi '+presentase.toFixed(1)+'%');
                        $('#pageLoading').addClass("show");
                        $('#pageLoading').hide();
                        h_data(1);
                    }
                },
                error: function (data) {
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                    $('#progress').hide();
                    swal.fire({
                            title: 'Error',
                            text: data.responseJSON.message,
                            type: 'error',
                            showConfirmButton: true
                    });
                    $('#alertHitung').show();
                    $('#alertHitung').addClass('show');
                    $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                    btnClick();
                    // $('.btn-hitung-now').removeAttr('disabled');
                },
            });
        }
        function h_data(no_data_next){
            {{-- 
                $('.bedge-loading').show();
                $('.progress').show();
                $('.progress-bar').css('width',"0%");
                $('.progress-bar').text('0%');
            --}}
            var jml_dt = '{{ $data_eval->count() }}';
            $.ajax({
                type: "POST",
                url: "{{ route('n-data-analis') }}/"+no_data_next,
                dataType: 'json',
                cache: false,
                data:{
                    "_token": "{{ csrf_token() }}",
                    "aksi": "h-data",
                    "dt_bru":false,
                    "type": "one"
                },
                success: function (data) {
                    progress++;
                    var presentase = (parseInt((progress<i_cek?data.no_data_next:jml_dt+1)))/(parseInt(jml_dt)+1)*100;
                    if(parseInt(no_data_next)<parseInt(jml_dt)){
                        if(data.sts){
                            $('.progress-bar').css('width',presentase+"%");
                            $('.progress-bar').text('Menghitung.. '+(progress<i_cek?progress:i_cek)+'/'+parseInt(i_cek)+'('+presentase.toFixed(1)+'%)');
                            h_data(parseInt(data.no_data_next));
                        }else{
                            $('#progress').hide();
                            swal.fire({
                                title: 'Error',
                                text: data.sts+'Perhitungan gagal silahkan coba lagi nanti, '+data.msg,
                                type: 'error',
                                showConfirmButton: true
                            });
                            $('#alertHitung').show();
                            $('#alertHitung').addClass('show');
                            $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                            $('.btn-hitung-now').removeAttr('disabled');
                            btnClick();
                        }
                    }else{
                        $('.progress-bar').css('width',100+"%");
                        $('.progress-bar').text('Menghitung.. '+parseInt(i_cek)+'/'+parseInt(i_cek)+'('+100+'%)');
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
                                text: data.sts+'Perhitungan gagal silahkan coba lagi nanti, '+data.msg,
                                type: 'error',
                                showConfirmButton: true
                            });
                            $('#alertHitung').show();
                            $('#alertHitung').addClass('show');
                            $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                            $('.btn-hitung-now').removeAttr('disabled');
                            btnClick();
                        }
                    }
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                    $('.btn-hitung-now').removeAttr('disabled');

                },error: function (data) {
                        console.log(data);
                        $('#progress').hide();
                        swal.fire({
                                title: 'Error',
                                text: data.responseJSON.message,
                                type: 'error',
                                showConfirmButton: true
                            });
                        $('#pageLoading').removeClass("show");
                        $('#pageLoading').hide();
                        $('#alertHitung').show();
                        $('#alertHitung').addClass('show');
                        $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                        $('.btn-hitung-now').removeAttr('disabled');
                        btnClick();
                    },
                });
            // $(jqxhr).on("downloadProgress", perhitunganProgres);
        }
    })
</script>
@endsection
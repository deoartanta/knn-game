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
                <div class="aksi-hitung my-2">
                    
                    <button class="btn-hitung-knn btn btn-sm btn-primary" role="button">Hitung KNN</button>
                    <button class="btn-hitung-knn-cus btn btn-sm btn-outline-info d-none" role="button">Hitung KNN(0)</button>
                </div>
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
        $('#alertHitung').hide();
        $('#progress').hide();
        $('.btn-hitung-knn-cus').hide();
        $('.btn-hitung-knn-cus').removeClass('d-none');
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
                                icon: 'info',
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonText:'Hitung sekarang'
                            }).then((result)=>{
                                $('#alerMsg').html('<strong>'+i_cek+' data belum dilakukan perhitungan</strong> KNN!!');
                                
                                $('.btn-hitung-knn-cus').show();
                                $('.btn-hitung-knn-cus').html('Hitung KNN <span class="badge badge-danger">'+i_cek+'</span>');
                                $('#pageLoading').removeClass("show");
                                $('#pageLoading').hide();
                                $('#alertHitung').show();
                                $('#alertHitung').addClass('show');
                                // btnClick();
                                if(result.value){
                                    $('#analis-data [name=aksi]').val('n-data');
                                    swal.fire({
                                        title: 'PERHITUNGAN KNN',
                                        text: 'Jumlah data yang akan dihitung adalah '+{{ $data_eval->count() }}+', lanjutkan perhitungan??',
                                        icon: 'question',
                                        showCancelButton: true,
                                        showConfirmButton: true,
                                        showCancelButton: true,
                                        confirmButtonText:'Lanjutkan',
                                        cancelButtonText:'Tidak, Hitung '+i_cek+' data saja!',
                                        showCancelButton: true
                                    }).then((result)=>{
                                        if(result.isConfirmed){
                                            modalHitungKnn();
                                        }else{
                                            modalHitungKnnCus();
                                        }
                                    });
                                    // $('#analis-data').submit();
                                }
                            });
                        }else{
                            $('#pageLoading').hide();
                            $('#pageLoading').removeClass("show");
                        }
                    }
                }, 100);
        })
        function modalHitungKnn(){
            swal.fire({
                title: 'PERHITUNGAN KNN',
                input: 'text',
                inputLabel: 'Masukan nilai K',
                inputValue: '3',
                icon: 'info',
                showCancelButton: true,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText:'Hitung {{ $data_eval->count() }} Data',
                // showDenyButton: true,
                // denyButtonColor:'#00d576',
                // denyButtonText:'Hitung ('+i_cek+')',
                showCancelButton: true,
                inputValidator: (value) => {
                    var validasiAngka = /^[0-9]+$/;
                    if (value) {
                        if(!value.match(validasiAngka)){
                            return "Inputan harus angka!";
                        }
                    }else{
                        return 'Inputan tidak boleh kosong!!'
                    }
                }

            }).then((result)=>{
                if(result.isConfirmed){
                    n_data("all",result.value);
                // }else if(result.isDenied){
                //     n_data("one",result.value);
                }else{
                    
                }
            });
        }
        {//btn click hitung knn
            $('.btn-hitung-knn').click(function() {
                modalHitungKnn();
            });
        }
        function modalHitungKnnCus(){
            swal.fire({
                title: 'PERHITUNGAN KNN',
                input: 'text',
                inputLabel: 'Masukan nilai K',
                inputValue: '3',
                icon: 'info',
                showCancelButton: true,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText:'Hitung '+i_cek+' Data',
                showCancelButton: true,
                inputValidator: (value) => {
                    var validasiAngka = /^[0-9]+$/;
                    if (value) {
                        if(!value.match(validasiAngka)){
                            return "Inputan harus angka!";
                        }
                    }else{
                        return 'Inputan tidak boleh kosong!!'
                    }
                }

            }).then((result)=>{
                if(result.isConfirmed){
                    n_data("one",result.value);
                // }else if(result.isDenied){
                //     n_data("one",result.value);
                }else{
                    
                }
            });
        }
        {//btn click hitung knn custom
            $('.btn-hitung-knn-cus').click(function() {
                modalHitungKnnCus();
            });
        }
        $('#analis-data').submit(function(e){
            e.preventDefault();
            // n_data($(this));
        });
        function n_data(type,k){
            
            $('#progress').show();
            $('.progress-bar').css('width',"0%");
            $('.progress-bar').text('Normalisasi 0 %');
            {{-- 
                $('.bedge-loading').show();
                $('.progress').show();
            --}}
            $('#pageLoading').addClass("show");
            $('#pageLoading').show();
            // var formData = _this.serialize();
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
                            icon: 'error',
                            showConfirmButton: true
                        });
                        $('#pageLoading').removeClass("show");
                        $('#pageLoading').hide();
                    }else{
                        $('#analis-data [name=aksi]').val('h-data');
                        var jml_dt = (type=="all"?'{{ $data_eval->count() }}':i_cek);
                        var presentase = 0.5/(parseInt(jml_dt))*100;
                        
                        $('.progress-bar').css('width',presentase+"%");
                        $('.progress-bar').text('Normalisasi '+presentase.toFixed(1)+'%');
                        $('#pageLoading').addClass("show");
                        $('#pageLoading').hide();
                        h_data(k,1,type,1,jml_dt);
                    }
                },
                error: function (data) {
                    $('#pageLoading').removeClass("show");
                    $('#pageLoading').hide();
                    $('#progress').hide();
                    swal.fire({
                            title: 'Error',
                            text: data.responseJSON.message,
                            icon: 'error',
                            showConfirmButton: true
                    });
                    // $('#alertHitung').show();
                    // $('#alertHitung').addClass('show');
                    // $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                    // btnClick();

                    // $('.btn-hitung-now').removeAttr('disabled');
                },
            });
        }
        function h_data(k,no_data_next,type,progress,progress_max){
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
                    "progress":progress,
                    "progress_max":progress_max,
                    "k":k,
                    "type": type
                },
                success: function (data) {
                    // var presentase = (parseInt(data.no_data_next))/(parseInt(jml_dt)+1)*100;
                    var presentase = parseInt(progress)/(parseInt(data.progress_max))*100;
                    // alert("presentase Hitung : "+presentase+"="+progress+"/"+((parseInt(data.progress_max))+"*"+100));

                    if(parseInt(progress)<parseInt(data.progress_max)){
                        if(data.sts){
                            $('.progress-bar').css('width',presentase+"%");
                            $('.progress-bar').text('Menghitung.. '+parseInt(progress)+'/'+parseInt(data.progress_max)+'('+presentase.toFixed(1)+'%)');
                            // $('.progress-bar').text('Menghitung.. '+(progress<i_cek?progress:i_cek)+'/'+parseInt(i_cek)+'('+presentase.toFixed(1)+'%)');
                            h_data(k,parseInt(data.no_data_next),type,data.progress,data.progress_max);
                        }else{
                            $('#progress').hide();
                            swal.fire({
                                title: 'Error',
                                text: data.sts+'Perhitungan gagal silahkan coba lagi nanti, '+data.msg,
                                icon: 'error',
                                showConfirmButton: true
                            });
                            // $('#alertHitung').show();
                            // $('#alertHitung').addClass('show');
                            // $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');

                            // $('.btn-hitung-now').removeAttr('disabled');
                            btnClick();
                        }
                    }else{
                        $('.progress-bar').css('width',100+"%");
                        $('.progress-bar').text('Menghitung.. '+parseInt(progress)+'/'+parseInt(data.progress_max)+'('+100+'%)');
                        if(data.sts){
                            swal.fire({
                                title: 'Selamat',
                                text: data.msg,
                                icon: 'success',
                                showConfirmButton: true
                            }).then((result)=>{
                                location.reload();
                            });
                        }else{
                            swal.fire({
                                title: 'Error',
                                text: data.sts+'Perhitungan gagal silahkan coba lagi nanti, '+data.msg,
                                icon: 'error',
                                showConfirmButton: true
                            });
                            // $('#alertHitung').show();
                            // $('#alertHitung').addClass('show');
                            // $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');
                            // $('.btn-hitung-now').removeAttr('disabled');

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
                                icon: 'error',
                                showConfirmButton: true
                            });
                        $('#pageLoading').removeClass("show");
                        $('#pageLoading').hide();
                        $('#alertHitung').show();
                        $('#alertHitung').addClass('show');

                        // $('#alerMsg').html('<strong>'+i_cek+' data kelas prediksi</strong> belum dihitung, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Mulai hitung</button> sekarang?');

                        // $('.btn-hitung-now').removeAttr('disabled');
                        btnClick();
                    },
                });
            // $(jqxhr).on("downloadProgress", perhitunganProgres);
        }
    })
</script>
@endsection
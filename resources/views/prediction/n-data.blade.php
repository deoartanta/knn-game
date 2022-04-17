@extends('layouts.admin')
@section('mo-prediction','menu-open')
@section('prediction','active')
@section('n-data','active')
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
        <h1 class="m-0 text-dark">Normalize Data</h1>
      </div>
      @if($jmlDt==0)
        <div class="alert alert-danger  alert-dismissible fade show w-100" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p class="mb-2">Tidak Ada Data</p>
        </div>
        @else
            @if($jml_dataBru>0)
                <div id="alertHitung" class="col-sm-12 alert alert-danger  alert-dismissible fade show" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                <p class="mb-2" id="alerMsg"><strong>{{ $jml_dataBru }} data baru</strong> belum dinormalisasi, <button class="btn-hitung-now btn btn-sm btn-primary" role="button">Normalisasikan</button> sekarang!!</p>
                </div>
            @endif
        @endif
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
                <h5 class="card-title">Data Normalisasi</h5>
                <table class="table table-search table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            @foreach ($question as $q)
                            <th>Q{{ $q->id }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @if($jmlDt!=0)
                                @if ($n_data->count()!=0)
                                    @php
                                        $no_data = 0;
                                        $jml_val = 0;
                                        $i = 0;
                                    @endphp
                                    @foreach ($n_data as $val) 
                                        @if ($no_data!=$val->no_data)
                                            <tr>
                                                <td scope="row">{{ $val->no_data }}</td>
                                            @php
                                                $no_data = $val->no_data;
                                                $jml_val = $i;
                                            @endphp
                                        @endif
                                            <td>{{ $val->val_normalisasi*1}}</td>
                                        @php
                                            $i++;
                                        @endphp
                                        @if ($i>8)
                                            
                                        </tr>
                                            @php
                                                $i=0;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                </table>
                <div id="pageLoading" class="loading justify-content-center fade show" aria-labelledby="loading" >
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
        $('#pageLoading').removeClass("show");
        $('#pageLoading').hide();
        $('.btn-hitung-now').click(function() {
        $('#analis-data [name=aksi]').val('n-data');
        $('#pageLoading').addClass("show");
        $('#pageLoading').show();
        $_this = $(this);
        $_this.attr('disabled','true');
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
                $('#pageLoading').removeClass("show");
                $('#pageLoading').hide();
                if(!data.sts){
                    swal.fire({
                        title: 'Error',
                        text: 'Normalisasi Gagal',
                        type: 'error',
                        showConfirmButton: true
                    });
                    $_this.attr('disabled','false');
                }else{
                    swal.fire({
                        title: 'Selamat',
                        text: 'Normalisasi Berhasil',
                        type: 'success',
                        showConfirmButton: true
                    }).then((result)=>{
                        location.reload();
                    });
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
                $_this.attr('disabled','false');
            },
        });
    });
    })
</script>
    
@endsection
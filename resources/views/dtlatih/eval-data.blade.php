@extends('layouts.admin')
@section('mo-data-latih','menu-open')
@section('data-latih','active')
@section('e-data-latih','active')

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
        <h1 class="m-0 text-dark">Training Data</h1>
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
                    
                    <button class="btn-import btn btn-sm btn-success" role="button" data-toggle="modal" data-target="#import"><i class="fa fa-upload mr-1" aria-hidden="true"></i>Import</button>
                    @if ($data_pred->count()!=0)
                    <a class="btn-export btn btn-sm btn-secondary" href="{{ route('export','testDT') }}" role="button"><i class="fa fa-download mr-1" aria-hidden="true"></i>Export</a>
                        <button  class="btn-delete-all btn btn-sm btn-danger" role="button" role="button" data-toggle="modal" data-target="#destroy"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Hapus Semua Data</button>
                        <a class="btn btn-sm btn-primary" href="{{ route('n-data-latih') }}" role="button">Normalisasi</a>
                    @endif
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
                        </tr>
                        </thead>
                        <tbody>
                            @if ($data_pred->count()!=0)
                                @php
                                    $no_data = 0;
                                    $jml_val = 0;
                                    $i = 0;
                                    $no = 1;
                                @endphp
                                @foreach ($data_pred as $val) 
                                    @if ($no_data!=$val->no)
                                        <tr>
                                            <td scope="row">{{ $no++ }}</td>
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
{{-- Modal --}}
<div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importData" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" id="importData">Import Data</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('import') }}" id="form-import" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body bg-light">
                <div class="form-group">
                  <input type="file"
                    class="form-control pt-3 pb-5" name="import-data" id="import-data" aria-describedby="desInput" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"multiple required>
                    <input type="hidden" name="dt_type" value="trainDT">
                  <small id="desInput" class="form-text text-muted">File excel yang diupload adalah format 97-2003 workbook (.xls) dan Microsoft Excel Worksheet(.xlsx)</small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <a href="{{ route('td-download') }}" class="btn btn-outline-secondary mr-auto" role="button">Download Template</a>
                <button id="btn-import" type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="destroy" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delAllDT" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="destroy">Hapus semua data</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('del-dtUji','trainDT') }}" id="form-destroy" method="get" enctype="multipart/form-data">
                @csrf
            <div class="modal-body bg-light">
                <div class="form-group">
                    <p>Semua data akan dihapus termasuk perhitungan normalisasi dari <b> Training Data </b>, anda yakin ingin melanjutkan??</p>
                    <input type="hidden" name="dt_type" value="testDT">
                    <small id="desInput" class="form-text text-danger"><strong>Peringatan : </strong>Data yang telah dihapus tidak akan bisa dikembalikan!!</small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button id="btn-destroy" type="submit" class="btn btn-danger">Lanjutkan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var i =0;
        var dt_end =$('.kelas-prediksi').length;
        var i_cek = 0;
        $('#form-import').submit(function(e){
            // e.preventDefault();
            $('#btn-import').attr('disabled',true);
            $('#import').modal('hide');
        });
        $('#form-destroy').submit(function(e){
            // e.preventDefault();
            $('#btn-destroy').attr('disabled',true);
            $('#destroy').modal('hide');
        });
        $('#alertHitung').hide();
        $('#pageLoading').hide();
        $('#progress').hide();
        $('.btn-hitung-knn-cus').hide();
        $('.btn-hitung-knn-cus').removeClass('d-none');
        if (dt_end!=0){
            $('#pageLoading').addClass("show");
            $('#pageLoading').show();
        }
    })
</script>
@endsection
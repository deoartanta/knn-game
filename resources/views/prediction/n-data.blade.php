@extends('layouts.admin')
@section('mo-prediction','menu-open')
@section('prediction','active')
@section('n-data','active')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Normalize Data</h1>
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
                            @foreach ($data_eval as $eval)  
                            <tr>
                                <td scope="row">{{ $eval->no }}</td>
                                @foreach ($question as $q)
                                <td>{{ ($n_data->where('prediction_dt_id',$data_pred->where('qu_id',$q->id)->where('no_data',$eval->no)->first()->id)->first()->val_normalisasi*1) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
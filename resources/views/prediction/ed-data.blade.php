@extends('layouts.admin')
@section('mo-prediction','menu-open')
@section('prediction','active')
@section('ed-data','active')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Confution Matrix</h1>
      </div>
    </div>
  </div>
</div>

<section class="container">
  <div class="container-fluid">
      <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Normalisasi</h5>
                <table class="table table-search table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th width="30px">#</th>        
                            <th width="40%">Nilai</th>        
                            <th>Kelas</th>        
                            <th>Last Update</th>        
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($dist as $val)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td class="text-center">{{ $val->nilai }}</td>
                                <td>{{ $val->kelas==1?'Berat': ($val->kelas==0?'Ringan':'Belum ada kelas')}}</td>
                                <td>{{ date("Y-m-d, h:ia",strtotime($val->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</section>
@endsection
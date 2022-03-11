@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Dosen</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Dosen</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
    <section class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Dosen</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dosen" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $dosen->id }}</td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->alamat}}</td>
                                    <td>{{ $dosen->ttl }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
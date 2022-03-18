@extends('layouts.admin')
@section('mo-prediction','menu-open')
@section('prediction','active')
@section('eval-data','active')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Evalution Data</h1>
      </div>
    </div>
  </div>
</div>

<section class="container">
    <div class="container-fluid">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Tes</th>
                    <th>Tes Table</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>kjkj</td>
                        <td>kjkj</td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td>kjkj</td>
                        <td>kjkj</td>
                    </tr>
                </tbody>
        </table>
    </div>
</section>
@endsection
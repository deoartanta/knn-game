@extends('navbar.nav')
@section('judul1','Profil')
@section('profil','active')

@section('style')
	<style type="text/css" media="screen">
		section {
	      min-height: 420px; 
	    }
	</style>
@endsection
@section('content1')
<div class="jumbotron jumbotron-fluid">
  <div class="container text-center">
    <img src="img/ff.png" width="200" height="200" class="rounded-circle">
    <h1 class="display-4">Deo Artanta</h1>
    <p class="lead">Selamat Datang.</p>
  </div>
</div>

<section id="profil">
<div class="countainer">
  <div class="row mb-4">
    <div class="col text-center">
      <h2>Profil</h2>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col text-center">
      <table class="table ml-5">
		<tbody>
			<tr>
				<th width="150">Data Pribadi</th>
			</tr>
			<tr>
				<td width="50"></td>
				<th width="150" class="text-left">Nama</th>
				<td>{{$nama}}</td>
			</tr>
			<tr>
				<td></td>
				<th class="text-left">Nim</th>
				<td>19201182</td>
			</tr>
			<tr>
				<td></td>
				<th class="text-left">Tempat lahir</th>
				<td>Malang</td>
			</tr>
			<tr>
				<td></td>
				<th class="text-left">TTL</th>
				<td>15 Juli 2000</td>
			</tr>
		</tr>
		</tbody>
	</table>
    </div>
    <div class="col text-center">
      <table class="table ml-5">
		<tbody>
			
			<tr>
				<th width="150">Contact Person</th>
			</tr>
			<tr>
				<td width="50"></td>
				<th width="150" class="text-left">No.Telp/Wa</th>
				<td>089234768549</td>
			</tr>
			<tr>
				<td></td>
				<th class="text-left">Instagram</th>
				<td class="text-lowercase">{{"@".$ig}}</td>
			</tr>
		</tr>
		</tbody>
	</table>
    </div>
  </div>

</div>
</section>
@endsection

@section('script')
	
@endsection
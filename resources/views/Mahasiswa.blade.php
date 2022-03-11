@extends('template')
@section('mhs','active')
@section('content')
<div class="container">
	<h3 class="m-4 text-uppercase">Data {{$title}} ITB Asia Malang</h3>
	<table class="table">
		<thead>
			<th>No</th>
			<th>Nama</th>
			<th>NIM</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($data as $v=>$rs)
				<tr>
				<td>{{intval($v)+1}}</td>
			@foreach($rs as $value)
				<td>{{$value}}</td>
			@endforeach
				<td><a href="/mahasiswa/profil/{{$rs[0]}}" >Profil</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
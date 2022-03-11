@extends('layouts.admin')
@section('judul','Welcome')
@section('style')
	<style type="text/css" media="screen">
		body{
			background: #EFF7FE;
			padding-top: 15px;
		}.main-section{
			border:1px solid #138496;
			background-color: #fff;
		}.profile-header{
			background-color: #17a2b8;
			height:150px;
		}.user-detail{
			margin:-50px 0px 30px 0px;
		}.user-detail img{
			height:100px;
			width:100px;
		}.user-detail h5{
			margin:15px 0px 5px 0px;
		}.user-social-detail{
			padding:15px 0px;
			background-color: #17a2b8;
		}.user-social-detail a i{
			color:#fff;
			font-size:23px;
			padding: 0px 5px;
		}
	</style>
@endsection


@section('content')
  <div class="container">
    <div class="row">
      <div class="offset-lg-4 col-lg-4 col-sm-6 col-12 main-section text-center">
          <div class="row">
              <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
          </div>
          <div class="row user-detail">
              <div class="col-lg-12 col-sm-12 col-12">
                  <img src="img/ff.png" class="rounded-circle img-thumbnail">
                  <h5 class="text-uppercase">Deo Artanta Aji Rismanda</h5>
                  <p><i class="fa fa-map-marker" aria-hidden="true"></i> Jember, Jawa Timur.</p>

                  <hr>
                  <a href="/myprofil" class="btn btn-info btn-sm">Profil</a>

                  <hr>
                  <span>Seseorang yang sangat antusias dengan segala hal yang berbau pemograman.</span>
              </div>
          </div>
          <div class="row user-social-detail">
              <div class="col-lg-12 col-sm-12 col-12">
                  <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                  <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              </div>
          </div>
      </div>
    </div>
  </div>
  @endsection
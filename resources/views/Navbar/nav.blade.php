@extends('template')
@section('judul')
@yield('judul1')
@endsection
@section('nav-hide','d-none')
@section('content')
{{--
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  @auth
  <a class="navbar-brand text-uppercase" href="{{ url('/') }}">
    {{ Auth::user()->name }}
  </a>
  @endauth
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('evalution')" href="{{ route('analytic.index') }}">Confution Matrix</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('prediction')" href="{{ route('prediction.create') }}">Prediction</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link @yield('pf')" href="{{ url('/portfolio') }}">Portfolio</a>
      </li> -->
    </ul>
  </div>
</nav> 
--}}

@yield('content1')

{{-- <footer class="bg-dark text-white">
  <div class="countainer">
    <div class="row pt-3">
      <div class="col text-center">
        <p>Copyright 2021 | Deo Artanta.</p>
      </div>
    </div>
  </div>
  
</footer> --}}
@endsection
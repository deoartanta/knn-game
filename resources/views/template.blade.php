<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	{{-- <link rel="stylesheet" href="/css/app.css"> --}}
	<link rel="stylesheet" href="{{ asset('assets\bootstrap-4.3.1\dist\css\bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets\perfect-scrollbar-1.4.0\css\perfect-scrollbar.css')}}">
	<link rel="stylesheet" href="{{ asset('assets\fontawesome-free\css\all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css\style.css')}}">
	@yield('style')
	<title>@yield('judul')KNN</title>

	<style>
		@font-face {
			font-family: "Poppins-regular";
			src: url("{{ asset('fonts/Poppins/Poppins-Regular.ttf')}}") format("truetype");
		}

		* {
			font-family: 'Poppins-regular';
		}
	</style>
</head>

<body>
	<nav class="navbarku navbar navbar-expand-lg navbar-dark bg-primary fixed-top bg-gray @yield('nav-hide')">
		<div class="container">
			<a class="navbar-brand text-uppercase" style="font-weight: 600;" href="#">&emsp; K-nn</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav justify-content-center w-100">
					<li class="nav-item">
						<a class="nav-link s-o-white text-uppercase js-scroll-trigger" href="#home" style="font-weight: 600;">Home <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item">
						<a class="nav-link s-o-white text-uppercase" style="font-weight: 600;" href="#about">About</a>
					</li>

					<!-- <li class="nav-item">
						<a class="nav-link s-o-white text-uppercase js-scroll-trigger" href="{{ route('prediction.index') }}">Prediction</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link s-o-white dropdown-toggle text-uppercase" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Analisis
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="#">Evaluation</a>
							<a class="dropdown-item" href="#">Confution</a>
							<a class="dropdown-item" href="#">Normalize</a>
						</div>
					</li>
					<li class="nav-item ">
						<a class="nav-link s-o-white text-uppercase" href="#contact">contact</a>
					</li> -->
					@guest
					@if (Route::has('login'))
					<li class="nav-item ">
						<a class="nav-link s-o-white text-uppercase" style="font-weight: 600;" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@endif

					@if (Route::has('register'))
					<li class="nav-item ">
						<a class="nav-link s-o-white text-uppercase" style="font-weight: 600;" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
					@endif
					@endguest
				</ul>
				@auth
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link s-o-white dropdown-toggle text-uppercase" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{ Auth::user()->name }}
						</a>
						<div class="dropdown-menu dropdown-menu-lg-right bg-transparent" style="border: 0;" aria-labelledby="navbarDropdownMenuLink">
							<div class="card mr-2 ml-2" style="width: 18rem;">
								<div class="card-body text-center">
									<h5 class="card-title text-uppercase">{{ Auth::user()->name }}</h5>
									<p class="card-text">{{ Auth::user()->email }} @if (Auth::user()->level==0)
										<span class="text-capitalize badge badge-info">Visitors</span>
										@else
										<span class="text-capitalize badge badge-primary">Administrator</span>
										@endif
									</p>
								</div>
								<div class="card-body d-inline-block">
									<a class="card-link d-inline-block text-uppercase text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
									<a name="profile" id="profile" class="btn btn-outline-success btn-sm float-right" href="#home" role="button">Profile</a>
									@if (Auth::user()->level==1)
									<a class="btn btn-outline-primary btn-sm float-right mr-2" href="{{ route('home') }}">Admin</a>
									@endif
								</div>
							</div>
						</div>
					</li>
				</ul>
				@endauth
			</div>
		</div>
	</nav>
	@yield('content')

	<script src="{{ asset('js\jquery-3.4.1.js')}}"></script>
	<script src="{{ asset('assets\bootstrap-4.3.1\dist\js\bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('assets\perfect-scrollbar-1.4.0\dist\perfect-scrollbar.js')}}"></script>
	@yield('script')
	{{-- <script src="{{ asset('js\New folder\scrolling-nav.js')}}"></script> --}}
	{{-- {{-- <script src="{{ asset('js\New folder\scrolling-nav.js')}}"></script> --}}
	{{-- <script src="{{ asset('js\library\scrollspy.js')}}"></script> --}}
	<script src="{{ asset('js\style.js')}}"></script>
</body>

</html>
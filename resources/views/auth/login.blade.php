@extends('layouts.app')
@section('title','Login |')
@section('content')
    <img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="{{asset('img\video_game.svg')}}">
		</div>
		<div id="scroll-perfect-custom" class="login-content position-relative overvlow-auto" 
    style="height: 100vh;padding-top: 80px;">
            <form class="lo" action="{{ route('login') }}" method="POST">
                @csrf
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="bi bi-person-fill"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control input @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback text-left" style="margin-top: 3.25rem;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="bi bi-lock-fill"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                           <input type="password" name="password" required autocomplete="current-password" class="form-control input @error('password') is-invalid @enderror">
                           @error('password')
                                <span class="invalid-feedback text-left" style="margin-top: 3.25rem;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            	   </div>
                </div>
                <div class="text-left">
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-left" style="font-size: 13px;">
                    D<span class="text-lowercase">ON'T HAVE AN ACCOUNT?</span>
                    <a class="span" href="{{ route('register') }}">Register Now</a>
                </div>
            	<a href="{{ route('password.request') }}">Forgot Password?</a>
            	<input type="submit" class="btn lo" value="Login">
            </form>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .container {
            width: 100vw;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 7rem;
            padding: 0 2rem;
        }
        @media screen and (max-width: 1050px) {
            .container {
                grid-gap: 5rem;
            }
        }
        @media screen and (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .img {
                display: none;
            }

            .wave {
                display: none;
            }

            .login-content {
                justify-content: center;
            }
        }
    </style>
@endsection
@section('script')
    <script>
        const demo = document.querySelector("#scroll-perfect-custom");
        const ps = new PerfectScrollbar(demo);

        $(document).ready(function() {
        $(".ps__rail-x").css("display","none");
        $(".ps__rail-y").css("z-index","1031");
        })
    </script>
@endsection

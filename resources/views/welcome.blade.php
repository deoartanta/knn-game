@extends('template')

@section('content')
<div id="scroll-perfect-custom" class="overflow-auto scroll-custom position-relative" style="height: 100vh;">
    <div class="bg">
        <div class="container jb" id="home">
            <div class="jb-content item-center w-50">
                <p class="title">Prediksi Tingkat Bermain Game Pada Anak</p>
                <a href="{{ route('prediction.index') }}" style="display: flex; text-decoration: none;"><button class="btn lo btn-primary btn-lg" style="border-radius: 25px; width: max-content; height: auto; margin-top: 0 !important;">
                        <div class="mx-3 my-0 p-0">MULAI PREDIKSI<i class="fa fa-arrow-right ml-3"></i></div>
                    </button></a>
            </div>
            <div class="image1 position-relative" style="right:-130px;">
                <img src="{{asset('img\video_game.svg')}}" alt="" srcset="" height="450px">
            </div>
        </div>
    </div>
    <div class="bg-flip">
        <div class="container pt-4">
            <div class="card shadow-sm mb-3" id="about">
                <div class="card-body">
                    <h5 class="card-title text-uppercase text-center">about</h5>
                    <div class="card mb-3 border-0">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum neque ad, excepturi beatae voluptate explicabo facere magni? Quo explicabo asperiores quaerat vero ab eaque? Consequuntur eos neque molestiae ea molestias?Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia excepturi rerum praesentium, ipsam sapiente natus aspernatur, harum officiis animi debitis minima assumenda in architecto nesciunt ea veniam doloremque! Amet, sit?Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, numquam sunt exercitationem nobis illum maxime quod vero delectus eaque ipsam doloribus enim praesentium laboriosam nisi, accusantium nostrum hic ullam fugiat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="footer bg-primary">
        <div class="container">
            <div class="row" id="contact">
                <div class="col-6">
                    no : 085234123312
                </div>
                <div class="col-6">
                    alamat : jl. gondosari
                </div>
            </div>
            <div id="pesan"></div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script>
    const demo = document.querySelector("#scroll-perfect-custom");
    const ps = new PerfectScrollbar(demo);


    $(document).ready(function() {
        $(window).width(function(i, w) {
            console.log(w);
        });
        $(".ps__rail-x").css("display", "none");
        $(".ps__rail-y").css("z-index", "1031");
        if ($(window).width() <= 992) {
            $(".navbarku").removeClass("bg-transparent");
            $(".nav-size-19").removeClass("nav-size-19");
            $(".navbarku").addClass("shadow");
        } else {
            if ($(".scroll-custom").scrollTop() <= 50) {
                $(".navbarku").addClass("bg-transparent");
                $(".navbar-nav").addClass("nav-size-19");
            }
            $(".scroll-custom").scroll(function() {
                if ($(this).scrollTop() <= 5) {
                    $(".navbarku").addClass("bg-transparent");
                    $(".navbar-nav").addClass("nav-size-19");
                    $(".navbarku").removeClass("shadow");
                }
                if ($(this).scrollTop() >= 50) {
                    $(".navbarku").removeClass("bg-transparent");
                    $(".nav-size-19").removeClass("nav-size-19");
                    $(".navbarku").addClass("shadow");

                }
            })
        }
    });
</script>
@endsection
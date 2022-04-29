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
            <div class="card shadow-sm mb-3" id="panduan">
                <div class="card-body bg-light">
                    <h5 class="card-title text-uppercase text-center">Panduan</h5>
                    <div class="card mb-3 border-0">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="main-card mb-3 card">
                                                <div class="card-body"><h5 class="card-title">Persiapan Data</h5>
                                                    <p>Persiapan ini digunakan untuk menjawab pertanyaan-pertanyaan yang diperlukan dalam melakukan prediksi tingkat bermain game pada anak menggunakan algoritma k-NN </p>

                                                    {{-- <p><span class="badge badge-success">1</span> Persiapkan Nilai <b>Jumlah MK Semester 1-4  </b> dan <b>Jumlah SKS 1-4</b></p>

                                                    <p><span class="badge badge-success">2</span> Persiapkan Nilai <b>IP Semester 1 - 4 </b></p> --}}

                                                    <p><span class="badge badge-success">1</span> Keterangan angka desimal <b>,(koma) </b> diganti <b>. (titik)</b></p>
                                                </div>
                                            </div>
                                            <div class="main-card mb-3 card">
                                                <div class="card-body"><h5 class="card-title">Large Scrollable Area</h5>
                                                    <p>Ini adalah hasil dimana data yang kamu masukkan sudah diklasifikasikan menggunakan algoritma k-NN</p>
                                                    <p><span class="badge badge-warning">4</span> Hasil <b>Prediksi</b> Berupa Tingkat Bermain yang <span class="badge badge-success">RINGAN</span> dan <span class="badge badge-danger">BERAT</span></p>
                                                    <p><span class="badge badge-warning">5</span> Jika sudah melakukan <i>Prediksi</i> Tekan tombol <b>OK</b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="main-card mb-3 card">
                                                <div class="card-body"><h5 class="card-title">Prediction</h5>
                                                    <p>Jika sudah mempersiapkan data, langkah selanjutnya adalah melakukan prediksi tingkat bermain game yang dianalisis menggunakan algoritma k-NN</p>
                                                    <p><span class="badge badge-info">2</span> Lakukan <b>Prediksi</b> dengan menekan tombo <b>MULAI PREDIKSI</b> </p>
                                                    <p><span class="badge badge-info">3</span> Isi <b><i> Form Prediksi </i></b> Sesuai Data Yang Telah Ada</p>
                                                </div>
                                            </div>
                                                <div class="main-card mb-3 card">
                                                    <div class="card-body"><h5 class="card-title">Ketentuan Sistem</h5>
                                                        {{-- <p><span class="badge badge-info"></span> Menu <b>Analytic</b> hanya akan menampilkan data <i>confusion matrix</i> setelah melakukan <b>PREDIKSI</b></p> --}}

                                                        <p><span class="badge badge-info">6</span> Hasil Prediksi ditentukan dengan menggunakan Algoritma <i>k-NN</i> </p>

                                                        <p><span class="badge badge-info">7</span> Apabila Halaman <b>Prediksi</b> tidak bisa di buka atau ada kendala lain yang membuat prediksi anda belum bisa dilakukan. Silahkan Hub.  <i>Administrator</i> </p>

                                                        {{-- <p><span class="badge badge-info">8</span> Kontak Admin (085784808281), E-mail = <i>abdoel.muiz27@gmail.com</i></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
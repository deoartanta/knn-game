@extends('navbar.nav')

@section('style')
<style type="text/css" media="screen">
    section {
        min-height: 420px;
    }
</style>
@endsection
@section('judul1','Prediction | ')
@section('prediction','active')
@section('content1')
<section id="portfolio" class="portfolio bg-light pt-4 pb-5">
    <div id="scroll-perfect-custom" class="position-relative " style="height: 100vh;">
        <div class="row justify-content-md-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header container">
                        Prediksi Tingkat Bermain Game Pada Anak
                    </div>
                    
                    <div class="card-body">
                        @if (session()->get('sts'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Prediksi Data Berhasil</h4>
                                <p>Jumlah Ringan = <strong>{{ session()->get('jml_r') }}</strong></p>
                                <p>Jumlah Berat = <strong>{{ session()->get('jml_b') }}</strong></p>
                                <p>Jumlah K = <strong>{{ session()->get('jml_k') }}</strong></p>
                                <p class="mb-2">Hasil prediksi anda adalah <strong>{{ session()->get('jml_r')<session()->get('jml_b')?'Berat':'Ringan' }}</strong></p>
                            </div>
                        @endif
                        <h5 class="card-title">Lengkapi data anda</h5>
                        <p class="card-text">Kuesioner dibawah sesuai dengan petunjuk</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center mb-5">
            <div class="col-lg-9">
                <div class="container main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">(*) Wajib Diisi</h5>
                        <form method="POST" action="{{ route('prediction.store') }}" enctype="multipart/form-data">
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Bermain Game Setiap Hari (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="1" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="1" value="2" type="radio" class="form-check-input" required=""> Iya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Lama Bermain dalam Sehari (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="2" value="1" type="radio" class="form-check-input" required=""> Kurang Dari 2 Jam
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="2" value="2" type="radio" class="form-check-input" required=""> Lebih Dari 2 Jam
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Dimarahin Orang Tua karena bermain Game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="3" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="3" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Merasa Pusing saat main Game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="4" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="4" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="4" value="3" type="radio" class="form-check-input" required="">Kadang-kadang
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Lupa mengerjakan tugas karena bermain game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="5" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="5" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="5" value="3" type="radio" class="form-check-input" required="">Kadang-kadang
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Marah Saat bermain game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="6" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="6" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="6" value="3" type="radio" class="form-check-input" required="">Kadang-kadang
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Membeli Voucher Game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="7" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="7" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="angka" class="col-sm-6 col-form-label">Level Tertingi Game (*)</label>
                                <div class="col-sm-6">
                                    <input name="8" id="angka" placeholder="Jumlah Level Tertingi" type="number" step="0.01" class="form-control" required="">
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="radio2" class="col-sm-6 col-form-label">Merasa Malu Saat Kalah bermain game (*)</label>
                                <div class="col-sm-6">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input name="9" value="1" type="radio" class="form-check-input" required=""> Tidak
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="9" value="2" type="radio" class="form-check-input" required="">Iya
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label">
                                            <input name="9" value="3" type="radio" class="form-check-input" required="">Kadang-kadang
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                @csrf
                                <a href="{{ url('.') }}" class="mt-1 btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                <button type="reset" class="mt-1 btn btn-warning"><i class="fa fa-undo mr-2"></i>Reset</button>
                                <button type="submit" class="mt-1 btn btn-primary"><i class="fa fa-paper-plane mr-2"></i>Prediksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    const demo = document.querySelector("#scroll-perfect-custom");
    const ps = new PerfectScrollbar(demo);

    $(document).ready(function() {
        $(".ps__rail-x").css("display", "none");
        $(".ps__rail-y").css("z-index", "1031");
    
        @if (session()->get('sts'))
            swal.fire({
                title: 'Sukses',
                text: 'Hasil prediksi anda adalah {{ (session()->get('jml_r')>session()->get('jml_b')?"Ringan":"Berat") }}',
                type: 'success',
                showConfirmButton: true
            });
        @endif
    })
</script>
@endsection
@extends('layouts.admin')
@section('style')
<style type="text/css" media="screen">
    section {
        min-height: 420px;
    }
</style>
@endsection
@section('prediction','active')
@section('mo-prediction','menu-open')
@section('tambah','active')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"> 
        <h1 class="m-0 text-dark">Tambah Data</h1>
      </div>
    </div>
  </div>
</div>

<section class="container">
    <div class="container-fluid">
        <div id="scroll-perfect-custom" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container">
                            Prediksi Tingkat Bermain Game Pada Anak 
                            @if($jmlDt==0)
                                <button class="btn btn-success mx-2" type="button" data-toggle="modal" data-target="#import">Import</button>
                            @endif
                            @if($jmlDt!=0)
                            <form action="{{ route('set-k') }}" method="get">
                                <div class="mt-3 row form-group">
                                    <div class="col-12 input-group">
                                        <label class="pr-5 input-group-text text-left">Masukan Nilai K</label>
                                        <input type="number"
                                        class="form-control" name="k" id="k" aria-describedby="helpk" placeholder="Masukan Nilai K" value="{{ $k }}">
                                        {{-- <span class="input-group-text"> --}}
                                            <button for="k" type="submit" id="setK" class="btn  btn-sm mx-1 btn-primary">SET <i class="fa fa-arrow-right ml-1" aria-hidden="true"></i></button>
                                        {{-- </span> --}}
                                    </div>
                                    <div class="col-12">
                                        <small id="helpk" class="form-text text-muted">Nilai K ini akan digunakan disemua form prediksi. (<i><strong>Penting : </strong>Nilai K yang disarankan adalah bilangan ganjil</i>)</small>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>

                        <div class="card-body">
                            @if($jmlDt==0)
                                <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="mb-2">Mohon maaf saat ini system belum bisa melakukan <strong>Prediksi</strong>, silahkan import data test terlebih dahulu!!</p>
                                </div>
                            @endif
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

                            {{-- Question --}}
                            @if($jmlDt!=0)
                                <form method="POST" id="addP" action="{{ route('prediction.store') }}" enctype="multipart/form-data">
                                    <h5 class="card-title">(*) Wajib Diisi</h5>
                                    <input type="hidden"
                                        class="form-control" name="k" id="k2" aria-describedby="helpk" placeholder="Masukan Nilai K" value="{{ $k }}">
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
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                        <button type="reset" class="mt-1 btn btn-warning"><i class="fa fa-undo mr-2"></i>Reset</button>
                                        <button type="submit" class="mt-1 btn btn-primary"><i class="fa fa-paper-plane mr-2"></i>Prediksi</button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center">
                                    <strong class="text-danger">Tambah data belum bisa dilakukan!!</strong>
                                </div>
                            @endif
                            {{-- end question --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Modal --}}
<div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importData" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" id="importData">Import Data</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('import') }}" id="form-import" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body bg-light">
                <div class="form-group">
                  <input type="file"
                    class="form-control pt-3 pb-5" name="import-data" id="import-data" aria-describedby="desInput" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"multiple required>
                    <input type="hidden" name="dt_type" value="trainDT">
                  <small id="desInput" class="form-text text-muted">File excel yang diupload adalah format 97-2003 workbook (.xls) dan Microsoft Excel Worksheet(.xlsx)</small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button id="btn-import" type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#k').change(function(){
            $('#k2').val($(this).val());
        })
        $('#form-import').submit(function(e){
            $('#btn-import').attr('disabled',true);
        });
        $('#addP').submit(function(e){
            $('#addP button[type=submit]').attr('disabled',true);
        });
        @if(session()->get('sts'))
        swal.fire({
            title: 'Sukses',
            text: 'Hasil prediksi anda adalah {{ (session()->get('jml_r') > session()->get('jml_b')?"Ringan":"Berat") }}',
            icon: 'success',
            showConfirmButton: true,
        });
        @endif
        @if(session()->get('stsImport'))
            swal.fire({
                title: 'Selamat',
                text: 'Data berhasil diimport',
                icon: 'success',
                showConfirmButton: false,
                timer:1500
            });
        @endif
    })
</script>
@endsection
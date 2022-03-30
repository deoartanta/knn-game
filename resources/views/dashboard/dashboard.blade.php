@extends('layouts.admin')
@section('dashboard','active')

@section('content')
<section class="content" style="padding-top: 10px;">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h5 class="my-0">Input Data Kuesioner</h5>
      </div>
      <div class="card-body">
        <div class="row justify-content-md-center">
          <div class="col-lg-12">
            <div class="container main-card mb-3">
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
                    <button type="reset" class="mt-1 btn btn-warning mr-2"><i class="fa fa-undo mr-2"></i>Reset</button>
                    <button type="submit" class="mt-1 btn btn-primary"><i class="fa fa-paper-plane mr-2"></i>Prediksi</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $dt_eval->count() }}</h3>
            <p>Total Data</p>
          </div>
          <div class="icon">
            <i class="fas fa-pencil-alt    "></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $akurasi }}<sup style="font-size: 20px">%</sup></h3>
            <p>Accuracy</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $presisi }}<sup style="font-size: 20px">%</sup></h3>
            <p>Precission</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $recall }}<sup style="font-size: 20px">%</sup></h3>
            <p>Recall</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $F_Rate }}<sup style="font-size: 20px">%</sup></h3>
            <p>F Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $F1_score }}<sup style="font-size: 20px">%</sup></h3>
            <p>F1 Score</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $spesi }}<sup style="font-size: 20px">%</sup></h3>
            <p>Specificity</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $auc }}</h3>
            <p>AUC/(Area Under Curver)</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
  </div>
  </div>
  @endsection
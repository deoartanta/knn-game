@extends('layouts.admin')
@section('dashboard','active')

@section('content')
<section class="content" style="padding-top: 10px;">
    <div class="container-fluid">
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
      <div class="col-lg-12">
        <div class="small-box bg-light">
          <div class="row">
            <div class="col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Persiapan Data</h5>
                        <p>Persiapan ini adalah tahap awal untuk melakukan klasifikasi menggunakan algoritma k-NN, yaitu persiapan <i> Training Data </i> dan <i> Normalisasi Training Data </i> </p>

                        <p><span class="badge badge-success">1</span> Persiapkan data di menu <span class="badge badge-primary"><i class="fa fa-database mr-1" aria-hidden="true"></i>Training Data</span>  kemudian pilih submenu <b>Evaluation Data</b>, atau langsung menekan tombol <span class="badge badge-success"><i class="fa fa-upload mr-1" aria-hidden="true"> Import</i></span> di submenu <b> Tambah </b> pada menu <span class="badge badge-info"><i class="fa fa-star mr-1" aria-hidden="true"></i>Prediction</span> (<span class="text-danger"><strong>Catatan : </strong>tombol import tersebut akan tampil jika belum ada <i>Training Data</i> yang ditambahkan</span>)</p>

                        <p><span class="badge badge-success">2</span> Lakukan impor data berupa <i>Excel</i> sesuai templat yang di unduh pada tombol <span class="badge badge-success"><i class="fa fa-upload" aria-hidden="true"> Import</i></span> Dan Jangan Lupa <i>Unduh Template Excelnya Terlebih Dahulu</i></p>

                        <p><span class="badge badge-success">3</span> Selanjutnya lakukan perhitungan di submenu <b> Normalisasi data </b> pada menu <span class="badge badge-info"><i class="fa fa-star mr-1" aria-hidden="true"></i>Prediction</span></p>

                    </div>
                </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Test Evaluasi k-NN</h5>
                            <p>Jika sudah mempersiapkan data, langkah selanjutnya adalah melakukan klasifikasi tingkat bermain game pada anak yang dianalisis menggunakan algoritma k-NN</p>
                            <p><span class="badge badge-info">1</span> Persiapkan data di menu <span class="badge badge-primary"><i class="fa fa-server mr-1" aria-hidden="true"></i></i>Test Data</span> kemudian pilih submenu <b> Evaluation Data </b></p>
                            
                            <p><span class="badge badge-info">2</span> Lakukan import data berupa <i>Excel</i> sesuai templat yang di unduh pada tombol <span class="badge badge-success"><i class="fa fa-upload" aria-hidden="true"> Import</i></span> Dan Jangan Lupa <i>Unduh Template Excelnya Terlebih Dahulu</i></p>
                            <p><span class="badge badge-info">3</span> Selanjutnya lakukan perhitungan pada tombol <span class="badge badge-info"><i class="fa fa-calculator mr-1" aria-hidden="true"></i> Hitung k-NN</span> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Settings Users</h5>
                        <p>Digunakan untuk menambah, mengedit dan menghapus data pengguna yang memungkinkan untuk mengakses Sistem</p>
                        <p><span class="badge badge-warning">1</span> Pilih menu <span class="badge badge-warning"><i class="fa fa-id-card mr-1" aria-hidden="true"></i>Users Settings</span></p>
                        <p><span class="badge badge-warning">2</span> Lakukan manajemen user sesuai kebutuhan</b></p>
                        <p><span class="badge badge-warning">3</span> Jika ingin keluar Sistem, pilih menu  <span class="badge badge-danger"><i class="fas fa-power-off mr-1" aria-hidden="true"></i>LOGOUT</span> pada sidebar kanan</p>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Ketentuan Sistem</h5>
                        <p><span class="badge badge-danger">1</span> <b>Penting</b> untuk melakukan Tahap Pertama Persiapan Data</p>
                        <p><span class="badge badge-danger">2</span> <b>Penting</b> untuk melakukan Tes Evaluasi Algoritma k-NN di submenu <b>Test Data</b> pada menu <span class="badge badge-primary"><i class="fas fa-book-open mr-1"></i>Evaluation Data</span></p>
                        <p><span class="badge badge-danger">3</span> Menu <b>Hasil Perhitungan</b> Akan tampil jika sudah melakukan <b>Tahap Pertama </b> dan <b>Tahap Kedua</b> </p>
                  </div>
                </div>
            </div>
        </div>
        </div>
      </div>
{{-- 
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
      </div> --}}

    </div>
  </div>
  </div>
  @endsection
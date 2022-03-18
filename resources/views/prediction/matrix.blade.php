@extends('navbar.nav')

@section('style')
<style type="text/css" media="screen">
    section {
        min-height: 420px;
    }
</style>
@endsection
@section('judul1','Confution Matrix | ')
@section('matrix','active')
@section('content1')
    <section id="matrix">
        <div id="scroll-perfect-custom" class="position-relative " style="height: 100vh;">
            <div class="tab-pane tabs-animation fade show mt-5" id="tab-content-1" role="tabpanel">
            <div class="row mt-5">
                <div class="col-lg-6 mt-5">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Evaluation Table</h5>
                            <table class="mb-0 table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Variable</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><b>Accuracy</b></td>
                                        <td><div class="badge badge-success">{{ $akurasi }} %</div></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><b>Precission</b></td>
                                        <td><div class="badge badge-warning">{{ $presisi }} %</div> </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><b>Recall</b></td>
                                        <td><div class="badge badge-info">{{ $recall }} %</div> </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><b>F Rate</b></td>
                                        <td><div class="badge badge-danger">{{ $F_rate }} %</div> </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><b>F1 Score</b></td>
                                        <td><div class="badge badge-warning">{{ $F1_score }} %</div> </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><b>Specificity</b></td>
                                        <td><div class="badge badge-info">{{ $spesi }} %</div> </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><b> </b></td>
                                        <td><div class="badge badge-success">{{ $auc }}</div> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Confusion Matrix Table</h5>
                            <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jumlah = {{ $data->count() }} </th>
                                        <th>Kelas Berat</th>
                                        <th>Kelas Ringan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Kelas Berat</b></td>
                                        <td><font color="blue"><b>{{ $bb }}</b></font></td>
                                        <td>{{ $br }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Kelas Ringan</b></td>
                                        <td>{{ $rb }}</td>
                                        <td><font color="blue"><b>{{ $rr}}</b></font></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>N = {{ $bb+$rb }}</td>
                                        <td>N = {{ $br+$rr }}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
        })
    </script>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Normalisasi;
use App\Models\Prediction;
use App\Models\DtEvals;
use App\Models\Question;
use App\Http\Controllers\PredictionController;

class analyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtEvals = DtEvals::all();
        $pred_controll = new PredictionController;
        // $pred_controll->normalisasi($dtEvals,Prediction::all());
        // $pred_controll->hitung(false,$dtEvals);
        $data = $this->createConfutionMatrix();
        $data['data']=$dtEvals;
        return (view()->exists('prediction.matrix'))?view('prediction.matrix',$data):'';
    }
    public function evalDTPage(){
        $data['data_eval']=[];
        $data['data_pred']=Prediction::leftJoin('dt_evals','dt_evals.no','=','pred_datas.no_data')
                            ->select('dt_evals.*','pred_datas.*')->get();
                            // dd($data['data_pred']->first());
        $data['question']=Question::all();
        // $data['n_data']=Normalisasi::all();
        return (view()->exists('prediction.eval-data'))?view('prediction.eval-data',$data):'';
    }
    public function normalizeDTPage(){
        $pred_controll = new PredictionController;
        $pred_controll->normalisasi(DtEvals::all(),Prediction::all());
        $data['data_eval']=DtEvals::all();
        $data['data_pred']=Prediction::all();
        $data['question']=Question::all();
        $data['n_data']=Normalisasi::all();
        return (view()->exists('prediction.n-data'))?view('prediction.n-data',$data):'';
    }
    public function createConfutionMatrix(){
        $dtEvals = DtEvals::all();        
        $bb=0;$br=0;$rb=0;$rr=0;$kk=0;$jml_k = $dtEvals->count()>0?$dtEvals->first()->jml_k:0;
        foreach ($dtEvals as $key => $val) {
            if($val->kelas==$val->kelas_prediksi){
                if($val->kelas==0){
                    $rr++;
                }else if($val->kelas==1){
                    $bb++;
                }
            }else{
                if($val->kelas==0){
                    $rb++;
                }else if($val->kelas==1){
                    $br++;
                }else if($val->kelas_prediksi==null){
                    $kk++;
                }
            }
        }
        if ($dtEvals->count()>0) {
            $berat = $bb+$rr;
            $tidak_Berat = $br+$rb+$kk;
            $jumlah_uji = $dtEvals->count();

            $F_Rate = ($tidak_Berat/$jumlah_uji==0?1:$jumlah_uji)*100;
            $F_Rate     = round($F_Rate,2);

            $akurasi    = ($berat/$jumlah_uji)*100;
            $akurasi    = round($akurasi,2);

            $presisi    = ($bb/(($bb + $br)!=0?($bb + $br):1))*100;
            $presisi    = round($presisi,2);

            $recall     = ($bb/(($bb + $rb)!=0?($bb + $rb):1))*100;
            $recall     = round($recall);

            $F1_score   = 2*($presisi*$recall)/(($presisi+$recall)!=0?($presisi+$recall):1);
            $F1_score   = round($F1_score,2);

            $spesi      =  ($rr /(($rr + $br)!=0?($rr + $br):1))*100;
            $spesi      = round($spesi,2);
    
            $auc        = (($recall+$spesi)/2);
            $auc        = round($auc,2);
        }else{
            $berat = $bb+$rr;
            $tidak_Berat = $br+$rb+$kk;
            $jumlah_uji = $dtEvals->count();

            $F_Rate = 0;
            $F_Rate = round($F_Rate,2);

            $akurasi = 0;
            $akurasi = round($akurasi,2);

            $presisi = 0;
            $presisi = round($presisi,2);

            $recall = 0;
            $recall = round($recall);

            $F1_score = 0;
            $F1_score = round($F1_score,2);

            $spesi = 0;
            $spesi = round($spesi,2);

            $auc = 0;
            $auc = round($auc,2);
        }
        $data=[
            'bb'=>$bb,
            'br'=>$br,
            'rb'=>$rb,
            'rr'=>$rr,
            'F_Rate'=>$F_Rate,
            'akurasi'=>$akurasi,
            'presisi'=>$presisi,
            'recall'=>$recall,
            'F1_score'=>$F1_score,
            'spesi'=>$spesi,
            'auc'=>$auc
        ];
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAlert ($title,$message,$type) {
        $swal = "<script type='text/javascript'>";

        $swal .="swal.fire({";
        $swal .="title: '".$title."',";
        $swal .="text:'".$message."',";
        $swal .="type: '".$type."',";
        $swal .="showConfirmButton: true";
        // $swal .="allowOutsideClick: false,";
        // $swal .="allowEscapeKey: false";

        $swal .="});</script>";
        return $swal;
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

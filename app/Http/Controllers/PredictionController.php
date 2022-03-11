<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db_dt_evals = new DtEvals;
        $prediction = new Prediction;
        $dt_evals = $db_dt_evals->get();
        // return $this->hitung(90);
        // return $dt_evals;
       return (view()->exists('prediction.index'))?view('prediction.index'):'';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $db_dt_evals = new DtEvals;
        // $dt_evals = $db_dt_evals->get();
        // return $dt_evals;
        return (view()->exists('prediction.index'))?view('prediction.index'):'';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keyadd=[];
        $keyall=[];
        $i=0;
        $db_dt_evals = new DtEvals;
        $dt_evals = $db_dt_evals->get();
        $no_data = ($dt_evals->count()+1);

        $jml_qu = Question::all()->count();
        $prediction = new Prediction;
        // $dist = $this->hitung($request,$dt_evals)->get();
        // return $this->normalisasi($dt_evals,$prediction->get());

        $db_dt_evals->no = $no_data;
        $db_dt_evals->kelas = 0;
        $db_dt_evals->jml_k = 3;
        $db_dt_evals->save();


        foreach ($request->all() as $key => $value) {
            if ($i<$jml_qu) {    
                $keyadd['qu_id']= $i+1;
                $keyadd['no_data']= $no_data;
                $keyadd['value']= $value;
                $keyall [$i]=$keyadd;

            }
            
            $i++;
        }
        $prediction = new Prediction;
        $prediction->insert($keyall);
        return redirect('prediction');
        // $no = 0;
        // $jml_r = 0;
        // $jml_b = 0;
        // foreach ($dist as $key => $val) {
        //    if ($no<$db_dt_evals->jml_k) {
        //        if ($val->kelas==0) {
        //            $jml_r++;
        //        } else if($val->kelas==1){
        //            $jml_b++;
        //        }
               
        //    }
        //    $no++;
        // }
        // echo $jml_r<$jml_b?"Kelas Berat":"Kelas Ringan";
        // return $dist ;
    }
    public function hitung($request,$dt_evals){
        // $akar = sqrt(9);
        
        // return $request->input(''.strval(8));
        Distances::truncate();
        foreach ($dt_evals as $ev) {
            $data = Prediction::all()
                ->where('no_data',$ev->no);
            $dt_hsl_jml = 0;
            foreach ($data as $key => $val) {
                $dtNew = $request->input($val->qu_id);
                $dtOld = $val->value;
                $dt_hsl_kurang = $dtNew-$dtOld;
                $dt_hsl_jml += pow($dt_hsl_kurang,2);
            }
            $dt_hsl_akar = sqrt($dt_hsl_jml);
            $dist = new Distances;
            $dist->no_data = $ev->no;
            $dist->nilai = $dt_hsl_akar;
            $dist->kelas = $ev->kelas;
            $dist->save();
        }
        return Distances::orderBy('nilai', 'ASC');
    }
    public function  normalisasi($dt_evals,$prediction){
        Normalisasi::truncate();
        $jml_dt = 0;
        // $jml_dt1 = 0;
        foreach ($prediction as $key => $val) {
            $pred_max = $prediction->where('qu_id',$val->qu_id)->max('value');
            $pred_min = $prediction->where('qu_id',$val->qu_id)->min('value');
            echo "ID =>".$val->qu_id."</br>";
            echo "Max =>".$pred_max."</br>";
            echo "Min =>".$pred_min."</br>";
            $jml_dt1 = 0;
            if($pred_max>2){
                echo "(".$val->value."-".$pred_min.")/(".$pred_max."-".$pred_min.")";
                echo " = ".($val->value-$pred_min)/($pred_max-$pred_min)."</br>";
                $value = ($val->value-$pred_min)/($pred_max-$pred_min);
            }else{
                if($val->value ==1 ){
                    echo "Value ".$val->value." = 0</br>";
                    $value = 0;
                }else{
                    echo "Value ".$val->value." = 1</br>";
                    $value = 1;
                }
            }
            $nor = new Normalisasi;
            $nor->prediction_dt_id = $val->id;
            $nor->val_normalisasi = $value;
            $nor->save();
            $jml_dt1++;
            echo "</br>";
            $jml_dt++;
        }
        // echo $prediction->;
        return Prediction::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function show(Prediction $prediction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function edit(Prediction $prediction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prediction $prediction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prediction $prediction)
    {
        //
    }
}

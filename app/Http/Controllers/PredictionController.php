<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use App\Http\Controllers\analyticController;
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
       return ((view()->exists('prediction.index'))?view('prediction.index'):'');
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
        return ((view()->exists('prediction.index'))?view('prediction.index'):'');
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
        $analyticControl = new analyticController;
        $db_dt_evals = new DtEvals;
        $dt_evals = $db_dt_evals->get();
        $no_data = ($dt_evals->count()+1);


        $jml_qu = Question::all()->count();
        $prediction = new Prediction;

        // $pred_dt = $this->normalisasi($dt_evals,$prediction->get());
        // $dist = $this->hitung(false,$dt_evals);
        // return $dist;
        // die();

        $jmlD_ringan= $dt_evals->where('kelas','0')->count();
        $jmlD_berat= $dt_evals->where('kelas','1')->count();
        $jml_k_tmp = ($jmlD_ringan<$jmlD_berat?$jmlD_ringan:$jmlD_berat);
        $jml_k = (($jml_k_tmp%2)==0?($jml_k_tmp+1):$jml_k_tmp);
        
        $db_dt_evals->no = $no_data;
        $db_dt_evals->save();                
        $up_dt_evals = DtEvals::where('jml_k','<>','0')->update(['jml_k'=>$jml_k]);
        
        
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
        $pred_dt = $this->normalisasi($dt_evals,$prediction->get());
        $dist = $this->hitung(true,$dt_evals);

        $no = 0;
        $jml_r = 0;
        $jml_b = 0;
        foreach ($dist as $key => $val) {
            if ($no<$jml_k) {
                if ($val->kelas==0) {
                    $jml_r++;
                } else if($val->kelas==1){
                    $jml_b++;
                }
                
            }
            $no++;
        }
        // echo $jml_r<$jml_b?"Kelas Berat":"Kelas Ringan";
        // echo '</br> Jumlah Ringan='.$jml_r.'</br> Jumlah Berat='.$jml_b;
        $db_dt_evals->kelas = $jml_r<$jml_b?1:0;
        $db_dt_evals->jml_k = $jml_k;
        $db_dt_evals->save();
        // return $dist ;
        return redirect()->back()->with([
                            'sts'=>true,
                            'jml_r'=>$jml_r,
                            'jml_b'=>$jml_b,
                            'jml_k'=>$jml_k,
                        ]);
    }
    public function hitung($new_dt,$dt_evals){
        $return =null;
        if ($new_dt){
            Distances::truncate();
            $dt_eval_last = $dt_evals->last();
            foreach ($dt_evals->where('no','<>',$dt_eval_last->no) as $ev) {
                $data_new = Prediction::all()
                        ->where('no_data',$dt_eval_last->no);
                $data = Prediction::all()
                        ->where('no_data',$ev->no)
                        ->where('no_data','<>',$dt_eval_last->no);
                $dt_hsl_jml = 0;
                foreach ($data as $key => $val) {
                    $dtNew_id = $data_new->where('qu_id',$val->qu_id)->first()
                            ->id;
                    $dtOld_id = $val->id;
                    $dtNew_val = Normalisasi::all()
                                ->where('prediction_dt_id',$dtNew_id)
                                ->first()->val_normalisasi;
                    $dtOld_val = Normalisasi::all()
                                ->where('prediction_dt_id',$dtOld_id)
                                ->first()->val_normalisasi;
                    $dt_hsl_kurang = $dtNew_val-$dtOld_val;
                    $dt_hsl_jml += pow($dt_hsl_kurang,2);
                }
                $dt_hsl_akar = sqrt($dt_hsl_jml);
                $dist = new Distances;
                $dist->no_data = $ev->no;
                $dist->nilai = $dt_hsl_akar;
                $dist->kelas = $ev->kelas;
                $dist->save();
            }
            $return = Distances::orderBy('nilai', 'ASC')->get();
        }else{
            $pred_dt = Prediction::all();
            $normals_dt = Normalisasi::all();
            $hsl_hitung_dt=0;
            foreach ($dt_evals as $key => $val_evals) {
                // echo '</br> No Data = '.$val_evals->no.'</br>';
            // foreach ($pred_dt->where('no_data',1) as $key => $val_pred) {
                // $hsl_hitung_dt=0;
                // echo '<================Start Data ('.$val_evals->no.')=============></br>';
                Distances::truncate();
                foreach ($dt_evals as $key => $val_evals2) {
                    // echo '==>Normalisasi Data '.$val_evals2->no.'</br>';
                        $hsl_hitung_dt = 0;
                        foreach ($pred_dt->where('no_data',$val_evals2->no) as $key => $val_pred2) {
                            // $hsl_hitung_dt=0;
                            $normalisasi = $normals_dt->where('prediction_dt_id',$val_pred2->id)->first();
                            $pred_data = $pred_dt->where('no_data',$val_evals->no)->where('qu_id',$val_pred2->qu_id)->first();
                            $hsl_hitung_dt +=pow($normalisasi->val_normalisasi-$pred_data->value,2);

                            // echo '===>>D'.$val_pred2->no_data.'Qn'.$val_pred2->qu_id.' - D'.$pred_data->no_data.'Q'.$pred_data->qu_id.'</br>';
                        }
                        $dt_hsl_akar = sqrt($hsl_hitung_dt);
                        // echo 'Hasil Hitung=>'.$hsl_hitung_dt.'</br>';
                        // echo 'Hasil Hitung Akar=>'.$dt_hsl_akar.'</br>';
                        $dist = new Distances;
                        $dist->no_data = $val_evals2->no;
                        $dist->nilai = $dt_hsl_akar;
                        $dist->kelas = $val_evals2->kelas;
                        $dist->save();
                    }
                    $no = 0;
                    $jml_r = 0;
                    $jml_b = 0;
                    $total = 0;
                    foreach (Distances::orderBy('nilai', 'ASC')->get() as $key => $val_dist) {
                        if ($no<$val_evals2->jml_k) {
                            if ($val_dist->kelas==0) {
                                $jml_r++;
                            } else if($val_dist->kelas==1){
                                $jml_b++;
                            }
                            $total +=$val_dist->kelas;
                            // echo "</br>total + ".$val_dist->kelas."=>".$total."</br>";
                            // echo "</br>jumlah K =>".$val_evals2->jml_k."</br>";
                        
                        }
                        $no++;
                    }
                    // echo '</br> Jumlah Ringan='.$jml_r.'</br> Jumlah Berat='.$jml_b;
                    // $hsl_akhir = $total/$val_evals->jml_k;
                    $kelas = $jml_r>$jml_b?0:1;
                    $update_DtEvals = DtEvals::find($val_evals->id);
                    $update_DtEvals->kelas_prediksi = $kelas;
                    $update_DtEvals->save();
                    // echo "Hasil Akhir==>".$hsl_akhir."</br> Kelas =>".$kelas."</br>";
                }
                // echo '</br>Hasil Perhitungan => '.$hsl_hitung_dt;
                // echo '</br>Akar Perhitungan => '.sqrt($hsl_hitung_dt);
            // }
            $return = Distances::orderBy('nilai', 'ASC')->get();

        }
        return $return;
    }
    public function  normalisasi($dt_evals,$prediction){
        Normalisasi::truncate();
        $jml_dt = 0;
        // $jml_dt1 = 0;
        foreach ($prediction as $key => $val) {
            $pred_max = $prediction->where('qu_id',$val->qu_id)->max('value');
            $pred_min = $prediction->where('qu_id',$val->qu_id)->min('value');
            // echo "ID =>".$val->qu_id."</br>";
            // echo "Max =>".$pred_max."</br>";
            // echo "Min =>".$pred_min."</br>";
            $jml_dt1 = 0;
            // if($pred_max>2){
                // echo "(".$val->value."-".$pred_min.")/(".$pred_max."-".$pred_min.")";
                // echo " = ".($val->value-$pred_min)/($pred_max-$pred_min)."</br>";
                $value = ($val->value-$pred_min)/($pred_max-$pred_min);
            // }else{
            //     if($val->value ==1 ){
            //         // echo "Value ".$val->value." = 0</br>";
            //         $value = 0;
            //     }else{
            //         // echo "Value ".$val->value." = 1</br>";
            //         $value = 1;
            //     }
            // }
            $nor = new Normalisasi;
            $nor->prediction_dt_id = $val->id;
            $nor->val_normalisasi = $value;
            $nor->save();
            $jml_dt1++;
            // echo "</br>";
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

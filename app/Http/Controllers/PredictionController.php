<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use App\Http\Controllers\analyticController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $prediction = new Prediction;

        $dt_evals = $db_dt_evals->get();
        $no_data = ($dt_evals->count()+1);

        $jml_qu = Question::all()->count();

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
        $db_dt_evals->kelas = $jml_r<$jml_b?1:0;
        $db_dt_evals->jml_k = $jml_k;
        $db_dt_evals->save();

        return redirect()->back()->with([
                            'sts'=>true,
                            'jml_r'=>$jml_r,
                            'jml_b'=>$jml_b,
                            'jml_k'=>$jml_k,
                     ]);
    }
    public function hitung($new_dt,$dt_evals){
        $return =null;
        $data_all = Prediction::all();
        $norm_all = Normalisasi::all();
        $dt_eval_all = new DtEvals;
        $dt_eval_add = [];
        $dt_eval_all_arr = [];

        $dist = new Distances;
        if ($new_dt){
            Distances::truncate();
            $dt_eval_last = $dt_evals->last();
            $dist_add = [];
            $dist_all_arr = [];
            $i = 0;
            foreach ($dt_evals->where('no','<>',$dt_eval_last->no) as $ev) {
                $data_new=$data_all->where('no_data',$dt_eval_last->no);
                $data = $data_all
                        ->where('no_data',$ev->no)
                        ->where('no_data','<>',$dt_eval_last->no);
                $dt_hsl_jml = 0;
                foreach ($data as $key => $val) {
                    $dtNew_id = $data_new->where('qu_id',$val->qu_id)->first()
                            ->id;
                    $dtOld_id = $val->id;
                    $dtNew_val = $norm_all
                                ->where('prediction_dt_id',$dtNew_id)
                                ->first()->val_normalisasi;
                    $dtOld_val = $norm_all
                                ->where('prediction_dt_id',$dtOld_id)
                                ->first()->val_normalisasi;
                    $dt_hsl_kurang = $dtNew_val-$dtOld_val;
                    $dt_hsl_jml += pow($dt_hsl_kurang,2);
                }
                $dt_hsl_akar = sqrt($dt_hsl_jml);
                $dist_add['no_data']=$ev->no;
                $dist_add['nilai']=$dt_hsl_akar;
                $dist_add['kelas']=$ev->kelas;
                $dist_all_arr[$i]=$dist_add;
                $i++;
            }
            $dist->insert($dist_all_arr);
            $return = Distances::orderBy('nilai', 'ASC')->get();
        }else{
            $hsl_hitung_dt=0;
            $i = 1;
            foreach ($dt_evals as $key => $val_evals) {
                Distances::truncate();
                $i1 = 0;
                foreach ($dt_evals as $key => $val_evals2) {
                        $hsl_hitung_dt = 0;
                        foreach ($data_all->where('no_data',$val_evals2->no) as $key => $val_pred2) {
                            $normalisasi = $norm_all->where('prediction_dt_id',$val_pred2->id)->first();
                            $pred_data = $data_all->where('no_data',$val_evals->no)->where('qu_id',$val_pred2->qu_id)->first();
                            $hsl_hitung_dt +=pow($normalisasi->val_normalisasi-$pred_data->value,2);
                        }
                        $dt_hsl_akar = sqrt($hsl_hitung_dt);
                        $dist_add['no_data']=$val_evals2->no;
                        $dist_add['nilai']=$dt_hsl_akar;
                        $dist_add['kelas']=$val_evals2->kelas;
                        $dist_all_arr[$i1]=$dist_add;
                        $i1++;
                    }
                    $dist->insert($dist_all_arr);
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
                        }
                        $no++;
                    }
                    $kelas = $jml_r>$jml_b?0:1;
                    $dt_eval_add['kelas_prediksi'] = $kelas;
                    $dt_eval_all_arr[$i++] = $dt_eval_add;
                }
                foreach ($dt_eval_all_arr as $key => $value) {
                    $dt_eval_all = DtEvals::find($key)->update($value);
                }
            $return = Distances::orderBy('nilai', 'ASC')->get();

        }
        return $return;
    }
    public function  normalisasi($dt_evals,$prediction){
        Normalisasi::truncate();
        $jml_dt = 0;
        $norm_add = [];
        $norm_all_arr = [];
        $nor = new Normalisasi;
        foreach ($prediction as $key => $val) {
            $pred_max = $prediction->where('qu_id',$val->qu_id)->max('value');
            $pred_min = $prediction->where('qu_id',$val->qu_id)->min('value');
            
            $jml_dt1 = 0;
            $value = ($val->value-$pred_min)>0?($val->value-$pred_min)/($pred_max-$pred_min):0;;
            $norm_add['prediction_dt_id'] =$val->id;
            $norm_add['val_normalisasi'] =$value;
            $norm_all_arr[$jml_dt]= $norm_add;
            $jml_dt1++;
            $jml_dt++;
        }
        $nor->insert($norm_all_arr);
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

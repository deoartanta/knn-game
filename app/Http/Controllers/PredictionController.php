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
        $data['jmlDt'] = $prediction->get()->count();
        // return $this->hitung(90);
        // return $dt_evals;
       return ((view()->exists('prediction.index'))?view('prediction.index',$data):'');
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
        $jml_k = ((($jml_k_tmp>3?$jml_k_tmp/2:$jml_k_tmp)%2)==0?($jml_k_tmp+1):$jml_k_tmp);
        
        $db_dt_evals->no = $no_data;
        $db_dt_evals->save();        
        $up_dt_evals = DtEvals::where('jml_k','<>','-1')->update(['jml_k'=>$jml_k]);
        
        
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
        $db_dt_evals = new DtEvals;
        $db_dt_evals = $db_dt_evals->get()->last();

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
    public function create_jmlK($k){
        $db_dt_evals = new DtEvals;
        $dt_evals = $db_dt_evals->get();
        // dd($dt_evals->last()->jml_k===null);
        // if($dt_evals->last()->jml_k===null){
            $jmlD_ringan= $dt_evals->where('kelas','0')->count();
            $jmlD_berat= $dt_evals->where('kelas','1')->count();
            $jml_k_tmp = ($jmlD_ringan<$jmlD_berat?$jmlD_ringan:$jmlD_berat); 
            $jml_k_tmp = $jml_k_tmp%2==0?$jml_k_tmp:$jml_k_tmp-1;
            $jml_k_tmp = ($jml_k_tmp>3?$jml_k_tmp/2:$jml_k_tmp);
            $jml_k=(($jml_k_tmp%2)==0?($jml_k_tmp+1):$jml_k_tmp);
            $up_dt_evals = DtEvals::where('kelas','<>',null)->update(['jml_k'=>($k!=null?$k:$jml_k)]);
            // dd($jml_k);
        // }
    }
    public function createKelas($data,$dt_bru){
        $dist = new Distances;
        $ques = Question::all();
        $dt_norm_arr = [];
        $no = 0;
        $i = 0;
        $dt_hsl_kurang = 0;
        $dt_hsl_jml= 0;
        $dt_hsl_akar = 0;
        $dist_add = [];
        $dist_all_arr = [];
        $arrNewDt = $data;
        if($dt_bru){
            // dd($arrNewDt);
            $dt_evals = Prediction::leftJoin('dt_evals','dt_evals.no','pred_datas.no_data')->select('dt_evals.id as id_eval','pred_datas.id as id_pred','pred_datas.no_data as no_pred','dt_evals.no as no_eval','dt_evals.kelas','dt_evals.kelas_prediksi','dt_evals.jml_k','pred_datas.qu_id','pred_datas.value')->get();
            $dt_norm =
            Normalisasi::leftJoin('pred_datas','pred_datas.id','normalisasi.prediction_dt_id')->select('normalisasi.val_normalisasi as val_norm','normalisasi.prediction_dt_id as id_pred')->get();
            foreach ($dt_norm as $key => $val) {
                $dt_norm_arr[$val->id_pred] = [
                    'id'=>$val->id_pred,
                    'val'=>$val->val_norm,
                ];
            };
            $dist->truncate();
            foreach ($dt_evals as $ev) {
                if($ev->no_eval!=$arrNewDt->no_data){
                        $dt_hsl_kurang = $dt_norm_arr[$ev->id_pred]['val']-$dt_norm_arr[$arrNewDt->id]['val'];
                        $dt_hsl_jml =$dt_hsl_jml + pow($dt_hsl_kurang,2);
                        // echo $dt_norm_arr[$ev->id_pred]['val']."-".$dt_norm_arr[$arrNewDt->id]['val'] ."=".($dt_norm_arr[$ev->id_pred]['val']-$dt_norm_arr[$arrNewDt->id]['val']);
                        // echo $dt_hsl_jml.";";
                        if($i==($ques->count()-1)){
                            $i=-1;
                            $dt_hsl_akar = sqrt($dt_hsl_jml);
                            $dist_add['no_data']=$ev->no_eval;
                            $dist_add['nilai']=$dt_hsl_akar;
                            $dist_add['kelas']=$ev->kelas;
                            // dd($dist_add['kelas']);
                            $dist_all_arr[$no]=$dist_add;
                            // echo "==".$dt_hsl_akar.'<=>'.$dt_hsl_jml.'</br>';
                            $dt_hsl_jml = 0;
                            $no++;
                        };
                    $i++;
                }
            }
            $dist->insert($dist_all_arr);
            // dd(Distances::orderBy('nilai', 'ASC')->get());
        }else{
            $dist->truncate();
            $dt_evals = $arrNewDt['dt_evals'];
            foreach ($dt_evals as $ev) {
                if($ev->no_eval!=$arrNewDt['dt_hitung_kelas_prediksi']->no_eval){
                    $dt_hsl_kurang = $ev->val_norm-$arrNewDt[$ev->qu_id]['val_norm'];
                    // echo
                    // $ev->val_norm."-".$arrNewDt[$ev->qu_id]['val_norm']."=".($ev->val_norm-$arrNewDt[$ev->qu_id]['val_norm'])."</br>";
                    
                    $dt_hsl_jml +=pow($dt_hsl_kurang,2);
                    // echo ($dt_hsl_jml)."=$dt_hsl_jml + pow($dt_hsl_kurang,2)</br>";
                    // echo $dt_hsl_jml.";";
                        // echo "---------------".$ev->no_eval."----------------";
                        // echo "</br></br>";
                    if($i==($ques->count()-1)){
                        $i=-1;
                        $dt_hsl_akar = sqrt($dt_hsl_jml);
                        $dist_add['no_data']=$ev->no_eval;
                        $dist_add['nilai']=$dt_hsl_akar;
                        $dist_add['kelas']=$ev->kelas;
                        // dd($dist_add['kelas']);
                        $dist_all_arr[$no]=$dist_add;
                        // echo "==".$dt_hsl_akar.'<=>'.$dt_hsl_jml.'</br>';
                        $dt_hsl_jml = 0;
                        $no++;
                    };
                    $i++;
                }
            }
            // dd($dt_evals);
            // dd($dist_all_arr);
            $dist->insert($dist_all_arr);
        }
        return Distances::orderBy('nilai', 'ASC')->get();
    }
    public function hitung($new_dt,$data){
        $return =null;
        $pred_dt = new Prediction;
        // $dt_evals = $data['dt_evals'];
        // $norm_all = Normalisasi::all();
        // $dt_eval_all = new DtEvals;
        // $dt_eval_add = [];
        // $dt_eval_all_arr = [];

        // $dist = new Distances;
        if ($new_dt==true){
            $data['dt_new'] = $pred_dt->get()->last();
            
            $return = $this->createKelas($data['dt_new'],$new_dt);
        }else{
            // $hsl_hitung_dt=0;
                // $i = 1;
                // foreach ($dt_evals as $key => $val_evals) {
                //     Distances::truncate();
                //     $i1 = 0;
                //     foreach ($dt_evals as $key => $val_evals2) {
                //             $hsl_hitung_dt = 0;
                //             foreach ($data_all->where('no_data',$val_evals2->no) as $key => $val_pred2) {
                //                 $normalisasi = $norm_all->where('prediction_dt_id',$val_pred2->id)->first();
                //                 $pred_data = $data_all->where('no_data',$val_evals->no)->where('qu_id',$val_pred2->qu_id)->first();
                //                 $hsl_hitung_dt +=pow($normalisasi->val_normalisasi-$pred_data->value,2);
                //             }
                //             $dt_hsl_akar = sqrt($hsl_hitung_dt);
                //             $dist_add['no_data']=$val_evals2->no;
                //             $dist_add['nilai']=$dt_hsl_akar;
                //             $dist_add['kelas']=$val_evals2->kelas;
                //             $dist_all_arr[$i1]=$dist_add;
                //             $i1++;
                //         }
                //         $dist->insert($dist_all_arr);
                //         $no = 0;
                //         $jml_r = 0;
                //         $jml_b = 0;
                //         $total = 0;
                //         foreach (Distances::orderBy('nilai', 'ASC')->get() as $key => $val_dist) {
                //             if ($no<$val_evals2->jml_k) {
                //                 if ($val_dist->kelas==0) {
                //                     $jml_r++;
                //                 } else if($val_dist->kelas==1){
                //                     $jml_b++;
                //                 }
                //                 $total +=$val_dist->kelas;
                //             }
                //             $no++;
                //         }
                //         $kelas = $jml_r>$jml_b?0:1;
                //         $dt_eval_add['kelas_prediksi'] = $kelas;
                //         $dt_eval_all_arr[$i++] = $dt_eval_add;
            //     }
            if(true){
                $pred_dt = Prediction::leftJoin('dt_evals','dt_evals.no','pred_datas.no_data')
                ->leftJoin('normalisasi','pred_datas.id','normalisasi.prediction_dt_id')
                ->select('dt_evals.id as id_eval','pred_datas.id as id_pred',
                    'pred_datas.no_data as no_pred','dt_evals.no as no_eval',
                    'dt_evals.kelas','dt_evals.kelas_prediksi','dt_evals.jml_k','pred_datas.qu_id',
                    'pred_datas.value','normalisasi.val_normalisasi as val_norm');
                $jml_pred_dt =$pred_dt->get()->count();
                $pred_all_dt = $pred_dt->get();
                $data['sts'] = true;
                if ($data['no_data']==1) {
                    $this->create_jmlK($data['k']);
                    $jml_norm = Normalisasi::all()->count();
                    $jml_pred_dt =$pred_dt->count();
                    if($jml_norm!=$jml_pred_dt){
                        $data['sts'] = false;
                        $data['msg'] = "Ada data baru yang belum dinormalisasikan!!";
                        return $data;
                    }else{
                        $data['sts'] = true;
                    }
                }
                foreach ($pred_dt->where('no',$data['no_data'])->get() as $key => $val) {
                    $data['dt_hitung_kelas_prediksi'] = $val;
                    $data['dt_evals'] = $pred_all_dt;
                    $data[$val->qu_id] = ['val_norm'=>$val->val_norm];
                    // dd($data);
                }
                $jml_r = 0;
                $jml_b = 0;
                $dist = $this->createKelas($data,false);
                foreach ($dist as $key_dist => $val_dist) {
                if (($key_dist)<$data['k']) {
                        if ($val_dist->kelas==0) {
                            $jml_r++;
                        } else if($val_dist->kelas==1){
                            $jml_b++;
                        }
                    }
                }
                $i_q = 1;
                $db_dt_evals = new DtEvals;
                $db_dt_evals = $db_dt_evals->where('no',$val->no_eval)->first();
                $db_dt_evals->kelas_prediksi = $jml_r < $jml_b ? 1 : 0 ;
                $db_dt_evals->save();
                $data['val_norm'] = [];
                $data['dt_evals'] = null;
                $data['dt_evals_next'] = $data['no_data']+1;
                // dd($db_dt_evals.'=>('.$jml_r.','.$jml_b.')');
                // dd($jml_r<$jml_b?1:0);

            }else{
                $this->create_jmlK($data['k']);
                $jml_quest = Question::all()->count();
                $i_q = 1;
                $jml_norm = Normalisasi::all()->count();
                $pred_dt = Prediction::leftJoin('dt_evals','dt_evals.no','pred_datas.no_data')
                ->leftJoin('normalisasi','pred_datas.id','normalisasi.prediction_dt_id')
                ->select('dt_evals.id as id_eval','pred_datas.id as id_pred','pred_datas.no_data as no_pred','dt_evals.no as no_eval','dt_evals.kelas','dt_evals.kelas_prediksi','dt_evals.jml_k','pred_datas.qu_id','pred_datas.value','normalisasi.val_normalisasi as val_norm')->get();
                $jml_norm = Normalisasi::all()->count();
                $jml_pred_dt =$pred_dt->count();
                $data['sts'] = true;
                if($jml_norm!=$jml_pred_dt){
                    $data['sts'] = false;
                    $data['msg'] = "Ada data baru yang belum dinormalisasikan!!";
                }else{
                    $data['sts'] = true;
                }
                
                foreach ($pred_dt as $key => $val) {
                    $data['dt_hitung_kelas_prediksi'] = $val;
                    $data['dt_evals'] = $pred_dt;
                    $data[$val->qu_id] = ['val_norm'=>$val->val_norm];
                    // dd($data);
                    $jml_r = 0;
                    $jml_b = 0;
                    
                    if($i_q++==$jml_quest){
                        $dist = $this->createKelas($data,false);
                        foreach ($dist as $key_dist => $val_dist) {
                        if (($key_dist)<$val->jml_k) {
                                if ($val->kelas==0) {
                                    $jml_r++;
                                } else if($val->kelas==1){
                                    $jml_b++;
                                }
                            }
                        }
                        $i_q = 1;
                        $db_dt_evals = new DtEvals;
                        $db_dt_evals = $db_dt_evals->where('no',$val->no_eval)->first();
                        $db_dt_evals->kelas_prediksi = $jml_r < $jml_b ? 1 : 0 ;
                        $db_dt_evals->save();
                        dd($jml_r.",".$jml_b.",".($jml_r<$jml_b?1:0));
                        $data['val_norm'] = [];
                        // dd($db_dt_evals);
                        // dd($db_dt_evals.'=>('.$jml_r.','.$jml_b.')');
                        // dd($jml_r<$jml_b?1:0);
                    }
                }
            }
            $return = $data;
            
        }
        // dd($return);

        return $return;
    }

    public function  normalisasi($dt_evals,$prediction){
        Normalisasi::truncate();
        $jml_dt = 0;
        $norm_add = [];
        $norm_all_arr = [];
        $nor = new Normalisasi;
        $dt_pred_vall_arr =[];
        foreach ($prediction as $key => $val) {
            $dt_pred_vall_arr[$val->qu_id][$val->id] = $val->value;
        }
        foreach ($prediction as $key => $val) {
            $pred_max = max($dt_pred_vall_arr[$val->qu_id]);
            $pred_min = min($dt_pred_vall_arr[$val->qu_id]);
            
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

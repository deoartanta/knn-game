<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use App\Models\importData;
use App\Models\exportData;
use App\Imports\ImportDTLatih;
use App\Exports\ExportDTLatih;
use Session;
use App\Http\Controllers\analyticController;
use App\Http\Controllers\PredictionController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $pred_dt, $dt_evals, $analytic_controll, $pred_controll;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->pred_dt = new Prediction;
        $this->dt_evals = new DtEvals;
        $this->pred_controll = new PredictionController;
        $this->analytic_controll = new analyticController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->level == 1) {
            // $this->pred_controll->normalisasi($this->dt_evals->get(), $this->pred_dt->get());
            // $this->pred_controll->hitung(false, $this->dt_evals->get());
            $data = $this->analytic_controll->createConfutionMatrix();
            $data['user'] = Auth::user();
            $data['pred_dt'] = $this->pred_dt->get();
            $data['dt_eval'] = $this->dt_evals->where('dt_type','testDT')->get();
            // dd($data);
            return view('dashboard.dashboard', $data);
        } else {
            return redirect('/');
        }
    }
    public function confutionMatrix()
    {
        return $this->analytic_controll->index();
    }

    public function normalizeData()
    {
        // $dist = new Distances;
        // $dt_norm_arr = [];        
        // $this->pred_controll->hitung(false, $data);
        return $this->analytic_controll->normalizeDTPage();
    }
    public function normalizeDataLatih()
    {
        // $dist = new Distances;
        // $dt_norm_arr = [];        
        // $this->pred_controll->hitung(false, $data);
        return $this->analytic_controll->normalizeDTLatihPage();
    }
    public function analisDataOne(Request $req,$no_data){
        $dt_bru = $req->input('dt_bru')=='false'?false:true;
        // dd($req->input("progress")+1);
        
        $data['no_data'] = $no_data;
        $data['k'] = $req->input('k');
        // return $data['k'];
        $data['type'] = $req->input('type');
        $data['dt_type'] = $req->input('dt_type');
        if($data['type']=="all"){
            $hsl = $this->pred_controll->hitung($dt_bru, $data);
            $data['DtEvals'] = DtEvals::all()->where('dt_type',$data['dt_type']);
            $jml_dt = $data['DtEvals']->count();
            $data['no_data_next'] = $no_data+1;
            $data['progress_max'] = $jml_dt;
        }else{
            $data['DtEvals'] = DtEvals::all()
                            ->where('kelas_prediksi','<>','0')
                            ->where('kelas_prediksi',null)
                            ->where('dt_type',$data['dt_type']);
            $jml_dt = $data['DtEvals']->count();
            $data['no_data_next'] = $data['DtEvals']->count()!=0?$data['DtEvals']->first()->no:$jml_dt+1;
            $data['progress_max'] = $req->input("progress_max");
            $data['no_data'] = $data['no_data_next'];
            $hsl = $this->pred_controll->hitung($dt_bru, $data);
        }
        $data['progress'] = $req->input("progress")+1;
        $data['sts'] = $hsl['sts'];
        $data['msg'] = $hsl['sts']?"Perhitungan berhasil":$hsl['msg'];
        return json_encode($data);
    }
    public function analisData(Request $req){
        $data = [];
        switch ($req->input('aksi')) {
            case 'n-data':
                
                $this->pred_controll->normalisasi($this->dt_evals->where('dt_type',$req->input('dt_type'))->get(),
                $this->pred_dt->get());

                $data['sts'] = true;
                $data['msg'] = "Normalisasi sukses";

                break;
                
            case 'h-data':        
                $dt_bru = $req->input('dt_bru')=='false'?false:true;
                // $data['dt_evals'] = $this->dt_evals->get();
                $data['no_data'] = null;
                $data['type'] = null;
                $data['dt_type'] = $req->input('dt_type');
                $hsl = $this->pred_controll->hitung($dt_bru, $data);
                $data['sts'] = $hsl['sts'];
                $data['msg'] = $hsl['sts']?"Perhitungan berhasil":$hsl['msg'];
                break;

            default:
                $data['sts'] = false;
                $data['msg'] = "Tidak ada aksi";
                break;
        }
        return json_encode($data);
    }

    public function evalData()
    {
        return $this->analytic_controll->evalDTPage();
    }
    public function evalDataLatih()
    {
        return $this->analytic_controll->evalDTLatihPage();
    }
    public function tambahData()
    {
        $data['jmlDt'] = $this->dt_evals->where('dt_type','trainDT')->get()->count();
        if(Session::get('stsImport')!=null){
            $data['stsImport'] = Session::get('stsImport');
            return view('prediction.admin-index', $data)->with(['stsImport'=>Session::get('stsImport')]);
        }else{
            return view('prediction.admin-index', $data);
        }

    }
    public function destroyDtUji($dt_type){
        // dd($dt_type);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Normalisasi::leftJoin('pred_datas','normalisasi.prediction_dt_id','=','pred_datas.id')
        ->leftJoin('dt_evals','dt_evals.no','=','pred_datas.no_data')
        ->where('dt_type',$dt_type)->delete();
        Prediction::leftJoin('dt_evals','dt_evals.no','=','pred_datas.no_data')
        ->where('dt_type',$dt_type)->delete();
        DtEvals::where('dt_type',$dt_type)->delete();
        // foreach ($del_evalsdDt->get() as $key => $val) {
        //     $del_predDt = $this->pred_dt->where('no_data',$val->no);
        //     $del_predDt->delete();
        //     // dd($del_predDt);
        // }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $return['stsDel'] = true;

        return redirect()->back()->with($return);
    }
    public function exportData($dt_type){
        // $insert = $this->exportDtToTbl($dt_type);
        // return Excel::download(new ExportDTLatih, 'data_uji.xlsx');

        $pred_dt = $this->pred_dt->get();
        $dt_evals = $this->dt_evals->where('dt_type',$dt_type)->get();
        $dt_qu = new Question;
        $dt_arr = [];
        $dt_arr_all = [];
        $heading = [];
        $heading[0] = "No";
        foreach ($dt_qu->get() as $key => $val) {
            $heading[$key+1] = "Q".$val->id;
        }
        $heading[$dt_qu->count()+1] = "Kelas";
        // dd($heading);
        $no_qu = 0;
        foreach ($dt_evals as $key => $val) {
            $dt_arr[0] = $key+1;
            foreach ($pred_dt as $key1 => $val1) {
                if ($val1->no_data==$val->no) {
                    $dt_arr[($no_qu+1)] = $val1->value;
                    if($no_qu==$dt_qu->count()){
                        $no_qu = 0;
                        break;
                    }
                    $no_qu++;
                }
            }
            $dt_arr[$dt_qu->count()+1] = $val->kelas==0?"Ringan":"Berat";
            // $dt_arr["created_at"] = $val->created_at;
            // $dt_arr["updated_at"] = $val->updated_at;
            $dt_arr_all[$key+1] = $dt_arr;
        }
        // dd($dt_arr_all);
        
        return Excel::download(new ExportDTLatih($dt_arr_all,$heading), 'data_uji.xlsx');;
    }
    public function importData(Request $request)
    {
        importData::truncate();
        // validasi
		// $valid = $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);
        // dd($valid);
        // die();
 
		// menangkap file excel
		$file = $request->file('import-data');
		$dt_type = $request->input('dt_type');
        $ext = pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION);
        // dd($ext);
		// membuat nama file unik
		// $nama_file = rand().$file->getClientOriginalName();
		$nama_file = 'dtImportTerbaru.'.$ext;
 
		// upload ke folder file_siswa di dalam folder public
        $dir = $dt_type =='testDT'?'file_dt_uji':'file_dt_latih';
		$file->move($dir,$nama_file); 
 
        $data['jmlDt'] = $this->pred_dt->get()->count();
        $data['sts_msg'] = true;
        $data['msg'] = "Sukses import data";
        Excel::import(new ImportDTLatih,public_path('/'.$dir.'/'.$nama_file));
        
        $return = [];
        if($this->importDtToDb($dt_type)->count()>0){
            $return['stsImport'] = true;
        }else{
            $return['stsImport'] = false;
        }
        // return importData::all();
        
        return redirect()->back()->with($return);
    }
    function exportDtToTbl($dt_type){
        exportData::truncate();
        $pred_dt = $this->pred_dt->get();
        $dt_evals = $this->dt_evals->where('dt_type',$dt_type)->get();
        $dt_qu = new Question;
        $dt_arr = [];
        $dt_arr_all = [];
        $no_qu = 1;
        foreach ($dt_evals as $key => $val) {
            foreach ($pred_dt as $key1 => $val1) {
                if ($val1->no_data==$val->no) {
                    $dt_arr["q".$no_qu] = $val1->value;
                    if($no_qu==$dt_qu->count()){
                        $no_qu = 1;
                        break;
                    }
                    $no_qu++;
                }
            }
            $dt_arr["kelas"] = $val->kelas;
            $dt_arr["created_at"] = $val->created_at;
            $dt_arr["updated_at"] = $val->updated_at;
            $dt_arr_all[$key] = $dt_arr;
        }
        $insert = exportData::insert($dt_arr_all);
        return $insert;
    }
    function importDtToDb($dt_type){
        $dtImport = importData::all();
        $pred_dt = $this->pred_dt->get();
        $dt_evals = $this->dt_evals->get();
        $dt_qu = new Question;
        $dt_evalsArr = [];
        $pred_dtArr = [];
        $dt_evalsArr_all = [];
        $pred_dtArr_all = [];
        $no = ($dt_evals->count());
        // dd($no);
        $no_qu = 0;
        foreach ($dtImport as $key => $val) {
            $dt_evalsArr['no'] = ($no+1);
            $dt_evalsArr['dt_type'] = $dt_type;
            $dt_evalsArr['kelas'] = $val->kelas;
            $dt_evalsArr_all[$no] = $dt_evalsArr;
            $val_for_data[1]=$val->q1;
            $val_for_data[2]=$val->q2;
            $val_for_data[3]=$val->q3;
            $val_for_data[4]=$val->q4;
            $val_for_data[5]=$val->q5;
            $val_for_data[6]=$val->q6;
            $val_for_data[7]=$val->q7;
            $val_for_data[8]=$val->q8;
            $val_for_data[9]=$val->q9;
            foreach ($dt_qu->get() as $key1 => $val1) {
                $pred_dtArr['qu_id'] = $val1->id;
                $pred_dtArr['no_data'] = ($no+1);
                $pred_dtArr['value'] = $val_for_data[$val1->id];
                $pred_dtArr_all[$no_qu] = $pred_dtArr;
                $no_qu++;
            }
            $no++;
        }
        $this->dt_evals->insert($dt_evalsArr_all);
        $this->pred_dt->insert($pred_dtArr_all);
        return Prediction::all();
    }
}

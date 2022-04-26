<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use App\Models\importData;
use App\Imports\ImportDTLatih;
use Session;
use App\Http\Controllers\analyticController;
use App\Http\Controllers\PredictionController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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
            $data['dt_eval'] = $this->dt_evals->get();
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
    public function analisDataOne(Request $req,$no_data){
        $dt_bru = $req->input('dt_bru')=='false'?false:true;
        $jml_dt = $this->dt_evals->count();
        // dd($req->input("progress")+1);
        
        $data['no_data'] = $no_data;
        $data['k'] = $req->input('k');
        // return $data['k'];
        $data['type'] = $req->input('type');
        if($data['type']=="all"){
            $hsl = $this->pred_controll->hitung($dt_bru, $data);
            $data['DtEvals'] = DtEvals::all();
            $data['no_data_next'] = $no_data+1;
            $data['progress_max'] = $jml_dt;
        }else{
            $data['DtEvals'] = DtEvals::all()
                            ->where('kelas_prediksi','<>','0')
                            ->where('kelas_prediksi',null);
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
                
                $this->pred_controll->normalisasi($this->dt_evals->get(), $this->pred_dt->get());

                $data['sts'] = true;
                $data['msg'] = "Normalisasi sukses";

                break;
                
            case 'h-data':        
                $dt_bru = $req->input('dt_bru')=='false'?false:true;
                // $data['dt_evals'] = $this->dt_evals->get();
                $data['no_data'] = null;
                $data['type'] = null;
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
    public function tambahData()
    {
        $data['jmlDt'] = $this->pred_dt->get()->count();
        if(Session::get('stsImport')!=null){
            $data['stsImport'] = Session::get('stsImport');
            return view('prediction.admin-index', $data)->with(['stsImport'=>Session::get('stsImport')]);
        }else{
            return view('prediction.admin-index', $data);
        }

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
        $ext = pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION);
        // dd($ext);
		// membuat nama file unik
		// $nama_file = rand().$file->getClientOriginalName();
		$nama_file = 'dtImportTerbaru.'.$ext;
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_dt_latih',$nama_file);
 
        $data['jmlDt'] = $this->pred_dt->get()->count();
        $data['sts_msg'] = true;
        $data['msg'] = "Sukses import data";
        Excel::import(new ImportDTLatih,public_path('/file_dt_latih/'.$nama_file));
        
        $return = [];
        if($this->importDtToDb()->count()>0){
            $return['stsImport'] = true;
        }else{
            $return['stsImport'] = false;
        }
        // return importData::all();
        
        return redirect()->route('tambah')->with($return);
    }
    function importDtToDb(){
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

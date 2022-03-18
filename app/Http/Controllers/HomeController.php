<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prediction;
use App\Models\Distances;
use App\Models\DtEvals;
use App\Models\Question;
use App\Models\Normalisasi;
use App\Http\Controllers\analyticController;
use App\Http\Controllers\PredictionController;
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
            $this->pred_controll->normalisasi($this->dt_evals->get(), $this->pred_dt->get());
            $this->pred_controll->hitung(false, $this->dt_evals->get());
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
        return $this->analytic_controll->normalizeDTPage();
    }

    public function evalData()
    {
        return $this->analytic_controll->evalDTPage();
    }
}

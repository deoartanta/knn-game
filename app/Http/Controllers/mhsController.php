<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mhsController extends Controller
{
    public function index(){
    	// $data = array('	d' => 	'Deo' );
    	$data = array(
    					'title' =>'Mahasiswa',
    					'data'=>[
    						['Bayu Aji Saputra','19236677'],
    						['Deo Artanta','19201299'],
    						['Syaiful Ramadhan','28976544'],
    						['Fiqih Vandy','20896756'],
    						['Shohib Habibullah','20182988']
    					]

    			);
    	return view('mahasiswa')->with($data);
    }
    public function profil(){
        
    	$nama = 'Deo Artanta';
		$ig = str_replace(" ", "", "$nama");
		
        return view('profil.profilmhs',['nama'=>$nama,'ig'=>$ig]);
    }

    public function pf(){
        return view('portfolio.pf');
    }
}

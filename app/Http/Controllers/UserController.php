<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cekEmail(){
        $msg = "";
        $sts = false;
        if(isset($_POST['email'])){
            $email =$_POST['email'];
            $sts = true;
        }else{
            $msg = "Internal Server Error";
            $sts = false;
        }
        if($sts){
            $user = User::all()->where('email',$email);
            if ($user->count()>0) {
                $sts=false;
                $msg = 'Email already used, please create a new one';
            }else{
                $sts=true;
                $msg = 'Looks good!';
            }
        }
        $result = [
            'sts'=>$sts,
            'msg'=>$msg
        ];
        return json_encode($result);
    }
    public function index()
    {
        $data['data'] = User::All();
        return (view()->exists('user.index')) ? view('user.index', $data) : '';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input(['password'])),
            'level' => $request->input('level')
        ]);
        return redirect()->back();
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
        if ($request->input('nama')!=null) {
            $data['name'] = $request->input('nama');
        }
        if ($request->input('email')!=null) {
            $data['email'] = $request->input('email');
        }
        if ($request->input('password')!=null) {
            if($request->input('password')!='passwordtetep'){
                $data['password'] = $request->input('password');
            }
        }
        if ($request->input('level')!=null) {
            $data['level'] = $request->input('level');
        }
        $user = User::find($id);
        $user->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}

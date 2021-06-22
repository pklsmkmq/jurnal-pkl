<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\walsan;
use App\Models\User;
use Validator;

class walsanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = walsan::with('santri')->get();
        return view('layouts/walsan/walsan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = santri::get();
        return view('layouts/walsan/addWalsan',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cekNisn = santri::where('nisn',$request->santri_nisn)->first();

        // if(!$cekNisn){
        //     return ["result"=>"Nisn tidak ditemukan"];
        // }

        $rules = array(
            "santri_nisn"=>"required|unique:walsan",
            "nama_walsan"=>"required",
            "email_walsan"=>"required|email|unique:walsan",
            "telepon_walsan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addWalsan')->with('warning',$errorString);
        }else{
            $cekUser = user::where('email',$request->email_walsan)->first();
            if($cekUser){
                return redirect()->route('addWalsan')->with('warning',"The email has already been taken.");    
            }

            $data = new walsan;
            $data->santri_nisn = $request->santri_nisn;
            $data->nama_walsan = $request->nama_walsan;
            $data->email_walsan = $request->email_walsan;
            $data->telepon_walsan = $request->telepon_walsan;

            $result = $data->save();
            if ($result) {
                $dataUser = new User;
                $dataUser->name = $request->nama_walsan;
                $dataUser->email = $request->email_walsan;
                $dataUser->password = bcrypt("walsansmkmq2021");
                $dataUser->status = "walsan";
                $resultUser = $dataUser->save();
                if($resultUser){
                    return redirect()->route('walsan')->with('success',"Data Berhasil Tersimpan");
                }else{
                    return redirect()->route('walsan')->with('error',"Data Gagal Tersimpan");
                }
            }else{
                return redirect()->route('walsan')->with('error',"Data Gagal Tersimpan");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = walsan::where('id',$id)->with('santri')->first();
        if ($data) {
            return ["result"=>$data];
        } else {
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = walsan::where('id',$id)->with('santri')->first();
        $santri = santri::get();
        if ($data) {
            return view('layouts/walsan/editWalsan',[
                'data'=>$data,
                'santri'=>$santri
            ]);
        }else{
            return abort(404);
        }
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
        $updateEmail = false;
        $cekId = walsan::where('id',$id)->first();
        if(!$cekId){
            return redirect()->route('walsan')->with('error',"ID tidak ditemukan");
        }

        $rules = array(
            "santri_nisn"=>"required",
            "nama_walsan"=>"required",
            "email_walsan"=>"required|email",
            "telepon_walsan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('editWalsan')->with('warning',$errorString);
        }else{
            if($request->email_walsan != $cekId->email_walsan){
                $cekEmail = walsan::where('email_walsan',$request->email_walsan)->first();
                if(!$cekEmail){
                    $updateEmail = true;
                    $cekUser = user::where('email',$request->email_walsan)->first();
                    if(!$cekUser){
                        $updateUser = user::where('email',$cekId->email_walsan)->first();
                        $updateUser->email = $request->email_walsan;
                        $resultUpdate = $updateUser->save();
                    }else{
                        return redirect()->route('editWalsan',$id = $cekId->id)->with('warning',"The email has already been taken.");    
                    }
                }else{
                    return redirect()->route('editWalsan',$id = $cekId->id)->with('warning',"The email has already been taken.");
                }
            }

            $data = $cekId;
            $data->santri_nisn = $request->santri_nisn;
            $data->nama_walsan = $request->nama_walsan;
            $data->email_walsan = $request->email_walsan;
            $data->telepon_walsan = $request->telepon_walsan;

            $result = $data->save();
            if ($result) {
                return redirect()->route('pembimbing')->with('success',"Data Berhasil Terubah");
            }else{
                return redirect()->route('pembimbing')->with('error',"Data Gagal Terubah");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = walsan::where('id',$id)->first();
        
        if($data){
            $email = $data->email_walsan;
            if($data->delete()){
                $deleteEmail = user::where('email',$email)->first();
                if($deleteEmail){
                    if ($deleteEmail->delete()) {
                        return redirect()->route('walsan')->with('success',"Berhasil Menghapus Data");
                    } else {
                        return redirect()->route('walsan')->with('error',"Gagal Menghapus Data");
                    }
                }else{
                    return redirect()->route('walsan')->with('error',"Gagal Menghapus Data");
                }
            }else{
                return redirect()->route('walsan')->with('error',"Gagal Menghapus Data");
            }
        }else{
            return abort(404);
        }
    }
}
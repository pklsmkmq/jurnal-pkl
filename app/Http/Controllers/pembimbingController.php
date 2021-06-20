<?php

namespace App\Http\Controllers;
use App\Models\santri;
use App\Models\pembimbing;
use App\Models\User;
use Validator;

use Illuminate\Http\Request;

class pembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pembimbing::get();
        return view('layouts/pembimbing/pembimbing',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/pembimbing/addPembimbing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            "nama_pembimbing"=>"required",
            "email_pembimbing"=>"required|email|unique:pembimbing",
            "telepon_pembimbing"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addPembimbing')->with('warning',$errorString);
        }else{
            $cekUser = user::where('email',$request->email_pembimbing)->first();
            if($cekUser){
                return redirect()->route('addPembimbing')->with('warning',"The email has already been taken.");    
            }

            $data = new pembimbing;
            $data->nama_pembimbing = $request->nama_pembimbing;
            $data->email_pembimbing = $request->email_pembimbing;
            $data->telepon_pembimbing = $request->telepon_pembimbing;

            $result = $data->save();
            if ($result) {
                $dataUser = new User;
                $dataUser->name = $request->nama_pembimbing;
                $dataUser->email = $request->email_pembimbing;
                $dataUser->password = bcrypt("gurusmk2021");
                $dataUser->status = "pembimbing";
                $resultUser = $dataUser->save();
                if($resultUser){
                    return redirect()->route('pembimbing')->with('success',"Data Berhasil Tersimpan");
                }else{
                    return redirect()->route('pembimbing')->with('error',"Data Gagal Tersimpan");
                }
            }else{
                return redirect()->route('pembimbing')->with('error',"Data Gagal Tersimpan");
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
        $data = pembimbing::where('id',$id)->first();
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
        $data = pembimbing::where('id',$id)->first();
        if ($data) {
            return view('layouts/pembimbing/editPembimbing',compact('data'));
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
        $cekId = pembimbing::where('id',$id)->first();
        if(!$cekId){
            return redirect()->route('pembimbing')->with('error',"ID tidak ditemukan");
        }

        $rules = array(
            "nama_pembimbing"=>"required",
            "email_pembimbing"=>"required|email",
            "telepon_pembimbing"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('editPembimbing')->with('warning',$errorString);
        }else{
            if($request->email_pembimbing != $cekId->email_pembimbing){
                $cekEmail = pembimbing::where('email_pembimbing',$request->email_pembimbing)->first();
                if(!$cekEmail){
                    $updateEmail = true;
                    $cekUser = user::where('email',$request->email_pembimbing)->first();
                    if(!$cekUser){
                        $updateUser = user::where('email',$cekId->email_pembimbing)->first();
                        $updateUser->email = $request->email_pembimbing;
                        $resultUpdate = $updateUser->save();
                    }else{
                        return redirect()->route('editPembimbing',$id = $cekId->id)->with('warning',"The email has already been taken.");    
                    }
                }else{
                    return redirect()->route('editPembimbing',$id = $cekId->id)->with('warning',"The email has already been taken.");
                }
            }

            $data = $cekId;
            $data->nama_pembimbing = $request->nama_pembimbing;
            $data->email_pembimbing = $updateEmail == false ? $cekId->email_pembimbing : $request->email_pembimbing;
            $data->telepon_pembimbing = $request->telepon_pembimbing;

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
        $data = pembimbing::where('id',$id)->first();
        
        if($data){
            $email = $data->email_pembimbing;
            if($data->delete()){
                $deleteEmail = user::where('email',$email)->first();
                if($deleteEmail){
                    if ($deleteEmail->delete()) {
                        return redirect()->route('pembimbing')->with('success',"Berhasil Menghapus Data");
                    } else {
                        return redirect()->route('pembimbing')->with('error',"Gagal Menghapus Data");
                    }
                }else{
                    return redirect()->route('pembimbing')->with('error',"Gagal Menghapus Data");
                }
            }else{
                return redirect()->route('pembimbing')->with('error',"Gagal Menghapus Data");
            }
        }else{
            return abort(404);
        }
    }

    public function listSiswa($id)
    {
        $cekId = pembimbing::where('id',$id)->first();
        
        if($cekId){
            $data = pembimbing::where('id',$id)->with('santri')->first();
            if($data){
                return ["result"=>$data];    
            }else{
                return ["result"=>"Data Gagal Ditampilkan"];
            }
        }else{
            return ["result"=>"ID tidak ditemukan"];
        }
    }
}
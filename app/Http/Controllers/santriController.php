<?php

namespace App\Http\Controllers;

use App\Models\santri;
use Illuminate\Http\Request;
use Validator;
use App\Imports\santriImport;
use App\Imports\userImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\pembimbing;
use App\Models\jurnal;
use Auth;

class santriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->status == "admin"){
            $dt = santri::get();
            $data = array();
            foreach ($dt as $key) {
                $cek = jurnal::where('santri_nisn', $key->nisn)->count();
                $key->jumlah = $cek;
                array_push($data,$key);
            }
            return view('layouts/santri/santri',compact('data'));
        }elseif (Auth::user()->status == "pembimbing") {
            $email = Auth::user()->email;
            $pembimbing = pembimbing::where('email_pembimbing',$email)->first();
            $dt = santri::where('pembimbing_id',$pembimbing->id)->get();
            $dataPT = santri::where('pembimbing_lapangan_1',$pembimbing->id)->orWhere('pembimbing_lapangan_2',$pembimbing->id)->get();
            $data = array();
            foreach ($dt as $key) {
                $cek = jurnal::where('santri_nisn', $key->nisn)->count();
                $key->jumlah = $cek;
                array_push($data,$key);
            }
            return view('layouts/santri/santri',[
                "data"=>$data,
                "dataPT"=>$dataPT
            ]);
        }else {
            return abort(404);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->cekAdmin();
        $data = pembimbing::get();
        return view('layouts/santri/addSantri',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cekAdmin();
        $rules = array(
            "nisn"=>"required|unique:santri",
            "nama_santri"=>"required",
            "email_santri"=>"required|email|unique:santri",
            "telepon_santri"=>"required",
            "kelas_santri"=>"required",
            "perusahaan_santri"=>"required",
            "daerah_perusahaan_santri"=>"required",
            "pembimbing_id"=>"required",
            "pembimbing_lapangan_1"=>"required",
            "pembimbing_lapangan_2"=>"required",
            "angkatan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addSantri')->with('warning',$errorString);
        }else{
            $cekUser = user::where('email',$request->email_santri)->first();
            if($cekUser){
                return redirect()->route('addSantri')->with('warning',"The email santri has already been taken.");    
            }

            $data = new santri;
            $data->nisn = $request->nisn;
            $data->nama_santri = $request->nama_santri;
            $data->email_santri = $request->email_santri;
            $data->telepon_santri = $request->telepon_santri;
            $data->kelas_santri = $request->kelas_santri;
            $data->perusahaan_santri = $request->perusahaan_santri;
            $data->daerah_perusahaan_santri = $request->daerah_perusahaan_santri;
            $data->pembimbing_id = $request->pembimbing_id;
            $data->pembimbing_lapangan_1 = $request->pembimbing_lapangan_1;
            $data->pembimbing_lapangan_2 = $request->pembimbing_lapangan_2;
            $data->angkatan = $request->angkatan;

            $result = $data->save();
            if ($result) {
                $dataUser = new User;
                $dataUser->name = $request->nama_santri;
                $dataUser->email = $request->email_santri;
                $dataUser->password = bcrypt("pklsmkmq2021");
                $dataUser->status = "santri";
                $resultUser = $dataUser->save();
                if($resultUser){
                    return redirect()->route('santri')->with('success',"Data Berhasil Tersimpan");
                }else{
                    return redirect()->route('santri')->with('error',"Data Gagal Tersimpan");
                }
            }else{
                return redirect()->route('santri')->with('error',"Data Gagal Tersimpan");
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
        $this->cekAdmin();
        $data = santri::where('nisn',$id)->first();
        
        if($data){
            return ["result"=>$data];
        }else{
            return ["result"=>"Nisn tidak ditemukan"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($santri)
    {
        $this->cekAdmin();
        $data = santri::where('nisn',$santri)->first();
        $pemb = pembimbing::get();
        
        if($data){
            return view('layouts/santri/editSantri',[
                'data'=>$data,
                'pemb'=>$pemb
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
        $this->cekAdmin();
        $updateEmail = false;
        $cekNisn = santri::where('nisn',$id)->first();

        if(!$cekNisn){
            return redirect()->route('santri')->with('error',"Nisn tidak ditemukan");
        }

        $rules = array(
            "nama_santri"=>"required",
            "email_santri"=>"required|email",
            "telepon_santri"=>"required",
            "kelas_santri"=>"required",
            "perusahaan_santri"=>"required",
            "daerah_perusahaan_santri"=>"required",
            "pembimbing_id"=>"required",
            "pembimbing_lapangan_1"=>"required",
            "pembimbing_lapangan_2"=>"required",
            "angkatan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('editSantri',$nisn = $cekNisn->nisn)->with('warning',$errorString);
        }else{
            if($request->email_santri != $cekNisn->email_santri){
                $cekEmail = santri::where('email_santri',$request->email_santri)->first();
                if(!$cekEmail){
                    $updateEmail = true;
                    $cekUser = user::where('email',$request->email_santri)->first();
                    if(!$cekUser){
                        $updateUser = user::where('email',$cekNisn->email_santri)->first();
                        $updateUser->email = $request->email_santri;
                        $resultUpdate = $updateUser->save();
                    }else{
                        return redirect()->route('editSantri',$nisn = $cekNisn->nisn)->with('warning',"The email santri has already been taken.");    
                    }
                }else{
                    return redirect()->route('editSantri',$nisn = $cekNisn->nisn)->with('warning',"The email santri has already been taken.");
                }
            }

            $data = $cekNisn;
            $data->nama_santri = $request->nama_santri;
            $data->email_santri = $updateEmail == false ? $cekNisn->email_santri : $request->email_santri ;
            $data->telepon_santri = $request->telepon_santri;
            $data->kelas_santri = $request->kelas_santri;
            $data->perusahaan_santri = $request->perusahaan_santri;
            $data->daerah_perusahaan_santri = $request->daerah_perusahaan_santri;
            $data->pembimbing_id = $request->pembimbing_id;
            $data->pembimbing_lapangan_1 = $request->pembimbing_lapangan_1;
            $data->pembimbing_lapangan_2 = $request->pembimbing_lapangan_2;
            $data->angkatan = $request->angkatan;

            $result = $data->save();
            if ($result) {
                return redirect()->route('santri')->with('success',"Data Berhasil Terubah");
            }else{
                return redirect()->route('santri')->with('error',"Data Gagal Terubah");
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
        $this->cekAdmin();
        $data = santri::where('nisn',$id)->first();
        
        if($data){
            $email = $data->email_santri;
            if($data->delete()){
                $deleteEmail = user::where('email',$email)->first();
                $deleteJurnal = jurnal::where('santri_nisn',$id)->delete();
                if($deleteEmail){
                    if ($deleteEmail->delete()) {
                        return redirect()->route('santri')->with('success',"Berhasil Menghapus Data");
                    } else {
                        return redirect()->route('santri')->with('error',"Gagal Menghapus Data");
                    }
                }else{
                    return redirect()->route('santri')->with('error',"Gagal Menghapus Data");
                }
            }else{
                return redirect()->route('santri')->with('error',"Gagal Menghapus Data");
            }
        }else{
            return abort(404);
        }
        
    }

    public function uploadExcel(Request $request)
    {
        $this->cekAdmin();
        $rules = array(
            "file"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('santri')->with('warning',$errorString);
        }else{
            $data = Excel::import(new santriImport, $request->file('file')->store('temp'));
            if ($data) {
                $dataUser = Excel::import(new userImport, $request->file('file')->store('temp'));
                if ($dataUser) {
                    return redirect()->route('santri')->with('success',"Berhasil Mengupload Data");
                }else{
                    return redirect()->route('santri')->with('error',"Gagal Mengupload Data");
                }
            } else {
                return redirect()->route('santri')->with('error',"Gagal Mengupload Data");
            }
        }
    }

    public function contohFile()
    {
        $this->cekAdmin();
        $filePath = public_path("data.xlsx");
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $fileName = 'formatUpload.xlsx';

        return response()->download($filePath, $fileName, $headers);
    }

    public function cekAdmin()
    {
        if(Auth::user()->status != "admin"){
            return abort(404);
        }
    }
}
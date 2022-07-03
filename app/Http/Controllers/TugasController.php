<?php

namespace App\Http\Controllers;

use App\Models\{Tugas,pembimbing,santri,walsan};
use Illuminate\Http\Request;
use Auth;
use Validator;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Auth::user()->status;
        $email = Auth::user()->email;
        if ($status == "pembimbing") {
            $pem = pembimbing::where('email_pembimbing', $email)->first();
            $data = Tugas::where('pembimbing_id', $pem->id)->orderBy('id', 'asc')->get();
        }elseif ($status == "santri") {
            $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->orderBy('id', 'asc')->get();
        }elseif ($status == "walsan") {
            $walsan = walsan::where('email_walsan',$email)->with('santri')->first();
            $santri = santri::where('email_santri',$walsan->santri->email_santri)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->orderBy('id', 'asc')->get();
        }else {
            $data = Tugas::orderBy('id', 'asc')->with('pembimbing')->get();
        }
        
        $jumlah = count($data);
        return view('layouts/bimbingan/bimbingan',[
            "data"=>$data,
            "jumlah"=>$jumlah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->cekAuth();
        return view('layouts/bimbingan/addTugas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cekAuth();

        $rules = array(
            "nama_tugas"=>"required",
            "deskripsi_tugas"=>"required",
            "batas_pengumpulan_tugas"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addTugas')->with('warning',$errorString);
        }else{
            $email = Auth::user()->email;
            $pem = pembimbing::where('email_pembimbing', $email)->first();

            $data = new Tugas;
            $data->nama_tugas = $request->nama_tugas;
            $data->deskripsi_tugas = $request->deskripsi_tugas;
            $data->batas_pengumpulan_tugas = $request->batas_pengumpulan_tugas;
            $data->pembimbing_id = $pem->id;
            if ($request->file('file_tugas')) {
                $fileT = $request->file('file_tugas');
                $response = cloudinary()->upload($fileT->getRealPath())->getSecurePath();
                $data->file_tugas = $response;
            }

            $result = $data->save();
            if ($result) {
                return redirect()->route('bimbingan')->with('success',"Data Tugas Berhasil Tersimpan");
            }else{
                return redirect()->route('bimbingan')->with('error',"Data Gagal Tersimpan");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tugas::find($id);  
        $pisah = explode(" ",$data->batas_pengumpulan_tugas);
        $dt = substr($pisah[0] . "T" . $pisah[1],0, -3);               
        if ($data) {
            return view('layouts/bimbingan/editTugas', [
                "data"=>$data,
                "dt"=>$dt
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas)
    {
        //
    }

    public function cekAuth()
    {
        if(Auth::user()->status != "pembimbing"){
            return abort(404);
        }
    }
}

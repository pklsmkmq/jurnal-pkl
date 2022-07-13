<?php

namespace App\Http\Controllers;

use App\Models\{Tugas,pembimbing,santri,walsan,Jawaban};
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
            foreach ($data as $key) {
                $jawaban = Jawaban::where('tugas_id', $key->id)->with('santri')->with('revisi')->get();
                $key->jawaban = $jawaban;
            }
            // return $data;
        }elseif ($status == "santri") {
            $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->orderBy('id', 'asc')->get();
            foreach ($data as $key) {
                $jawaban = Jawaban::where('santri_nisn', $santri->nisn)->where('tugas_id', $key->id)->with('revisi')->first();
                $key->jawaban = $jawaban;
            }
        }elseif ($status == "walsan") {
            $walsan = walsan::where('email_walsan',$email)->with('santri')->first();
            $santri = santri::where('email_santri',$walsan->santri->email_santri)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->orderBy('id', 'asc')->get();
            foreach ($data as $key) {
                $jawaban = Jawaban::where('santri_nisn', $santri->nisn)->where('tugas_id', $key->id)->with('revisi')->first();
                $key->jawaban = $jawaban;
            }
        }else {
            $data = Tugas::orderBy('id', 'asc')->with('pembimbing')->get();
            foreach ($data as $key) {
                $jawaban = Jawaban::where('tugas_id', $key->id)->with('santri')->with('revisi')->get();
                $key->jawaban = $jawaban;
            }
        }
        
        $jumlah = count($data);
        return view('layouts/bimbingan/bimbingan',[
            "data"=>$data,
            "jumlah"=>$jumlah
        ]);
        // return $data;
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
        $status = Auth::user()->status; 
        $email = Auth::user()->email;
        if ($status == "santri") {
            $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->where('id', $id)->first();
            if (!$data) {
                return abort(404);
            }
        }elseif ($status == "walsan") {
            $walsan = walsan::where('email_walsan',$email)->with('santri')->first();
            $santri = santri::where('email_santri',$walsan->santri->email_santri)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->where('id', $id)->first();
            if (!$data) {
                return abort(404);
            }
        }else {
            $data = Tugas::find($id); 
            if (!$data) {
                return abort(404);
            }
        }  
        $pisah = explode(" ",$data->batas_pengumpulan_tugas);
        $dt = substr($pisah[0] . "T" . $pisah[1],0, -3);
        return view('layouts/bimbingan/detailTugas', [
            "data"=>$data,
            "dt"=>$dt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->cekTugas($id);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->cekAuth();
        $this->cekTugas($id);

        $rules = array(
            "nama_tugas"=>"required",
            "deskripsi_tugas"=>"required",
            "batas_pengumpulan_tugas"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('editTugas')->with('warning',$errorString);
        }else{
            $pem = pembimbing::where('email_pembimbing', Auth::user()->email)->first();

            $data = Tugas::where('id',$id)->where('pembimbing_id',$pem->id)->first();
            if ($data) {
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
                    return redirect()->route('bimbingan')->with('success',"Data Tugas Berhasil Terubah");
                }else{
                    return redirect()->route('bimbingan')->with('error',"Data Gagal Terubah");
                } 
            } else {
                return redirect()->route('bimbingan')->with('error',"Data Tidak Ditemukan");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cekAuth();
        $this->cekTugas($id);

        $data = Tugas::where('id',$id)->delete();
        if ($data) {
            return redirect()->route('bimbingan')->with('success',"Berhasil Menghapus Tugas");
        } else {
            return redirect()->route('bimbingan')->with('error',"Gagal Menghapus Tugas");
        }
    }

    public function cekAuth()
    {
        if(Auth::user()->status != "pembimbing"){
            return abort(404);
        }
    }

    public function cekTugas($id)
    {
        $pembimbing = pembimbing::where('email_pembimbing', Auth::user()->email)->first();
        $cekData = Tugas::where('id',$id)->where('pembimbing_id',$pembimbing->id)->first();
        if (!$cekData) {
            return abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{Revisi, jawaban, pembimbing};
use Illuminate\Http\Request;
use Auth;
use Validator;

class RevisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id)
    {
        $rules = array(
            "status_revisi"=>"required",
            "keterangan_revisi"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('detailJawaban')->with('warning',$errorString);
        }else{
            $status = Auth::user()->status; 
            $email = Auth::user()->email;

            if ($status == "pembimbing") {
                $pembimbing = pembimbing::where('email_pembimbing', $email)->first();

                $revisi = new Revisi;
                $revisi->jawaban_id = $id;
                $revisi->pembimbing_id = $pembimbing->id;
                $revisi->status_revisi = $request->status_revisi;
                $revisi->keterangan_revisi = $request->keterangan_revisi;
                $revisi->tanggal_revisi = date("Y-m-d");
                $result = $revisi->save();

                if ($result) {
                    return redirect()->route('bimbingan')->with('success',"Penilaian Berhasil Tersimpan");
                }else{
                    return redirect()->route('bimbingan')->with('error',"Penilaian Gagal Tersimpan");
                }
            }else{
                return abort(404);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function show(Revisi $revisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Revisi $revisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            "status_revisi"=>"required",
            "keterangan_revisi"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('detailJawaban')->with('warning',$errorString);
        }else{
            $status = Auth::user()->status; 
            $email = Auth::user()->email;

            if ($status == "pembimbing") {
                $pembimbing = pembimbing::where('email_pembimbing', $email)->first();

                $revisi = Revisi::where('pembimbing_id', $pembimbing->id)->where('id',$id)->first();
                $revisi->status_revisi = $request->status_revisi;
                $revisi->keterangan_revisi = $request->keterangan_revisi;
                $revisi->tanggal_revisi = date("Y-m-d");
                $result = $revisi->save();

                if ($result) {
                    return redirect()->route('bimbingan')->with('success',"Penilaian Berhasil Tersimpan");
                }else{
                    return redirect()->route('bimbingan')->with('error',"Penilaian Gagal Tersimpan");
                }
            }else{
                return abort(404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revisi $revisi)
    {
        //
    }
}

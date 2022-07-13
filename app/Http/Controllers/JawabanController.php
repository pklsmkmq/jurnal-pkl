<?php

namespace App\Http\Controllers;

use App\Models\{Jawaban, Tugas, santri, pembimbing};
use Illuminate\Http\Request;
use Auth;
use Validator;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $status = Auth::user()->status; 
        $email = Auth::user()->email;
        if ($status == "santri") {
            $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
            $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->where('id', $id)->with('jawaban')->first();
            if (!$data) {
                return abort(404);
            }else{
                $newformat = strtotime($data->batas_pengumpulan_tugas);
                $batas = date('d-m-Y h:i:s', $newformat);
                $sekarang = date("d-m-Y h:i:s");
                
                if ($sekarang < $batas) {
                    if ($data->jawaban != null) {
                        return abort(404);
                    }else{
                        return view('layouts/bimbingan/addJawaban', [
                            "data"=>$data
                        ]);    
                    }
                } else {
                    return view('layouts/bimbingan/expired');
                }
            }
        }else{
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
            "link_jawaban"=>"required",
            "keterangan_jawaban"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addJawaban')->with('warning',$errorString);
        }else{
            $status = Auth::user()->status; 
            $email = Auth::user()->email;
            if ($status == "santri") {
                $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
                $data = Tugas::where('pembimbing_id', $santri->pembimbing->id)->where('id', $id)->first();
                if (!$data) {
                    return abort(404);
                }
            }else{
                return abort(404);
            }

            $jawaban = new Jawaban;
            $jawaban->tugas_id = $id;
            $jawaban->santri_nisn = $santri->nisn;
            $jawaban->link_jawaban = $request->link_jawaban;
            $jawaban->keterangan_jawaban = $request->keterangan_jawaban;
            $jawaban->waktu_jawaban = date("Y-m-d h:i:s");
            $result = $jawaban->save();
            if ($result) {
                return redirect()->route('bimbingan')->with('success',"Jawaban Berhasil Tersimpan");
            }else{
                return redirect()->route('bimbingan')->with('error',"Jawaban Gagal Tersimpan");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Auth::user()->status; 
        $email = Auth::user()->email;
        if ($status == "santri") {
            $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
            $data = Jawaban::where('id', $id)->where('santri_nisn', $santri->nisn)->with('tugas')->first();
            if (!$data) {
                return abort(404);
            }else{
                return view('layouts/bimbingan/editJawaban', [
                    "data"=>$data
                ]);
            }
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban $jawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            "link_jawaban"=>"required",
            "keterangan_jawaban"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('editJawaban')->with('warning',$errorString);
        }else{
            $status = Auth::user()->status; 
            $email = Auth::user()->email;
            if ($status == "santri") {
                $santri = santri::where('email_santri',$email)->with('pembimbing')->first();
                $data = Jawaban::where('id', $id)->where('santri_nisn', $santri->nisn)->with('tugas')->first();
                if (!$data) {
                    return abort(404);
                }
            }else{
                return abort(404);
            }

            $data->link_jawaban = $request->link_jawaban;
            $data->keterangan_jawaban = $request->keterangan_jawaban;
            $data->waktu_jawaban = date("Y-m-d h:i:s");
            $result = $data->save();
            if ($result) {
                return redirect()->route('bimbingan')->with('success',"Jawaban Berhasil Diubah");
            }else{
                return redirect()->route('bimbingan')->with('error',"Jawaban Gagal Diubah");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        //
    }

    public function detailJawaban($id)
    {
        $status = Auth::user()->status; 
        $email = Auth::user()->email;
        $find = "";
        $angka = 1;
        if ($status == "pembimbing") {
            $pembimbing = pembimbing::where('email_pembimbing',$email)->with('tugas')->first();
            if (count($pembimbing->tugas) > 0) {
                foreach ($pembimbing->tugas as $key) {
                    $jawaban = Jawaban::where('tugas_id',$key->id)->get();
                    foreach ($jawaban as $item) {
                        if ($item->id == $id) {
                            $find = $id;
                            break;
                        }
                    }
                    if ($find != "") {
                        $jawaban = Jawaban::where('tugas_id',$key->id)->where('id',$find)->with('santri')->with('tugas')->with('revisi')->first();
                        return view('layouts/bimbingan/detailJawaban', compact('jawaban'));
                        // return $jawaban;
                    } 
                    if($angka == count($pembimbing->tugas)) {
                        return abort(404);
                    }
                    $angka++;
                }
            }else{
                return abort(404);    
            }
        }else{
            return abort(404);
        }
    }
}

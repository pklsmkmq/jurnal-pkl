<?php

namespace App\Http\Controllers;
use App\Models\santri;
use App\Models\pembimbing;
use App\Models\kunjungan;
use App\Models\User;
use Validator;
use Auth;

use Illuminate\Http\Request;

class kunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Auth::user()->email;
        $pembimbing = pembimbing::where('email_pembimbing',$email)->first();
        $data = santri::where('pembimbing_id',$pembimbing->id)->groupBy('perusahaan_santri')->get();
        $kunjungan = kunjungan::where('pembimbing_id',$pembimbing->id)->get();
        return view('layouts/kunjungan/kunjungan',[
            'data'=>$data,
            'kunjungan'=>$kunjungan
        ]);
    }

    public function riwayat()
    {
        $email = Auth::user()->email;
        $pembimbing = pembimbing::where('email_pembimbing',$email)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $email = Auth::user()->email;
        $pembimbing = pembimbing::where('email_pembimbing',$email)->first();
        $data = santri::where('pembimbing_id',$pembimbing->id)->groupBy('perusahaan_santri')->get();
        return view('layouts/kunjungan/addKunjungan',compact('data'));
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
            "tanggal_kunjungan"=>"required",
            "foto_dokumentasi_kunjungan"=>"required",
            "keterangan_kunjungan"=>"required",
            "nama_perusahaan_kunjungan"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addKunjungan')->with('warning',$errorString);
        }else{
            $email = Auth::user()->email;
            $pembimbing = pembimbing::where('email_pembimbing',$email)->first();
            $cekKe = kunjungan::where('pembimbing_id',$pembimbing->id)->where('nama_perusahaan_kunjungan',$request->nama_perusahaan_kunjungan)->count();
            $kunjunganKe = $cekKe + 1;

            $gambar = $request->file('foto_dokumentasi_kunjungan');
            $response = cloudinary()->upload($gambar->path())->getSecurePath();
            
            $data = new kunjungan;
            $data->pembimbing_id = $pembimbing->id;
            $data->tanggal_kunjungan = $request->tanggal_kunjungan;
            $data->keterangan_kunjungan = $request->keterangan_kunjungan;
            $data->foto_dokumentasi_kunjungan = $response;
            // $data->foto_dokumentasi_jurnal = "https://res.cloudinary.com/smk-madinatul-quran/image/upload/v1624542446/xosf6hxy0ye7lmoopors.jpg";
            $data->nama_perusahaan_kunjungan = $request->nama_perusahaan_kunjungan;
            $data->kunjungan_ke = $kunjunganKe;

            $result = $data->save();
            if ($result) {
                return redirect()->route('kunjungan')->with('success',"Kunjungan Berhasil Tersimpan");
            }else{
                return redirect()->route('kunjungan')->with('error',"Kurnal Gagal Tersimpan");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

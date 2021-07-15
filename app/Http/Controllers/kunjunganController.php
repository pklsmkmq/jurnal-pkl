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
        //
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

<?php

namespace App\Http\Controllers;

use App\Models\{
    Setting,
    User,
    santri
};
use Illuminate\Http\Request;
use Auth;
use Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->cekAdmin();
        $data = Setting::all();
        $angkatan = Setting::where('pengaturan','angkatan')->first();
        if (count($data) == 0) {
            $data = null;
        }

        if (!$angkatan) {
            $angkatan = null;
        }
        
        return view('layouts/setting/setting', [
            "data" => $data,
            "angkatan" => $angkatan
        ]);
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
        $this->cekAdmin();

        $cekSetting = Setting::where('pengaturan','angkatan')->first();
        if ($cekSetting) {
            $cekSetting->pengaturan = "angkatan";
            $cekSetting->isi_pengaturan = $request->angkatan;
            $result = $cekSetting->save();
            $this->ubahKet($request->angkatan);
            if ($result) {
                return redirect()->route('pengaturan')->with('success',"Pengaturan Berhasil Tersimpan");
            }else{
                return redirect()->route('pengaturan')->with('error',"Pengaturan Gagal Tersimpan");
            }
        } else {
            $data = new Setting;
            $data->pengaturan = "angkatan";
            $data->isi_pengaturan = $request->angkatan;
            $result = $data->save();
            $this->ubahKet($request->angkatan);
            if ($result) {
                return redirect()->route('pengaturan')->with('success',"Pengaturan Berhasil Tersimpan");
            }else{
                return redirect()->route('pengaturan')->with('error',"Pengaturan Gagal Tersimpan");
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function cekAdmin()
    {
        if(Auth::user()->status != "admin"){
            return abort(404);
        }
    }

    public function ubahKet($angkatan)
    {
       $nonAktif = santri::whereNotIn('angkatan', [$angkatan])->update(['status' => 1]);
       $aktif = santri::where('angkatan', $angkatan)->update(['status' => 0]);
    }
}

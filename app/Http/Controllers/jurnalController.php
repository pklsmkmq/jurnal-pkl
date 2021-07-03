<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\pembimbing;
use App\Models\jurnal;
use App\Models\walsan;
use App\Models\kegiatan;
use Validator;
use Auth;

class jurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->status;
        if($user == "santri"){
            $santri = santri::where('email_santri',Auth::user()->email)->first();
            $data = jurnal::where('santri_nisn',$santri->nisn)->with('santri')->orderBy('tanggal_jurnal', 'desc')->get();
        }elseif($user == "pembimbing"){
            $guru = pembimbing::where('email_pembimbing',Auth::user()->email)->first();
            $santri = santri::where('pembimbing_id',$guru->id)->get();
            $data = jurnal::with('santri');
            foreach ($santri as $item) {
                $data = $data->orWhere('santri_nisn',$item->nisn);
            }
            $data = $data->orderBy('tanggal_jurnal', 'desc')->get();
        }elseif ($user == "walsan") {
            $walsan = walsan::where('email_walsan',Auth::user()->email)->first();
            $data = jurnal::where('santri_nisn',$walsan->santri_nisn)->orderBy('tanggal_jurnal', 'desc')->with('santri')->get();
        }else{
            $data = jurnal::with('santri')->orderBy('tanggal_jurnal', 'desc')->get();
        }
        return view('layouts/jurnal/jurnal',compact('data'));
    }

    public function detail($id)
    {
        $data = jurnal::where('id',$id)->with('santri')->first();
        $kegiatan = kegiatan::where('santri_nisn',$data->santri_nisn)->where('tanggal_kegiatan',$data->tanggal_jurnal)->first();
        if ($data) {
            if (Auth::user()->name == $data->santri->nama_santri || Auth::user()->status == "pembimbing" || Auth::user()->status == "admin" || Auth::user()->status == "walsan") {
                return view('layouts/jurnal/jurnalDetail',[
                    "data"=>$data,
                    "kegiatan"=>$kegiatan
                ]);
            }else{
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function santri($nisn)
    {
        $data = jurnal::where('santri_nisn',$nisn)->with('santri')->get();
        return view('layouts/jurnal/jurnal',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->status == "santri") {
            return view('layouts/jurnal/addJurnal');
        } else {
            return abort('404');
        }
        
        
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
            "judul_jurnal"=>"required",
            "deskripsi_jurnal"=>"required",
            "foto_dokumentasi_jurnal"=>"required|image",
            "tanggal_jurnal"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('addJurnal')->with('warning',$errorString);
        }else{
            $santri = santri::where('email_santri',Auth::user()->email)->first();
            $cekTgl = jurnal::where('tanggal_jurnal',$request->tanggal_jurnal)->where('santri_nisn',$santri->nisn)->first();
            if ($cekTgl) {
                return redirect()->route('addJurnal')->with('warning',"Tanggal jurnal sudah ada!");    
            }
            $gambar = $request->file('foto_dokumentasi_jurnal');
            $response = cloudinary()->upload($gambar->path())->getSecurePath();
            
            $data = new jurnal;
            $data->santri_nisn = $santri->nisn;
            $data->judul_jurnal = $request->judul_jurnal;
            $data->deskripsi_jurnal = $request->deskripsi_jurnal;
            // $data->foto_dokumentasi_jurnal = $response;
            $data->foto_dokumentasi_jurnal = "https://res.cloudinary.com/smk-madinatul-quran/image/upload/v1624542446/xosf6hxy0ye7lmoopors.jpg";
            $data->tanggal_jurnal = $request->tanggal_jurnal;

            $result = $data->save();
            if ($result) {
                if ($request->kegiatan == "on") {
                    $simpanKegiatan = $this->saveKegiatan($request,$santri->nisn,$request->tanggal_jurnal);
                    if ($simpanKegiatan == "sukses") {
                        return redirect()->route('jurnal')->with('success',"Jurnal & Kegiatan Berhasil Tersimpan");
                    } else {
                        return redirect()->route('jurnal')->with('error',"Jurnal Tersimpan Tetapi Kegiatan Gagal Tersimpan");
                    }
                    
                } else {
                    return redirect()->route('jurnal')->with('success',"Jurnal Berhasil Tersimpan");
                }
            }else{
                return redirect()->route('jurnal')->with('error',"Jurnal Gagal Tersimpan");
            }
        }

        // if ($request->kegiatan == "on") {
        //     return $request->dzikir_pagi;
        // } else {
        //     return "not";
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = jurnal::where('id',$id)->first();
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
        $data = jurnal::where('id',$id)->with('santri')->first();
        if ($data) {
            if (Auth::user()->name == $data->santri->nama_santri) {
                return view('layouts/jurnal/editJurnal',compact('data'));
            }else{
                return abort(401);
            }
        } else {
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
        $rules = array(
            "judul_jurnal"=>"required",
            "deskripsi_jurnal"=>"required",
            "tanggal_jurnal"=>"required",
            "foto_dokumentasi_jurnal"=>"image",
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return redirect()->route('jurnalEdit')->with('warning',$errorString);
        }else{
            $santri = santri::where('email_santri',Auth::user()->email)->first();
            $cekTgl = jurnal::where('tanggal_jurnal',$request->tanggal_jurnal)->where('santri_nisn',$santri->nisn)->first();
            if ($cekTgl) {
                if ($cekTgl->id != $id) {
                    return redirect()->route('jurnalEdit',$id = $id)->with('warning',"Tanggal jurnal sudah ada!");    
                }
            }

            $data = jurnal::where('id',$id)->first();

            if($request->file('foto_dokumentasi_jurnal')){
                $gambar = $request->file('foto_dokumentasi_jurnal');
                $response = cloudinary()->upload($gambar->getRealPath())->getSecurePath();
                $data->foto_dokumentasi_jurnal = $response;
            }
            
            $data->santri_nisn = $santri->nisn;
            $data->judul_jurnal = $request->judul_jurnal;
            $data->deskripsi_jurnal = $request->deskripsi_jurnal;
            $data->foto_dokumentasi_jurnal = $data->foto_dokumentasi_jurnal;
            $data->tanggal_jurnal = $request->tanggal_jurnal;

            $result = $data->save();
            if ($result) {
                return redirect()->route('jurnal')->with('success',"Data Berhasil Terubah");
            }else{
                return redirect()->route('jurnal')->with('error',"Data Gagal Terubah");
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
        $data = jurnal::where('id',$id)->first();
        
        if($data){
            if($data->delete()){
                return ["result"=>"Berhasil Menghapus Data"];
            }else{
                return ["result"=>"Gagal Menghapus Data"];
            }
        }else{
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    public function listJurnalByPembimbing($idPembimbing)
    {
        $cekId = pembimbing::where('id',$idPembimbing)->first();

        if($cekId){
            $data = jurnal::whereHas('santri',function($query) use ($idPembimbing){
                $query->where('pembimbing_id',$idPembimbing);
            })->with('santri')->orderBy('created_at','desc')->get();
            if($data){
                return ["result"=>$data];    
            }else{
                return ["result"=>"Gagal Mendapatkan Data"];
            }
        }else{
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    public function listJurnalByWalsan($idWalsan)
    {
        $cekId = walsan::where('id',$idWalsan)->first();

        if($cekId){
            $data = jurnal::whereHas('santri',function($query) use ($cekId){
                $query->where('nisn',$cekId->santri_nisn);
            })->with('santri')->orderBy('created_at','desc')->get();
            if($data){
                return ["result"=>$data];    
            }else{
                return ["result"=>"Gagal Mendapatkan Data"];
            }
        }else{
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    public function saveKegiatan($request,$nisn,$tgl)
    {
        $data = new kegiatan;
        $data->santri_nisn = $nisn;
        $data->dzikir_pagi = $this->cekData($request->dzikir_pagi);
        $data->dzikir_petang = $this->cekData($request->dzikir_petang);
        $data->subuh = $this->cekData($request->subuh);
        $data->dzuhur = $this->cekData($request->dzuhur);
        $data->ashar = $this->cekData($request->ashar);
        $data->maghrib = $this->cekData($request->maghrib);
        $data->isya = $this->cekData($request->isya);
        $data->baca_alquran = $this->cekData($request->membaca_alquran);
        $data->tanggal_kegiatan = $tgl;

        $result = $data->save();
        if ($result) {
            return "sukses";
        }else{
            return "gagal";
        }
    }

    public function cekData($data)
    {
        if ($data) {
            return $data;
        }else{
            return "belum";
        }
    }
}
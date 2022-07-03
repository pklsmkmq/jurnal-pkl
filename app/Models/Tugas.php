<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ["pembimbing_id","nama_tugas","deskripsi_tugas","batas_pengumpulan_tugas","file_tugas"];
    protected $keyType = 'string';

    public function pembimbing()
    {
        return $this->belongsTo(pembimbing::class);
    }

    // public function walsan()
    // {
    //     return $this->hasOne(walsan::class);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $table = "jawaban";
    protected $fillable = ["tugas_id","santri_nisn","link_jawaban","keterangan_jawaban","waktu_jawaban"];
    protected $keyType = 'string';

    public function santri()
    {
        return $this->belongsTo(santri::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function revisi()
    {
        return $this->hasOne(Revisi::class);
    }
}

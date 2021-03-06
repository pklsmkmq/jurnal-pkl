<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembimbing extends Model
{
    use HasFactory;
    protected $table = "pembimbing";

    public function santri()
    {
        return $this->hasMany(santri::class);
    }

    public function kunjungan()
    {
        return $this->hasMany(kunjungan::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function revisi()
    {
        return $this->hasOne(Revisi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    use HasFactory;
    protected $table = "revisi";
    protected $fillable = ["jawaban_id","pembimbing_id","status_revisi","keterangan_revisi","tanggal_revisi"];
    protected $keyType = 'string';

    public function pembimbing()
    {
        return $this->belongsTo(pembimbing::class);
    }

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walsan extends Model
{
    use HasFactory;
    protected $table = "walsan";
    protected $fillable = ["santri_nisn","nama_walsan","email_walsan","telepon_walsan"];

    public function santri()
    {
        return $this->belongsTo(santri::class);
    }
}
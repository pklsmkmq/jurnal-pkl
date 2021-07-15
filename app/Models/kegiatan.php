<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatan extends Model
{
    use HasFactory;
    protected $table = "kegiatan";

    public function santri()
    {
        return $this->belongsTo(santri::class);
    }
}

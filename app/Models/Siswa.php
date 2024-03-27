<?php

namespace App\Models;



use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Models;

class Siswa extends Models
{
    use HasFactory;

    protected $guarded = [];
    protected $guard = "siswa";

    public function Kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }

}

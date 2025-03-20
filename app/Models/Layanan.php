<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = ['nama','slug','deskripsi','kategori_id','gambar'];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->nama);
        });

        static::updating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->nama);
        });
    }

}

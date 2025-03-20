<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['nama','slug','deskripsi'];

    public function layanan(){
        return $this->hasMany(Layanan::class, 'kategori_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });

        static::updating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });
    }
}

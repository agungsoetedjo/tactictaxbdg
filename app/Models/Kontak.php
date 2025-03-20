<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    protected $fillable = ['pic','phone', 'email', 'address', 'facebook', 'instagram', 'whatsapp'];

    public function whatsappLink($message)
    {
        if ($this->whatsapp) {
            $phone = preg_replace('/[^0-9]/', '', $this->whatsapp); // Bersihkan nomor
            return "https://wa.me/{$phone}?text=" . urlencode($message);
        }
        return '#';
    }
}

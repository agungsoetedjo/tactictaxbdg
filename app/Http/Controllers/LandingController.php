<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kontak;
use App\Models\Layanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    
    public function index(){
        $kategori = Kategori::all();
        $kontak = Kontak::first();
        $testimoni = Testimoni::latest()->get();
        // return view('index', ['kategori' => $kategori, 'kontak' => $kontak]);
        return view('index', compact(['kategori','kontak','testimoni']));
    }

    public function detillayanan($slug, Request $request){
        $kontak = Kontak::first();
        $kategori = Kategori::where('slug',$slug)->firstOrFail();
        $layanan = $kategori->layanan;
        $activeLayanan = $request->query('layanan',$layanan->first()?->slug);
        // return response()->json($layanan);
        return view('detil-layanan', compact('layanan','kategori','activeLayanan','kontak'));
    }

    //contoh mendapatkan semua layanan dari sebuah kategori
    public function tesKategori(){
        $kategori = Kategori::with('layanan')->find(1);
        foreach ($kategori->layanan as $layanan) {
            echo $layanan->nama;
        }
    }

    //contoh mendapatkan kategori dari sebuah layanan
    public function tesLayanan(){
        $layanan = Layanan::find(1);
        echo $layanan->kategori->nama;
    }

    public function sendWhatsApp(Request $request)
    {
        $kontak = Kontak::firstOrFail(); // Pastikan data kontak ada

        $request->validate([
            'name' => 'required|string|max:100',
            'message' => 'required|string|max:500',
        ]);

        // Ambil data dari form
        $phone = preg_replace('/[^0-9]/', '', $kontak->whatsapp); // Bersihkan nomor
        $message = urlencode("Halo, saya $request->name.\n\n" . $request->message);

        // Buat URL WhatsApp
        $whatsappUrl = "https://wa.me/$phone?text=$message";

        // Redirect ke WhatsApp
        return redirect()->away($whatsappUrl);
    }

    public function sendWhatsAppDaftar(Request $request)
    {
        $kontak = Kontak::first();
        // Ambil data dari form
        
        $phone = preg_replace('/[^0-9]/', '', $kontak->whatsapp); // Bersihkan nomor
        $message = urlencode("Halo, saya ".$request->name.".\n\nSaya ingin mendaftarkan diri untuk mengikuti " .$request->layananMsg.". Untuk biaya pendaftarannya berapa harganya?");

        // Buat URL WhatsApp
        $whatsappUrl = "https://wa.me/$phone?text=$message";

        // Redirect ke WhatsApp
        return redirect()->away($whatsappUrl);
    }
}

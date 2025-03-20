<?php
namespace App\Helpers;

class MyHelper
{
    
    public static function formatText($text)
    {
        // mengganti hanya tag unorderedlist menjadi i class namun tag ordered list tetap
        // Mencari dan mengubah hanya tag <ul><li></li></ul> menjadi <i class="">
        $text = preg_replace_callback('/<ul[^>]*>(.*?)<\/ul>/s', function ($matches) {
            // Mengubah <li> menjadi <i class="">
            $updatedList = preg_replace('/<li>(.*?)<\/li>/', '<i class="bi bi-check-circle-fill"></i> $1<br>', $matches[1]);
            return $updatedList;
        }, $text);

        // menyisipkan i class hanya didalam tag orderedlist namun tag orderedlist tetap
        // Mencari dan mengubah hanya tag <ul><li></li></ul> menjadi <i class="">
        // $text = preg_replace_callback('/<ul[^>]*>(.*?)<\/ul>/s', function ($matches) {
        //     // Ubah <li> di dalam <ul> menjadi <i class="fas fa-check"></i>
        //     $updatedList = preg_replace('/<li>(.*?)<\/li>/', '<i class="bi bi-check-circle-fill"></i> $1<br>', $matches[1]);
        //     return "<ul>" . $updatedList . "</ul>";
        // }, $text);

        return $text;
    }
}

<?php


namespace App\services;


use Illuminate\Support\Facades\Storage;

class ImageFileService
{

    public static function upload($file){
        $extension = $file->getClientOriginalExtension();
        $photo_name = uniqid();
        Storage::disk('public')->putFileAs('images',$file,$photo_name.'.'.$extension);
        return  $photo_name.'.'.$extension;
    }

}

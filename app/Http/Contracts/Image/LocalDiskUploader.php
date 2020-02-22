<?php

namespace App\Http\Contracts\Image;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LocalDiskUploader implements ImageUpload {
   private $destinationPath = 'uploads/';
   private $fileName;

   public function generateRandomName($file){
      $fileExtension = $file->getClientOriginalExtension();
      $this->fileName = now()->format('dmyy') . md5(rand(0,999)). Str::random(40) . "." . $fileExtension;
   }

   public function uploadToDriver($file) {
      $this->generateRandomName($file);
      try{
         Storage::putFileAs('public/'.$this->destinationPath, $file,$this->fileName);
         return $this->destinationPath.$this->fileName;
      } catch(Exception $exception){
         return back()->withErrors('Upload failed');
      }
   }
}
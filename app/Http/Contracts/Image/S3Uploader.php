<?php

namespace App\Http\Contracts\Image;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class S3Uploader implements ImageUpload {
   private $destinationPath = 'images/';
   private $fileName;

   public function generateRandomName($file){
      $fileExtension = $file->getClientOriginalExtension();
      $this->fileName = now()->format('dmyy') . md5(rand(0,999999)). Str::random(40) . "." . $fileExtension;
   }

   public function uploadToDriver($file) {
      try{
         $this->generateRandomName($file);
         Storage::disk('s3')->putFileAs($this->destinationPath . $this->fileName, $file,$this->fileName);
         return config('filesystems.disks.s3.url').$this>destinationPath.$this->fileName;
      } catch(Exception $exception){
         return false;
      }
   }
}
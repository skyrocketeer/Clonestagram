<?php

namespace App\Http\Contracts\Image;

use App\Http\Contracts\Image\S3Uploader;
use App\Http\Contracts\Image\LocalDiskUploader;

class DriverFactory {
   public function getDriver($driver){
      switch ($driver) {
         case 's3':
            return new S3Uploader;
         break;

         case 'local':
            return new LocalDiskUploader;
         break;

         default: 
            return null;
         break;
      }
   }
}
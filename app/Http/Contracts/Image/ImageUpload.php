<?php

namespace App\Http\Contracts\Image;

interface ImageUpload {
   public function generateRandomName($file);
   public function uploadToDriver($photo);
}
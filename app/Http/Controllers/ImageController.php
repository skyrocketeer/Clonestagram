<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\Handler as Exception;

class ImageController extends Controller
{
    protected $imgPath;

    /**
     * Handle image upload
     * @param $request
     */
    public function uploadToS3($request_file){
        $rules = [ 'image' => 'image|mimes:jpg,jpeg,png,max:2048' ]; 
        $validator = Validator::make(request()->file(), $rules);
        // $this->validate(request()->all(), [
        //     'image' => 'image|mimes:jpg,jpeg,png,max:2048'
        // ]);
        // Kiểm tra nếu có lỗi
        if ($validator->fails()) {
            return redirect()->back()->withErrors('invalid file');
        }

        $destinationPath = 'images/profile/';
        // foreach($request_files as $file => $img){
        //     dd($file);
            // $imgPath = request()->file('image')->store('profile','public');
            $fileExtension = $request_file->getClientOriginalExtension();
            $fileName = now()->format('dmyy') . md5(rand(0,999999)). Str::random(40) . "." . $fileExtension;
            try{
                Storage::disk('s3')->put($destinationPath . $fileName, file_get_contents($request_file));
                $this->imgPath = config('filesystems.disks.s3.url').$destinationPath.$fileName ;
            }catch(Exception $exception){
                return back()->withErrors('Upload failed')->withInput();
            }
        // }
    }

    /**
     * get image path 
     * @param AWS S3 path
     * return path
     */
    public function getImgPath(){
        return $this->imgPath;
    }
}

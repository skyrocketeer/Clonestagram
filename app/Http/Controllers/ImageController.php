<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Http\Contracts\Image\DriverFactory;
use App\Exceptions\Handler as Exception;

class ImageController extends Controller
{
    protected $uploader;
    protected $strategy;

    /**
     * get a concrete factory
     */
    public function __construct(DriverFactory $factory) {
        $this->setStrategy();
        $this->uploader = $factory->getDriver($this->strategy);
    }

    /**
     * Handle image upload
     * @param $request
     */
    public function upload(){
        $rules = [ 'image' => 'image|mimes:jpg,jpeg,png,max:2048' ]; 
        $validator = Validator::make(request()->all(), $rules);
    
        // Kiểm tra nếu có lỗi
        if ($validator->fails()) {
            return redirect()->back()->withErrors('invalid file');
        }
        
        $imgPath = $this->uploader->uploadToDriver(request()->file('image'));
        return $imgPath;
    }

    public function setStrategy(){
        $this->strategy = app()->environment('local')? 'local' : 's3'; 
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

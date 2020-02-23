<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Http\Contracts\Image\DriverFactory;

class ImageController extends Controller
{
    protected $uploader;
    protected $strategy;
    protected $imgPath;

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
        $isUploaded = $this->uploader->uploadToDriver(request()->file('image'));
        if(!$isUploaded){
            return null;
        }

        $this->imgPath = $isUploaded;
    }

    public function setStrategy(){
        $this->strategy = app()->environment('local')? 'local' : 's3'; 
    }

    /** 
     * return path
     */
    public function getImgPath(){
        // $this->upload();
        return $this->imgPath;
    }
}

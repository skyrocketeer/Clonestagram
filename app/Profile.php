<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Expression;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function profileImage(){
        $fallbackImg = (env('APP_ENV') == 'production')? env('AWS_URI').'/images/profile/no-image.png' : 'profile/no-image.png';   
        $imagePath = ($this->image)? $this->image : $fallbackImg;
        return (env('APP_ENV') == 'production')? $imagePath : '/storage/'. $imagePath;
    }
}

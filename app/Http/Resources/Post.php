<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'image' => $this->image,
        ];
    }

    /**
     * add more fields to the response (must disable withoutWrapping method in AppServiceProvider)
     * @param  \Illuminate\Http\Request  $request
     */
    // public function with($request){
    //     return [
    //         'status' => 200,
    //         'message' => 'OK'
    //     ];
    // }
}

<?php

namespace App\Http\Resources;

use App\Models\Countdown;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $countdowns = request('finished') == '1' ? $this->countdowns : Countdown::where('user_id',$this->id)->where('finished',0)->get();
        return [
            'id' => $this->id,
            'name' => $this->name, 
            'countdowns' => $countdowns,
             
            //'cards' => $this->cards,          
        ];
    }
}

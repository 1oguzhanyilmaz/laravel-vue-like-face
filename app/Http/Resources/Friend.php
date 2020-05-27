<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Friend extends JsonResource
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
            'data' => [
                'type' => 'friend-request',
                'friend_request_id' => $this->id,
                'attributes' => [
                    'confirmed_at' => optional($this->confirmed_at)->diffForHumans(),
                    'friend_id' => $this->friend_id,
                    'user_id' => $this->user_id,
                ]
            ],
            'links' => [
                'self' => url('/users/'.$this->friend_id),
            ]
        ];
    }

    public static function friendship(){
        return (new static())
            ->whereNotNull('confirmed_at')
            ->where(function ($query){
                return $query->where('user_id', auth()->user()->id)
                    ->orWhere('friend_id', auth()->user()->id);
            })
            ->get();
    }
}

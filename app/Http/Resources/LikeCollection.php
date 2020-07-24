<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LikeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => LikeResource::collection($this->collection),
            'like_count' => $this->count(),
            'user_likes_count' => $this->collection->contains('id', auth()->user()->id),
            'links' => [
                'self' => url('/posts'),
            ]
        ];
    }
}

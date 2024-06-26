<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'movie' => $this->movie_id ? $this->movie->title : null,
            'serie' => $this->serie_id ? $this->serie->title : null,
            'comment' => $this->comment
        ];
    }
}

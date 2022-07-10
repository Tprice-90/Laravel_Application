<?php

namespace App\Http\Resources;

use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'articles' => ArticleResource::collection($this->articles),
        ];
    }
}

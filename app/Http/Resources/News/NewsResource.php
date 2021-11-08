<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{

    public function toArray($request)
    {
       return [
           'id' => $this->id,
           'title' => $this->title,
           'text' => $this->text,
           'image' => $this->getUrl(),
           'published_at' => $this->published_at
       ];
    }
}

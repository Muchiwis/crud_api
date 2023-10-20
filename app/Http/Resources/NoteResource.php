<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        //se especifica como devuelve el formato Json, si quermeos añadir nuevos campos tmb, diferentes del model
        return [
            'id' => $this->id,
            'title' => 'Title: '. $this->title,
            'content' => $this->content,
            'example' => 'This is an example'
        ];
        
    }
}

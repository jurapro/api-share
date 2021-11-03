<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function toArray($request)
    {
        self::$wrap = 'body';

        return [
            'file_id' => $this->id,
            'name' => $this->name,
            'url' => url('/api-share')."/file/{$this->id}"
        ];
    }
}

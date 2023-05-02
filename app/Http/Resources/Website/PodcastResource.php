<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class PodcastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title ?? "",
            "text" => $this->text ?? "",
            "image" => $this->image->image_link ?? "",
            "audio" => $this->audio_link ?? "",
            "price" => intval($this->price),
            "mintues" => intval($this->mintues),
            "date" => $this->date ?? "",
            "IsBuyed" => $this->IsBuyed($request->bearerToken())

        ];
    }
}

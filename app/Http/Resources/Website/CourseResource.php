<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "features" => $this->features ?? "",
            "image" => $this->image->image_link ?? "",
            "video" => $this->video_link ?? "",
            "price" => intval($this->price),
            "number_of_lessons" => count($this->lessons),
        ];
    }
}

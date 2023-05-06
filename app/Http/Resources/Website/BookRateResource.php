<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class BookRateResource extends JsonResource
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
            "rate" => $this->rate,
            "comment" => $this->comment ?? "",
            "user_name" => $this->user->name ?? "",
            "date" => $this->date ?? "",
            "user_image" => $this->user->image->image_link ?? "",
        ];
    }
}

<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "mini_text" => $this->mini_text ?? "",
            "text" => $this->text ?? "",
            "image" => $this->image->image_link ?? "",
            "pdf" => $this->pdf_link ?? "",
            "price" => intval($this->price),
            "number_of_pages" => intval($this->number_of_pages),
            "IsBuyed" => $this->IsBuyed($request->bearerToken())
        ];
    }
}

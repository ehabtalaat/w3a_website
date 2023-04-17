<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteTextResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        ['features_text','courses_text','store_text','doctors_text','blog_text','brief_text','website_reasons_text','experiences_text'];
        return [
            "id" => $this->id,
            "features_text" => $this->features_text ?? "",
            "courses_text" => $this->courses_text ?? "",
            "store_text" => $this->store_text ?? "",
            "doctors_text" => $this->doctors_text ?? "",
            "blog_text" => $this->blog_text ?? "",
            "brief_text" => $this->brief_text ?? "",
            "website_reasons_text" => $this->website_reasons_text ?? "",
            "experiences_text" => $this->experiences_text ?? "",
        ];
    }
}

<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            "name" => $this->name ?? "",
            "mini_description" => $this->mini_description ?? "",
            "description" => $this->description ?? "",
            "image" => $this->image->image_link ?? "",
            "rate" => $this->rate ?? 0,
            "certificates" => CertificateResource::collection($this->certificates),
            "experiences" => ExperienceResource::collection($this->experiences),
        ];
    }
}

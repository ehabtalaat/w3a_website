<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            "website" => $this->website ?? "",
            "phone" => $this->phone ?? "",
            "whatsapp" => $this->whatsapp ?? "",
            "email" => $this->email ?? "",
            "facebook" => $this->facebook ?? "",
            "twitter" => $this->twitter ?? "",
            "linkedin" => $this->linkedin ?? "",
            "instagram" => $this->instagram ?? "",
            "youtube" => $this->youtube ?? "",
        ];
    }
}

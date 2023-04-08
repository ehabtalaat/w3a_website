<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "image" => $this->image->image_link ?? "",
            "gender" => intval($this->gender),
            "chronic_diseases" => $this->chronic_diseases,
            "age" => intval($this->age),
            "api_token" => $this->api_token ?? ""
 
        ];
    }
}

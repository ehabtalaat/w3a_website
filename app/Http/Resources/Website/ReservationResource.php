<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            "user_name" => $this->user_name ?? "",
            "user_phone" => $this->user_phone ?? "",
            "doctor_name" => $this->doctor->name ?? "",
            "doctor_description" => $this->doctor->description ?? "",
            "doctor_image" => $this->doctor->image->image_link ?? "",

            "consultation_title" => $this->consultation->title ?? "",
            "payment_method_title" => $this->payment_method->title ?? "",
            "contact_type" => intval($this->contact_type),
            "for_another_person" => intval($this->for_another_person),
            "another_person_name" => $this->another_person_name ?? "",
            "another_person_phone" => $this->another_person_phone ?? "",
            "date" => $this->date ?? "",
            "images" => $this->images->pluck("image_link")->toArray(),
            "doctor_images" => $this->result  ? $this->result->images->pluck("image_link")->toArray() : [],
            "price" => $this->price ?? null,
            "patient_notes" => $this->patient_notes ?? '',
            "doctor_notes" => $this->result->doctor_notes ?? '',
            "status" => intval($this->status),
            "receipt_image" => $this->receipt_image ? asset($this->receipt_image) : "",
            "type" => intval($this->type),
            "payment_status" => 0


        ];
    }
}

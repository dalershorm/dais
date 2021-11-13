<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'avatar' => $this->avatar,
            'user_type' => $this->user_type,
            'year_of_foundation' => $this->year_of_foundation,
            'description' => $this->description,
            'official_documents' => $this->official_documents,
            'certificates' => $this->certificates,
            'balance' => $this->balance,
            'sales_office' => new SalesOfficeResource($this->sales_office),
        ];
    }
}

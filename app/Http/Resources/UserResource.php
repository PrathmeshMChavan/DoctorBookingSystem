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
        $data = [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
        ];

        if (!is_null($this->gender)) {
            $data['gender'] = $this->gender;
        }

        if (!is_null($this->address)) {
            $data['address'] = $this->address;
        }

        if (!is_null($this->about)) {
            $data['about'] = $this->about;
        }

        if (!is_null($this->profile_photo)) {
            $data['profile_photo'] = $this->profile_photo;
        }

        if (!is_null($this->role)) {
            $data['role'] = $this->role;
        }

        if (!is_null($this->active)) {
            $data['active'] = $this->active;
        }

        return $data;
    }
}

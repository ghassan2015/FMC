<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fcm_token' => $this->fcm_token,
            'token' => $this->plainTextToken ?? $request->bearerToken(),
            'name' => $this->name,
            'provider_id'=>$this->provider_id,
            'provider_name'=>$this->provider_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'id_number'=>$this->id_number,
            'birth_date'=>$this->birth_date,
            'gender'=>new ConstantResource($this->genderCd),
            'lang' => $this->lang ?? 'ar',
            'photo' => $this->photo,

        ];
    }
}

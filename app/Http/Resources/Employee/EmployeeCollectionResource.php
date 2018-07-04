<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCollectionResource extends JsonResource
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
            'id'=> $this->id,
            'name'=> $this->name,
            'code'=> $this->code,
            'contact_no'=> $this->contact_no,
            'email'=> $this->contact_no,
            'user_account'=> function() {
                if($this->user_id != null){
                    return User::select('email')->where('id','=', $this->user_id)->first();
                }
                return null;
            }
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "id"   => $this->name,
            "text" => $this->full_name,
            "logo" => $this->logo_full_url,
        ];
    }
}

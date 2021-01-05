<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CarResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'lat' => $this->lat,
            'lng' => $this->lng
        ];
        return $data;
    }

}

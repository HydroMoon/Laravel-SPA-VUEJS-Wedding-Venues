<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
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
            'venue_name' => $this->venue_name,
            'venue_desc' => $this->venue_desc,
            'location' => $this->location,
            'selected' => false,
            'contact' => new ContactInfoResource($this->whenLoaded('contact')),
            'venue_service' => new VenueServiceResource($this->whenLoaded('venue_service'))
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueServiceResource extends JsonResource
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
            'photography' => $this->photography,
            'videography' => $this->videography,
            'organize_team' => $this->organize_team,
            'overnight' => $this->overnight,
            'jirtg' => $this->jirtg,
            'guests' => $this->guests,
        ];
    }
}

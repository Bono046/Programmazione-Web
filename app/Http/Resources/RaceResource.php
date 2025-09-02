<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaceResource extends JsonResource
{
public function toArray(Request $request): array
    
{
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
        ];

        // Aggiungiamo devices solo se richiesti
        if ($request->query('withDevices')) {
            $data['devices'] = $this->devices;
        }

        return $data;
    }
}

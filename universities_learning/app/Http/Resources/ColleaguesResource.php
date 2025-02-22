<?php

namespace App\Http\Resources;

use App\Actions\DisplayDataWithCurrentLang;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColleaguesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'id' => $this->id,
            'name' => $this->name,
            'info' => $this->info,
            'government' => GovernmentResource::make($this->whenLoaded('government')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];

        if (app()->getLocale() != 'all') {
            $arr['name'] = DisplayDataWithCurrentLang::display($this->name);
            $arr['info'] = DisplayDataWithCurrentLang::display($this->info);
        }

        return $arr;
    }
}

<?php

namespace App\Http\Resourse;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\ResourceCollection;
class PdfResourse extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'draw' => true,
            'recordsTotal' => $this->resource->count(),
            'recordsFiltered' => $this->resource->count(),
            'data' => $this->resource->transform(function($item){
                return [
                    'original_pdf' => $item->original_pdf,
                    'created_at' => $item->created_at,
                    'download'=> Storage::disk('public')->url($item->signed_pdf),
                ];
            }),

        ];
    }
}

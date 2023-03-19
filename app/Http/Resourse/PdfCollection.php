<?php

namespace App\Http\Resourse;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\ResourceCollection;
class PdfCollection extends ResourceCollection
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
            'recordsTotal' => $this->collection->count(),
            'recordsFiltered' => $this->collection->count(),
            'data' => $this->collection->transform(function($item){
                return [
                    'original_pdf' => $item->original_pdf,
                    'created_at' => $item->created_at,
                    'download_original_pdf'=> Storage::disk('public')->url($item->original_pdf),
                    'download_signed_pdf'=> Storage::disk('public')->url($item->signed_pdf),
                ];
            }),

        ];
    }
}

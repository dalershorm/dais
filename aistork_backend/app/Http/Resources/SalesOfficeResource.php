<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SalesOfficeResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray([
        //     'id' => $this->collection
        // ]);
        return [
            'data' => SaleOfficeResource::collection($this->collection),
            'meta' => ['song_count' => $this->collection->count()],
        ];
    }
}

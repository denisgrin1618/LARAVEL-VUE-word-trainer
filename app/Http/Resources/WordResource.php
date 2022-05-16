<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     title="WordResource",
 *     description="Word resource",
 *     @OA\Xml(
 *         name="WordResource"
 *     ),
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="language",
 *          ref="#/components/schemas/LanguageResource"
 *     )
 *     @OA\Property(
 *          property="created_at",
 *          type="date"
 *     ),
 *     @OA\Property(
 *          property="updated_at",
 *          type="date"
 *     ),
 * )
 */
class WordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'language' => new LanguageResource($this->language),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

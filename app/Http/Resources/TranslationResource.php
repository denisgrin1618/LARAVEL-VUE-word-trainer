<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     title="TranslationResource",
 *     description="Translation resource",
 *     @OA\Xml(
 *         name="TranslationResource"
 *     ),
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="word_origin",
 *          ref="#/components/schemas/WordResource"
 *     ),
 *     @OA\Property(
 *          property="word_translation",
 *          ref="#/components/schemas/WordResource"
 *     )
 * )
 */
class TranslationResource extends JsonResource
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
            'word_origin' => new WordResource($this->wordOrigin),
            'word_translation' => new WordResource($this->wordTranslation),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

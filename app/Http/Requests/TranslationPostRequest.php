<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="Store Translation request",
 *      description="Store Translation request body data",
 *      type="object",
 *      required={"word_origin_id","word_translation_id"},
 *      @OA\Property(
 *          property="word_origin_id",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="word_translation_id",
 *          example="1"
 *      )
 * )
 */
class TranslationPostRequest extends ParentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word_origin_id' => 'required|exists:words,id',
            'word_translation_id' => 'required|exists:words,id|different:word_origin_id'
        ];
    }
}

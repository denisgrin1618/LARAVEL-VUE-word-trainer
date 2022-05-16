<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="Store Word request",
 *      description="Store Word request body data",
 *      type="object",
 *      required={"name","language_id"},
 *      @OA\Property(
 *          property="name",
 *          example="A nice word"
 *      ),
 *      @OA\Property(
 *          property="language_id",
 *          example="1"
 *      )
 * )
 */
class WordPostRequest extends ParentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'language_id' => 'required|exists:languages,id'
        ];
    }
}

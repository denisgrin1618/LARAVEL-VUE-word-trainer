<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
class TranslationPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}

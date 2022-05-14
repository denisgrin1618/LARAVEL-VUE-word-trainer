<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
class WordPostRequest extends FormRequest
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
            'name' => 'required',
            'language_id' => 'required|exists:languages,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['data' => $validator->errors()], 422)
        );
    }
}

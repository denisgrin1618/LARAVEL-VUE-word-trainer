<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::all();
    
        return $this->sendResponse(WordResource::collection($words), 'Words retrieved successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'language_id' => 'required|exists:languages,id'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $word = Word::create($input);
   
        return $this->sendResponse(new WordResource($word), 'Word created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        if (is_null($word)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new WordResource($word), 'Word retrieved successfully.');
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'language_id' => 'required|exists:languages,id'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $word->update($input);
   
        return $this->sendResponse(new WordResource($word), 'Word updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Word $word)
    {
        $word->delete();
   
        return $this->sendResponse([], 'Word deleted successfully.');
    }
}
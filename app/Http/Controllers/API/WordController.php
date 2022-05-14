<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\WordPostRequest;
use App\Http\Resources\WordResource;
use App\Repositories\WordRepositoryInterface;

class WordController extends Controller
{

    private $wordRepository;

    public function __construct(WordRepositoryInterface $wordRepository) {
        $this->wordRepository = $wordRepository;
    }

    /**
     * @OA\Get(
     *   path="/api/words",
     *   summary="list of words",
     *   security={ {"sanctum": {} }},
     *   @OA\Response(
     *     response=200,
     *     description="A list with words"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function index(Request $request)
    {
        $words = $this->wordRepository->all();
    
        return $this->sendResponse(WordResource::collection($words), 'Words retrieved successfully.'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordPostRequest $request)
    {
        $word = $this->wordRepository->create($request->validated());
   
        return $this->sendResponse(new WordResource($word), 'Word created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $word = $this->wordRepository->findById($id);

        if (is_null($word)) {
            return $this->sendError('Word not found.');
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
    public function update(WordPostRequest $request, $id)
    {
        $word = $this->wordRepository->update($id, $request->validated());
   
        return $this->sendResponse(new WordResource($word), 'Word updated successfully.');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->wordRepository->destroy($id);
   
        return $this->sendResponse([], 'Word deleted successfully.');
    }
}

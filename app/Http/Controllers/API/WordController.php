<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\WordPostRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use App\Repositories\WordRepositoryInterface;
use Illuminate\Http\Response;

/**
 * @OA\Tag(name="Words")
 */
class WordController extends Controller
{

    private $wordRepository;

    public function __construct(WordRepositoryInterface $wordRepository) {
        $this->wordRepository = $wordRepository;
    }

    /**
     * @OA\Get(
     *   path="/v1/words",
     *   summary="list of words",
     *   tags={"Words"},
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
    
        return WordResource::collection($words); 
    }

    /**
     * @OA\Post(
     *      path="/v1/words",
     *      operationId="storeWord",
     *      summary="Store new word",
     *      tags={"Words"},
     *      description="Returns word data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/WordPostRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/WordResource")
     *       )
     * )
     */
    public function store(WordPostRequest $request)
    {
        $word = $this->wordRepository->create($request->validated());
   
        return (new WordResource($word))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/v1/words/{id}",
     *      operationId="getWordById",
     *      tags={"Words"},
     *      summary="Get word information",
     *      description="Returns project word",
     *      @OA\Parameter(
     *          name="id",
     *          description="Word id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/WordResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function show(Word $word)
    {
        return new WordResource($word);
    }

    /**
     * @OA\Put(
     *      path="/v1/words/{id}",
     *      operationId="updateWord",
     *      tags={"Words"},
     *      summary="Update existing word",
     *      description="Returns updated word data",
     *      @OA\Parameter(
     *          name="id",
     *          description="word id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/WordPostRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/WordResource")
     *       )
     * )
     */
    public function update(WordPostRequest $request, $id)
    {
        $word = $this->wordRepository->update($id, $request->validated());
   
        return (new WordResource($word))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/v1/words/{id}",
     *      operationId="deleteWord",
     *      tags={"Words"},
     *      summary="Delete existing word",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Word id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     * )
     */
    public function destroy(Word $word)
    {
        $word->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\TranslationPostRequest;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use App\Repositories\TranslationRepositoryInterface;
use Illuminate\Http\Response;

/**
 * @OA\Tag(name="Translations")
 */
class TranslationController extends Controller
{

    private $repo;

    public function __construct(TranslationRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *   path="/v1/translations",
     *   summary="list of translations",
     *   tags={"Translations"},
     *   @OA\Response(
     *     response=200,
     *     description="A list with translations"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function index(Request $request)
    {
        $translations = $this->repo->all();
    
        return TranslationResource::collection($translations); 
    }

    /**
     * @OA\Post(
     *      path="/v1/translations",
     *      operationId="storeTranslation",
     *      summary="Store new translation",
     *      tags={"Translations"},
     *      description="Returns translation data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TranslationPostRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
     *       )
     * )
     */
    public function store(TranslationPostRequest $request)
    {
        $translation = $this->repo->create($request->validated());
   
        return (new TranslationResource($translation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/v1/translations/{id}",
     *      operationId="getTranslationById",
     *      tags={"Translations"},
     *      summary="Get translation information",
     *      description="Returns translation",
     *      @OA\Parameter(
     *          name="id",
     *          description="Translation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function show(Translation $translation)
    {
        return new TranslationResource($translation);
    }

    /**
     * @OA\Put(
     *      path="/v1/translations/{id}",
     *      operationId="updateTranslation",
     *      tags={"Translations"},
     *      summary="Update existing translation",
     *      description="Returns updated translation data",
     *      @OA\Parameter(
     *          name="id",
     *          description="translation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TranslationPostRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
     *       )
     * )
     */
    public function update(TranslationPostRequest $request, Translation $translation)
    {
        $translation = $this->repo->update($translation, $request->validated());
   
        return (new TranslationResource($translation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/v1/translations/{id}",
     *      operationId="deleteTranslation",
     *      tags={"Translations"},
     *      summary="Delete existing translation",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Translation id",
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
     *      )
     * )
     */
    public function destroy(Translation $translation)
    {
        $this->repo->destroy($translation);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

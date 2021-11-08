<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Http\Resources\News\NewsResource;
use App\Services\News\NewsService;


/**
 * @OA\Info(
 *   version="1.0",
 *   title="NEWS SERVICE",
 * ),
 * @OA\Server(
 *     url="http://localhost:8080/api",
 * ),
 *
 */

class NewsController extends Controller
{
    private $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }
    /**
     * @OA\Get (
     *     path="/news",
     *     summary="Получить все новости",
     *     tags={"News API"},
     *     operationId="index",
     *
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data",
     *                       @OA\Property(property="id", type="string",example="1"),
     *                       @OA\Property(property="title", type="string",example="Тест"),
     *                       @OA\Property(property="tуче", type="string",example="Текст текст текст ..."),
     *                      @OA\Property(property="image", type="string",example="http://localhost:8080/storage/news_images/1hwGtnuKAmwFysMD3gRb6JtiIOG2l0RMezbc73m1.png"),
     *                  ),
     *              )
     *          )
     *      ),
     *
     * )
     */

    public function index()
    {
        return NewsResource::collection($this->service->getNewsList());
    }

    /**
     * @OA\Post (
     *      path="/news",
     *     summary="Создать новость",
     *     tags={"News API"},
     *     operationId="store",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *               required={"title", "description", "text", "image"},
     *                  @OA\Property (property="title", type="string"),
     *                  @OA\Property (property="description", type="string"),
     *                  @OA\Property (property="text", type="string"),
     *                  @OA\Property( property="image", type="file",
     *                      @OA\Property (type="string", format="binary")
     *                  ),
     *               ),
     *           ),
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     *
     */


    public function store(CreateRequest $request)
    {
        return new NewsResource($this->service->create($request));
    }

    /**
     * @OA\Get(
     *     path="/news/{id}",
     *     summary="Получить новость",
     *     tags={"News API"},
     *     operationId="show",
     *     @OA\Parameter(
     *          name="id",
     *          description="news id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data",
     *                       @OA\Property(property="id", type="string",example="1"),
     *                       @OA\Property(property="title", type="string",example="Тест"),
     *                       @OA\Property(property="text", type="string",example="Текст текст текст ..."),
     *                      @OA\Property(property="image", type="string",example="http://localhost:8080/storage/news_images/1hwGtnuKAmwFysMD3gRb6JtiIOG2l0RMezbc73m1.png"),
     *                  ),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     */


    public function show($id)
    {
        return new NewsResource($this->service->getNews($id));
    }

    /**
     * @OA\Post (
     *      path="/news/{id}/update",
     *     summary="Обновить новость",
     *     tags={"News API"},
     *     operationId="update",
     *     @OA\Parameter(
     *          name="id",
     *          description="news id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *               required={"title", "description", "text", "image"},
     *                  @OA\Property (property="title", type="string"),
     *                  @OA\Property (property="description", type="string"),
     *                  @OA\Property (property="text", type="string"),
     *                  @OA\Property( property="image", type="file",
     *                      @OA\Property (type="string", format="binary")
     *                  ),
     *               ),
     *           ),
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessible entity",
     *    ),
     *    @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     *
     */


    public function update(UpdateRequest $request, $id)
    {
        return new NewsResource($this->service->update($request, $id));
    }

    /**
     * @OA\Post(
     *     path="/news/{id}/publish",
     *     summary="Опубликовать новость",
     *     tags={"News API"},
     *     operationId="publish",
     *     @OA\Parameter(
     *          name="id",
     *          description="news id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data",
     *                       @OA\Property(property="id", type="string",example="1"),
     *                       @OA\Property(property="title", type="string",example="Тест"),
     *                       @OA\Property(property="text", type="string",example="Текст текст текст ..."),
     *                       @OA\Property(property="image", type="string",example="http://localhost:8080/storage/news_images/1hwGtnuKAmwFysMD3gRb6JtiIOG2l0RMezbc73m1.png"),
     *                       @OA\Property(property="published_at", type="string",example="2021-11-08 04:11:05"),
     *                  ),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors.",
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     */

    public function publish($id)
    {
        return new NewsResource($this->service->makePublish($id));
    }

    /**
     * @OA\Post(
     *     path="/news/{id}/unpublish",
     *     summary="Отключить публикацию",
     *     tags={"News API"},
     *     operationId="unpublish",
     *     @OA\Parameter(
     *          name="id",
     *          description="news id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data",
     *                       @OA\Property(property="id", type="string",example="1"),
     *                       @OA\Property(property="title", type="string",example="Тест"),
     *                       @OA\Property(property="text", type="string",example="Текст текст текст ..."),
     *                       @OA\Property(property="image", type="string",example="http://localhost:8080/storage/news_images/1hwGtnuKAmwFysMD3gRb6JtiIOG2l0RMezbc73m1.png"),
     *                       @OA\Property(property="published_at", type="string",example="null"),
     *                  ),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     */

    public function unpublish($id)
    {
        return new NewsResource($this->service->makeUnpublish($id));
    }

    /**
     * @OA\Delete  (
     *      path="/news/{id}",
     *     summary="Удалить новость",
     *     tags={"News API"},
     *     operationId="destroy",
     *     @OA\Parameter(
     *       name="id",
     *       description="news id",
     *       in="path",
     *       required=true,
     *     @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found.",
     *      ),
     * )
     *
     */

    public function destroy($id)
    {
        return new NewsResource($this->service->delete($id));
    }
}

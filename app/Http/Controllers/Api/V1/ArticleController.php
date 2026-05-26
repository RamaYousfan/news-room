<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\V1\ArticleResource;
use App\Services\Article\ArticleService;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}


    public function index()
    {
        return ArticleResource::collection(

            $this->articleService->getAll()

        );
    }


    public function show($id)
    {
        return new ArticleResource(

            $this->articleService->getById($id)

        );
    }


    public function store(
        StoreArticleRequest $request
    )
    {

        $article =

        $this->articleService

        ->create(

            $request->validated()

        );


        return new ArticleResource(

            $article

        );

    }



    public function update(

        UpdateArticleRequest $request,

        $id

    )
    {

        $article =

        $this->articleService

        ->update(

            $id,

            $request->validated()

        );


        return new ArticleResource(

            $article

        );

    }



    public function destroy($id)
    {

        $this->articleService->delete(

            $id

        );


        return response()->json([

            'message'

            =>

            'Deleted'

        ]);

    }
}
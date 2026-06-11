<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
 use App\Http\Resources\V1\ArticleResource;
use App\Services\Article\ArticleService;
 use App\Mail\ArticlePublishedMail;
use App\Jobs\NotifySubscribersJob;
use App\Models\Article;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{     use AuthorizesRequests, ApiResponse;
    public function __construct(
        protected ArticleService $articleService
    ) {}


    public function index()
    {
 return $this->success(ArticleResource::collection($this->articleService->getAll()),'Articles retrieved');
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

        $article = $this->articleService->create( $request->validated() );


        return new ArticleResource( $article);

    }



    public function update(UpdateArticleRequest $request, $id )
    {

        $article =$this->articleService->update($id,$request->validated()  );
        return new ArticleResource($article);

    }

public function destroy($id)
{
    $this->articleService->delete($id);

    return response()->json(['message' => 'Deleted' ], 200);
}


    
    public function publish(Article $article)
{
    $this->authorize('publish', $article);

    $article->update(['status' => 'published']);

    Mail::to($article->user->email)
        ->queue(new ArticlePublishedMail($article));

    dispatch(new NotifySubscribersJob($article));

   return $this->success(null, 'Article published successfully');
}
}
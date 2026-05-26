<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct(
        protected CommentService $commentService
    ){}

    public function store(Request $request)
    {

        return $this->commentService
            ->create($request->all());

    }


    public function destroy($id)
    {

        return $this->commentService
            ->delete($id);

    }

}
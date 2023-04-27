<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CommentController extends Controller
{
    /**
     * Add a new comment to the news.
     *
     * @param CommentRequest $request
     * @return Response
     */
    public function store(CommentRequest $request): Response
    {
        Comment::create($request->validated());
        return response()->noContent(HttpFoundationResponse::HTTP_CREATED);
    }
}

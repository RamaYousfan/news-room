<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{

    public function view( User $user, Article $article ): bool
    {

        return

        $article->status === 'published'  || $user->hasRole('admin' )|| $article->user_id === $user->id;

    }



    public function update(User $user,Article $article): bool
    {

        return $user->hasRole('admin') ||$article->user_id === $user->id;}



    public function delete( User $user,Article $article): bool
    {

        return $user->hasRole('admin' );
        }
        public function publish(User $user, Article $article): bool
{
 return $user->role === 'writer'&& $article->user_id === $user->id;}

}
<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class MainService
{
    public function collectData(array $posts, array $comments)
    {
        $insertPostsData = Post::upsert($posts, ['userId', 'id', 'title', 'body']);
        $insertCommentsData = Comment::upsert($comments, ['postId', 'id', 'name', 'email', 'body']);
        return ['post' => $insertPostsData, 'comment' => $insertCommentsData];
    }

    public function searchPost(string $word)
    {
//        $data = Comment::select(['title' => Post::select('title')
//            ->whereColumn('postId', 'post.id')])
//            ->where('body', 'like', '%enim%')
//            ->get(['title', 'body']);
        $data = Comment::where('body', 'like', '%enim%')
            ->get();

        dd($data->post);
        $data = $data->toArray();
        dd($data);
        $posts = [];

       foreach ($data as $item) {
           if (array_key_exists($item['postId'], $posts)) {
               $posts[$item['postId']]['comments'][] = ['id' => $item['id'], 'body' => $item['body']];
           } else {
               $posts[$item['postId']] = ['title' => $item['title'], 'comments' => [['id' => $item['id'], 'body' => $item['body']]]];
           }
       }
       dd($posts);
    }
}

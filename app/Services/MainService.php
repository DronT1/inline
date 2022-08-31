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
//        $comments = Comment::where('body', 'like', '%enim%')->get(['postId', 'body']);
        $data = Comment::addSelect(['title' => Post::select('title')
            ->whereColumn('postId', 'posts.id')])
            ->where('body', 'like', '%enim%')
            ->get(['title', 'body']);
        $data = $data->toArray();
        $posts = [];
        $data = [
            [
              "postId" => 1,
              "id" => 1,
              "name" => "id labore ex et quam laborum",
              "email" => "Eliseo@gardner.biz",
              "body" => "laudantium enim quasi est quidem magnam voluptate ipsam eos",
              "created_at" => "2022-08-31T05:34:45.000000Z",
              "updated_at" => "2022-08-31T05:34:45.000000Z",
              "title" => "sunt aut facere repellat provident occaecati excepturi optio reprehenderit"
            ],
            [
                "postId" => 1,
                "id" => 2,
                "name" => "id labore ex et quam laborum",
                "email" => "Eliseo@gardner.biz",
                "body" => "laui est quidem magnam voluptate ipsam eos",
                "created_at" => "2022-08-31T05:34:45.000000Z",
                "updated_at" => "2022-08-31T05:34:45.000000Z",
                "title" => "lat provident occaecati excepturi optio reprehenderit"
            ]
       ];
       $test = [
//           1 => [
//               'title' => 'test title',
//               'comments' => ['id' => 1, 'body' => 'comment body']
//           ],
//           2 => [
//               'title' => 'test title2',
//               'comments' => ['id' => 1, 'body' => 'comment body2']
//           ]
       ];
//        dd($test[1]['comments']);
       foreach ($data as $item) {
//           dd($item['postId']);
           if (array_key_exists($item['postId'], $test)) {
//               array_push($test[$item['postId']], [''])
//               array_push($test[$item['postId']['comments']], ['id' => $item['id'], 'body' => $item['body']]);
//               dd($test);
               $test[$item['postId']['comments']][] = ['id' => $item['id'], 'body' => $item['body']];
           } else {
            $test[$item['postId']] = ['title' => $item['title'], 'comments' => [['id' => $item['id'], 'body' => $item['body']]]];
           }
       }
//       dd($test);
//        dd($data->toArray());
    }
}

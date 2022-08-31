<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MainController extends Controller
{
    protected $mainService;

    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function getJsonData(string $url)
    {
        return json_decode(file_get_contents($url), true);
    }

    public function index()
    {
        return view('home');
    }

    public function collectData()
    {
        $jsonPosts = $this->getJsonData('https://jsonplaceholder.typicode.com/posts');
        $jsonComments = $this->getJsonData('https://jsonplaceholder.typicode.com/comments');
        $dataLength = $this->mainService->collectData($jsonPosts, $jsonComments);
        return view('home', compact('dataLength'));
    }

    public function search()
    {
        return view('search');
    }

    public function searchPost(Request $request)
    {
        $word = $request->validate([
            'word' => ['required', 'string', 'min:3']
        ]);
//        dd($word);
        $data = $this->mainService->searchPost($word['word']);

    }
}

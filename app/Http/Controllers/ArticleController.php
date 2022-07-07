<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class ArticleController extends Controller
{
    public function index(Request $request)
    {

        $articles=Article::when($request->has("title"),function($q)use($request){
            return $q->where("title","like","%".$request->get("title")."%");
        })->paginate(5);
        if($request->ajax()){
            return view('articles.article-pagination ',['articles'=>$articles]); 
        } 
        return view('articles.article ',['articles'=>$articles]);
    }
}
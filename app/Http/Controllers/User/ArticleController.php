<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::orderBy('posted_date')->take(5)->get();
        return view('users.top', compact('articles'));
    }

    public function showArticle(Article $article) {
        return view('users.article', compact('article'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required|string',
        ]);

        Article::create($request->all());

        return redirect()->back()->with('success', '記事が作成されました。');
        
        }
}


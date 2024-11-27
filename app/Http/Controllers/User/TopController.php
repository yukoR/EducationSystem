<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculums;
use App\Models\Banner;
use App\Models\Article;
use App\Models\CurriculumProgress;

class TopController extends Controller
{
    public function __construct() {
        // 認証ミドルウェアを適用し、ログインしていない場合ログインページにリダイレクト
        $this->middleware('auth');
    }
    
    public function showTop() {
        $banners = Banner::all();
        $articles = Article::orderBy('posted_date')->take(5)->get();
        return view('users.top', compact('banners', 'articles'));
    }

    public function showTest($viewType) {
        $curriculums = Curriculums::all();
        switch ($viewType) {
            case 'profile':
                return view('users.profile');
            case 'curriculum_list':
                return view('users.curriculum_list', compact('curriculums'));
            case 'curriculum_progress':
                return view('users.curriculum_progress');
            default:
                abort(404);
        };
    }
}

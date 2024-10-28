<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculums;
use App\Models\Video;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション: 動画ファイルが必須
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:20000', // 動画ファイルのフォーマットと最大サイズ(20MB)
        ]);

        // 動画ファイルをstorage/public/videosに保存
        $path = $request->file('video')->store('videos', 'public');

        // データベースにファイルパスを保存
        $video = new Curriculums();
        $video->video_url = $path;
        $video->save();

        return back()->with('success', '動画がアップロードされました');
    }
}

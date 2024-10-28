<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 必要に応じてバリデーションを追加
        ]);
    
        // アップロードしたファイルを処理する
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');

            Banner::create([
                'image' => $imagePath,
            ]);
        }
    
        return redirect()->back()->with('status', 'バナーが登録されました。');
    }
}

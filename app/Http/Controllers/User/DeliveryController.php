<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grades;
use App\Models\Curriculums;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use App\Models\Video;

class DeliveryController extends Controller
{
    public function showDelivery($id) {
        $user = auth()->user();
        $curriculum = Curriculums::with('deliveryTimes', 'grades')->findOrFail($id);
        $video = Curriculums::where('video_url', $curriculum->video_url)->first();
        //dd($curriculum->grades->name);
        return view('users.delivery',compact( 'curriculum', 'video'));
    }
}

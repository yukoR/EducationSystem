<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grades;
use App\Models\Curriculums;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use App\Models\Video;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    public function showDelivery($id) {
        $user = auth()->user();
        $curriculum = Curriculums::with('deliveryTimes', 'grades')->findOrFail($id);
        $video = Curriculums::where('video_url', $curriculum->video_url)->first();

        $currentDate = Carbon::now();
        $deliveryTimes = $curriculum->deliveryTimes;
        $isAvailable = false;

        if (!empty($deliveryTimes)) {
            foreach ($deliveryTimes as $deliveryTime) {
                if (is_object($deliveryTime)) {
                    if (isset($deliveryTime -> delivery_from, $deliveryTime -> delivery_to) &&
                    $currentDate -> between($deliveryTime -> delivery_from, $deliveryTime -> delivery_to)) {
                        $isAvailable = true;
                        break;
                    }
                }
                elseif (is_array($deliveryTime)) {
                    $deliveryTime = (object) $deliveryTime;

                    if (isset($deliveryTime -> delivery_from, $deliveryTime -> delivery_to) &&
                    $currentDate -> between($deliveryTime -> delivery_from, $deliveryTime -> delivery_to)) {
                        $isAvailable = true;
                        break;
                    }
                }
            }
        }
        return view('users.delivery',compact( 'curriculum', 'video', 'isAvailable'));
    }

    public function markAsCompleted($id) {
        $curriculumProgress = CurriculumProgress::where('curriculums_id', $id)->first();
        
        if ($curriculumProgress) {
            $curriculumProgress->clear_flg = 1;
            $curriculumProgress->save();
        }
        return redirect()->back()->with('status', '受講が完了しました！');
    }
}

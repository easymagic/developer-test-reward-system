<?php

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users/{user}/achievements',function($user, UserActivityInterface $userActivityInterface){

    return [
      'unlocked_achievements'=>$userActivityInterface->getUnlockedAchievements($user),
      'next_available_achievements'=>[
          'lessons_watched'=>$userActivityInterface->getNextAvailableLessonAchievements($user),
          'comments_written'=>$userActivityInterface->getNextAvailableCommentAchievements($user)
      ],
      'current_badge'=>$userActivityInterface->getCurrentBadge($user),
      'next_badge'=>$userActivityInterface->getNextBadgeFromCurrentBadge($user),
      'remaining_to_unlock_next_badge'=>$userActivityInterface->getRemainingToUnlockNextBadge($user)
    ];
    //getNextBadgeFromCurrentBadge
    //getRemainingToUnlockNextBadge


});

Route::get('log-lesson-watched/{userId}',function($userId,UserActivityInterface $userActivityInterface,AchievementInterface $achievementInterface){

    $userActivityInterface->logLessonWatched($userId,$achievementInterface);

    return [
        'message'=>'Lesson watched logged successfully',
        'error'=>false
    ];

});

Route::get('log-comment-written/{userId}',function($userId,UserActivityInterface $userActivityInterface,AchievementInterface $achievementInterface){

    $userActivityInterface->logCommentWritten($userId,$achievementInterface);

    return [
        'message'=>'Comment Written logged successfully',
        'error'=>false
    ];

});

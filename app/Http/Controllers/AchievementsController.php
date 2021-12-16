<?php

namespace App\Http\Controllers;

use App\Interfaces\UserActivityInterface;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user,UserActivityInterface $userActivityInterface)
    {
        return response()->json([
            'unlocked_achievements' => $userActivityInterface->getUnlockedAchievements($user->id),
            'next_available_achievements' => [
                         'lessons_watched'=>$userActivityInterface->getNextAvailableLessonAchievements($user->id),
                         'comments_written'=>$userActivityInterface->getNextAvailableCommentAchievements($user->id)
             ],
            'current_badge' => $userActivityInterface->getCurrentBadge($user->id),
            'next_badge' => $userActivityInterface->getNextBadgeFromCurrentBadge($user->id),
            'remaing_to_unlock_next_badge' => $userActivityInterface->getRemainingToUnlockNextBadge($user->id)
        ]);

        // return [
        //     'unlocked_achievements'=>$userActivityInterface->getUnlockedAchievements($user),
        //     'next_available_achievements'=>[
        //         'lessons_watched'=>$userActivityInterface->getNextAvailableLessonAchievements($user),
        //         'comments_written'=>$userActivityInterface->getNextAvailableCommentAchievements($user)
        //     ],
        //     'current_badge'=>$userActivityInterface->getCurrentBadge($user),
        //     'next_badge'=>$userActivityInterface->getNextBadgeFromCurrentBadge($user),
        //     'remaining_to_unlock_next_badge'=>$userActivityInterface->getRemainingToUnlockNextBadge($user)
        //   ];

    }
}

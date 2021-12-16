<?php
namespace App\Repositories;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use App\Models\UserActivity;

class UserActivityRepository implements UserActivityInterface{


    function logLessonWatched($userId, $lessionId, AchievementInterface $achievementInterface)
    {

        UserActivity::create([
            'user_id'=>$userId,
            'type'=>AchievementRepository::LESSON_WATCHED
        ]);

        $countLessonWatched = $achievementInterface->getCountLessonWatched($userId);

        if ($achievementInterface->hasUnlockedNewAchievement($countLessonWatched,AchievementRepository::LESSON_WATCHED)){
            $newAchivement = $achievementInterface->getUnlockedAchievement($countLessonWatched,AchievementRepository::LESSON_WATCHED);
            $achievementInterface->logLessonWatchedAchievement($newAchivement->id,$userId);
        }

        $countAchievements = $achievementInterface->getCountAchievements($userId);

        if ($achievementInterface->hasUnlockedNewBadge($countAchievements)){
           $newBadge = $achievementInterface->getUnlockedNewBadge($countAchievements);
           $achievementInterface->logBadgeAchievement($newBadge->id,$userId);
        }


        return [
            'message'=>'Logged Lesson Watched',
            'error'=>false
        ];

    }

    function logCommentWritten($userId, $commentId, AchievementInterface $achievementInterface)
    {

        UserActivity::create([
            'user_id'=>$userId,
            'type'=>AchievementRepository::COMMENT_WRITTEN
        ]);

        $countCommentWritten = $achievementInterface->getCountCommentWritten($userId);

        if ($achievementInterface->hasUnlockedNewAchievement($countCommentWritten,AchievementRepository::COMMENT_WRITTEN)){
           $newAchivement = $achievementInterface->getUnlockedAchievement($countCommentWritten,AchievementRepository::COMMENT_WRITTEN);
           $achievementInterface->logCommentWrittenAchievement($newAchivement->id,$userId);
        }

        $countAchievements = $achievementInterface->getCountAchievements($userId);

        if ($achievementInterface->hasUnlockedNewBadge($countAchievements)){
          $newBadge = $achievementInterface->getUnlockedNewBadge($countAchievements);
          $achievementInterface->logBadgeAchievement($newBadge->id,$userId);
        }

        return [
            'message'=>'Logged Lesson Watched',
            'error'=>false
        ];

    }

}

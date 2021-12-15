<?php
namespace App\Repositories;

use App\Interfaces\AchievementInterface;

class AchievementRepository implements AchievementInterface{


    function getCountAchievements($userId)
    {

    }

    function getCountCommentWritten($userId)
    {

    }

    function getCountLessonWatched($userId)
    {

    }

    function getNextBadge($badgeCriteriaConfigId)
    {

    }

    function getNextCommentWrittenAchievement($achievementCriteriaConfigId)
    {

    }

    function getNextLessonWatchedAchievement($achievementCriteriaConfigId)
    {

    }

    function userHasAchievement($achievementCriteriaConfigId)
    {

    }

    function userHasBadgeAchievement($badgeCriteriaConfigId)
    {

    }

    function hasUnlockedNewAchievement($hitCount, $type)
    {

    }

    function getUnlockedAchievement($hitCount, $type)
    {

    }

    function getUnlockedNewBadge($hitCount)
    {

    }

    function logCommentWrittenAchievement($achievementCriteriaConfigId, $userId)
    {

    }

    function logLessonWatchedAchievement($achievementCriteriaConfigId, $userId)
    {

    }

    function logBadgeAchievement($badgeCriteriaConfigId, $userId)
    {

    }

    function hasUnlockedNewBadge($countAchievements)
    {

    }


}

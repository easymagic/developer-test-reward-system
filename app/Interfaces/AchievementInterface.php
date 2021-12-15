<?php
namespace App\Interfaces;

interface AchievementInterface{


    function getCountLessonWatched($userId);
    function getCountCommentWritten($userId);
    function getNextLessonWatchedAchievement($achievementCriteriaConfigId);
    function getNextCommentWrittenAchievement($achievementCriteriaConfigId);
    function userHasAchievement($achievementCriteriaConfigId);
    function hasUnlockedNewAchievement($hitCount,$type);//hit_count_requirement
    function getUnlockedAchievement($hitCount,$type);

    function getCountAchievements($userId);
    function getNextBadge($badgeCriteriaConfigId);
    function userHasBadgeAchievement($badgeCriteriaConfigId);
    function getUnlockedNewBadge($hitCount); //hit_count_requirement

}

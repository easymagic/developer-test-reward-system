<?php
namespace App\Interfaces;

interface AchievementInterface{


    function getCountLessonWatched($userId);
    function getCountCommentWritten($userId);
    function getNextLessonWatchedAchievement($achievementCriteriaConfigId);
    function getNextCommentWrittenAchievement($achievementCriteriaConfigId);
    function userHasAchievement($userId,$achievementCriteriaConfigId);
    function hasUnlockedNewAchievement($hitCount,$type);//hit_count_requirement
    function getUnlockedAchievement($hitCount,$type);

    function getCountAchievements($userId);
    function getNextBadge($badgeCriteriaConfigId);
    function userHasBadgeAchievement($userId,$badgeCriteriaConfigId);
    function getUnlockedNewBadge($hitCount); //hit_count_requirement
    function hasUnlockedNewBadge($countAchievements);


    function logCommentWrittenAchievement($achievementCriteriaConfigId,$userId);
    function logLessonWatchedAchievement($achievementCriteriaConfigId,$userId);
    function logBadgeAchievement($badgeCriteriaConfigId,$userId);

}

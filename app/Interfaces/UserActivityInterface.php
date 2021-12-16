<?php
namespace App\Interfaces;

interface UserActivityInterface{

    function logLessonWatched($userId , AchievementInterface $achievementInterface);
    function logCommentWritten($userId , AchievementInterface $achievementInterface);
    function getUnlockedAchievements($userId);
    function getRecentLessonWatchedAchievement($userId);
    function getRecentCommentWrittenAchievement($userId);
    function getNextAvailableCommentAchievements($userId);
    function getNextAvailableLessonAchievements($userId);
    function getCurrentBadge($userId);
    function getNextBadgeFromCurrentBadge($userId);
    function getRemainingToUnlockNextBadge($userId);
    //remaining_to_unlock_next_badge



}

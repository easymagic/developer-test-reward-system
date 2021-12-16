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


}

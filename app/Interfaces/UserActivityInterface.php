<?php
namespace App\Interfaces;

interface UserActivityInterface{

    function logLessonWatched($userId , AchievementInterface $achievementInterface);
    function logCommentWritten($userId , AchievementInterface $achievementInterface);

}

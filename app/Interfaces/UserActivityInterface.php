<?php
namespace App\Interfaces;

interface UserActivityInterface{

    function logLessonWatched($userId,$lessionId , AchievementInterface $achievementInterface);
    function logCommentWritten($userId,$commentId , AchievementInterface $achievementInterface);

}

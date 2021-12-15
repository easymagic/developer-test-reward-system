<?php
namespace App\Repositories;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;

class UserActivityRepository implements UserActivityInterface{

    function logLessonWatched($userId, $lessionId, AchievementInterface $achievementInterface)
    {


    }

    function logCommentWritten($userId, $commentId, AchievementInterface $achievementInterface)
    {

    }

}

<?php
namespace App\Repositories;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use App\Models\AchievementCriteriaConfig;
use App\Models\BadgeCriteriaConfig;
use App\Models\UserActivity;
use Illuminate\Database\Eloquent\Builder;

class UserActivityRepository implements UserActivityInterface{


    function logLessonWatched($userId, AchievementInterface $achievementInterface)
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

    function logCommentWritten($userId, AchievementInterface $achievementInterface)
    {

        UserActivity::create([
            'user_id'=>$userId,
            'type'=>AchievementRepository::COMMENT_WRITTEN
        ]);

        $countCommentWritten = $achievementInterface->getCountCommentWritten($userId);

        // dd($countCommentWritten);

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

    function getUnlockedAchievements($userId)
    {
       return AchievementCriteriaConfig::query()->whereHas('users',function(Builder $builder) use ($userId){
         return $builder->where('user_id',$userId);
       })->pluck('name');
    }

    function getRecentCommentWrittenAchievement($userId)
    {
      return AchievementCriteriaConfig::query()->whereHas('users',function(Builder $builder) use ($userId){
          return $builder->where('user_id',$userId);
      })->where('type',AchievementRepository::COMMENT_WRITTEN)->orderBy('sequence_order','desc')->first();
    }

    function getRecentLessonWatchedAchievement($userId)
    {
        return AchievementCriteriaConfig::query()->whereHas('users',function(Builder $builder) use ($userId){
            return $builder->where('user_id',$userId);
        })->where('type',AchievementRepository::LESSON_WATCHED)->orderBy('sequence_order','desc')->first();
    }

    function getNextAvailableCommentAchievements($userId)
    {
        $recent = $this->getRecentCommentWrittenAchievement($userId);
        $index = 0;
        if ($recent){
         $index = $recent->id;
        }
        return AchievementCriteriaConfig::query()
        ->where('id','>',$index)
        ->where('type',AchievementRepository::COMMENT_WRITTEN)->orderBy('sequence_order','desc')->get();
    }

    function getNextAvailableLessonAchievements($userId)
    {
        $recent = $this->getRecentLessonWatchedAchievement($userId);
        $index = 0;
        if ($recent){
         $index = $recent->id;
        }
        return AchievementCriteriaConfig::query()
        ->where('id','>',$index)
        ->where('type',AchievementRepository::LESSON_WATCHED)->orderBy('sequence_order','desc')->get();
    }

    function getCurrentBadge($userId)
    {

       return BadgeCriteriaConfig::query()->whereHas('users',function(Builder $builder) use ($userId){
          return $builder->where('user_id',$userId);
       })->orderBy('id','desc')->first();

    }

    function getNextBadgeFromCurrentBadge($userId)
    {
       $current = $this->getCurrentBadge($userId);

       if ($current){

         return BadgeCriteriaConfig::query()
         ->where('sequence_order',$current->sequence_order + 1)
         ->first();

       }

       return $current;

    }

    function getRemainingToUnlockNextBadge($userId)
    {
        $current = $this->getCurrentBadge($userId);
        $next = $this->getNextBadgeFromCurrentBadge($userId);

        if ($current){
          if ($next){
            return ($next->hit_count_requirement - $current->hit_count_requirement);
          }
          return 0;
        }

        return BadgeCriteriaConfig::query()->first()->hit_count_requirement;
    }


}

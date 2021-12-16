<?php
namespace App\Repositories;

use App\Interfaces\AchievementInterface;
use App\Models\AchievementCriteriaConfig;
use App\Models\BadgeCriteriaConfig;
use App\Models\UserAchievementStack;
use App\Models\UserBadge;
use Illuminate\Database\Eloquent\Builder;

class AchievementRepository implements AchievementInterface{

    const LESSON_WATCHED = 'lesson-watched';
    const COMMENT_WRITTEN = 'comment-written';


    function getCountAchievements($userId)
    {
       return UserAchievementStack::query()->where('user_id',$userId)->count();
    }

    function getCountCommentWritten($userId)
    {
        return UserAchievementStack::query()->where('user_id',$userId)->whereHas('criteria',function(Builder $builder){
           return $builder->where('type',self::COMMENT_WRITTEN);
        })->count();
    }

    function getCountLessonWatched($userId)
    {
        return UserAchievementStack::query()->where('user_id',$userId)->whereHas('criteria',function(Builder $builder){
            return $builder->where('type',self::LESSON_WATCHED);
         })->count();
    }

    function getNextBadge($badgeCriteriaConfigId)
    {
      $badge = BadgeCriteriaConfig::query()->find($badgeCriteriaConfigId);
      $sequence_order = $badge->sequence_order + 1;
      $badgeNext = BadgeCriteriaConfig::query()->where('sequence_order',$sequence_order);
      if ($badgeNext->exists()){
         return $badgeNext->first();
      }
      return $badge;
    }

    function getNextCommentWrittenAchievement($achievementCriteriaConfigId)
    {
      $criteria = AchievementCriteriaConfig::query()->find($achievementCriteriaConfigId);
      $sequence_order = $criteria->sequence_order + 1;
      $criteriaNext = AchievementCriteriaConfig::query()
      ->where('sequence_order',$sequence_order)
      ->where('type',AchievementRepository::COMMENT_WRITTEN);
      if ($criteriaNext->exists()){
          return $criteriaNext->first();
      }
      return $criteria;
    }

    function getNextLessonWatchedAchievement($achievementCriteriaConfigId)
    {
        $criteria = AchievementCriteriaConfig::query()->find($achievementCriteriaConfigId);
        $sequence_order = $criteria->sequence_order + 1;
        $criteriaNext = AchievementCriteriaConfig::query()
        ->where('sequence_order',$sequence_order)
        ->where('type',AchievementRepository::LESSON_WATCHED);
        if ($criteriaNext->exists()){
            return $criteriaNext->first();
        }
        return $criteria;
    }

    function userHasAchievement($userId,$achievementCriteriaConfigId)
    {
       return UserAchievementStack::query()
       ->where('achievement_criteria_config_id',$achievementCriteriaConfigId)
       ->where('user_id',$userId)->exists();
    }

    function userHasBadgeAchievement($userId,$badgeCriteriaConfigId)
    {
        return UserBadge::query()
        ->where('badge_criteria_config_id',$badgeCriteriaConfigId)
        ->where('user_id',$userId)->exists();
    }

    function hasUnlockedNewAchievement($hitCount, $type)
    {
      return AchievementCriteriaConfig::query()
      ->where('hit_count_requirement',$hitCount)
      ->where('type',$type)->exists();
    }

    function getUnlockedAchievement($hitCount, $type)
    {
        return AchievementCriteriaConfig::query()
        ->where('hit_count_requirement',$hitCount)
        ->where('type',$type)->first();
    }

    function getUnlockedNewBadge($hitCount)
    {
       return BadgeCriteriaConfig::query()
       ->where('hit_count_requirement',$hitCount)
       ->first();
    }

    function logCommentWrittenAchievement($achievementCriteriaConfigId, $userId)
    {
        //achievement_criteria_config_id
       UserAchievementStack::create([
           'user_id'=>$userId,
           'achievement_criteria_config_id'=>$achievementCriteriaConfigId
       ]);

    }

    function logLessonWatchedAchievement($achievementCriteriaConfigId, $userId) //same with above
    {
       UserAchievementStack::create([
           'user_id'=>$userId,
           'achievement_criteria_config_id'=>$achievementCriteriaConfigId
       ]);
    }

    function logBadgeAchievement($badgeCriteriaConfigId, $userId)
    {
      UserBadge::create([
        'badge_criteria_config_id'=>$badgeCriteriaConfigId,
        'user_id'=>$userId
      ]);
    }

    function hasUnlockedNewBadge($countAchievements)
    {
        return BadgeCriteriaConfig::query()
        ->where('hit_count_requirement',$countAchievements)
        ->exists();
    }

    function createAchievementCriteria($name, $type, $sequence_order, $hit_count_requirement)
    {
       $check = AchievementCriteriaConfig::query()->where('name',$name);
       if ($check->exists()){
         return $check->first();
       }

        return AchievementCriteriaConfig::create([
            'name'=>$name,
            'type'=>$type,
            'sequence_order'=>$sequence_order,
            'hit_count_requirement'=>$hit_count_requirement
        ]);
    }

    function createBadgeCriteria($name, $sequence_order, $hit_count_requirement)
    {

        $check = BadgeCriteriaConfig::query()->where('name',$name);
        if ($check->exists()){
          return $check->first();
        }

        return BadgeCriteriaConfig::create([
            'name'=>$name,
            'sequence_order'=>$sequence_order,
            'hit_count_requirement'=>$hit_count_requirement
        ]);

    }

    function countCommentAchievements()
    {
        return AchievementCriteriaConfig::query()->where('type',self::COMMENT_WRITTEN)->count();
    }

    function countLessonAchievements()
    {
        return AchievementCriteriaConfig::query()->where('type',self::LESSON_WATCHED)->count();
    }


}

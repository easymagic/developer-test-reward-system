<?php

namespace Database\Seeders;

use App\Interfaces\AchievementInterface;
use App\Models\Lesson;
use App\Models\User;
use App\Repositories\AchievementRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::factory()
            ->count(20)
            ->create();
            User::factory()->count(5)->create();

            $this->loadLessonAchievementConfig();
            $this->loadCommentAchievementConfig();
            $this->loadBadges();

    }

    function loadBadges(){
        $achievementConfig = app()->make(AchievementInterface::class);

        $achievementConfig->createBadgeCriteria(
            $name='Beginner',
            $sequence_order=0,
            $hit_count_requirement=0
        );

        $achievementConfig->createBadgeCriteria(
            $name='Intermediate',
            $sequence_order=1,
            $hit_count_requirement=4
        );

        $achievementConfig->createBadgeCriteria(
            $name='Advanced',
            $sequence_order=2,
            $hit_count_requirement=8
        );

        $achievementConfig->createBadgeCriteria(
            $name='Master',
            $sequence_order=3,
            $hit_count_requirement=10
        );

        // $this->assertEquals(4,$achievementConfig->countBadges());

    }


    function loadLessonAchievementConfig(){
        $achievementConfig = app()->make(AchievementInterface::class);

        $achievementConfig->createAchievementCriteria(
            $name='First Lesson Watched',
            $type=AchievementRepository::LESSON_WATCHED,
            $sequence_order=0,
            $hit_count_requirement=1
        );

        $achievementConfig->createAchievementCriteria(
            $name='5 Lessons Watched',
            $type=AchievementRepository::LESSON_WATCHED,
            $sequence_order=1,
            $hit_count_requirement=5
        );

        $achievementConfig->createAchievementCriteria(
            $name='10 Lessons Watched',
            $type=AchievementRepository::LESSON_WATCHED,
            $sequence_order=2,
            $hit_count_requirement=10
        );

        $achievementConfig->createAchievementCriteria(
            $name='25 Lessons Watched',
            $type=AchievementRepository::LESSON_WATCHED,
            $sequence_order=3,
            $hit_count_requirement=25
        );

        $dd = $achievementConfig->createAchievementCriteria(
            $name='50 Lessons Watched',
            $type=AchievementRepository::LESSON_WATCHED,
            $sequence_order=4,
            $hit_count_requirement=50
        );
    }


    function loadCommentAchievementConfig(){
        $achievementConfig = app()->make(AchievementInterface::class);
        $achievementConfig->createAchievementCriteria(
            $name='First Comment Written',
            $type=AchievementRepository::COMMENT_WRITTEN,
            $sequence_order=0,
            $hit_count_requirement=1
        );

        $achievementConfig->createAchievementCriteria(
            $name='3 Comments Written',
            $type=AchievementRepository::COMMENT_WRITTEN,
            $sequence_order=1,
            $hit_count_requirement=3
        );

        $achievementConfig->createAchievementCriteria(
            $name='5 Comments Written',
            $type=AchievementRepository::COMMENT_WRITTEN,
            $sequence_order=2,
            $hit_count_requirement=5
        );

        $achievementConfig->createAchievementCriteria(
            $name='10 Comments Written',
            $type=AchievementRepository::COMMENT_WRITTEN,
            $sequence_order=3,
            $hit_count_requirement=10
        );

        $dd = $achievementConfig->createAchievementCriteria(
            $name='20 Comments Written',
            $type=AchievementRepository::COMMENT_WRITTEN,
            $sequence_order=4,
            $hit_count_requirement=20
        );

    }


}

<?php

namespace Tests\Feature;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use App\Models\AchievementCriteriaConfig;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserAchievementStack;
use App\Models\UserActivity;
use App\Repositories\AchievementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }

    // function test_user(){
    //     $userActivityInterface = app()->make(UserActivityInterface::class);
    //     // $this->assertCount(3,[11,22,8]);
    //     $this->assertEquals(11,11);
    // }

    function loadLessons(){
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

    function test_lesson_achivement_config(){
        $achievementConfig = app()->make(AchievementInterface::class);
        $this->loadLessons();
        $this->assertEquals(5,$achievementConfig->countLessonAchievements());
    }

    function loadComments(){
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

    function test_comment_achievement_config(){
        $achievementConfig = app()->make(AchievementInterface::class);
        $this->loadComments();
        // dd($dd);
        $this->assertEquals(5,$achievementConfig->countCommentAchievements());

    }

    function test_comment_achievement(){

        // dd(AchievementCriteriaConfig::all());
        $this->loadComments();
        // $this->loadLessons();
        $userActivity = app()->make(UserActivityInterface::class);
        $achievement = app()->make(AchievementInterface::class);

        $userActivity->logCommentWritten(1,$achievement);
        // dd(UserActivity::all());
        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'First Comment Written'));

        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement); //3

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'3 Comments Written'));


        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement); //5

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'5 Comments Written'));

        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement); //10

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'10 Comments Written'));


        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement);
        $userActivity->logCommentWritten(1,$achievement); //20

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'20 Comments Written'));

    }

    function test_lesson_achievement(){
        $this->loadLessons();
        $userActivity = app()->make(UserActivityInterface::class);
        $achievement = app()->make(AchievementInterface::class);

        $userActivity->logLessonWatched(1,$achievement);

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'First Lesson Watched'));



        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);//5

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'5 Lessons Watched'));


        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);//10

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'10 Lessons Watched'));


        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);//25

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'25 Lessons Watched'));


        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);
        $userActivity->logLessonWatched(1,$achievement);//50

        $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'50 Lessons Watched'));

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

        $this->assertEquals(4,$achievementConfig->countBadges());

    }

    function test_badge_config(){
        $this->loadBadges();
    }

    function test_badge_requirements(){
        $userActivity = app()->make(UserActivityInterface::class);
        $achievement = app()->make(AchievementInterface::class);

       $this->loadBadges();
       $this->loadComments();
       $this->loadLessons();

       $this->assertEquals(true,!$achievement->userHasUnlockedBadgeByName(1,'Beginner'));//valid , since you are testing based on no records.


       $userActivity->logCommentWritten(1,$achievement);
       // dd(UserActivity::all());
       $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'First Comment Written'));

       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement); //3

       $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'3 Comments Written'));


       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement); //5

       $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'5 Comments Written'));

       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement); //10

       $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'10 Comments Written'));

       //4 achievements here...
       $this->assertEquals(true,$achievement->userHasUnlockedBadgeByName(1,'Intermediate'));

       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement);
       $userActivity->logCommentWritten(1,$achievement); //20

       //5 achievement
       $this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'20 Comments Written'));


//////new divide////////
$userActivity->logLessonWatched(1,$achievement);

//6 achievements
$this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'First Lesson Watched'));



$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);//5

//7 achievements
$this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'5 Lessons Watched'));


$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);//10

//8 achievements
$this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'10 Lessons Watched'));
//Advanced
$this->assertEquals(true,$achievement->userHasUnlockedBadgeByName(1,'Advanced'));

$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);//25

//9 achievements
$this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'25 Lessons Watched'));


$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);
$userActivity->logLessonWatched(1,$achievement);//50

//10 achievements
$this->assertEquals(true,$achievement->userHasUnlockedAchievementByName(1,'50 Lessons Watched'));
//Master
$this->assertEquals(true,$achievement->userHasUnlockedBadgeByName(1,'Master'));


    }






}

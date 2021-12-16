<?php

namespace Tests\Feature;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use Tests\TestCase;
use App\Models\User;
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

    function test_comment_achivement_config(){
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

        // dd($dd);

        $this->assertEquals(5,$achievementConfig->countLessonAchievements());
    }


}

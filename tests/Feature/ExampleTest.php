<?php

namespace Tests\Feature;

use App\Interfaces\UserActivityInterface;
use Tests\TestCase;
use App\Models\User;
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

    function test_user(){
        $userActivityInterface = app()->make(UserActivityInterface::class);
        $this->assertCount(3,[11,22,8]);
        $this->assertEquals(11,11);
    }
}

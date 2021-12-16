<?php

use App\Interfaces\AchievementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users/{user}/achievements',function($user, AchievementInterface $achievementInterface){

    return [
      'unlocked_achievements'=>'',
      'next_available_achievements'=>'',
      'current_badge'=>'',
      'next_badge'=>'',
      'remaining_to_unlock_next_badge'=>''
    ];


});

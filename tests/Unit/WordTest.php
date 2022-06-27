<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Word;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetRussianAttribute()
    {
        $value = 'тест';
        $valueExpected = 'Тест';
        $model = new Word();
        $this->assertEquals($valueExpected, $model->getRussianAttribute($value));
    }

    public function testGetEnglishAttribute()
    {
        $value = 'test';
        $valueExpected = 'Test';
        $model = new Word();
        $this->assertEquals($valueExpected, $model->getEnglishAttribute($value));
    }

    public function testUser()
    {
        $user = User::factory()->create();
        $word = Word::factory()->create(['user_id' => $user->id]);
        $userFromDB = User::find($user->id);
        $this->assertEquals($userFromDB, $word->user);
    }

}

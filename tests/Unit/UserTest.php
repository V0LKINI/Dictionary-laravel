<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testIsAdminTrue()
    {
        $user = User::factory()->admin()->create();
        $this->assertTrue($user->isAdmin());
    }

    public function testIsAdminFalse()
    {
        $user = User::factory()->create();
        $this->assertFalse($user->isAdmin());
    }

    public function testChangeThemeTrue()
    {
        $user = User::factory()->create();
        $user->changeTheme(true);
        $userFromDB = User::find($user->id);
        $this->assertTrue((bool) $userFromDB->is_dark_theme);
    }

    public function testChangeThemeFalse()
    {
        $user = User::factory()->create();
        $user->changeTheme(false);
        $userFromDB = User::find($user->id);
        $this->assertFalse((bool) $userFromDB->is_dark_theme);
    }
}

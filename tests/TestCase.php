<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public static $user;

    public function createUser(bool $authorised = false)
    {
        self::$user = $authorised
            ? User::factory()->authorisationCompleted()->createQuietly()
            : User::factory()->createQuietly();

        $this->actingAs(self::$user);

        return self::$user;
    }
}

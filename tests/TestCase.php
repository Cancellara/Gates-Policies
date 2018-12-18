<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\{User,Post};

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAdmin()
    {
        return factory(User::class)->states('admin')->create();
    }

    protected function createUser()
    {
        return factory(User::class)->create();
    }
}

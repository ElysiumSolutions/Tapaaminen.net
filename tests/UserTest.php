<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    public function create_users_and_check_if_they_are_created()
    {
        $users = factory(App\User::class, 3)->create();
        $this->assertEquals(3, App\User::all()->count());

    }
}

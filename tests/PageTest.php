<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTests extends TestCase
{
    /** @test */
    public function check_if_homepage_has_right_title()
    {
        $this->visit('/')
        	 ->see('Tapaaminen.net');
    }
}

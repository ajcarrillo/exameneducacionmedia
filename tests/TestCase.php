<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    // use CreatesApplication, RefreshDatabase;
    use CreatesApplication;

    /*public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }*/
}

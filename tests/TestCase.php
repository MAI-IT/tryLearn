<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
     { 
        parent::setUp();
        
        $this->withoutExceptionHandling(); // Forces Laravel to throw exceptions instead of rendering HTML error pages
        
    }

}

<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function testBoard()
    {
        $this->visit('/posts')//  postsページにアクセスしてみる
        ->see('Recent Comment');//           「Recent Comment」という文字列が見える
    }




}

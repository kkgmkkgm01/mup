<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testBoard()
    {
        $this->visit('/posts')//  postsページにアクセスしてみる
        ->see('Recent Comment');//           「Recent Comment」という文字列が見える
    }



}

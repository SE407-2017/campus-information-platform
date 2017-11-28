<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
            $response = $this->call('GET', 'localhost:8086/api/admin/login');
    $this->assertEquals(200, $response->status());
    $response = $this->call('GET', '/api/admin/logout');
    $this->assertEquals(200, $response->status());
    $response = $this->call('GET', '/api/admin/check');
    $this->assertEquals(200, $response->status());
     

    $response = $this->call('GET', '/api/activity/add');
    $this->assertEquals(200, $response->status());
    $response = $this->call('GET', '/api/activity/update');
    $this->assertEquals(200, $response->status());

    $response = $this->call('GET', '/api/activity/read');
    $this->assertEquals(200, $response->status());
    $response = $this->call('GET', '/api/activity/remove');
    $this->assertEquals(200, $response->status());



    $response = $this->call('GET', '/api/comment/add');
    $this->assertEquals(200, $response->status());
    $response = $this->call('GET', '/api/comment/read');
    $this->assertEquals(200, $response->status());
 
     }
}

<?php

namespace Tests\Unit;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_getAll()
    {
        $response = $this->get('/api/getAll');
        $response->assertStatus(200);
    }
    public function test_createsucces(){
        $response = $this->post('api/create/?name=yunus&email=ahmdfsesdsat@gmail.com&password=Yunus29.&password_confirmation=Yunus29.');
        $this->assertDatabaseHas('users',[
            'email'=> "ahmdfsesdsat@gmail.com",
        ]);
    }
    public function test_updatesucces(){
        $response = $this->post('api/update/2/?name=Yunus Emre Erturk&email=yeerturk@gmail.com&password=Yunus29.&password_confirmation=Yunus29.');
        $this->assertDatabaseHas('users',[
            'name'=> "Yunus Emre Erturk",
        ]);
    }
    public function test_getbyid(){
        $response = $this->get('/api/getById/5');
        $response->assertStatus(200);
    }
}

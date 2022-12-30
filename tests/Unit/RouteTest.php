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

    public function test_updatesucces(){
        $response = $this->post('api/update/250/?name=Yunus Emre Ertürk&email=yeerturk@gmail.com&password=Yunus29.&password_confirmation=Yunus29.');
        if(is_array($response->baseResponse->original)){
            $this->assertTrue(false);
        }
        elseif ($response->baseResponse->original == "Bu id'ye sahip kullanici yok "){
            $this->assertFalse(true);
        }
        $this->assertDatabaseHas('users',[
            'name'=> "Yunus Emre Erturk",
        ]);
    }
    public function test_getbyid(){
        $response = $this->get('/api/getById/5');
        $response->assertStatus(200);
    }
    public function test_createsucces(){
        $response = $this->post('api/create/?name=yun3us&email=lasdjlsdsat@gmail.com1&password=Yunus29.&password_confirmation=Yunus29.');
        if(is_array($response->baseResponse->original)){
            $this->assertFalse(true);
        }
        $this->assertDatabaseHas('users',[
            'email'=> "lasdjlsdsat@gmail.com1",
        ]);
    }
}

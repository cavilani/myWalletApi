<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App;

class loginTest extends TestCase
{    
    use DatabaseMigrations;


    protected function setUp()
    {
        parent::setUp();

        //Creating some mock objects to test
        $this->user = factory(User::class)->create(['email' => 'karolni90@gmail.com']);        
    }


    
    public function testLogin()
    {   

        $loginData = [
        	'username' => $this->user->email,
        	'password' => 'secret'
        	];
 
        $response = $this->json('POST', '/api/login/',$loginData);

        $response->assertStatus(200);

        $data = json_decode($response->getBody(), true);

		$this->assertArrayHasKey('access_token', $data);

    }


}

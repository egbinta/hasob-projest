<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $formDate = [
            'firstName' => 'James',
            'middleName' => 'D',
            'lastName' => 'Subo',
            'email' => 'james@gmail.com',
            'phoneNumber' => '7738364',
            'pictureUrl' => 'pictureurl',
            'password' => 'password',
            'isDisabled' => true
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',url('api/auth/register'),$formDate)
            ->assertStatus(200);
    }

    // 

    public function test_user_can_refresh()
    {
        
        $this->withoutExceptionHandling();
        $this->json('POST',url('api/auth/refresh'))
                ->assertStatus(200);
                
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function user_can_login_with_credentials(){
    	$user=factory(User::class)->create();
    	$response=$this->post('/login', [
            'email'=>$user->email,
            'password'=>'secret'
    	]);
    	$response->assertStatus(302;
    	$this->seeIsAuthenticatedAs($user);
    }

    public function user_cannot_login_with_invalid_credentials(){
    	$user=factory(User::class)->create();
    	$response=$this->post('/login', [
            'email'=>$user->email,
            'password'=>'invalid'
    	]);
    	$response->assertSessionHasErrors();
    	$this->dontSeeIsAuthenticated();
    }
    public function user_can_register_with_valid_credentials(){
    	$user=factory(User::class)->create();
    	$response=$this->post('/login', [
            'email'=>$user->email,
            'password'=>'secret',
            'pasword_confirmation'=>'secret'
    	]);
    	$response->assertStatus(302;
    	$this->seeIsAuthenticatedAs($user);

    public function user_can_login_with_credentials(){
    	$user=factory(User::class)->create();
    	$response=$this->post('/login', [
            'email'=>$user->email,
            'password'=>'secret'
    	]);
    	$response->assertSessionHasErrors();
    	$this->dontSeeIsAuthenticated();
    }
    
    public function user_can_request_for_reset_password_code(){
    	$user=factory(User::class)->create();
    	$response=$this->post('/login', [
            'email'=>$user->email,
    	]);
    	$response->assertStatus(302);
    }	

    public function user_can_reset_password_with_valid_code(){
    	$user=factory(User::class)->create();
    	$token=Password::CreateToken($user);
    	$response=$this->post('password/reset', [
            'token'=>$token,
            'email'=>$user->email,
            'password'=>'password',
            'password_confirmation'=>'password'
    	]);
    	$this->assertTrue(Hash::check('password', $User->fresh()->password));
    }

}

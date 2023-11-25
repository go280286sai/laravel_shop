<?php

//
//namespace Tests\Feature\Auth;
//
//use App\Models\User;
//use App\Providers\RouteServiceProvider;
//use Tests\TestCase;
//
//class RegistrationTest extends TestCase
//{
//
//    public function test_registration_screen_can_be_rendered(): void
//    {
//        $response = $this->get('/register');
//
//        $response->assertStatus(200);
//    }
//
//    public function test_new_users_can_register(): void
//    {
//        $this->post('/register', [
//            'name' => "test5",
//            'email' => "test5@email.com",
//            'password' => "password",
//            'password_confirmation' => "password",
//        ]);
//        $this->post('/login', [
//            'email' => "test5@email.com",
//            'password' => "password",
//        ]);
//        $this->assertAuthenticated();
//
//    }
//}

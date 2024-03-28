<?php

namespace Feature;

use App\Actions\ActionCreateTokenClass;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class GetTokenTest extends TestCase
{
    public function test_GetToken()
    {
        $this->post('/register', [
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $token = ActionCreateTokenClass::getToken();
        $this->assertIsString($token);
    }
}

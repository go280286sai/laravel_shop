<?php

namespace Feature;

use App\Actions\ActionCreateTokenClass;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class GetFilesTest extends TestCase
{
    public function test_GetFiles(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $token = ActionCreateTokenClass::getToken();
        echo $token;
        $file = UploadedFile::fake()->image('image.jpg');
        $name = fake()->name();
        $path = fake()->word();
        $request = $this->post('api/getFiles',
            ['name' => $name, 'file' => $file, 'path' => $path],
            ["Authorization" => "Bearer " . $token, "Content-Type" => "multipart/form-data", "Accept" => "application/json"]);
        $request->assertStatus(200);

    }
}

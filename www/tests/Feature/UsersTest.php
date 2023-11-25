<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\User_comment;
use App\Models\User_description;
use App\Notifications\SendEmailUserNotification;
use Database\Factories\UserFactory;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_add(): string
    {
       $user = UserFactory::new()->create();
       $this->assertDatabaseHas('users', ['name' => $user->name]);
       $user_description = new User_description();
       $user_description->user_id = $user->id;
       $user_description->last_name = fake()->lastName();
       $user_description->gender_id = 1;
       $user_description->save();
       $this->assertDatabaseHas('user_descriptions', ['user_id' => $user->id]);

       return $user->id;
    }

    /**
     * @depends test_user_add
     */
    public function test_user_comment($id): int
    {
        $data = [
            'id' => $id,
            'content' => fake()->text(100),
        ];
        User_comment::add_comment($data);
        $this->assertDatabaseHas('user_comments', ['comment' => $data['content']]);

        return $id;
    }

    /**
     * @depends test_user_comment
     */
    public function test_block($id): int
    {
        User::status($id);
        $this->assertDatabaseHas('users', ['status' => 0]);
        User::status($id);
        $this->assertDatabaseHas('users', ['status' => 1]);

        return $id;
      }

    /**
     * @depends test_block
     */
    public function test_user_destroy($id)
    {
        $this->assertDatabaseHas('users', ['id' => $id]);
        User::remove($id);
        $this->assertDatabaseHas('users', ['id' => $id, 'deleted_at' => now()]);
        User::soft_recovery($id);
        $this->assertDatabaseHas('users', ['id' => $id, 'deleted_at' => null]);
        User::remove($id);
        $this->assertDatabaseHas('users', ['id' => $id, 'deleted_at' => now()]);
        User::soft_remove($id);
        $this->assertDatabaseMissing('users', ['id' => $id]);
      }
}

<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AddAvatarTest extends TestCase
{
    /** @test */
    public function only_autherized_users_can_add_avatar()
    {
        $jane = create(User::class, ['username' => 'jane']);
        $john = create(User::class, ['username' => 'john']);

        $this->signIn($jane);

        $this->json('POST', '/user/john/avatar', [])
             ->assertStatus(403);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $jane = create(User::class, ['username' => 'jane']);
        $this->signIn($jane);

        $this->json('POST', '/user/jane/avatar', [
            'avatar' => 'not-an-image',
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_may_add_an_avatar_to_their_profile()
    {
        $jane = create(User::class, ['username' => 'jane']);
        $this->signIn($jane);

        Storage::fake('public');

        $this->json('POST', '/user/jane/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $this->assertEquals(asset('img/avatars/' . $file->hashName()), auth()->user()->profile->avatar);

        Storage::disk('public')->assertExists('img/avatars/' . $file->hashName());
    }
}

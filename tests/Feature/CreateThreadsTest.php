<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use App\Channel;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->get('/threads/create')->assertRedirect('/login');

        $this->post('/threads', [])->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_create_new_threads()
    {
        $this->signIn($user = create(User::class));

        $thread = make(Thread::class, ['user_id' => $user->id]);

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->signIn();

        $this->publishThread(['title' => null])->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->signIn();

        $this->publishThread(['body' => null])->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $this->signIn();

        create(Channel::class, [], 2);

        $this->publishThread(['channel_id' => 399])->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function only_an_authorized_user_can_delete_threads()
    {
        $john = create(User::class);
        $jane = create(User::class);

        $this->signIn($john);

        $thread = create(Thread::class, ['user_id' => $john->id]);
        $response = $this->json('DELETE', route('threads.destroy', ['channel' => $thread->channel->slug, 'thread' => $thread->slug]));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);

        $thread = create(Thread::class, ['user_id' => $john->id]);

        $this->signIn($jane);
        $response = $this->json('DELETE', route('threads.destroy', ['channel' => $thread->channel->slug, 'thread' => $thread->slug]));
        $response->assertStatus(403);
    }

    protected function publishThread(array $attributes = [])
    {
        $thread = make(Thread::class, $attributes);

        return $this->post('/threads', $thread->toArray());
    }
}

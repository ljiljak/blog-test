<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class PostsTest extends TestCase
{
    // test valid index
    public function testIndexValid()
    {

        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    // test valid create
    public function testCreateValid()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/posts/create');

        $response->assertStatus(200);
    }

    //test invalid create for no user
    public function testCreateInvalid()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(302);
    }
}

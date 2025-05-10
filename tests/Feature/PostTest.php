<?php

namespace Tests\Feature;


use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_post_delete(): void
    {
        $post = Post::create([
            'post'=>'Consectetur id non ullamco pariatur occaecat velit.',
            'header'=>'lorem'
        ]);

        Livewire::test('posts.posts')
            ->call('deletion', $post->id);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_user_post_created()
    {

        Livewire::test('Posts.CreatePosts')
        ->set('header', 'New Post')
        ->set('post', 'Post content')
        ->call('savePost')
        ->assertSet('post', null); 

        $this->assertDatabaseHas('posts', [
            'header' => 'New Post',
            'post' => 'Post content'
        ]);

    }

    public function test_post_rendered()
    {

        Livewire::test('posts.posts')
        ->assertStatus(200);


    }

    

}

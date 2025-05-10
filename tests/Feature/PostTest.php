<?php

namespace Tests\Feature;


use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostTest extends TestCase
{

    use DatabaseTransactions;

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

    public function test_edit_post()
    {

        $post = Post::create([
            'header' => 'Test Header',
            'post' => 'This is a test post.',
        ]);

       
        Livewire::test('posts.posts')
            ->dispatch('edit', $post->id)
            ->assertSet('id', $post->id)
            ->assertSet('header', 'Test Header')
            ->assertSet('post', 'This is a test post.');

    }

    public function test_update_user_post()
    {

        $post=Post::create([
            'header' => 'Test Header',
            'post' => 'This is a test post.',
        ]);

        Livewire::test('posts.posts')
        ->call('editPost',$post->id)
        ->set('header','post')
        ->set('post','lorem ipsum')
        ->call('updatePost',$post->id)
        ->assertSet('header','post');


        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'header' => 'Post',
            'post' => 'lorem ipsum'
        ]);



    }

    public function test_user_view_posts()  
    {

        $post =Post::create([
            'header' => 'Test Header',
            'post' => 'This is a test post.',
        ]);

        Livewire::test('posts.posts')
        ->call('viewUserPosts',$post->id)
        ->assertSee('Test Header');



    }



}

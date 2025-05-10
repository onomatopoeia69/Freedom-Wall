<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Posts extends Component
{   
    #[Locked]
    public $id;

    public $title = 'Edit Post';

    public $post; 
    public $header;

    #[On('confDelete')]
    public function deletion($id)
    {

        $this->id = $id;
        
        $post =Post::find($this->id);
        $post->delete();
        
    }

    #[On('edit')]
    public function editPost($id)
    {
        $this->id = $id;
        $post = Post::findOrFail($this->id);
        $this->post = $post->post;
        $this->header = $post->header;
    }

    public function cancel()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function updatePost($id)
    {

        $this->id = $id;
        $post = Post::find($this->id);
        $post->update([

            'post' => $this->post,
            'header' => $this->header,

        ]);        
    }

    public function viewUserPosts($id)
    {
        
        $posts = Post::find($id);
        $this->post = $posts->post;
        $this->header = $posts->header;

    }

    
    #[On('postCreated')]
    public function render()
    {
        $all_post = Post::all();
        return view('livewire.posts.posts',compact('all_post'));
    }
}

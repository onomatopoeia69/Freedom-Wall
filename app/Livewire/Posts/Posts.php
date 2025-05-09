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

    #[On('confDelete')]
    public function deletion($id)
    {

        $this->id = $id;
        
        $post =Post::find($this->id);
        $post->delete();
        
    }


    

    public function render()
    {

        $post = Post::all();

        return view('livewire.posts.posts',compact('post'));
    }
}

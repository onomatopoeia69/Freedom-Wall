<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePosts extends Component
{

    public $title = 'Create Post';

    #[Validate('required')]
    public $header; 
    #[Validate('required')]
    public $post;


    public function savePost()
    {

        $this->validate(); 
        
        DB::beginTransaction();
        
       try{

        Post::create([

            'header' => $this->header,
            'post' => $this->post
        ]);

        DB::commit();

        $this->hardReset();
        $this->dispatch('postCreated');

       }catch(\Exception $e)
       {
        
        DB::rollback();

       }

    }


    public function hardReset()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function render()
    {



        return view('livewire.posts.create-posts');
    }
}

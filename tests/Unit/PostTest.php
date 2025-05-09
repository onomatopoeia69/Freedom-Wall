<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class PostTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic unit test example.
     */
    public function test_post_header_is_uppercasefirst(): void
    {
        
        $user = Post::create(['post'=>'Consectetur id non ullamco pariatur occaecat velit.','header'=>'lorem']);

        $this->assertEquals('Lorem',$user->header);

    }
}

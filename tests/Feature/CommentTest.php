<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Blog\Services\PostService;
use Blog\Services\CommentService;
use Illuminate\Support\Str;

class CommentTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет добавления нового комментария
     * @return void
     */
    public function testCreate()
    {
        $message = Str::random(40);
        $response = $this->post(route('comment.store'), [
            'post_id' => 1, 
            'parent_id' => NULL, 
            'name' => $this->faker->name, 
            'email' => $this->faker->unique()->safeEmail, 
            'website' => $this->faker->company(), 
            'message' => $message
        ]);
        
        $postService = app(PostService::class);
        $urlPost = $postService->find(1)->url;
        
        $response->assertLocation(route("post.show", $urlPost));
        
        $commentService = app(CommentService::class);
        $comment = $commentService->findByMessage($message);
        
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
        
        $commentService->destroy($comment->id);
    }
}

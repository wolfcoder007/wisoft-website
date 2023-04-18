<?php

namespace Modules\Blog\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Status;
use Modules\Blog\Http\Requests\CreatePostRequest;
use Modules\Blog\Http\Requests\UpdatePostRequest;
use Modules\Blog\Repositories\PostRepository;
use Modules\Blog\Transformers\FullPostTransformer;
use Modules\Blog\Transformers\PostTransformer;
use Modules\Setting\Entities\Setting;


class PostController extends Controller
{
    /**
     * @var PageRepository
     */
    private $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {   
        $publishedPosts = Post::published()->get();
        return PostTransformer::collection($publishedPosts);
    }

    public function blogspagination(Request $request)
    {
        return PostTransformer::collection($this->post->serverPaginationFilteringFor($request));
    }
    
    public function find(Post $post)
    {
        return new FullPostTransformer($post);
    }
    
    public function getSingleData($post)
    {
        //$blog = $this->post->find($post)->published();
        $blog = $this->post->find($post);
        return new PostTransformer($blog);
        
    }


    
}

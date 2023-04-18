<?php

namespace Modules\Blog\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Post;

interface PostRepository extends BaseRepository
{
    public function all();
    /**
     * Return the latest x blog posts
     * @param int $amount
     * @return Collection
     */
    public function latest($amount = 5);

    /**
     * Get the previous post of the given post
     * @param object $post
     * @return object
     */
    public function getPreviousOf($post);

    /**
     * Get the next post of the given post
     * @param object $post
     * @return object
     */
    public function getNextOf($post);
    
    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(Request $request) : LengthAwarePaginator;/**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function apiPaginationFilteringFor(Request $request) : LengthAwarePaginator;


    
}

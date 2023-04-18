<?php

namespace Modules\Client\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Client\Entities\Client;

interface ClientRepository extends BaseRepository
{
    public function all();
     /**
     * Find the page set as homepage
     * @return object
     */
    public function findHomepage();

    /**
     * Count all records
     * @return int
     */
    public function countAll();

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
   // public function findBySlugInLocale($slug, $locale);

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


    /**
     * @param Page $page
     * @return mixed
     * @internal param int $pageId
     */
    public function markAsOnlineInAllLocales(Client $client);

    /**
     * @param array $pageIds[int]
     * @return mixed
     */
    public function markMultipleAsOnlineInAllLocales(array $clientIds);

    /**
     * @param Page $page
     * @return mixed
     * @internal param int $pageId
     */
    public function markAsOfflineInAllLocales(Client $client);

    /**
     * @param array $pageIds[int]
     * @return mixed
     */
    public function markMultipleAsOfflineInAllLocales(array $clientIds);
    
}

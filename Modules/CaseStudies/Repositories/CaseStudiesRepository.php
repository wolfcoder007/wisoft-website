<?php

namespace Modules\CaseStudies\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Core\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Modules\CaseStudies\Entities\CaseStudies;

interface CaseStudiesRepository extends BaseRepository
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
    public function markAsOnlineInAllLocales(CaseStudies $casestudies);

    /**
     * @param array $pageIds[int]
     * @return mixed
     */
    public function markMultipleAsOnlineInAllLocales(array $casestudieslIds);

    /**
     * @param Page $page
     * @return mixed
     * @internal param int $pageId
     */
    public function markAsOfflineInAllLocales(CaseStudies $casestudies);

    /**
     * @param array $pageIds[int]
     * @return mixed
     */
    public function markMultipleAsOfflineInAllLocales(array $casestudiesIds);
    
    
}

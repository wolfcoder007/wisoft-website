<?php

namespace Modules\Testimonials\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Testimonials\Entities\Testimonial;
use Modules\Testimonials\Repositories\TestimonialRepository;
use Modules\Setting\Entities\Setting;
use Modules\Testimonials\Events\TestimonialIsCreating;
use Modules\Testimonials\Events\TestimonialIsUpdating;
use Modules\Testimonials\Events\TestimonialWasCreated;
use Modules\Testimonials\Events\TestimonialWasDeleted;
use Modules\Testimonials\Events\TestimonialWasUpdated;

class EloquentTestimonialRepository extends EloquentBaseRepository implements TestimonialRepository
{
    public function allApiData(){
        
        $data=   Testimonial::select('testimonials__testimonials.id', 'testimonials__testimonials.created_at', 'testimonials__testimonial_translations.title','testimonials__testimonial_translations.content', 'testimonials__testimonial_translations.author', 'media__files.path')
        ->join('testimonials__testimonial_translations', 'testimonials__testimonial_translations.testimonial_id', '=', 'testimonials__testimonials.id')
        ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'testimonials__testimonials.id')
        ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
        ->where('testimonials__testimonial_translations.locale', locale())
        ->where('media__imageables.imageable_type', 'like' , '%Testimonials%')
        ->orWhereNull('media__imageables.imageable_type')
        ->get();
        
        return $data;
       
    }
    public function all()
    {
        return $this->model->with('translations')->orderBy('created_at', 'ASC')->get();
    }
    /**
     * @inheritdoc
     */
    public function paginate($perPage = 1)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->paginate($perPage);
        }

        return $this->model->paginate($perPage);
    }

    /**
     * Find the page set as homepage
     * @return object
     */
    public function findHomepage()
    {
        return $this->model->where('is_home', 1)->first();
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    
    
    /**
     * Create a blog post
     * @param  array $data
     * @return Post
     */
    public function create($data)
    {
        event($event = new TestimonialIsCreating($data));
        $testimonial = $this->model->create($event->getAttributes());

        event(new TestimonialWasCreated($testimonial, $data));

        return $testimonial;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
   /* public function update($model, $data)
    {
        if (Arr::get($data, 'is_home') === '1') {
            $this->removeOtherHomepage($model->id);
        }

        event($event = new PageIsUpdating($model, $data));
        $model->update($event->getAttributes());

        event(new PageWasUpdated($model, $data));

        $model->setTags(Arr::get($data, 'tags', []));

        return $model;
    }*/
    
    /**
     * Update a resource
     * @param $post
     * @param  array $data
     * @return mixed
     */
    public function update($testimonial, $data)
    {
        event($event = new TestimonialIsUpdating($testimonial, $data));
        $testimonial->update($event->getAttributes());

        //$testimonial->setTags(array_get($data, 'tags'));

        event(new TestimonialWasUpdated($testimonial, $data));

        return $testimonial;
    }

    
    public function destroy($testimonial)
    {
        //$model->untag();

        event(new TestimonialWasDeleted($testimonial->id, get_class($testimonial)));

        return $testimonial->delete();
    }

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
    public function findBySlugInLocale($slug, $locale)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug, $locale) {
                $q->where('slug', $slug);
                $q->where('locale', $locale);
            })->with('translations')->first();
        }

        return $this->model->where('slug', $slug)->where('locale', $locale)->first();
    }

    /**
     * Set the current page set as homepage to 0
     * @param null $pageId
     */
    private function removeOtherHomepage($pageId = null)
    {
        $homepage = $this->findHomepage();
        if ($homepage === null) {
            return;
        }
        if ($pageId === $homepage->id) {
            return;
        }

        $homepage->is_home = 0;
        $homepage->save();
    }

    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $pages = $this->allWithBuilder();

        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $pages->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->orWhere('slug', 'LIKE', "%{$term}%");
            })
                ->orWhere('id', $term);
        }

        /*if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';

            if (Str::contains($request->get('order_by'), '.')) {
                $fields = explode('.', $request->get('order_by'));

                $pages->with('translations')->join('page__page_translations as t', function ($join) {
                    $join->on('page__pages.id', '=', 't.page_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('page__pages.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($request->get('order_by'), $order);
            }
        }*/
        $page_order_by = Setting::where('name', 'generalsettings::order-by')->pluck('plainValue');
        $page_order = Setting::where('name', 'generalsettings::post-order')->pluck('plainValue');
        
        $order = ($page_order !== 'null') ? $page_order[0] : 'asc';
        $order_by = ($page_order !== 'null') ? $page_order_by[0] : 'created_at';
        
        //if ($order_by !== null &&  $order !== 'null') {
            $order_by = $page_order_by[0];
            $order      = $page_order[0];

            if (Str::contains($order , '.')) {
                $fields = explode('.', $order);

                $pages->with('translations')->join('testimonials__testimonial_translations as t', function ($join) {
                    $join->on('testimonials__testimonials.id', '=', 't.testimonial_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('testimonials__testimonials.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($order_by, $order);
            }
       // }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('testimonials__testimonials', $post_per_page[0]));
    }
    
    
    
    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function apiPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $pages = $this->allWithBuilder();

        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $pages->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->orWhere('slug', 'LIKE', "%{$term}%");
            })
                ->orWhere('id', $term);
        }

        $page_order_by = Setting::where('name', 'generalsettings::order-by')->pluck('plainValue');
        $page_order = Setting::where('name', 'generalsettings::post-order')->pluck('plainValue');
        
        $order = ($page_order !== 'null') ? $page_order[0] : 'asc';
        $order_by = ($page_order !== 'null') ? $page_order_by[0] : 'created_at';
        
        //if ($order_by !== null &&  $order !== 'null') {
            $order_by = $page_order_by[0];
            $order      = $page_order[0];

            if (Str::contains($order , '.')) {
                $fields = explode('.', $order);

                $pages->select('testimonials__testimonials.id', 'testimonials__testimonials.created_at', 'testimonials__testimonial_translations.title','testimonials__testimonial_translations.content', 'testimonials__testimonial_translations.author', 'media__files.path')
       
                        ->join('testimonials__testimonial_translations as t', function ($join) {
                    $join->on('testimonials__testimonials.id', '=', 't.testimonial_id');
                })
                    ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'testimonials__testimonials.id')
                    ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
   
                    ->where('t.locale', locale())
                    ->where('media__imageables.imageable_type', 'like' , '%Testimonials%')
                    ->orWhereNull('media__imageables.imageable_type')
                    ->groupBy('testimonials__testimonials.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->select('testimonials__testimonials.id', 'testimonials__testimonials.created_at', 't.title','t.content', 't.author', 'media__files.path')
       
                        ->join('testimonials__testimonial_translations as t', function ($join) {
                    $join->on('testimonials__testimonials.id', '=', 't.testimonial_id');
                })
                    ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'testimonials__testimonials.id')
                    ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
   
                    ->where('t.locale', locale())
                    ->where('media__imageables.imageable_type', 'like' , '%Testimonials%')
                    ->orWhereNull('media__imageables.imageable_type')
                ->orderBy($order_by, $order);
            }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('testimonials__testimonials', $post_per_page[0]));
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOnlineInAllLocales(Testimonial $testimonial)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 1];
        }

        return $this->update($testimonial, $data);
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOfflineInAllLocales(Testimonial $testimonial)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 0];
        }

        return $this->update($testimonial, $data);
    }

    /**
     * @param array $pageIds [int]
     * @return mixed
     */
    public function markMultipleAsOnlineInAllLocales(array $pageIds)
    {
        foreach ($pageIds as $pageId) {
            $this->markAsOnlineInAllLocales($this->find($pageId));
        }
    }

    /**
     * @param array $pageIds [int]
     * @return mixed
     */
    public function markMultipleAsOfflineInAllLocales(array $pageIds)
    {
        foreach ($pageIds as $pageId) {
            $this->markAsOfflineInAllLocales($this->find($pageId));
        }
    }
}


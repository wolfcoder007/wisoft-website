<?php

namespace Modules\Block\Repositories\Eloquent;

use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Block\Entities\Block;
use Modules\Setting\Entities\Setting;
use Modules\Block\Events\BlockIsCreating;
use Modules\Block\Events\BlockIsUpdating;
use Modules\Block\Events\BlockWasCreated;
use Modules\Block\Events\BlockWasDeleted;
use Modules\Block\Events\BlockWasUpdated;

class EloquentBlockRepository extends EloquentBaseRepository implements BlockRepository
{
    /*public function allApiData(){
        
        $data=   Block::select('block__blocks.id','block__blocks.status','block__blocks.category_id', 'block__blocks.created_at', 'block__block_translations.title','block__block_translations.content', 'block__block_translations.author', 'media__files.path')
        ->join('block__block_translations', 'block__block_translations.block_id', '=', 'block__blocks.id')
        ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'block__blocks.id')
        ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
        ->where('block__block_translations.locale', locale())
        ->where('media__imageables.imageable_type', 'like' , '%Block%')
        ->orWhereNull('media__imageables.imageable_type')
        ->get();
        
        return $data;
       
    }*/
    
    
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
        event($event = new BlockIsCreating($data));
        $block = $this->model->create($event->getAttributes());

        event(new BlockWasCreated($block, $data));

        return $block;
    }
    
    
    /**
     * Update a resource
     * @param $post
     * @param  array $data
     * @return mixed
     */
    public function update($block, $data)
    {
        event($event = new BlockIsUpdating($block, $data));
        $block->update($event->getAttributes());

        //$testimonial->setTags(array_get($data, 'tags'));

        event(new BlockWasUpdated($block, $data));

        return $block;
    }

    
    public function destroy($block)
    {
        //$model->untag();

        event(new BlockWasDeleted($block->id, get_class($block)));

        return $block->delete();
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
        $pages = $this->allWithBuilder()->where('status', 2);

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

                $pages->with('translations')->join('block__block_translations as t', function ($join) {
                    $join->on('block__blocks.id', '=', 't.block_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('block__blocks.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($order_by, $order);
            }
       // }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('block__blocks', $post_per_page[0]));
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

                $pages->with('translations')->join('block__block_translations as t', function ($join) {
                    $join->on('block__blocks.id', '=', 't.block_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('block__blocks.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                 $pages->with('translations')->join('block__block_translations as t', function ($join) {
                    $join->on('block__blocks.id', '=', 't.block_id');
                })
                    
                    ->where('t.locale', locale())
                ->orderBy($order_by, $order);
            }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('block__blocks', $post_per_page[0]));
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOnlineInAllLocales(Block $block)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 1];
        }

        return $this->update($block, $data);
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOfflineInAllLocales(Block $block)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 0];
        }

        return $this->update($block, $data);
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

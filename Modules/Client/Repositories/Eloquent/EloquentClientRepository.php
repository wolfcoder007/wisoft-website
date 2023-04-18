<?php

namespace Modules\Client\Repositories\Eloquent;

use Modules\Client\Repositories\ClientRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Client\Entities\Client;
use Modules\Setting\Entities\Setting;

use Modules\Client\Events\ClientIsCreating;
use Modules\Client\Events\ClientIsUpdating;
use Modules\Client\Events\ClientWasCreated;
use Modules\Client\Events\ClientWasDeleted;
use Modules\Client\Events\ClientWasUpdated;

class EloquentClientRepository extends EloquentBaseRepository implements ClientRepository
{
    /*public function allApiData(){
        
        $data=   Client::select('client__clients.id','client__clients.status','client__clients.category_id', 'client__clients.name', 'client__clients.created_at', 'media__files.path')
        ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'client__clients.id')
        ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
        ->where('media__imageables.imageable_type', 'like' , '%Client%')
        ->orWhereNull('media__imageables.imageable_type')
        ->get();
        
        return $data;
       
    }*/
    
    
    
    
    public function all()
    {
        return $this->model->with('translations')->orderBy('created_at', 'ASC')->get();
    }
    
    public function find($id)
    {
        return $this->model->with('translations')->find($id);
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
     * Create a client post
     * @param  array $data
     * @return Post
     */
    public function create($data)
    {
        event($event = new ClientIsCreating($data));
        $client = $this->model->create($event->getAttributes());

        event(new ClientWasCreated($client, $data));

        return $client;
    }
    
    
    /**
     * Update a resource
     * @param $post
     * @param  array $data
     * @return mixed
     */
    public function update($client, $data)
    {
        event($event = new ClientIsUpdating($client, $data));
        $client->update($event->getAttributes());

        //$testimonial->setTags(array_get($data, 'tags'));

        event(new ClientWasUpdated($client, $data));

        return $client;
    }

    
    public function destroy($client)
    {
        //$model->untag();

        event(new ClientWasDeleted($client->id, get_class($client)));

        return $client->delete();
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

                $pages->with('translations')->join('client__client_translations as t', function ($join) {
                    $join->on('client__clients.id', '=', 't.client_id');
                })
                    ->groupBy('client__clients.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($order_by, $order);
            }
       // }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('client__clients', $post_per_page[0]));
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

                $pages->select('client__clients.id', 'client__clients.status','client__clients.category_id', 'client__clients.created_at','client__clients.name', 'media__files.path')
       
                    ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'client__clients.id')
                    ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
   
                    ->where('media__imageables.imageable_type', 'like' , '%Client%')
                    ->orWhereNull('media__imageables.imageable_type')
                    ->groupBy('client__clients.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->select('client__clients.id','client__clients.status','client__clients.category_id', 'client__clients.created_at','client__clients.name', 'media__files.path')
       
                    ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'client__clients.id')
                    ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
   
                    ->where('media__imageables.imageable_type', 'like' , '%Client%')
                    ->orWhereNull('media__imageables.imageable_type')
                ->orderBy($order_by, $order);
            }
        
        $post_per_page = Setting::where('name', 'generalsettings::posts-per-page')->pluck('plainValue');

        return $pages->paginate($request->get('client__clients', $post_per_page[0]));
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOnlineInAllLocales(Client $client)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 1];
        }

        return $this->update($client, $data);
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOfflineInAllLocales(Client $client)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 0];
        }

        return $this->update($client, $data);
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

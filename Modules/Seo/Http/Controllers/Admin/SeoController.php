<?php

namespace Modules\Seo\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Seo\Entities\Seo;
use Modules\Seo\Http\Requests\CreateSeoRequest;
use Modules\Seo\Http\Requests\UpdateSeoRequest;
use Modules\Seo\Repositories\SeoRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Page\Entities\Page;
use Modules\Page\Repositories\PageRepository;
use Modules\Blog\Entities\Post;
use Modules\Blog\Repositories\PostRepository;

class SeoController extends AdminBaseController
{
    /**
     * @var SeoRepository
     */
    private $seo;
    
    private $post;
    
    private $pages;

    public function __construct(SeoRepository $seo, 
        PostRepository     $post, PageRepository     $page)
    {
        parent::__construct();

        $this->post = $post;
        $this->page = $page;
        $this->seo = $seo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $seos = $this->seo->all();
        $posts = $this->post->all();
        $pages = $this->page->all();
        return view('seo::admin.seos.index', compact('seos', 'posts', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('seo::admin.seos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSeoRequest $request
     * @return Response
     */
    public function store(CreateSeoRequest $request)
    {
        $this->seo->create($request->all());

        return redirect()->route('admin.seo.seo.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('seo::seos.title.seos')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Seo $seo
     * @return Response
     */
    public function edit()
    {
        //$id = request()->route('seo');
        return view('seo::admin.seos.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Seo $seo
     * @param  UpdateSeoRequest $request
     * @return Response
     */
    public function update(Seo $seo, UpdateSeoRequest $request)
    {
        $this->seo->update($seo, $request->all());

        return redirect()->route('admin.seo.seo.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('seo::seos.title.seos')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Seo $seo
     * @return Response
     */
    public function destroy(Seo $seo)
    {
        $this->seo->destroy($seo);

        return redirect()->route('admin.seo.seo.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('seo::seos.title.seos')]));
    }
}

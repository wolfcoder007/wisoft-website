<?php

namespace Modules\Industry\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Industry\Entities\Industry;
use Modules\Industry\Entities\Status;
use Modules\Industry\Entities\Category;
use Modules\Industry\Http\Requests\CreateIndustryRequest;
use Modules\Industry\Http\Requests\UpdateIndustryRequest;
use Modules\Industry\Repositories\IndustryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class IndustryController extends AdminBaseController
{
    /**
     * @var IndustryRepository
     */
    private $industry;
    /**
     * @var Status
     */
    private $status;
    
    /**
     * @var Category
     */
    private $category;/**
     * @var FileRepository
     */
    private $file;

    public function __construct(
        IndustryRepository $industry,
        Status             $status,
        Category           $category,
        FileRepository $file   )
    {
        parent::__construct();

        $this->industry = $industry;
        $this->status = $status;
        $this->category = $category;
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->lists();
        $industries = $this->industry->all();

        return view('industry::admin.industries.index', compact('industries', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        
        return view('industry::admin.industries.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateIndustryRequest $request
     * @return Response
     */
    public function store(CreateIndustryRequest $request)
    {
        $this->industry->create($request->all());

        return redirect()->route('admin.industry.industry.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('industry::industries.title.industries')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Industry $industry
     * @return Response
     */
    public function edit(Industry $industry)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $industry);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('industry::admin.industries.edit', compact('industry','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Industry $industry
     * @param  UpdateIndustryRequest $request
     * @return Response
     */
    public function update(Industry $industry, UpdateIndustryRequest $request)
    {
        $this->industry->update($industry, $request->all());

        return redirect()->route('admin.industry.industry.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('industry::industries.title.industries')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Industry $industry
     * @return Response
     */
    public function destroy(Industry $industry)
    {
        $this->industry->destroy($industry);

        return redirect()->route('admin.industry.industry.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('industry::industries.title.industries')]));
    }
}

<?php

namespace Modules\CaseStudies\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CaseStudies\Entities\CaseStudies;
use Modules\CaseStudies\Entities\Status;
use Modules\CaseStudies\Entities\Category;
use Modules\CaseStudies\Http\Requests\CreateCaseStudiesRequest;
use Modules\CaseStudies\Http\Requests\UpdateCaseStudiesRequest;
use Modules\CaseStudies\Repositories\CaseStudiesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class CaseStudiesController extends AdminBaseController
{
    /**
     * @var CaseStudiesRepository
     */
    private $casestudies;
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

    public function __construct(CaseStudiesRepository $casestudies,  
        Status             $status,
        Category           $category,
        FileRepository $file    )
    {
        parent::__construct();

        $this->casestudies = $casestudies;
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
        $casestudies = $this->casestudies->all();

        return view('casestudies::admin.casestudies.index', compact('casestudies'));
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
        return view('casestudies::admin.casestudies.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCaseStudiesRequest $request
     * @return Response
     */
    public function store(CreateCaseStudiesRequest $request)
    {
        $this->casestudies->create($request->all());

        return redirect()->route('admin.casestudies.casestudies.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('casestudies::casestudies.title.casestudies')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CaseStudies $casestudies
     * @return Response
     */
    public function edit(CaseStudies $casestudies)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $casestudies);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('casestudies::admin.casestudies.edit', compact('casestudies','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CaseStudies $casestudies
     * @param  UpdateCaseStudiesRequest $request
     * @return Response
     */
    public function update(CaseStudies $casestudies, UpdateCaseStudiesRequest $request)
    {
        $this->casestudies->update($casestudies, $request->all());

        return redirect()->route('admin.casestudies.casestudies.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('casestudies::casestudies.title.casestudies')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CaseStudies $casestudies
     * @return Response
     */
    public function destroy(CaseStudies $casestudies)
    {
        $this->casestudies->destroy($casestudies);

        return redirect()->route('admin.casestudies.casestudies.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('casestudies::casestudies.title.casestudies')]));
    }
}

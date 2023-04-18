<?php

namespace Modules\Services\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Services\Entities\Service;
use Modules\Services\Entities\Status;
use Modules\Services\Entities\Category;
use Modules\Services\Http\Requests\CreateServiceRequest;
use Modules\Services\Http\Requests\UpdateServiceRequest;
use Modules\Services\Repositories\ServiceRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class ServiceController extends AdminBaseController
{
    /**
     * @var ServiceRepository
     */
    private $service;
    
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
        ServiceRepository $service,
        Status             $status,
        Category           $category,
        FileRepository $file    )
    {
        parent::__construct();

        $this->service = $service;
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
        $services = $this->service->all();
        return view('services::admin.services.index', compact('services', 'categories'));
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
        return view('services::admin.services.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateServiceRequest $request
     * @return Response
     */
    public function store(CreateServiceRequest $request)
    {
        $this->service->create($request->all());

        return redirect()->route('admin.services.service.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('services::services.title.services')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Service $service
     * @return Response
     */
    public function edit(Service $service)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $service);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('services::admin.services.edit', compact('service','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Service $service
     * @param  UpdateServiceRequest $request
     * @return Response
     */
    public function update(Service $service, UpdateServiceRequest $request)
    {
        $this->service->update($service, $request->all());

        return redirect()->route('admin.services.service.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('services::services.title.services')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @return Response
     */
    public function destroy(Service $service)
    {
        $this->service->destroy($service);

        return redirect()->route('admin.services.service.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('services::services.title.services')]));
    }
}

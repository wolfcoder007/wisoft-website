<?php

namespace Modules\Testimonials\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Testimonials\Entities\Testimonial;
use Modules\Testimonials\Entities\Status;
use Modules\Testimonials\Entities\Category;
use Modules\Testimonials\Http\Requests\CreateTestimonialRequest;
use Modules\Testimonials\Http\Requests\UpdateTestimonialRequest;
use Modules\Testimonials\Repositories\TestimonialRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class TestimonialController extends AdminBaseController
{
    /**
     * @var TestimonialRepository
     */
    private $testimonial;
    
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
        TestimonialRepository $testimonial, 
        Status             $status,
        Category           $category,
        FileRepository $file    )
    {
        parent::__construct();

        $this->testimonial = $testimonial;
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
        $testimonials = $this->testimonial->all();

        return view('testimonials::admin.testimonials.index', compact('testimonials'));
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
        return view('testimonials::admin.testimonials.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTestimonialRequest $request
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        //var_dump($request->all());die;
        $this->testimonial->create($request->all());

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Testimonial $testimonial
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $testimonial);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('testimonials::admin.testimonials.edit', compact('testimonial','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Testimonial $testimonial
     * @param  UpdateTestimonialRequest $request
     * @return Response
     */
    public function update(Testimonial $testimonial, UpdateTestimonialRequest $request)
    {
        //var_dump($request->all());die;
        $this->testimonial->update($testimonial, $request->all());

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Testimonial $testimonial
     * @return Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->testimonial->destroy($testimonial);

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }
    
    public function getTesmonialList()
    {
        $testimonials = $this->testimonial->all();
        return $testimonials;
    }
    
    public function getTesmonial(Testimonial $testimonial)
    {
        //$testimonials = $this->testimonial->all();
        return $testimonial;
    }
}

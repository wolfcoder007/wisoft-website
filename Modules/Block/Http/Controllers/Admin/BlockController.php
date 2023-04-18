<?php

namespace Modules\Block\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Block\Entities\Block;
use Modules\Block\Entities\Status;
use Modules\Block\Entities\Category;
use Modules\Block\Http\Requests\CreateBlockRequest;
use Modules\Block\Http\Requests\UpdateBlockRequest;
use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;


class BlockController extends AdminBaseController
{
    /**
     * @var BlockRepository
     */
    private $block;
    
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
        BlockRepository $block,
        Status             $status,
        Category           $category,
        FileRepository $file    )
    {
        parent::__construct();

        $this->block = $block;
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
        $blocks = $this->block->all();

        return view('block::admin.blocks.index', compact('blocks', 'categories'));
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
        return view('block::admin.blocks.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBlockRequest $request
     * @return Response
     */
    public function store(CreateBlockRequest $request)
    {
        $this->block->create($request->all());

        return redirect()->route('admin.block.block.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('block::blocks.title.blocks')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Block $block
     * @return Response
     */
    public function edit(Block $block)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $block);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('block::admin.blocks.edit', compact('block','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Block $block
     * @param  UpdateBlockRequest $request
     * @return Response
     */
    public function update(Block $block, UpdateBlockRequest $request)
    {
        $this->block->update($block, $request->all());

        return redirect()->route('admin.block.block.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('block::blocks.title.blocks')]));
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  Block $block
     * @return Response
     */
    public function destroy(Block $block)
    {
        $this->block->destroy($block);

        return redirect()->route('admin.block.block.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('block::blocks.title.blocks')]));
    }
}

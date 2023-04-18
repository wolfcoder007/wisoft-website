<?php

namespace Modules\Block\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Block\Entities\Block;
use Modules\Block\Http\Requests\CreateBlockRequest;
use Modules\Block\Http\Requests\UpdateBlockRequest;
use Modules\Block\Repositories\BlockRepository;
use Modules\Block\Transformers\FullBlockTransformer;
use Modules\Block\Transformers\BlockTransformer;
use Modules\Setting\Entities\Setting;


class BlockController extends Controller
{
    /**
     * @var PageRepository
     */
    private $block;

    public function __construct(BlockRepository $block)
    {
        $this->block = $block;
    }

    public function index()
    {
        $publishedBlocks = Block::published()->get();
        return BlockTransformer::collection($publishedBlocks);
    }

    public function blockspagination(Request $request)
    {
        return BlockTransformer::collection($this->block->serverPaginationFilteringFor($request));
    }
    
    public function find(Block $block)
    {
        return new FullBlockTransformer($block);
    }
    
    public function getSingleData(Block $block)
    {
        return new BlockTransformer($block);
        
    }


    
}

<?php

namespace Modules\Client\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\Status;
use Modules\Client\Entities\Category;
use Modules\Client\Http\Requests\CreateClientRequest;
use Modules\Client\Http\Requests\UpdateClientRequest;
use Modules\Client\Repositories\ClientRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class ClientController extends AdminBaseController
{
    /**
     * @var clientRepository
     */
    private $client;
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
        ClientRepository $client,
        Status             $status,
        Category           $category,
        FileRepository $file   )
    {
        parent::__construct();

        $this->client = $client;
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
        $clients = $this->client->all();
        $categories = $this->category->lists();

        return view('client::admin.clients.index', compact('clients', 'categories' ));
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
     
        return view('client::admin.clients.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateClientRequest $request
     * @return Response
     */
    public function store(CreateClientRequest $request)
    {
        $this->client->create($request->all());

        return redirect()->route('admin.client.client.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('client::clients.title.clients')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client $client
     * @return Response
     */
    public function edit(Client $client)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $client);
        $categories = $this->category->lists();
        $statuses = $this->status->lists();
        $this->assetPipeline->requireJs('ckeditor.js');
        return view('client::admin.clients.edit', compact('client','categories', 'thumbnail', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Client $client
     * @param  UpdateClientRequest $request
     * @return Response
     */
    public function update(Client $client, UpdateClientRequest $request)
    {
        $this->client->update($client, $request->all());

        return redirect()->route('admin.client.client.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('client::clients.title.clients')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client $client
     * @return Response
     */
    public function destroy(Client $client)
    {
        $this->client->destroy($client);

        return redirect()->route('admin.client.client.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('client::clients.title.clients')]));
    }
}

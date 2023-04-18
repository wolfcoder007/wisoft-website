<?php

namespace Modules\Client\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Client\Http\Requests\CreateClientRequest;
use Modules\Client\Http\Requests\UpdateClientRequest;
use Modules\Client\Repositories\ClientRepository;
use Modules\Client\Transformers\FullClientTransformer;
use Modules\Client\Transformers\ClientTransformer;
use Modules\Setting\Entities\Setting;


class ClientController extends Controller
{
    /**
     * @var PageRepository
     */
    private $client;

    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $publishedClients = Client::published()->get();
        return ClientTransformer::collection($publishedClients);
    }

    public function clientspagination(Request $request)
    {
        return ClientTransformer::collection($this->client->serverPaginationFilteringFor($request));
    }
    
    public function find(Client $client)
    {
        return new FullClientTransformer($client);
    }
    
    public function getSingleData(Client $client)
    {
        //$client = Client::published()->find($client);
        return new ClientTransformer($client);
    }


    
}

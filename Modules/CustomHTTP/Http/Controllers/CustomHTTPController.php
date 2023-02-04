<?php

namespace Modules\CustomHTTP\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CustomHTTP\Traits\ApiResponseHandler;
use Modules\CustomHTTP\Traits\HelperTrait;

class CustomHTTPController extends Controller
{
    use ApiResponseHandler, HelperTrait;

    /**
     * Global Web Settings
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function envSettings()
    {

        $settings = [
            'global' => [],
            'header' => [
                'logo' => '',
                'login' => '',
                'apply' => '',
            ],
            'primary_menu' => $this->getMenuByKey("Primary Menu"),
            'secondary_menu' => $this->getMenuByKey("Secondary Menu"),
            'extra_menu' => [],
            'footer' => [
                'logo' => '',
                'copyrights' => '',

            ],
            'sidebar' => [
                'social' => []
            ],
        ];
        //  return $this->setDefaultSuccessResponse([])->respondWithSuccess($settings);
        return $this->respondWithSuccess($settings);
    }

    private function getMenu (){

    }

    public function getPageBySlug(PagesRestRequest $request, $slug){
        $slug = $slug ?? null;
        $dateStr = '2019-10-30 18:29:19';
        //$date = Carbon::createFromFormat('Y-m-d H:i:s', $day);
        $date = Carbon::parse(strtotime($dateStr));
        $slug =  $date->subDay()->format("Y-m-d\TH:i:s\.v");;
        // return Carbon::parse(strtotime($dateStr))->format("Y-m-d\TH:i:s\.v");
        return $this->respondWithSuccess(['slug'=>$slug]);

    }

}

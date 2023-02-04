<?php

namespace Modules\GeneralSettings\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\GeneralSettings\Entities\GeneralSetting;
use Modules\GeneralSettings\Http\Requests\CreateGeneralSettingRequest;
use Modules\GeneralSettings\Http\Requests\UpdateGeneralSettingRequest;
use Modules\GeneralSettings\Repositories\GeneralSettingRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class GeneralSettingController extends AdminBaseController
{
    /**
     * @var GeneralSettingRepository
     */
    private $generalsetting;

    public function __construct(GeneralSettingRepository $generalsetting)
    {
        parent::__construct();

        $this->generalsetting = $generalsetting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$generalsettings = $this->generalsetting->all();

        return view('generalsettings::admin.generalsettings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('generalsettings::admin.generalsettings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGeneralSettingRequest $request
     * @return Response
     */
    public function store(CreateGeneralSettingRequest $request)
    {
        $this->generalsetting->create($request->all());

        return redirect()->route('admin.generalsettings.generalsetting.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('generalsettings::generalsettings.title.generalsettings')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  GeneralSetting $generalsetting
     * @return Response
     */
    public function edit(GeneralSetting $generalsetting)
    {
        return view('generalsettings::admin.generalsettings.edit', compact('generalsetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GeneralSetting $generalsetting
     * @param  UpdateGeneralSettingRequest $request
     * @return Response
     */
    public function update(GeneralSetting $generalsetting, UpdateGeneralSettingRequest $request)
    {
        $this->generalsetting->update($generalsetting, $request->all());

        return redirect()->route('admin.generalsettings.generalsetting.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('generalsettings::generalsettings.title.generalsettings')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GeneralSetting $generalsetting
     * @return Response
     */
    public function destroy(GeneralSetting $generalsetting)
    {
        $this->generalsetting->destroy($generalsetting);

        return redirect()->route('admin.generalsettings.generalsetting.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('generalsettings::generalsettings.title.generalsettings')]));
    }
}

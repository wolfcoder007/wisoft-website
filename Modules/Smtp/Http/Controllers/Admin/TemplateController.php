<?php

namespace Modules\Smtp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Smtp\Entities\Template;
use Modules\Smtp\Http\Requests\CreateTemplateRequest;
use Modules\Smtp\Http\Requests\UpdateTemplateRequest;
use Modules\Smtp\Repositories\TemplateRepository;
use Modules\Smtp\Repositories\ProviderRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TemplateController extends AdminBaseController
{
    /**
     * @var TemplateRepository
     */
    private $template;

    /**
     * @var ProviderRepository
     */
    private $provider;


    public function __construct(TemplateRepository $template, ProviderRepository $provider)
    {
        parent::__construct();

        $this->template = $template;
        $this->provider = $provider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $templates = $this->template->all();

        return view('smtp::admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $providers = $this->provider->all();
        return view('smtp::admin.templates.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTemplateRequest $request
     * @return Response
     */
    public function store(CreateTemplateRequest $request)
    {
        $this->template->create($request->all());

        return redirect()->route('admin.smtp.template.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('smtp::templates.title.templates')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Template $template
     * @return Response
     */
    public function edit(Template $template)
    {
        $providers = $this->provider->all();
        return view('smtp::admin.templates.edit', compact('template', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Template $template
     * @param  UpdateTemplateRequest $request
     * @return Response
     */
    public function update(Template $template, UpdateTemplateRequest $request)
    {
        $this->template->update($template, $request->all());

        return redirect()->route('admin.smtp.template.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('smtp::templates.title.templates')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Template $template
     * @return Response
     */
    public function destroy(Template $template)
    {
        $this->template->destroy($template);

        return redirect()->route('admin.smtp.template.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('smtp::templates.title.templates')]));
    }
}

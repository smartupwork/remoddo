<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\HelpCenter\HelpCenterDTO;
use App\Handler\Command\Admin\HelpCenter\SaveHelpCenterHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HelpCenterRequest;
use App\Models\HelpCenter;
use App\Models\HelpCenterCategory;
use App\Service\Admin\Datatable\HelpCenterDatatable;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{


    private HandlerService $handlerService;
    private HelpCenterDTO $dto;
    private $categries;

    public function __construct(HandlerService $handlerService, HelpCenterDTO $dto)
    {

        $this->handlerService = $handlerService;
        $this->dto = $dto;
        $this->categries = HelpCenterCategory::pluck('title', 'id');
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.help-center.index');
        }
        return HelpCenterDatatable::makeEntityList(new HelpCenter());
    }


    public function create()
    {
        $title = 'Help Center';
        $url = route('admin.help-center.store');
        $helpCenter = new HelpCenter();
        $categories = $this->categries;
        return view('admin.sections.help-center.save_form', compact('categories', 'title', 'url', 'helpCenter'));
    }

    public function store(HelpCenterRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveHelpCenterHandler)->getHandler();
        $handler->setDTO($dto)->setModel(new HelpCenter)->handle();
        return $this->jsonSuccess('Help Center  created successfully', [
            'redirect' => route('admin.help-center.index')
        ]);
    }

    public function edit(HelpCenter $helpCenter)
    {
        $title = 'Help Center';
        $url = route('admin.help-center.update', $helpCenter);
        $categories = $this->categries;
        return view('admin.sections.help-center.save_form', compact('categories', 'title', 'url', 'helpCenter'));
    }

    public function update(HelpCenter $helpCenter, HelpCenterRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveHelpCenterHandler)->getHandler();
        $handler->setDTO($dto)->setModel($helpCenter)->handle();
        return $this->jsonSuccess('Help Center updated successfully', [
            'redirect' => route('admin.help-center.edit', $helpCenter)
        ]);
    }

    public function destroy(HelpCenter $helpCenter)
    {
        $helpCenter->delete();
        return $this->jsonSuccess('Help Center deleted successfully');
    }

}

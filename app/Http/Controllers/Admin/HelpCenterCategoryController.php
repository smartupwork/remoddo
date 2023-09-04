<?php

namespace App\Http\Controllers\Admin;


use App\DTO\Admin\HelpCenter\Category\CategoryDTO;
use App\Handler\Command\Admin\HelpCenter\Category\SaveCategoryHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HelpCenterCategoryRequest;
use App\Models\HelpCenterCategory;
use App\Service\Admin\Datatable\HelpCenterCategoryDatatable;
use Illuminate\Http\Request;

class HelpCenterCategoryController extends Controller
{

    private CategoryDTO $dto;
    private HandlerService $handlerService;

    public function __construct(HandlerService $handlerService, CategoryDTO $dto)
    {
        $this->dto = $dto;
        $this->handlerService = $handlerService;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.help-center.category.index');
        }
        return HelpCenterCategoryDatatable::makeEntityList(new HelpCenterCategory());
    }


    public function create()
    {
        $title = 'Help Center Category';
        $url = route('admin.help-center-category.store');
        $category = new HelpCenterCategory();
        return view('admin.sections.help-center.category.save_form', compact('title', 'url', 'category'));
    }

    public function store(HelpCenterCategoryRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveCategoryHandler)->getHandler();
        $handler->setDTO($dto)->setModel(new HelpCenterCategory)->handle();
        return $this->jsonSuccess('Help Center Category created successfully', [
            'redirect' => route('admin.help-center-category.index')
        ]);
    }

    public function edit(HelpCenterCategory $helpCenterCategory)
    {
        $title = 'Help Center Category';
        $url = route('admin.help-center-category.update', $helpCenterCategory);
        $category = $helpCenterCategory;
        return view('admin.sections.help-center.category.save_form', compact('title', 'url', 'category'));
    }

    public function update(HelpCenterCategory $helpCenterCategory, HelpCenterCategoryRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveCategoryHandler)->getHandler();
        $handler->setDTO($dto)->setModel($helpCenterCategory)->handle();
        return $this->jsonSuccess('Help Center Category created successfully', [
            'redirect' => route('admin.help-center-category.edit', $helpCenterCategory)
        ]);
    }

    public function destroy(HelpCenterCategory $helpCenterCategory)
    {
        $helpCenterCategory->delete();
        return $this->jsonSuccess('Category deleted successfully');
    }

}

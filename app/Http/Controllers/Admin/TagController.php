<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Admin\Tag\TagDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use App\Service\Admin\Datatable\TagDatatable;
use App\Service\Admin\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{


    private TagDTO $dto;
    private TagService $service;

    public function __construct(TagDTO $dto, TagService $service)
    {
        $this->dto = $dto;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.tags.index');
        }
        return TagDatatable::makeEntityList(new Tag());
    }

    public function create()
    {
        $title = 'Create tag';
        $url = route('admin.tags.store');
        $tag = null;
        return view('admin.sections.tags.save_form', compact('title', 'url', 'tag'));
    }


    public function store(TagRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, new Tag);
        return $this->jsonSuccess('Tag created successfully', [
            'redirect' => route('admin.tags.index')
        ]);
    }

    public function edit(Tag $tag)
    {
        $title = 'Edit tag';
        $url = route('admin.tags.update', ['tag' => $tag->id]);
        return view('admin.sections.tags.save_form', compact('tag', 'title', 'url'));
    }

    public function update(Tag $tag, TagRequest $request)
    {
        $dto = $this->dto->make($request);
        $this->service->handle($dto, $tag);
        return $this->jsonSuccess('Tag created successfully', [
            'redirect' => route('admin.tags.edit', ['tag' => $tag->id])
        ]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->jsonSuccess('Tag deleted successfully');
    }
}

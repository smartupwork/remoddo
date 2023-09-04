<?php

namespace App\Http\Controllers;

use App\Models\DisputeCategory;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.problems.index');
        }

        return DisputeCategory::dataTable(DisputeCategory::query());

    }

    public function create()
    {
        return view('admin.sections.problems.create');
    }

    public function store(Request $request)
    {
        DisputeCategory::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return $this->jsonSuccess('Problem created successfully', [
            'redirect' => route('admin.problems.index')
        ]);
    }

    public function edit(DisputeCategory $problem)
    {
        return view('admin.sections.problems.edit', compact('problem'));
    }

    public function update(DisputeCategory $problem, Request $request)
    {
        $problem->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);


        return $this->jsonSuccess('Problem updated successfully', [
            'redirect' => route('admin.problems.index')
        ]);
    }


    public function destroy(DisputeCategory $problem)
    {
        $problem->delete();
        return $this->jsonSuccess('Problem deleted successfully', [
            'url' => route('admin.problems.index')
        ]);

    }
}

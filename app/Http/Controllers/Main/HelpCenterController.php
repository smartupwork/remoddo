<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\HelpCenter;
use App\Models\HelpCenterCategory;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index()
    {
        $categories = HelpCenterCategory::where('is_active', true)->get();
        return view('main.pages.help-center.index', compact('categories'));
    }

    public function byCategory(HelpCenterCategory $category)
    {
        $questions = $category->questions()->where('is_active', true)->get();
        return view('main.pages.help-center.category', compact('questions', 'category'));
    }


    public function categorySearch(Request $request)
    {
        $search = $request->get('search');
        $categories = HelpCenterCategory::where('title', 'like', "%$search%")->get();
        return $this->jsonSuccess('', [
            'categories' => $categories
        ]);
    }

    public function questionSearch(HelpCenterCategory $category, Request $request)
    {
        $search = $request->get('search');
        $questions = $category->questions()->where('question', 'like', "%$search%")->get();
        return $this->jsonSuccess('', [
            'questions' => $questions
        ]);
    }


    public function question(HelpCenter $question)
    {
        $questionQuery = HelpCenter::where('category_id', $question->category_id)
            ->where('id', '<>', $question->id);
        $lastQuestions = $questionQuery->orderByDesc('id')->limit(5)->get();
        $randomQuestions = $questionQuery->inRandomOrder()->limit(5)->get();
        return view('main.pages.help-center.question', compact('question', 'lastQuestions', 'randomQuestions'));
    }

}

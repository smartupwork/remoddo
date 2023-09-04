<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function search(Request $request)
    {
        $tags = Tag::select('id', 'title')->filterBy($request->all())->get();
        return $this->jsonSuccess('', [
            'tags' => $tags
        ]);
    }
}

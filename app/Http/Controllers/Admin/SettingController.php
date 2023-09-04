<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.sections.settings.index');
    }

    public function update(Request $request)
    {
        foreach ($request->s as $key => $value) {
            Setting::set($key, $value);
        }

        return $this->jsonSuccess('Settings udpated successfully');
    }
}

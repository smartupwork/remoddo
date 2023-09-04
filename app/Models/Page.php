<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class Page extends Model
{
    const STATUSES = [
        'draft',
        'published',
        'static'
    ];
    const EDITABLE_STATUSES = [
        'draft',
        'published'
    ];
    protected $fillable = [
        'user_id',
        'status',
        'title',
        'link',
        'template',
        'content',
        'meta_title',
        'meta_description',
    ];
    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    public static function get($url)
    {
        return self::where('link', $url)->where('status', 'static')->first();
    }

    public static function dataTable($query)
    {
        return DataTables::of($query)
            ->editColumn('link', function ($model) {
                return '<a href="' . url($model->link) . '" target="_blank">' . $model->link . '</a>';
            })
            ->editColumn('date', function ($model) {
                return $model->created_at;
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'pages'
                ])->render();
            })
            ->rawColumns(['link', 'action'])
            ->make(true);
    }

    public function blocks()
    {
        return $this->hasMany(PageBlock::class);
    }

    public function isStatic()
    {
        return $this->status == 'static';
    }

    public function show($key, $default = '')
    {
        $explode = explode(':', $key);
        $blockName = $explode[0];
        $dataName = $explode[1];
        return $this->blocks
            ->where('name', $blockName)
            ->first()
            ->show($dataName, $default);
    }
}

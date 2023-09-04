<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'menu_items';

    /**
     * Get the last sorting item.
     *
     * @param $menuId
     * @return int
     */
    public static function getLastSort($menuId)
    {
        $lastSort = self::where('menu_id', $menuId)->orderBy('sort', 'desc')->first();

        return is_null($lastSort) ? 0 : $lastSort->sort + 1;
    }

    /**
     * Get menu.
     *
     * @return BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // public function icon()
    // {
    //     return $this->morphOne(Attachment::class,'attachmentable');
    // }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id')->whereNotNull('parent_id')->orderBy('sort');//->get();
    }
}

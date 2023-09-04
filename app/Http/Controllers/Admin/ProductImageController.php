<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function remove(ProductImage $image)
    {
        $path = $image->getAttributes()['image'];
        $image->delete();
        Storage::disk($image->product->getDiskName())->delete($path);
        return $this->jsonSuccess('Product image deleted successfully');
    }
}

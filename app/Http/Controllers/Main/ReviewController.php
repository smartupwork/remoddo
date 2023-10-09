<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index($productId){
        $reviews = DB::table('reviews')->select('id', 'product_id','user_id', 'comments','star_rating')
        ->where('reviews.product_id', $productId)
        ->where('reviews.user_id', Auth::user()->id)
        ->get();
        $data['reviews'] =  $reviews;
        $data['prod_id'] = $productId;
        return view('main.pages.product.review',$data);
    }
    public function reviewstore(Request $request){
        $review = new Review();
        $review->product_id = $request->productId;
        $review->comments= $request->comment;
        $review->star_rating = $request->rating;
        $review->user_id = Auth::user()->id;
        //$review->service_id = $request->service_id;
        $review->save();
        return redirect()->back()->with('flash_msg_success','Your review has been submitted Successfully,');
    }
}

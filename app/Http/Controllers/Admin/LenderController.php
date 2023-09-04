<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BrandConfirmationStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Lender;
use App\Models\Product;
use App\Service\Admin\Datatable\ProductDatatable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LenderController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.lenders.index');
        }

        return Lender::dataTable(Lender::query());
    }

    public function edit(Lender $lender, Request $request)
    {
        if (!$request->ajax()) {
            $brandConfirmations = BrandConfirmationStatus::getValues();
            $attributes = Attribute::where('show_in_products_table', true)->get();
            return view('admin.sections.lenders.edit', compact('lender',
                'brandConfirmations', 'attributes'));
        }
        return ProductDatatable::makeEntityList(Product::customSelected()->where('lender_id',$lender->id));
    }

    public function destroy(Lender $lender)
    {
        try {
            DB::beginTransaction();

            if ($lender->hasStripeId()) {
                $customer = $lender->asStripeCustomer();
                $customer->delete();
            }

            $lender->delete();
            DB::commit();
            return $this->jsonSuccess('Lender deleted successfully', [
                'url' => route('admin.lenders.index')
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }

    }


}

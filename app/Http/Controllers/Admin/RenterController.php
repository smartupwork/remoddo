<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Renter;
use App\Service\Admin\Datatable\RenterProductDatatable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RenterController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.renters.index');
        }

        return Renter::dataTable(Renter::query());
    }

    public function edit(Renter $renter, Request $request)
    {
        if (!$request->ajax()) {
            $attributes = Attribute::where('show_in_products_table', true)->get();
            return view('admin.sections.renters.edit', compact('renter', 'attributes'));

        }

        return RenterProductDatatable::makeEntityList($renter->myRequests());

    }

    public function destroy(Renter $renter)
    {
        try {
            DB::beginTransaction();

            if ($renter->hasStripeId()) {
                $customer = $renter->asStripeCustomer();
                $customer->delete();
            }

            $renter->delete();
            DB::commit();
            return $this->jsonSuccess('Renter deleted successfully', [
                'url' => route('admin.renters.index')
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            info($exception->getMessage());
        }
    }

}

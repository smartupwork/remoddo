<?php

namespace App\Service\Admin\Datatable;

use App\Enums\BrandConfirmationStatus;
use App\Enums\OrderStatus;
use App\Models\Attribute;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ProductDatatable implements DatatableInterface
{


    public static function makeEntityList($query, ?int $id = null)
    {
        $attributes = Attribute::where('show_in_products_table', true)->get();

        $datatable = DataTables::of($query->withoutGlobalScopes()
            ->with(['values', 'orders'])
            ->withCount(['likes', 'views'])
            ->whereHas('attributes')
        )
            ->addColumn('brand', function ($model) {
                return $model->brand_title;
            });
        foreach ($attributes as $attribute) {
            $datatable->addColumn($attribute->name, function ($model) use ($attribute) {
                $values = $model->values->where('attribute_id', '=', $attribute->id)->pluck('value');

                return $values->join(' | ');
            });
        }

        $datatable->addColumn('liked', function ($model) {
            return $model->likes_count;
        })
            ->addColumn('sales_per_month', function ($model) {
                $end = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
                $start = Carbon::now()->subMonth()->format('Y-m-d');
                return $model->orders()
                    ->whereBetween('created_at', [$start, $end])
                    ->where('status', OrderStatus::ACCEPTED)
                    ->sum('total_price');
            })
            ->addColumn('trending', function ($model) {

                return view('components.admin.status', [
                    'className' => $model->views_count > 0 ? 'bg-success' : 'bg-danger',
                    'status_text' => $model->views_count > 0 ? 'Trending' : 'Not trending'
                ]);
            })
            ->addColumn('brand_confirmation', function ($model) {

                switch ($model->brand_confirmation) {
                    case BrandConfirmationStatus::PENDING:
                        $className = 'bg-warning';
                        break;
                    case BrandConfirmationStatus::CONFIRMED:
                        $className = 'bg-success';
                        break;
                    default:
                        $className = 'bg-danger';
                        break;
                }

                return view('components.admin.status', [
                    'className' => $className,
                    'status_text' => $model->brand_confirmation
                ]);
            })
            ->addColumn('action', function ($model) {
                return view('components.admin.actions', [
                    'model' => $model,
                    'name' => 'products'
                ])->render();
            })
            ->filter(function ($model) {
                if (request()->get('brand_confirmation')) {
                    $model->where('brand_confirmation', request()->get('brand_confirmation'));
                }
            })
            ->rawColumns(['action', 'brand_confirmation']);
        return $datatable->make(true);
    }
}

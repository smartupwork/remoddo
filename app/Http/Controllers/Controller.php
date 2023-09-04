<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function processForDataTable(Request $request, $model_name = "", $route_name = "", $fields = ["name" => "name"])
    {
        if (!$model_name) {
            return false;
        }

        $model = "\App\Models\\$model_name";

        $items = $model::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

        if (!is_null($request->search['value'])) {
            $items->where(function ($query) use ($request) {
                foreach ($request->columns as $column) {
                    if ($column["searchable"] == "true") {
                        $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                    }
                }
            });
        }

        $recordsFiltered = $items->count();
        $items->limit($request->length)
            ->offset($request->start);
        $data = [];

        foreach ($items->get() as $item) {
            $def = [
                'id' => $item->id,
                // 'created_at' => Carbon::parse($item->created_at)->format('d.m.Y, h:i A'),
                // 'updated_at' => Carbon::parse($item->updated_at)->format('d.m.Y, h:i A'),
                'action' => view('admin.inc.actions', ['item' => $item, "route" => ($route_name ? $route_name : strtolower($model_name))])->render()
            ];
            $data[] = array_merge(
                $def,
                $this->processFields($item, $fields)
            );
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $model::count(),
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ];
    }

    /**
     * Format of success json response for all ajax\axios requests
     *
     */
    public function jsonSuccess($msg = '', $data = null): JsonResponse
    {
        $resp = [
            'success' => true,
            'data' => $data,
            'message' => $msg
        ];
        return response()->json($resp);
    }

    /**
     * Format of error json response for all ajax\axios requests
     *
     */
    public function jsonError($msg = 'Server Error', $data = null, $code = 500): JsonResponse
    {
        if ($code == 422) {
            return response()->json(['errors' => $errorMsg], $code);
        }
        $res = [
            'success' => false,
            'data' => $data,
            'message' => $msg
        ];
        return response()->json($res, $code);
    }

}

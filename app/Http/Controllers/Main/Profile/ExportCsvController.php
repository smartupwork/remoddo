<?php

namespace App\Http\Controllers\Main\Profile;

use App\Exports\PaymentHistoryExport;
use App\Exports\TransactionHistoryExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportCsvController extends Controller
{
    public function export(Request $request)
    {
        $export_type = $request->get('type') ?? 'payment';
        switch ($export_type) {
            case 'transaction':
                $export_class = new TransactionHistoryExport();
                break;
            default:
                $export_class = new PaymentHistoryExport();
                break;
        }
        $file_name = "{$export_type}_" . date('Y_m_d_H_i_s') . '.csv';
        return Excel::download($export_class, $file_name);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exports\SaleItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleItemExportController
{
    public function export()
    {
        return Excel::download(new SaleItemsExport, 'sale_items.xlsx');
    }
}

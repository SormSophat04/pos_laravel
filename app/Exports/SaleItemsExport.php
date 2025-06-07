<?php

namespace App\Exports;

use App\Models\SaleItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SaleItem::select('id', 'sale_id', 'product_name', 'quantity', 'price', 'total', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Sale ID', 'Product Name', 'Quantity', 'Price', 'Total', 'Created At'];
    }
}

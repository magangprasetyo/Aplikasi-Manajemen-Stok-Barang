<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function view(): View
    {
        return view('project.content.crud.export_product', ['products' => $this->products]);
    }
}

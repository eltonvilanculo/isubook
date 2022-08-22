<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use App\SoldProduct;
use App\ProductCategory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function stats()
    {
        return view('inventory.stats', [
            'categories' => ProductCategory::all(),
            'products' => Product::all(),
            'soldproductsbystock' => SoldProduct::selectRaw('product_id, max(created_at), sum(qty) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('product_id')->orderBy('total_qty', 'desc')->limit(15)->get(),
            'soldproductsbyincomes' => SoldProduct::selectRaw('product_id, max(created_at), sum(qty) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('product_id')->orderBy('total_qty', 'desc')->limit(15)->get(),
            'soldproductsbyavgprice' => SoldProduct::selectRaw('product_id, max(created_at), sum(qty) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('product_id')->orderBy('total_qty', 'desc')->limit(15)->get()
        ]);
    }
}

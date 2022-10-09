<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Product;
use Carbon\Carbon;
use App\SoldProduct;
use App\Route;
use App\Worker;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function stats()
    {
        return view('inventory.stats', [
            'categories' => Route::all(),
            'products' => Worker::all(),
            'soldproductsbystock' => Assignment::selectRaw('worker_id, max(created_at), count(id) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('worker_id')->orderBy('total_qty', 'desc')->limit(15)->get(),
            'soldproductsbyincomes' => Assignment::selectRaw('worker_id, max(created_at), count(id) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('worker_id')->orderBy('total_qty', 'desc')->limit(15)->get(),
            'soldproductsbyavgprice' => Assignment::selectRaw('worker_id, max(created_at),count(id) as total_qty')->whereYear('created_at', Carbon::now()->year)->groupBy('worker_id')->orderBy('total_qty', 'desc')->limit(15)->get()
        ]);
    }
}
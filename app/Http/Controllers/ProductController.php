<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * แสดงหน้ารายการสินค้าทั้งหมด
     */
    public function index()
    {
        $products = Product::all();
        return view('productpage.index', ['products' => $products]);
    }
}
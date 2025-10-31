<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $term = trim($request->get('q'));
        $products = Product::query()
            ->search($term)
            ->orderByDesc('product_id')
            ->paginate(12)
            ->withQueryString();

        return view('productpage.index', [
            'products' => $products,
            'q' => $term,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user']);
        $avg = round($product->reviews()->avg('rating'), 1);

        return view('productpage.show', [
            'product' => $product,
            'avgRating' => $avg,
        ]);
    }

    public function storeReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
        ]);

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'prod_id' => $product->product_id],
            $data + ['review_date' => now()->toDateString()]
        );

        return back()->with('status', 'Review submitted!');
    }
}

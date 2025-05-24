<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function updateSize(Request $request)
    {
        try{
            $data = $request->validate([
                'id' => 'required|exists:products,id',
                'size' => 'required|in:S,M,L',
            ]);
    
            $product = Product::find($data['id']);
            $product->size = $data['size'];
            $product->save();
    
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
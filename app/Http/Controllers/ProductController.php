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
    // Show create form
    public function create()
    {
        return Inertia::render('Products/Create');
    }
    // Store product data
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:S,M,L',
        ]);
        $data['image_url'] = 'https://via.placeholder.com/150';
        Product::create($data);

        return redirect()->route('products.index');
    }
    // Show edit form and retrieve product data to show it form fields to update it
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }
    // Update product data
    public function update(Product $product, Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:S,M,L',
        ]);
        $product->update($data);
        return redirect()->route('products.index');
    }

    // Update product size
    public function updateSize(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:products,id',
                'size' => 'required|in:S,M,L',
            ]);

            $product = Product::find($data['id']);
            $product->size = $data['size'];
            $product->save();

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}

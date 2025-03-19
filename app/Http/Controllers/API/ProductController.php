<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Validator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $query = Product::query();
        $query = Product::with('images');

        // Keyword search (searches in name and description)
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->input('category') !== '') {
            $query->where('category', $request->input('category'));
        }

        // Paginate results (10 per page)
        $products = $query->paginate(10);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Server-side validation
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'required|string',
            'date_time'   => 'required|date',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($request->only('name', 'category', 'description', 'date_time'));

        // Handle image uploads and store paths in product_images table
        if ($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        // Validation for update
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'required|string',
            'date_time'   => 'required|date'
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'category', 'description', 'date_time'));

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Delete associated images from storage and DB
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}

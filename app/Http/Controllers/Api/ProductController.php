<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::paginate(10)); // Trả về JSON chuẩn
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);

        }
        $request->validate([
            'name' => 'required|string|max:255',
            // Tối đa 13 chữ số trước dấu thập phân và tối đa 2 
            // chữ số sau dấu thập phân
            'price' => [
                'required',
                'numeric',
                'regex:/^\d{1,13}(\.\d{1,2})?$/',
            ],
            'category_id' => 'required',
            'image' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $product = Product::find($id);
        $image = $request->input('image') ?: $product->image;
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'image' => $image,
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);
        return response()->json(['message' => 'Cập nhật sản phẩm thành công', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        try {
            //code...
            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }
            $product->delete();
            return response()->json(['message' => 'Sản phẩm đã được xóa thành công']);
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }

    }
}

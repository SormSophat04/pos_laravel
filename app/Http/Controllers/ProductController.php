<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    public function store(Request $request)
    {
        $data = array(
            'name' => $request->productName,
            'price' => $request->productPrice,
            'qty' => $request->productQty,
            'category' => $request->productCategory,
            'image' => $request->file('productImage')->store('store_imagePro', 'image_pro'),
            'created_at' => now(),
            'updated_at' => now(),
        );

        $product = DB::table('producs')->insert($data);

        if ($product) {
            return redirect()->back()->with('success', 'You have been registered successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function index()
    {
        $products = Product::all();
        return view('layout.add_product', compact('products'));
    }

    public function getToPos()
    {
        $products = Product::all();
        return view('layout.product', compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image file if exists
        if ($product->image && Storage::disk('image_pro')->exists($product->image)) {
            Storage::disk('image_pro')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'You have been deleted successfully');
    }

    public function edit($id)
    {
        $products = Product::all();
        $update = Product::findOrFail($id);
        return view('layout.update_pro', compact('update', 'products'));
    }


    public function update(Request $request, $id)
    {
        $update = Product::findOrFail($id);

        $validated = $request->validate([
            'productName'     => 'required|string|max:255',
            'productPrice'    => 'required|numeric|min:0',
            'productQty'      => 'required|integer|min:1',
            'productCategory' => 'required|string',
            'productImage'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle new image upload
        if ($request->hasFile('productImage')) {
            // Delete old image if exists
            if ($update->image && Storage::disk('image_pro')->exists($update->image)) {
                Storage::disk('image_pro')->delete($update->image);
            }

            $imagePath = $request->file('productImage')->store('store_imagePro', 'image_pro');
            $update->image = $imagePath;
        }

        // Update other fields
        $update->name     = $validated['productName'];
        $update->price    = $validated['productPrice'];
        $update->qty      = $validated['productQty'];
        $update->category = $validated['productCategory'];

        $update->save();

        return redirect()->route('product.show')->with('success', 'You have been updated successfully');
    }

    public function getPhone()
    {
        $products = Product::where('category', 'phone')->get();
        return view('layout.product', compact('products'));
    }
    public function getLaptop()
    {
        $products = Product::where('category', 'laptop')->get();
        return view('layout.product', compact('products'));
    }
    public function getTablet()
    {
        $products = Product::where('category', 'tablet')->get();
        return view('layout.product', compact('products'));
    }
    public function getWatch()
    {
        $products = Product::where('category', 'watch')->get();
        return view('layout.product', compact('products'));
    }
    public function getHeadphones()
    {
        $products = Product::where('category', 'headphones')->get();
        return view('layout.product', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->get();

        return view('layout.add_product', compact('products'));
    }
}

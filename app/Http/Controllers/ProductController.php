<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        // Fetch all products
        $products = Product::all();

        // Return the index view with the products
        return view('Product.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        // Return the view for creating a new product
        return view('Product.create');
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'BrandName' => 'required|max:255',
            'PurchasedDate' => 'required|date',
            'OpenDate' => 'required|date',
            'ExpiryDate' => 'required|date|after:purchased_date',
        ]);

        // Create and store the product in the database
        Product::create([
            'BrandName' => $validated['BrandName'],
            'PurchasedDate' => $validated['PurchasedDate'],
            'OpenDate' => $validated['OpenDate'],
            'ExpiryDate' => $validated['ExpiryDate'],
        ]);

        // Redirect to the 'products.index' page with a success message
        return redirect()->route('Product.index')->with('status', 'Product added successfully!');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Return the edit view with the product
        return view('Product.edit', compact('product'));
    }

    // Update the specified product in storage
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'BrandName' => 'required|max:255',
            'PurchasedDate' => 'required|date',
            'OpenDate' => 'required|date',
            'ExpiryDate' => 'required|date|after:PurchasedDate',
        ]);

        // Find the product by ID and update it
        $product = Product::findOrFail($id);
        
        $product->update([
            'BrandName' => $validated['BrandName'],
            'PurchasedDate' => $validated['PurchasedDate'],
            'OpenDate' => $validated['OpenDate'],
            'ExpiryDate' => $validated['ExpiryDate'],
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('Product.index')->with('status', 'Product updated successfully!');
    }

    // Remove the specified product from storage
    public function destroy($id)
    {
        // Find the product by ID and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect to the index page with a success message
        return redirect()->route('Product.index')->with('status', 'Product deleted successfully!');
    }
}

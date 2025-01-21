<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
         $user = auth()->user(); // Get the logged-in user

    if ($user->UserLevel == 0) { 
        // If the user is an admin (user_level 0), fetch all products with pagination
        $products = Product::paginate(3);
    } else {
        // Otherwise, fetch only the products of the logged-in user with pagination
        $products = Product::where('userid', $user->id)->paginate(3);
    }

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
           'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Validate image file (PNG, JPG, JPEG)
       ]);

       if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension(); // Generate unique name
        $request->image->move(public_path('products'), $imageName); // Store in public/products
    }

   
       // Associate the form with the logged-in user
       $validated['userid'] = auth()->user()->id; // Add the logged-in user's ID
   
       // Create and store the product in the database
       Product::create([
           'BrandName' => $validated['BrandName'],
           'PurchasedDate' => $validated['PurchasedDate'],
           'OpenDate' => $validated['OpenDate'],
           'ExpiryDate' => $validated['ExpiryDate'],
           'userid' => $validated['userid'], // Ensure that 'userid' is passed
           'image' => isset($imageName) ? $imageName : null, // Save the image path if an image was uploaded
       ]);
   
       // Redirect to the 'products.index' page with a success message
       return redirect()->route('Product.index')->with('status', 'Product Added successfully!');
   }


    // Show the form for editing the specified product
    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Return the edit view with the product
        return view('Product.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    // Validate the request data
    $validated = $request->validate([
        'BrandName' => 'required|max:255',
        'PurchasedDate' => 'required|date',
        'OpenDate' => 'required|date',
        'ExpiryDate' => 'required|date|after:PurchasedDate',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Validate image file (PNG, JPG, JPEG)
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Update the product with the validated data
    $product->update([
        'BrandName' => $validated['BrandName'],
        'PurchasedDate' => $validated['PurchasedDate'],
        'OpenDate' => $validated['OpenDate'],
        'ExpiryDate' => $validated['ExpiryDate'],
    ]);

   if ($request->hasFile('image')) {
        $imgName = str_replace('/products/', '', $product->image);
        $imagePath = public_path('products/' . $imgName); // Get the full path to the image
        if (file_exists($imagePath)) { // Check if the file exists
            unlink($imagePath); // Delete the file
        }
        $imageName = time() . '.' . $request->image->extension(); // Generate unique name
        $request->image->move(public_path('products'), $imageName); // Store in public/products
        $imageName;
        $product->update([
            'image' => $imageName, // Update image if a new one is uploaded
        ]);
    }

    // Redirect to the index page with a success message
    return redirect()->route('Product.index')->with('status', 'Product updated successfully!');
}

public function show($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Return the show view with the product details
    return view('Product.show', compact('product'));
    if ($request->hasFile('image')) {
        $imgName = str_replace('/products/', '', $product->image);
        $imagePath = public_path('products/' . $imgName); // Get the full path to the image
        if (file_exists($imagePath)) { // Check if the file exists
            unlink($imagePath); // Delete the file
        }
        $imageName = time() . '.' . $request->image->extension(); // Generate unique name
        $request->image->move(public_path('products'), $imageName); // Store in public/products
        $imageName;
        $product->update([
            'image' => $imageName, // Update image if a new one is uploaded
        ]);}

}

      // Remove the specified product from storage
    public function destroy($id)
    {
        // Find the product by ID and delete it
        $product = Product::findOrFail($id);
        $imgName = str_replace('/products/', '', $product->image);
        $imagePath = public_path('products/' . $imgName); // Get the full path to the image
        if (file_exists($imagePath)) { // Check if the file exists
            unlink($imagePath); // Delete the file
        }
        $product->delete();

        // Redirect to the index page with a success message
        return redirect()->route('Product.index')->with('status', 'Product deleted successfully!');
    }

    
}

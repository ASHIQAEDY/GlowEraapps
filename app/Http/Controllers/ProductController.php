<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProductExpiryNotification;
use Carbon\Carbon;
class ProductController extends Controller
{

    private function checkAndSendNotification(Product $product)
    {
        $currentDate = Carbon::now();
        $expiryDate = Carbon::parse($product->ExpiryDate);
        $openDate = Carbon::parse($product->OpenDate);

        // Condition 1: Less than 7 days before expiry
        if ($expiryDate->diffInDays($currentDate) < 7) {
            $product->user->notify(new ProductExpiryNotification($product));
        }

        // Condition 2: Exactly 7 days before expiry
        if ($expiryDate->diffInDays($currentDate) == 7) {
            $product->user->notify(new ProductExpiryNotification($product));
        }

        // Condition 3: Same day as the open date
        if ($expiryDate->isSameDay($openDate)) {
            $product->user->notify(new ProductExpiryNotification($product));
        }
    }

    public function index(Request $request)
{
    $user = auth()->user(); // Get the logged-in user

    $query = Product::query();

    if ($user->UserLevel == 0) {
        // Admin can search by userid, Product Name, Purchased Date, Open Date, Expiry Date
        if ($request->filled('userid')) {
            $query->where('userid', $request->userid);
        }
    } else {
        // Regular user can only see their own products
        $query->where('userid', $user->id);
    }

    if ($request->filled('BrandName')) {
        $query->where('BrandName', 'like', '%' . $request->BrandName . '%');
    }
    if ($request->filled('PurchasedDate')) {
        $query->whereDate('PurchasedDate', $request->PurchasedDate);
    }
    if ($request->filled('OpenDate')) {
        $query->whereDate('OpenDate', $request->OpenDate);
    }
    if ($request->filled('ExpiryDate')) {
        $query->whereDate('ExpiryDate', $request->ExpiryDate);
    }

    $products = $query->latest()->paginate(3);

    // Fetch notifications for the logged-in user
    $notifications = $user->notifications;

    // Return the index view with the products and notifications
    return view('Product.index', compact('products', 'notifications'));
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
            'OpenDate' => 'required|date|after_or_equal:PurchasedDate',
            'ExpiryDate' => 'required|date|after_or_equal:OpenDate|after_or_equal:PurchasedDate',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
        }

        $validated['userid'] = auth()->user()->id;

        $product = Product::create([
            'BrandName' => $validated['BrandName'],
            'PurchasedDate' => $validated['PurchasedDate'],
            'OpenDate' => $validated['OpenDate'],
            'ExpiryDate' => $validated['ExpiryDate'],
            'userid' => $validated['userid'],
            'image' => isset($imageName) ? $imageName : null,
        ]);

        // Check and send notifications
        $this->checkAndSendNotification($product);

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

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'BrandName' => 'required|max:255',
            'PurchasedDate' => 'required|date',
            'OpenDate' => 'required|date|after_or_equal:PurchasedDate',
            'ExpiryDate' => 'required|date|after_or_equal:OpenDate|after_or_equal:PurchasedDate',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'BrandName' => $validated['BrandName'],
            'PurchasedDate' => $validated['PurchasedDate'],
            'OpenDate' => $validated['OpenDate'],
            'ExpiryDate' => $validated['ExpiryDate'],
        ]);

        if ($request->hasFile('image')) {
            $imgName = str_replace('/products/', '', $product->image);
            $imagePath = public_path('products/' . $imgName);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->update(['image' => $imageName]);
        }

        // Check and send notifications
        $this->checkAndSendNotification($product);

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
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Delete associated image (if exists)
    $imgName = str_replace('/products/', '', $product->image);
    $imagePath = public_path('products/' . $imgName); // Get the full path to the image
    if (file_exists($imagePath)) {
        unlink($imagePath); // Delete the file
    }

    // Delete the product
    $product->delete();

    // Find the notification for the authenticated user that is associated with the product
    $notification = auth()->user()->notifications()->where('data->product_id', $id)->first();

    // Delete the notification if it exists
    if ($notification) {
        $notification->delete(); // Delete the notification
    }

    // Redirect to the index page with a success message
    return redirect()->route('Product.index')->with('status', 'Product and notification deleted successfully!');
}
      
    
    
}

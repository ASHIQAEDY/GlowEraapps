<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's default 'products')
    protected $table = 'products';

    protected $primaryKey = 'ProductID'; // Replace with your actual primary key column name
    // Protect against mass-assignment vulnerabilities
    protected $fillable = ['BrandName', 'PurchasedDate', 'OpenDate', 'ExpiryDate',   'userid','image'];

    // Optionally, you can cast dates to Carbon instances for date manipulation
    protected $dates = ['PurchasedDate', 'OpenDate', 'ExpiryDate'];


    // Define the inverse relationship - many products belong to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'userid'); // Ensure 'userid' is the foreign key
    }
    
     // Add an accessor for the image to easily fetch the full URL
     public function getImageAttribute($value)
     {
         return $value ? asset('storage/' . $value) : null;
     }

}

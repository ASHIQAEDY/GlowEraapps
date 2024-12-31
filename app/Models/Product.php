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
    protected $fillable = ['BrandName', 'PurchasedDate', 'OpenDate', 'ExpiryDate'];

    // Optionally, you can cast dates to Carbon instances for date manipulation
    protected $dates = ['PurchasedDate', 'OpenDate', 'ExpiryDate'];
}

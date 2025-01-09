<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductExpiryNotification;
use Carbon\Carbon;

class NotifyProductExpiry extends Command
{
    protected $signature = 'notify:product-expiry';
    protected $description = 'Notify users about products nearing their expiry date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $products = Product::where('ExpiryDate', '<=', Carbon::now()->addDays(7))->get(); // Products expiring in the next 7 days

        foreach ($products as $product) {
            $users = User::where('UserLevel', 1)->get();
            foreach ($users as $user) {
                $user->notify(new ProductExpiryNotification($product));
            }
        }

        $this->info('Product expiry notifications sent successfully.');
    }
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProductExpiryNotification extends Notification
{
    use Queueable;

    protected $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The product ' . $this->product->BrandName . ' is about to expire.')
                    ->action('View Product', url('/products/' . $this->product->ProductID))
                    ->line('Please throw away the product if it has expired.');
    }

    public function toArray($notifiable)
    {
        return [
            'product_id' => $this->product->ProductID,
            'brand_name' => $this->product->BrandName,
            'expiry_date' => $this->product->ExpiryDate,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'product_id' => $this->product->ProductID,
            'brand_name' => $this->product->BrandName,
            'expiry_date' => $this->product->ExpiryDate,
        ]);
    }


   

}
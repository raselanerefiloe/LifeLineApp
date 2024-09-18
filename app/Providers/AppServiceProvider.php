<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //URL::forceScheme('https');
        
        // Share cart data globally
        View::composer('*', function ($view) {
            $cartItems = collect();
            $cartItemCount = 0;
            $cartId = 0;
            $total = 0;
            $createdAt = null;

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $cartItems = $cart->items; // Assuming `items` is a relationship on `Cart`
                    $cartItemCount = $cartItems->count();
                    $total = $cart->total;
                    $cartId = $cart->id;
                    $createdAt = $cart->created_at;
                }
            }

            // Share the variables with all views
            $view->with(compact('cartItems','cartItemCount', 'total', 'cartId', 'createdAt'));
        });
    }
}

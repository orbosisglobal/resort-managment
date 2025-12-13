<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Models\CustomerCategory;
// use App\Models\DeliveryOrder;
// use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share variables only with the header partial
        // View::composer('admin.include.header', function ($view) {
        //     $view->with([
        //         'customer_categories' => CustomerCategory::all(),

        //         'pending_approval_order' => DeliveryOrder::where('status', 'Approval')->count()
        //     ]);
        // });
    }
}

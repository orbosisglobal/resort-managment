<?php

namespace App\Providers;

use App\Models\Attendance;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\CompanySetting;
use App\Models\CustomerCategory;
use App\Models\DeliveryOrder;
use Illuminate\Support\Facades\Gate;

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
        // SEO data composer
        // $companies = CompanySetting::all();
        // $customer_categories = CustomerCategory::all();
        // $pending_approval_order = DeliveryOrder::where('status', 'Approval')->count();

        // View::share(['all_companies' => $companies, 'customer_categories' => $customer_categories, 'pending_approval_order' => $pending_approval_order]);




        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }

    /**
     * Fetch SEO data based on the current URL slug.
     *
     * @return array
     */

    /**
     * Extract slug from the current URL.
     *
     * @return string|null
     */
}

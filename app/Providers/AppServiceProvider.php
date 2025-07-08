<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
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
        // ======================================================= Visitors>>
        Gate::define('visitor-access', function (User $user): bool {

            return $user->approved && now()->lessThan($user->expires_at);
        });

        // ======================================================= Admin>>
        Gate::define('admin', function (User $user): bool {

            return $user->is_admin;
        });

        // ======================================================= Admin & Staff Admin>>
        Gate::define('admin_and_staff_admin', function (User $user): bool {

            return $user->is_admin || $user->is_admin_staff;
        });

        // ======================================================= Admin & Technical Staff>>
        Gate::define('admin_and_technical', function (User $user): bool {

            return $user->is_admin || $user->is_technical;
        });


        // ======================================================= Admin & Clerical, Inspection>>
        Gate::define('admin_and_clerical', function (User $user): bool {

            return $user->is_admin || $user->is_clerical;
        });

        // ======================================================= Admin & Clerical, Inspection & Techincal>>
        Gate::define('admin_and_clerical_and_technical', function (User $user): bool {

            return $user->is_admin || $user->is_clerical || $user->is_technical;
        });

        // ======================================================= Admin & Technical & Tourist Assistance>>
        Gate::define('admin_and_tech_tourist', function (User $user): bool {

            return $user->is_admin || $user->is_technical || $user->is_tourist_assistance;
        });
        
        
        // Access Controll
        Gate::define('dashboard', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical || $user->is_tourist_assistance;
        });

        Gate::define('artifacts-management', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical || $user->is_tourist_assistance;
        });
        
        Gate::define('artifacts', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical || $user->is_tourist_assistance;
        });
        
        Gate::define('restoration', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical;
        });

        Gate::define('artifacts-exhibit-monitoring', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical;
        });
        
        Gate::define('mapping-heritage', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical;
        });
        
        Gate::define('visitor-monitoring', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff  || $user->is_technical || $user->is_tourist_assistance;
        });
        
        Gate::define('visitor-registration', function (User $user): bool {
            return $user->is_admin || $user->is_technical || $user->is_tourist_assistance;
        });
        
        Gate::define('visitor-profiling', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff  || $user->is_technical || $user->is_tourist_assistance;
        });
        
        Gate::define('visitor-feedback', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff  || $user->is_technical || $user->is_tourist_assistance;
        });
        
        Gate::define('contributor', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical;
        });
        
        Gate::define('report-generation', function (User $user): bool {
            return $user->is_admin || $user->is_technical || $user->is_admin_staff || $user->is_clerical || $user->is_tourist_assistance;
        });
        
        Gate::define('visitor-report', function (User $user): bool {
            return $user->is_admin || $user->is_technical || $user->is_tourist_assistance;
        });

        Gate::define('visitor-feedback', function (User $user): bool {
            return $user->is_admin || $user->is_technical || $user->is_tourist_assistance;
        });

        Gate::define('contributor-report', function (User $user): bool {
            return $user->is_admin || $user->is_technical || $user->is_admin_staff || $user->is_clerical;
        });
        
        Gate::define('account-management', function (User $user): bool {
            return $user->is_admin;
        });
        
        Gate::define('audit-trails', function (User $user): bool {
            return $user->is_admin || $user->is_admin_staff || $user->is_technical || $user->is_clerical || $user->is_tourist_assistance;
        });
    }
}

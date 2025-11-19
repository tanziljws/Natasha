<?php

namespace App\Providers;

use App\Models\Post;
use Livewire\Livewire;
use App\Models\Service;
use App\Models\UiConfigGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

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
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        // $this->registerPolicies();

         Livewire::setUpdateRoute(function ($handle) {
            return \Illuminate\Support\Facades\Route::post('/test/livewire/update', $handle);
        });

        Livewire::setScriptRoute(function ($handle) {
            return \Illuminate\Support\Facades\Route::get('/test/livewire/livewire.js', $handle);
        });

        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
        

            // Jika user dari tabel users (admin)
            if ($notifiable instanceof \App\Models\User) {
                return route('admin.password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ]);
            }

            // fallback (jaga-jaga)
            return url('/reset-password/' . $token . '?email=' . urlencode($notifiable->getEmailForPasswordReset()));
        });
    }

}

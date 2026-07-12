<?php

namespace App\Providers;

use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\LayananRepository;
use App\Repositories\PembayaranRepository;
use App\Repositories\ReservasiRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\AuthService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\DashboardServiceInterface;
use App\Services\Contracts\LayananServiceInterface;
use App\Services\Contracts\MidtransServiceInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Dashboard\DashboardService;
use App\Services\Layanan\LayananService;
use App\Services\Payment\MidtransService;
use App\Services\Reservasi\ReservasiService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ReservasiRepositoryInterface::class, ReservasiRepository::class);
        $this->app->bind(PembayaranRepositoryInterface::class, PembayaranRepository::class);
        $this->app->bind(LayananRepositoryInterface::class, LayananRepository::class);

        // Bind Services
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ReservasiServiceInterface::class, ReservasiService::class);
        $this->app->bind(MidtransServiceInterface::class, MidtransService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
        $this->app->bind(LayananServiceInterface::class, LayananService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}

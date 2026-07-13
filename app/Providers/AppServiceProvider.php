<?php

namespace App\Providers;

use App\Backend\Repositories\Contracts\LayananRepositoryInterface;
use App\Backend\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Backend\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Backend\Repositories\Contracts\UserRepositoryInterface;
use App\Backend\Repositories\LayananRepository;
use App\Backend\Repositories\PembayaranRepository;
use App\Backend\Repositories\ReservasiRepository;
use App\Backend\Repositories\UserRepository;
use App\Backend\Services\Auth\AuthService;
use App\Backend\Services\Contracts\AuthServiceInterface;
use App\Backend\Services\Contracts\DashboardServiceInterface;
use App\Backend\Services\Contracts\LayananServiceInterface;
use App\Backend\Services\Contracts\MidtransServiceInterface;
use App\Backend\Services\Contracts\ReservasiServiceInterface;
use App\Backend\Services\Contracts\UserServiceInterface;
use App\Backend\Services\Dashboard\DashboardService;
use App\Backend\Services\Layanan\LayananService;
use App\Backend\Services\Payment\MidtransService;
use App\Backend\Services\Reservasi\ReservasiService;
use App\Backend\Services\User\UserService;
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

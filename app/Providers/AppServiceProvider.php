<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <-- 1. Tambahkan ini
use App\Models\Room;                 // <-- 2. Tambahkan ini

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
        // 3. Tambahkan kode ini
        // Kode ini memberitahu Laravel: "Setiap kali view 'layouts.sidebar' akan dimuat,
        // jalankan fungsi ini untuk mengambil data ruangan dan sertakan variabel '$roomsForMenu'."
        View::composer('layouts.sidebar', function ($view) {
            $roomsForMenu = Room::orderBy('name', 'asc')->get();
            $view->with('roomsForMenu', $roomsForMenu);
        });
    }
}
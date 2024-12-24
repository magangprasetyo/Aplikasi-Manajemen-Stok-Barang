<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Cek dan tambah akun admin saat aplikasi dimulai
        // Cek apakah tabel 'users' ada
        if (Schema::hasTable('users')) {
            // Cek dan tambah akun admin saat aplikasi dimulai
            if (User::where('email', 'admin@gmail.com')->doesntExist()) {
                User::create([
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'), // Ganti 'admin' dengan password yang diinginkan
                    'role' => 'admin',
                ]);
            }
        }
    }

}

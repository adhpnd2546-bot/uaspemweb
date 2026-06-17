<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (\Illuminate\Http\Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin@admin.com' && $password === '123') {
            session(['user_role' => 'admin']);
            return redirect()->route('admin.dashboard')->with('login_success', 'admin');
        } elseif ($username === 'petugas@petugas.com' && $password === '123') {
            session(['user_role' => 'petugas']);
            return redirect()->route('petugas.kunjungan.create')->with('login_success', 'petugas');
        }

        return redirect()->route('login')->with('error', 'Email atau Password salah!');
    })->name('login.post');
});

Route::get('/logout', function (\Illuminate\Http\Request $request) {
    $request->session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::get('/public/lahan', function () {
    return view('public.lahan');
})->name('public.lahan');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['role:admin']) 
    ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::prefix('lahan')->group(function () {
            Route::get('/', function () {
                return view('admin.lahan');
            })->name('lahan'); // diakses via route('admin.lahan')
            
            Route::get('/detail', function () {
                return view('admin.lahan-detail');
            })->name('lahan.detail'); // diakses via route('admin.lahan.detail')
        });

        Route::get('/petani', function () {
            return view('admin.petani');
        })->name('petani');
        
});


/*
|--------------------------------------------------------------------------
| Petugas Lapangan Routes
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['role:petugas'])
    ->group(function () {
        
        Route::prefix('kunjungan')->group(function () {
            Route::get('/create', function () {
                return view('petugas.kunjungan-create');
            })->name('kunjungan.create'); // diakses via route('petugas.kunjungan.create')
        });
        
});

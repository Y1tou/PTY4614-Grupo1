<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    // Obtener el usuario desde Google
    $user_google = Socialite::driver('google')->stateless->user();
    
    // Crear o actualizar el usuario en la base de datos
    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);


    Auth::login($user);

    return redirect('/dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::prefix('admin')->group(function () {
    // Rutas de autenticación para admins
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Rutas protegidas por autenticación para administradores
    Route::middleware('auth:admin')->group(function () {
        Route::get('/registrar-cuenta', [AdminLoginController::class, 'mostrarPaginaRegistrar'])->name('admin.registrar-cuenta');
        // Route::post('/registrar-cuenta', [AdminLoginController::class, 'registrarNuevaCuenta'])->name('admin.registrar-cuenta');
        Route::post('/registrar-cuenta', [AdminLoginController::class, 'registrarCuenta'])->name('admin.registrar-cuenta');
        // Route::get('/registrar-cuenta', [AdminLoginController::class, 'unauthenticated']);
        Route::get('/listado-cuentas', [AdminLoginController::class, 'mostrarListado'])->name('admin.listado-cuentas');
        Route::post('/update', [AdminLoginController::class, 'update'])->name('admin.update');
        Route::delete('/eliminar-cuenta/{id}', [AdminLoginController::class, 'eliminarCuenta'])->name('admin.eliminar-cuenta');
    });

});
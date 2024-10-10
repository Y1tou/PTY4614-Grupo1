<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Auth\VotacionController;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AEAdminController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckAdmin;


Route::get('/', function () {
    return view('welcome'); // Página de login al iniciar
});

Route::get('/admin', function () {
    return view('/admin/login'); // Página de login al iniciar
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    // Obtener el usuario desde Google
    $user_google = Socialite::driver('google')->stateless()->user();

    // Buscar el usuario en la base de datos por el correo electrónico
    $user = User::where('email', $user_google->email)->first();

    $admin = Admin::where('CORREO', $user_google->email)->first();

    // Verificar si el usuario existe
    if ($user) {
        // Crear o actualizar el usuario en la base de datos
        $user->google_id = $user_google->id; // Solo actualizar google_id si es necesario
        $user->name = $user_google->name;
        $user->save(); // Guarda los cambios en la base de datos

        // Iniciar sesión
        Auth::login($user);

        // Redirigir al dashboard
        return redirect('/dashboard');
    }

    if ($admin) {
        // Crear o actualizar el usuario en la base de datos
        $admin->google_id = $user_google->id; // Solo actualizar google_id si es necesario
        $admin->NOMBRE = $user_google->name;
        $admin->save(); // Guarda los cambios en la base de datos

        // Iniciar sesión
        Auth::guard('admin')->login($admin);


        // Redirigir al dashboard
        return redirect()->route('admin.ae-home');
    }

    // Si el usuario no está registrado, redirigir a una página de error o al login
    return redirect('/')->withErrors(['msg' => 'Tu cuenta no esta registrada en esta plataforma. No puede ingresar a la página.']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin')->group(function () {
    // Rutas de autenticación para admins
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Rutas protegidas por autenticación para administradores
    Route::middleware('auth:admin')->group(function () {
        Route::middleware([CheckSuperAdmin::class])->group(function () {
            Route::get('/registrar-cuenta', [AdminLoginController::class, 'mostrarPaginaRegistrar'])->name('admin.registrar-cuenta');
            Route::post('/registrar-cuenta', [AdminLoginController::class, 'registrarCuenta'])->name('admin.registrar-cuenta.post');
            Route::get('/listado-cuentas', [AdminLoginController::class, 'mostrarListado'])->name('admin.listado-cuentas');
            Route::post('/update', [AdminLoginController::class, 'update'])->name('admin.update');
            Route::delete('/eliminar-cuenta/{id}', [AdminLoginController::class, 'eliminarCuenta'])->name('admin.eliminar-cuenta');
        });
        Route::middleware([CheckAdmin::class])->group(function () {
            Route::get('/ae-home', [AEAdminController::class, 'showAEHome'])->name('admin.ae-home');
            Route::get('/ae-listado-cuentas', [AEAdminController::class, 'mostrarListadoAE'])->name('admin.ae-listado-cuentas');
            Route::post('/update', [AEAdminController::class, 'update'])->name('admin.update');
            Route::delete('/eliminar-cuenta/{id}', [AEAdminController::class, 'eliminarCuenta'])->name('admin.eliminar-cuenta');
            Route::get('/ae-votaciones-activas', [AEAdminController::class, 'mostrarVotacionAct'])->name('admin.ae-votaciones-activas');
            Route::get('/ae-historial-votaciones', [AEAdminController::class, 'mostrarVotacionHist'])->name('admin.ae-historial-votaciones');
            Route::get('/votacion', [VotacionController::class, 'create'])->name('admin.votacion.create');

            Route::get('/admin/votacion', [VotacionController::class, 'create'])->name('votacion.create');
            Route::post('/admin/votacion', [VotacionController::class, 'store'])->name('votacion.store');
        });
    });
});

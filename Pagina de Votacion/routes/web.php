<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Auth\VotacionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AEAdminController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\Auth\VerificarCorreoController;

// Página de inicio (login)
Route::get('/', function () {
    return view('welcome'); 
});

// Página de login para admins
Route::get('/admin', function () {
    return view('/admin/login'); 
});

// Validación de correo para acceder a autenticación Google
Route::post('/verificar-correo', [VerificarCorreoController::class, 'verificar'])->name('verificar.correo');

// Rutas de autenticación con Google
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    // Comprobar si hay un error en la redirección
    if (request()->has('error')) {
        return redirect('/')->withErrors(['msg' => 'Autenticación cancelada. Por favor, intenta de nuevo o selecciona otra cuenta.']);
    }

    try {
        // Obtener el usuario autenticado desde Google
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

        // Verificar si el admin existe
        if ($admin) {
            // Crear o actualizar el administrador en la base de datos
            $admin->google_id = $user_google->id; // Solo actualizar google_id si es necesario
            $admin->NOMBRE = $user_google->name;
            $admin->save(); // Guarda los cambios en la base de datos

            // Iniciar sesión como admin
            Auth::guard('admin')->login($admin);

            // Redirigir al dashboard
            return redirect()->route('admin.ae-home');
        }

        // Si el usuario no está registrado, redirigir a una página de error o al login
        // return redirect('/')->withErrors(['msg' => 'Tu cuenta no está registrada en esta plataforma. No puedes ingresar a la página.']);
        return view('welcome')->with('correoValido', false);
    } catch (\Exception $e) {
        return redirect('/')->withErrors(['msg' => 'Hubo un problema al iniciar sesión con Google: ' . $e->getMessage()]);
    }
});

// Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Cargar rutas de autenticación
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
            Route::post('/updateAdmin', [AdminLoginController::class, 'updateAdmin'])->name('admin.updateAdmin');
            Route::delete('/eliminar-cuenta-admin/{id}', [AdminLoginController::class, 'eliminarCuentaAdmin'])->name('admin.eliminar-cuenta-admin');
        });
        Route::middleware([CheckAdmin::class])->group(function () {
            Route::get('/ae-home', [AEAdminController::class, 'showAEHome'])->name('admin.ae-home');
            Route::get('/ae-listado-cuentas', [AEAdminController::class, 'mostrarListadoAE'])->name('admin.ae-listado-cuentas');
            Route::post('/update', [AEAdminController::class, 'update'])->name('admin.update');
            Route::delete('/eliminar-cuenta/{id}', [AEAdminController::class, 'eliminarCuenta'])->name('admin.eliminar-cuenta');
            Route::get('/ae-votaciones-activas', [VotacionController::class, 'mostrarVotacionAct'])->name('admin.ae-votaciones-activas');
            Route::get('/ae-historial-votaciones', [VotacionController::class, 'mostrarVotacionHist'])->name('admin.ae-historial-votaciones');
            Route::post('/ae-detalles-votacion/{sigla}', [VotacionController::class, 'detallesVotacion'])->name('admin.ae-detalles-votacion');
            Route::get('/votacion', [VotacionController::class, 'create'])->name('admin.votacion.create');
            Route::get('/admin/votacion', [VotacionController::class, 'create'])->name('votacion.create');
            Route::post('/admin/votacion', [VotacionController::class, 'store'])->name('votacion.store');
            Route::post('/admin/finalizar-votacion/{sigla}', [VotacionController::class, 'finalizarVotacion'])->name('admin.finalizar-votacion');
        });
    });
});

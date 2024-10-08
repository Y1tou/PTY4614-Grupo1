<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        // return view('auth.admin-login');
        return view('admin/login');
    }

    // public function showAEHome()
    // {
    //     // return view('auth.admin-login');
    //     return view('admin/ae-home');
    // }

    // public function showAEListado()
    // {
    //     // return view('auth.admin-login');
    //     return view('admin/ae-listado-cuentas');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('CORREO', 'CONTRASENIA');

        // Intentar autenticar al administrador
        if (Auth::guard('admin')->attempt([
            'CORREO' => $credentials['CORREO'],
            'password' => $credentials['CONTRASENIA'], // Laravel verificará la contraseña encriptada
        ])) {
            // Autenticación exitosa
            $user = Auth::guard('admin')->user(); // Obtén el usuario autenticado
            // Redirigir según el tipo de admin
            if ($user->TIPO === 1) {
                return redirect()->route('admin.registrar-cuenta');
            } elseif ($user->TIPO === 2) {
                return redirect()->route('admin.ae-home');
            }
        }

        // Autenticación fallida
        return redirect()->back()->withErrors([
            // 'CORREO' => 'Las credenciales no coinciden con nuestros registros.',

        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout(); // Cierra la sesión del admin
        return redirect('/admin/login'); // Redirige al login
    }

    public function mostrarPaginaRegistrar()
    {
        return view('admin.registrar-cuenta');
    }

    public function mostrarListado()
    {
        $admins = Admin::all(); // Obtener todos los administradores
        return view('admin.listado-cuentas', compact('admins'));
    }

    public function registrarCuenta(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'NOMBRE' => '',
            'CORREO' => 'required|email|unique:admin,CORREO',
            'CONTRASENIA' => '',
            'TIPO' => 'required|integer',
        ]);

        // Crear el nuevo admin
        Admin::create([
            'NOMBRE' => $validatedData['NOMBRE'],
            'CORREO' => $validatedData['CORREO'],
            'CONTRASENIA' => bcrypt($validatedData['CONTRASENIA']), // Encriptar la contraseña
            'TIPO' => $validatedData['TIPO'],
        ]);

        // Redirigir a una página de confirmación o al listado de cuentas
        return redirect()->route('admin.listado-cuentas')->with('success', 'Cuenta creada exitosamente');
    }

        //Actualizar datos Admin
    public function update(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->NOMBRE = $request->nombre;
        $admin->CORREO = $request->correo;
        $admin->save();

        return redirect()->route('admin.listado-cuentas')->with('success', 'Administrador actualizado exitosamente.');
    }


    public function eliminarCuenta($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete(); // Eliminar el administrador

        return redirect()->route('admin.listado-cuentas')->with('success', 'Administrador eliminado con éxito.');
    }

}

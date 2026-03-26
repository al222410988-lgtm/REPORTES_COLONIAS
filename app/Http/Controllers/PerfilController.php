<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\ActualizacionPerfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $puedeActualizar = $this->puedeActualizar($user);
        $siguienteActualizacion = $this->getSiguienteActualizacion($user);
        
        return view('perfil', compact('puedeActualizar', 'siguienteActualizacion'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Verificar si puede actualizar
        if (!$this->puedeActualizar($user)) {
            return back()->with('warning', 'No puedes actualizar tus datos en este momento. Espera 30 días desde la última actualización.');
        }

        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password_actual' => 'nullable|required_with:password_nuevo',
            'password_nuevo' => 'nullable|min:8|confirmed',
        ]);

        // Actualizar información personal
        $user->nombre = $request->nombre;
        $user->email = $request->email;

        // Si se quiere cambiar la contraseña
        if ($request->filled('password_nuevo')) {
            // Verificar que la contraseña actual sea correcta
            if (!Hash::check($request->password_actual, $user->password)) {
                return back()->withErrors([
                    'password_actual' => 'La contraseña actual no es correcta.'
                ]);
            }

            // Actualizar la contraseña
            $user->password = Hash::make($request->password_nuevo);
            
            // Registrar actualización de contraseña
            ActualizacionPerfil::create([
                'user_id' => $user->id,
                'campo_actualizado' => 'password',
                'fecha_actualizacion' => now(),
            ]);
        }

        // Si se actualiza el email
        if ($user->wasChanged('email')) {
            // Registrar actualización de email
            ActualizacionPerfil::create([
                'user_id' => $user->id,
                'campo_actualizado' => 'email',
                'fecha_actualizacion' => now(),
            ]);
        }

        $user->save();

        return back()->with('success', '¡Tu perfil ha sido actualizado exitosamente!');
    }

    private function puedeActualizar($user)
    {
        // Obtener la última actualización de cualquier campo
        $ultimaActualizacion = ActualizacionPerfil::where('user_id', $user->id)
            ->orderBy('fecha_actualizacion', 'desc')
            ->first();

        if (!$ultimaActualizacion) {
            return true; // Primera vez que actualiza
        }

        // Verificar si han pasado 30 días
        return $ultimaActualizacion->fecha_actualizacion->diffInDays(now()) >= 30;
    }

    private function getSiguienteActualizacion($user)
    {
        $ultimaActualizacion = ActualizacionPerfil::where('user_id', $user->id)
            ->orderBy('fecha_actualizacion', 'desc')
            ->first();

        if (!$ultimaActualizacion) {
            return now(); // Si nunca ha actualizado, puede hacerlo ahora
        }

        // Calcular próxima actualización (30 días después de la última)
        return $ultimaActualizacion->fecha_actualizacion->addDays(30);
    }
}

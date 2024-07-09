<?php

namespace App\Http\Controllers;

use App\Models\User; // Asegúrate de importar el modelo User si no está importado
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUSers()
    {
        $users = User::all(); // Obtener todos los usuarios

        return response()->json($users, 200); // Devolver la lista de usuarios como respuesta JSON
    }
}

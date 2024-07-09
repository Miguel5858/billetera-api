<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class DepositController extends Controller
{


    public function getAllUsersWithBalance($superuserId)
{
    // Verificar si el usuario es un superusuario
    $superuser = User::find($superuserId);

    if ($superuser && $superuser->role === 'superuser') {
        // Obtener todos los depósitos con la fecha en formato Ecuador
        $deposits = Deposit::with('user')->get()->map(function ($deposit) {
            $deposit->created_at_ecuador = Carbon::parse($deposit->created_at)->setTimezone('America/Guayaquil')->format('Y/m/d - H:i');
            return $deposit;
        });

        // Obtener todos los retiros con la fecha en formato Ecuador
        $withdrawals = Withdrawal::with('user')->get()->map(function ($withdrawal) {
            $withdrawal->created_at_ecuador = Carbon::parse($withdrawal->created_at)->setTimezone('America/Guayaquil')->format('Y/m/d - H:i');
            return $withdrawal;
        });

        // Formatear los datos
        $allTransactions = [
            'deposits' => $deposits->map(function ($deposit) {
                return [
                    'user' => $deposit->user->name,
                    'created_at_ecuador' => $deposit->created_at_ecuador,
                    'amount' => number_format($deposit->amount, 2),
                ];
            }),
            'withdrawals' => $withdrawals->map(function ($withdrawal) {
                return [
                    'user' => $withdrawal->user->name,
                    'created_at_ecuador' => $withdrawal->created_at_ecuador,
                    'amount' => number_format($withdrawal->amount, 2),
                ];
            }),
        ];

        // Retornar la respuesta JSON con la lista de todas las transacciones
        return response()->json(['transactions' => $allTransactions]);
    } else {
        // El usuario no es un superusuario o no existe, lanzar un mensaje de error
        return response()->json(['message' => 'No tienes permiso para realizar esta acción'], 403);
    }
}

    

public function store(Request $request, $superuserId)
{
    // Verificar si el usuario es un superusuario
    $superuser = User::find($superuserId);

    if ($superuser && $superuser->role === 'superuser') {
        // El usuario es un superusuario, permitir el depósito completo
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:0.01',
            ]);
        } catch (ValidationException $e) {
            if ($e->validator->errors()->has('user_id')) {
                return response()->json(['message' => 'El usuario no existe'], 404);
            }
            throw $e;
        }

        $deposit = Deposit::create([            
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Depósito creado exitosamente', 'deposit' => $deposit], 201);
    } else {
        // El usuario no es un superusuario o no existe, lanzar un mensaje de error
        return response()->json(['message' => 'No tienes permiso para realizar esta acción'], 403);
    }
}



public function showUserDeposits($userId)
{
    // Verificar si el usuario existe
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'El usuario no existe'], 404);
    }

    // Obtener todos los depósitos del usuario con la hora de creación y actualización en formato de Ecuador
    $deposits = Deposit::where('user_id', $userId)->get()->map(function ($deposit) {
        $deposit->created_at_ecuador = Carbon::parse($deposit->created_at)->setTimezone('America/Guayaquil')->format('Y-m-d H:i:s');
        $deposit->updated_at_ecuador = Carbon::parse($deposit->updated_at)->setTimezone('America/Guayaquil')->format('Y-m-d H:i:s');
        return $deposit;
    });

    // Calcular la suma de todos los depósitos del usuario
    $totalDeposits = Deposit::where('user_id', $userId)->sum('amount');

    // Crear la respuesta JSON con los depósitos, la suma de los depósitos y las horas en formato de Ecuador
    $response = [
        'user_name' => $user->name,
        'user_id' => $userId,
        'total_deposits' => $totalDeposits,
        'deposits' => $deposits,
    ];

    return response()->json($response);
}






public function showUserWithdrawals($userId)
{
    // Verificar si el usuario existe
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'El usuario no existe'], 404);
    }

    // Obtener el total de retiros del usuario
    $totalWithdrawals = Withdrawal::where('user_id', $userId)->sum('amount');

    // Obtener todos los retiros del usuario con la hora de creación y actualización en formato de Ecuador
    $withdrawals = Withdrawal::where('user_id', $userId)->get()->map(function ($withdrawal) {
        $withdrawal->created_at_ecuador = Carbon::parse($withdrawal->created_at)->setTimezone('America/Guayaquil')->format('Y-m-d H:i:s');
        $withdrawal->updated_at_ecuador = Carbon::parse($withdrawal->updated_at)->setTimezone('America/Guayaquil')->format('Y-m-d H:i:s');
        return $withdrawal;
    });

    // Crear la respuesta JSON con los retiros y las horas en formato de Ecuador
    $response = [
        'user_name' => $user->name,
        'user_id' => $userId,
        'total_withdrawals' => $totalWithdrawals,
        'withdrawals' => $withdrawals,
    ];

    return response()->json($response);
}





public function withdraw(Request $request, $superuserId)
{
    // Verificar si $superuserId es realmente un superusuario en la base de datos
    $superuser = User::where('id', $superuserId)->where('role', 'superuser')->first();

    if (!$superuser) {
        return response()->json(['message' => 'No tienes permiso para realizar retiros'], 403);
    }

    try {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Verificar si el usuario tiene suficientes fondos para el retiro
        $deposits = Deposit::where('user_id', $request->user_id)->get();
        $withdrawals = Withdrawal::where('user_id', $request->user_id)->get();
        $totalDeposits = $deposits->sum('amount');
        $totalWithdrawals = $withdrawals->sum('amount');
        $totalTransactions = $totalDeposits - $totalWithdrawals;

        if ($totalTransactions < $request->amount) {
            return response()->json(['message' => 'Fondos insuficientes para el retiro'], 400);
        }

        // Crear el registro de retiro
        $withdraw = Withdrawal::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ]);
        return response()->json(['message' => 'Retiro creado exitosamente', 'withdraw' => $withdraw], 201);

    } catch (ValidationException $e) {
        if ($e->validator->errors()->has('user_id')) {
            return response()->json(['message' => 'El usuario no existe'], 404);
        }
        throw $e;
    }
}


public function getTotalGeneral()
    {
        // Obtener la suma de todos los depósitos
        $totalDeposits = Deposit::sum('amount');

        // Obtener la suma de todos los retiros
        $totalWithdrawals = Withdrawal::sum('amount');

        // Calcular el total general
        $totalGeneral = $totalDeposits - $totalWithdrawals;

        // Retornar el resultado en formato JSON
        return response()->json([
            'total_general' => $totalGeneral
        ]);
    }
    
}

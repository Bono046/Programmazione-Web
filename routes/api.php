<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRaceController;
use App\Models\User;


Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenziali non valide'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});



Route::middleware(['auth:sanctum, auth'])->group( function() {
    
    Route::get('/races', [ApiRaceController::class, 'listRaces']);   // tutte le gare
    Route::get('/race/{id}', [ApiRaceController::class, 'raceWithDevices']); // singola gara

});



Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logout effettuato']);
});
<?php

use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/sanctum/login', function (Request $request) {
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $request->user()->createToken('apidog')->plainTextToken;

    return response()->json(['token' => $token]);
});

// Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees',EmployeeController::class);
// });


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

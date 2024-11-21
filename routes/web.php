<?php

use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\Auth\PeopleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReseñaController; // Asegúrate de incluir el controlador de Reseña
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------- 
| Web Routes 
|--------------------------------------------------------------------------- 
| Here is where you can register web routes for your application. 
| These routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great! 
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('edit');
})->middleware(['auth', 'verified'])->name('dashboard');







Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/buscarPersonas', [EmployeeController::class, 'buscarPersona'])->name('buscar.personas');

// Rutas del perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate');
    
    // Rutas para el historial de pedidos
    Route::get('/ordershistory', [OrderController::class, 'index'])->name('ordershistory');
    
    // Ruta para las reseñas
    Route::get('/reseñas', [ReseñaController::class, 'index'])->name('reseñas.index'); // Mostrar reseñas
    Route::post('/reseñas', [ReseñaController::class, 'store'])->name('reseñas.store'); // Crear nueva reseña
});



require __DIR__ . '/auth.php';

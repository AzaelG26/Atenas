<?php

use App\Http\Controllers\Auth\PeopleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImagenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('edit');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// rutas para añadir empleados
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create'); // Cambiado a 'employee.create'
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/buscarPersonas', [PeopleController::class, 'buscarPersona'])->name('buscar.personas');



//controlador para añadir imagenes al sistema
Route::get('/añadir-imagenes', [ImagenController::class, 'showAddImagesForm'])->name('imagenes.add');
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';

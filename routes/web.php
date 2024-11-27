<?php

use App\Http\Controllers\ordercontroller;
use App\Http\Controllers\ReseñaController;
use App\Http\Controllers\Auth\PeopleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\AddressController;

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







// rutas para añadir empleados
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create'); // Cambiado a 'employee.create'
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/buscarPersonas', [EmployeeController::class, 'buscarPersona'])->name('buscar.personas');

Route::get('/añadir-imagenes', [ImagenController::class, 'showAddImagesForm'])->name('imagenes.add');
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::post('/post_carro', [MenuController::class, 'postCarro'])->name('post_carro');
    Route::get('/editarmenu', [MenuController::class, 'showEditionMenu'])->name('edit.menu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/form_direcciones', [AddressController::class, 'showForm'])->name('addresses.form');
    Route::get('/buscar-direcciones', [AddressController::class, 'buscarDirecciones'])->name('buscar.direcciones');
    Route::get('/get-neighborhoods', [AddressController::class, 'getNeighborhoodsByPostalCode'])->name('get.neighborhoods');
    Route::post('/register-address', [AddressController::class, 'registerAddress'])->name('register.address');
    Route::get('/user-addresses', [AddressController::class, 'userAddresses'])->name('user.addresses');
    Route::post('/select-address', [AddressController::class, 'seleccionarDireccion'])->name('select.address');
    Route::get('/vista-pago', [MenuController::class, 'vistaPago'])->name('vista.pago');
    Route::post('/procesar-pago', [MenuController::class, 'procesarPago'])->name('procesar.pago');
});




require __DIR__ . '/auth.php';

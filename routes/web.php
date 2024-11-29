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
use App\Http\Controllers\ordersController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\SupportTicketController;
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

Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/buscarPersonas', [EmployeeController::class, 'buscarPersona'])->name('buscar.personas');

    Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria');


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

    Route::patch('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate');
    
    Route::post('/reseñas', [ReseñaController::class, 'store'])->name('reseñas.store'); 
   
    Route::get('/reseñas', [ReseñaController::class, 'index'])->name('reseñas');
    Route::get('/historial', [PedidoController::class, 'mostrarHistorial'])->name('historial');
    
    Route::get('/historial/{id}', [PedidoController::class, 'mostrarDetalle'])->name('historial.detalle');

    Route::get('/showreseñas', [ReseñaController::class, 'show'])->name('showreseñas');
    Route::get('/Menu', [MenuController::class, 'index'])->name('Menu');

    Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria');
   

   
    Route::get('tickets', [SupportTicketController::class, 'index'])->name('tickets');

   
    Route::get('tickets/create', [SupportTicketController::class, 'create'])->name('tickets.create');

    
    Route::post('tickets', [SupportTicketController::class, 'store'])->name('tickets.store');

    Route::get('tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::get('tickets/{id_ticket}', [TicketController::class, 'show'])->name('tickets.show');

});


    




require __DIR__ . '/auth.php';
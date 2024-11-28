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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CartController;

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



Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-callback-url', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('google_id', $googleUser->id)
        ->orWhere('email', $googleUser->email)
        ->first();

    if (!$user) {

        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'password' => Hash::make(uniqid()),
            'active' => true,
        ]);
    }

    Auth::login($user);
    return redirect('/profile');
});


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

    //todas las rutas en relación con el carro

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/editarmenu', [MenuController::class, 'showEditionMenu'])->name('edit.menu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/vista-pago', [MenuController::class, 'vistaPago'])->name('vista.pago');
    Route::post('/procesar-pago', [MenuController::class, 'procesarPago'])->name('procesar.pago');

    // Rutas para el carrito
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/post_carro', [MenuController::class, 'postCarro'])->name('post_carro');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    // Rutas para direcciones
    Route::get('/form_direcciones', [AddressController::class, 'showForm'])->name('addresses.form');
    Route::post('/form_direcciones', [AddressController::class, 'showForm'])->name('addresses.form');
    Route::get('/buscar-direcciones', [AddressController::class, 'buscarDirecciones'])->name('buscar.direcciones');
    Route::get('/get-neighborhoods', [AddressController::class, 'getNeighborhoodsByPostalCode'])->name('get.neighborhoods');
    Route::post('/register-address', [AddressController::class, 'registerAddress'])->name('register.address');
    Route::get('/user-addresses', [AddressController::class, 'userAddresses'])->name('user.addresses');
    Route::post('/select-address', [AddressController::class, 'seleccionarDireccion'])->name('select.address');
    Route::get('/vista-pago', [MenuController::class, 'vistaPago'])->name('vista.pago');
    Route::post('/procesar-pago', [MenuController::class, 'procesarPago'])->name('procesar.pago');


    Route::post('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate');
    Route::post('/reseñas', [ReseñaController::class, 'store'])->name('reseñas.store');
    Route::get('/reseñas', [ReseñaController::class, 'index'])->name('reseñas');
    Route::get('/orders-history', [OrderController::class, 'history'])->name('ordershistory');
});

Route::middleware('admin')->group(function () {
    // rutas para añadir empleados
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create'); // Cambiado a 'employee.create'
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/buscarPersonas', [EmployeeController::class, 'buscarPersona'])->name('buscar.personas');
    Route::get('/ganancias', [ordersController::class, 'showProfits'])->name('ganancias');


    // menu
    Route::get('/editarmenu', [MenuController::class, 'showEditionMenu'])->name('edit.menu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
});


Route::middleware('employee')->group(function () {
    //orders
    Route::get('/orders', [ordersController::class, 'getOrdersOnline'])->name('orders');
    // Ordenes fisico
    Route::get('/realizar-orden', [ordersController::class, 'formMakeOrder'])->name('formOrders');
    Route::post('/realizar-orden', [ordersController::class, 'create'])->name('makeOrders');
});



require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\mostrarHistorial;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\CartController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\OrderHistoryController;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('edit');
})->middleware(['auth', 'verified'])->name('dashboard');

// Autenticación con Google
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


Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate');

    
    Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria');

   
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/showreview/{id}', [ReviewController::class, 'index'])->name('showreview');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
  
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/', [ReviewController::class, 'index']);

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/editarmenu', [MenuController::class, 'showEditionMenu'])->name('edit.menu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::post('/post_carro', [MenuController::class, 'postCarro'])->name('post_carro');


    Route::get('/vista-pago', [MenuController::class, 'vistaPago'])->name('vista.pago');
    Route::post('/procesar-pago', [MenuController::class, 'procesarPago'])->name('procesar.pago');

    
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/form_direcciones', [AddressController::class, 'showForm'])->name('addresses.form');
    Route::get('/buscar-direcciones', [AddressController::class, 'buscarDirecciones'])->name('buscar.direcciones');
    Route::get('/get-neighborhoods', [AddressController::class, 'getNeighborhoodsByPostalCode'])->name('get.neighborhoods');
    Route::post('/register-address', [AddressController::class, 'registerAddress'])->name('register.address');
    Route::get('/user-addresses', [AddressController::class, 'userAddresses'])->name('user.addresses');
    Route::post('/select-address', [AddressController::class, 'seleccionarDireccion'])->name('select.address');

  

    
    



    Route::get('/historial-pedidos', [OrderHistoryController::class, 'index'])->name('historial');

    


    Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets');
    Route::get('/tickets/create', [SupportTicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [SupportTicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
});


Route::middleware('employee')->group(function () {

    Route::get('/orders', [ordersController::class, 'getOrdersOnline'])->name('orders');
    Route::get('/orders/completadas', [ordersController::class, 'getCompletedOrders'])->name('orders.completed');
    Route::get('/orders/historial', [ordersController::class, 'getHistorialOrders'])->name('orders.historial');
    Route::get('/realizar-orden', [ordersController::class, 'formMakeOrder'])->name('formOrders');
    Route::post('/realizar-orden', [ordersController::class, 'create'])->name('makeOrders');
    Route::put('/orders/{id}/enfisico', [ordersController::class, 'updateFisicas'])->name('orders.updateFisicas');
    Route::put('/orders/{id}/enlinea', [ordersController::class, 'updateLine'])->name('orders.updateLine');
});


Route::middleware('admin')->group(function () {
 
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/buscarPersonas', [EmployeeController::class, 'buscarPersona'])->name('buscar.personas');

    Route::get('/ganancias', [ordersController::class, 'showProfits'])->name('ganancias');
        

    Route::get('/editarmenu', [MenuController::class, 'showEditionMenu'])->name('edit.menu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
});


require __DIR__ . '/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Menu;

use Carbon\Carbon;

use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ordersController extends Controller
{

    public function historySingle()
    {
        $pedidos = OnlineOrder::with([
            'folio',
            'onlineOrderDetails.menu',
            'people' => function ($query) {
                $query->select('id', DB::raw("CONCAT(name, ' ', paternal_lastname, ' ', maternal_lastname) as fullname"));
            }
        ])->orderBy('created_at', 'asc')
            ->paginate(20)
            ->through(function ($order) {
                $order->product_names = $order->onlineOrderDetails->map(function ($detail) {
                    return $detail->menu->name;
                })->implode(', ');

                return $order;
            });
        // dd($pedidos);
        return view('historial', ['pedidos' => $pedidos]);
    }

    public function showProfits(Request $request)
    {
        $ventas = Order::with('orderDetail.menu', 'folio')
            ->where('status', 'Completed')
            ->orderBy('created_at', 'asc');

        $ventasOnline = OnlineOrder::with([
            'onlineOrderDetails.menu',
        ])->orderBy('created_at', 'asc');

        if ($mes = $request->input('mes')) {
            $ventas = $ventas->whereMonth('created_at', $mes);
            $ventasOnline = $ventasOnline->whereMonth('created_at', $mes);
        }
        if ($anio = $request->input('anio')) {
            $ventas = $ventas->whereYear('created_at', $anio);
            $ventasOnline = $ventasOnline->whereYear('created_at', $anio);
        }

        $ventas = $ventas->get();
        $ventasOnline = $ventasOnline->get();

        $totalFisico = $ventas->sum('total_price');
        $totalOnline = $ventasOnline->sum('total_price');

        $minOrders = Order::min('created_at');
        $minOnlineOrders = OnlineOrder::min('created_at');

        $fechaMasAntigua = min($minOrders, $minOnlineOrders);

        $fechaActual = Carbon::now()->year; /*Este seria el año actual en el servidor*/

        $anioMasAntiguo = Carbon::parse($fechaMasAntigua)->year; //parsear los años más antiguos de las dos tablas de orders



        $anios = range($fechaActual, $anioMasAntiguo); // aqui se generan en orden descendente

        $ventas_anio_y_mes = $ventasOnline->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });

        $totalPorMesAnio = [];
        $YearsMonths = []; // Para las categorías (meses y años)

        foreach ($ventas_anio_y_mes as $yearMonth => $ventasgrafica) {
            $totalPorMesAnio[] = $ventasgrafica->sum('total_price'); //Suma que se le asignaa cada Año-mes
            $YearsMonths[] = Carbon::parse($ventasgrafica->first()->created_at)->format('F Y');
        }


        $datosGrafica = [
            'categories' => $YearsMonths,
            'seriesOnline' => $totalPorMesAnio,
        ];

        // en linea
        $fisicoVentasAnioMEs = $ventas->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });

        $fisicoTotalMesAnio = [];
        $anioMes = []; // Para las categorías (meses y años)

        foreach ($fisicoVentasAnioMEs as $FisicoAnioMes => $FisicoVentasgrafica) {
            $fisicoTotalMesAnio[] = $FisicoVentasgrafica->sum('total_price'); //Suma que se le asignaa cada Año-mes
            $anioMes[] = Carbon::parse($FisicoVentasgrafica->first()->created_at)->format('F Y');
        }


        $FisicoDatosGrafica = [
            'categoriesFisico' => $anioMes,
            'seriesFisico' => $fisicoTotalMesAnio,
        ];

        // dd($FisicoDatosGrafica);

        // dd($datosGrafica);
        return view('profits', compact(['ventas', 'ventasOnline', 'totalOnline', 'totalFisico', 'anios', 'datosGrafica', 'FisicoDatosGrafica']));
    }

    public function getOrdersOnline()
    {
        $onlineOrder = OnlineOrder::with([
            'folio',
            'onlineOrderDetails.menu',
            'people',
        ])->whereIn('status', ['Paid', 'In Process'])->orderBy('created_at', 'asc')->get();


        $orders = Order::with([
            'orderDetail.menu',
            'folio',
        ])->whereIn('status', ['Pending', 'In Process'])->orderBy('created_at', 'asc')->get();


        return view('orders', compact(['onlineOrder', 'orders']));
    }

    public function formMakeOrder()
    {
        $menuItems = Menu::all();
        return view('makeorder', compact('menuItems'));
    }

    public function getCompletedOrders()
    {
        $onlineCompleted = OnlineOrder::with([
            'folio',
            'onlineOrderDetails.menu',
            'people',
        ])->where('status', 'Completed')->orderBy('created_at', 'asc')->get();

        $localCompleted = Order::with([
            'orderDetail.menu',
            'folio',
        ])->where('status', 'Completed')->orderBy('created_at', 'asc')->get();

        return view('completedOrders', compact('onlineCompleted', 'localCompleted'));
    }

    public function getHistorialOrders()
    {
        $localHistorialOrders = Order::with([
            'orderDetail.menu',
            'folio',
        ])->orderBy('created_at', 'asc')
            ->paginate(20)
            ->through(function ($order) {
                $order->product_names = $order->orderDetail->map(function ($detail) {
                    return $detail->menu->name;
                })->implode(', ');

                return $order;
            });

        $lineHistorialOrders = OnlineOrder::with([
            'folio',
            'onlineOrderDetails.menu',
            'people' => function ($query) {
                $query->select('id', DB::raw("CONCAT(name, ' ', paternal_lastname, ' ', maternal_lastname) as fullname"));
            }
        ])->orderBy('created_at', 'asc')
            ->paginate(20)
            ->through(function ($order) {
                $order->product_names = $order->onlineOrderDetails->map(function ($detail) {
                    return $detail->menu->name;
                })->implode(', ');

                return $order;
            });


        return view('historialOrders', compact(['localHistorialOrders', 'lineHistorialOrders']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            // Inicia la transacción
            DB::beginTransaction();

            // Validar los datos de entrada
            $validated = $request->validate([
                'diner_name' => 'required|max:100', // Campo obligatorio con un límite de caracteres
                'menu_items.*.id_menu' => 'required|exists:menu,id_menu', // Asegura que los IDs existan en la tabla 'menu'
                'menu_items.*.quantity' => 'required|integer|min:1', // La cantidad debe ser un entero mayor o igual a 1
                'menu_items.*.notes' => 'nullable|string', // Opcional, si está presente debe ser texto
                'menu_items.*.specifications' => 'nullable|string', // Opcional, si está presente debe ser texto
            ]);

            // Calcular el precio total
            $menuItems = $validated['menu_items']; // Usa los datos validados
            $totalPrice = 0;

            foreach ($menuItems as $item) {
                $menuItem = Menu::find($item['id_menu']);
                $totalPrice += $menuItem->price * $item['quantity'];
            }

            // Obtener el empleado autenticado
            $employee = Auth::user()->people->employees->id_employee;

            // Crear la orden
            $order = new Order();
            $order->diner_name = $validated['diner_name']; // Usa el valor validado
            $order->status = 'Pending';
            $order->id_employee = $employee;
            $order->total_price = $totalPrice;
            $order->save();

            // Crear los detalles de la orden
            foreach ($menuItems as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->id_order = $order->id_order; // Relacionar con la orden creada
                $orderDetail->id_menu = $item['id_menu'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->notes = $item['notes'] ?? null;
                $orderDetail->specifications = $item['specifications'] ?? null;
                $orderDetail->save();
            }

            // Confirmar la transacción
            DB::commit();

            // Redireccionar con éxito
            return redirect()->route('formOrders')->with('success', 'Orden y platillos guardados con éxito.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Redireccionar con error
            return redirect()->route('formOrders')->with('error', 'Hubo un error al crear la orden: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLine(Request $request, $id)
    {
        $onlineOrder = OnlineOrder::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Pending,Canceled,In Process,Completed'
        ]);
        $onlineOrder->status = $request->status;
        $onlineOrder->save();

        if ($onlineOrder->status == 'Canceled') {
            return redirect()->route('orders')->with('success', 'Se ha cancelado la orden');
        } else if ($onlineOrder->status == 'In Process') {
            return redirect()->route('orders')->with('success', 'La orden ha sido atendida');
        } else if ($onlineOrder->status == 'Completed') {
            return redirect()->route('orders')->with('success', 'La orden ha sido Completada');
        }
    }

    public function updateFisicas(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Canceled,In Process,Completed'
        ]);

        $order->status = $request->status;
        $order->save();

        if ($order->status == 'Completed') {
            DB::statement('CALL GenerateFolioAfterOrderCompleted(?)', [$order->id_order]);
            return redirect()->route('orders')->with('success', 'La orden ha sido Completada');
        }

        if ($order->status == 'Canceled') {
            return redirect()->route('orders')->with('success', 'Se ha cancelado la orden');
        }

        if ($order->status == 'In Process') {
            return redirect()->route('orders')->with('success', 'La orden ha sido atendida');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

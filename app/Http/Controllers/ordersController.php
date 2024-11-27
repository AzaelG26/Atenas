<?php

namespace App\Http\Controllers;

use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ordersController extends Controller
{

    public function getOrdersOnline()
    {
        $onlineOrder = OnlineOrder::with([
            'onlineOrderDetails.folio',
            'onlineOrderDetails.menu',
            'people',
        ])->orderBy('updated_at', 'asc')->get();


        $orders = Order::with([
            'orderDetail.menu',
            'folio',
        ])->orderBy('updated_at', 'asc')->get();

        // dd($order->diner_name);

        return view('orders', compact(['onlineOrder', 'orders']));
    }

    public function formMakeOrder()
    {
        $menuItems = Menu::all();
        return view('makeorder', compact('menuItems'));
    }

    public function getMenuOrder() {}

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
            DB::beginTransaction();

            $menuItems = $request->input('menu_items');
            $totalPrice = 0;

            foreach ($menuItems as $item) {
                $menuItem = Menu::find($item['id_menu']);
                $totalPrice += $menuItem->price * $item['quantity'];
            }

            $employee = Auth::user()->people->employees->id_employee;

            $validated = $request->validate([
                'diner_name' => 'required|max:100',
                'menu_items.*.quantity' => 'integer|min:1',
                'menu_items.*.notes' => 'string',
                'menu_items.*.specifications' => 'string',
            ]);

            $order = new Order();
            $order->diner_name = $request->input('diner_name');
            $order->status = 'Pending';
            $order->id_employee = $employee;
            $order->total_price = $totalPrice;
            $order->save();
            // dd($order::all());

            foreach ($menuItems as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->id_order = $order->id_order;  // Relacionar con la orden creada
                $orderDetail->id_menu = $item['id_menu'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->notes = $item['notes'];
                $orderDetail->specifications = $item['specifications'];
                $orderDetail->status = 'Pending';
                $orderDetail->save();
            }

            DB::commit();
            return redirect()->route('formOrders')->with('success', 'Orden y platillos guardados con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('formOrders')->with('error', 'Hubo un error al crear la orden.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, $id)
    {
        //
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

<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Amount;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderFormMail;
use App\Mail\AdminOrderFor ;
use Illuminate\Http\Request;

class OrderrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::where('user_id', auth()->user()->id)
               ->orderBy('created_at', 'desc')
               ->get();
        return new UserResource($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
        // $this->authorize('update', auth()->user()->invoice);
        $data = request()->validate($this->rules());

        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->status = '0';
        $order->save();
        foreach ($data['order'] as $prodId => $value) { 
                $mnozstvi = new Amount;
                $mnozstvi->product_id = $prodId;
                $mnozstvi->edit = false;
                $mnozstvi->mnozstvi = $value;
                $mnozstvi->save();
                $order->amounts()->attach($mnozstvi->id); 
        }   
        $order->load('amounts.product');
        return new OrderResource($order);
    }


    public function show(Order $order)
    {
        $order->load('amounts.product');
        return new OrderResource($order);
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function confirm( Order $order)
    {
        $user = auth()->user();
        $data = request()->validate([
            'desc' => ''
        ]);
        $order->description = request()->input('desc');
        $order->status = 1;
        $order->push();
        $url = 'http://127.0.0.1:8000/objednavky/'.$order->id;
        Mail::to($user->email)->send(new OrderFormMail($user, $order, $url));
        // Mail::to('sotola@sotola.cz')->send(new AdminOrderFormMail($user, $order, $url));
        return response()->json('true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }

    public function rules()
    {
        return [
            'order' => 'required',
            'order.*' => 'numeric',
        ];
    }

}

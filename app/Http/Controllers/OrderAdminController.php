<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Amount;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderFormMail;

class OrderAdminController extends Controller
{

    public function index()
    {
        $this->isAdmin();
        $orders = Order::all();
        $orders->load('user.invoice');
        return OrderResource::collection($orders);
    }

    public function store($id)
    {
        $this->isAdmin();
        $user = User::find($id);        
        $data = request()->validate($this->rules());
        $order = $user->orders()->create();
        foreach ($data['order'] as $prodId => $value) { 
            $mnozstvi = Amount::create(['product_id' => $prodId, 'mnozstvi' => $value]);
            $order->amounts()->attach($mnozstvi->id); 
        }   
        $order->load('amounts.product');
        return new OrderResource($order);
    }


    public function show(Order $order)
    {
        $this->isAdmin();
        $order->load('amounts.product');
        return new OrderResource($order);
    }

    public function confirm( Order $order, $userId)
    {
        $this->isAdmin();
        $user = User::find($userId);   
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

    public function destroy(Order $order)
    {
        $this->isAdmin();
        $order->delete();
    }

    public function rules()
    {
        return [
            'order' => 'required',
            'order.*' => 'numeric',
        ];
    }

    protected function isAdmin()
    {
        if(auth()->user()->email != env('ADMIN_EMAIL')){
            return response()->json( 'Unauthorized', 400);
        }
    }

}

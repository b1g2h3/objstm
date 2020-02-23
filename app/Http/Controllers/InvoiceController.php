<?php

namespace App\Http\Controllers;
use DB;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class InvoiceController extends Controller
{
    public function check()
    {
        $user =auth()->user()->load('invoice');
        return new UserResource($user);
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate($this->rules());      
        auth()->user()->invoice()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $data = request()->validate($this->rules());      
        auth()->user()->invoice()->update($data);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function rules()
    {
       return [
            'ic' => ['required', 'unique:invoices', 'min:7',  'numeric'],
            'dic' => ['max:255',],
            'nazev' => ['max:255',],
            'ulice' => ['required', 'max:255'],
            'mesto' => ['required', 'max:255'],
            'psc' => ['required', 'max:255'],
            'zeme' => ['required', 'max:255'],
       ];
    }
    
}


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

    public function index()
    {
        //
    }


    public function store()
    {
        $data = request()->validate($this->rules());      
        auth()->user()->invoice()->create($data);
    }

    public function show(Invoice $invoice)
    {
        //
    }

    public function update()
    {
        $data = request()->validate($this->rules());      
        auth()->user()->invoice()->update($data);
    } 

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


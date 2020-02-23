<?php

namespace App\Http\Controllers;

use App\Amount;
use App\User;
use Illuminate\Http\Request;

class AmountController extends Controller
{
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amount  $amount
     * @return \Illuminate\Http\Response
     */
    public function show(Amount $amount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amount  $amount
     * @return \Illuminate\Http\Response
     */
    public function update(Amount $amount)
    {
        $item = request()->validate([
            'mnozstvi' => 'required|max:9999|numeric'
        ]);
        $amount->mnozstvi = $item['mnozstvi'];
        $amount->push();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amount  $amount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amount $amount)
    {
        $amount->delete();
    }
}

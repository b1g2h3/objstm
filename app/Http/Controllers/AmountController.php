<?php

namespace App\Http\Controllers;

use App\Amount;
use Illuminate\Http\Request;

class AmountController extends Controller
{
    public function index()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Amount $amount)
    {
        //
    }
    public function update(Amount $amount)
    {
        $item = request()->validate([
            'mnozstvi' => 'required|max:9999|numeric'
        ]);
        $amount->mnozstvi = $item['mnozstvi'];
        $amount->push();
    }
    public function destroy(Amount $amount)
    {
        $amount->delete();
    }
}

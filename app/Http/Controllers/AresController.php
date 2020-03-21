<?php

namespace App\Http\Controllers;

use App\Http\Resources\Ares as AresResource;
use App\Module\ARES;
class AresController extends Controller
{
 
    public function check()
    {
       $data = request()->validate($this->rules());
       $ares = new ARES($data['ic']);
       $aresData = $ares->getData();
       
       if($aresData){
           return new AresResource($aresData);
        }
        return response()->json(false);

    }

    public function rules()
    {
        return [
            'ic' => ['required', 'unique:invoices', 'min:7',  'numeric'],
        ];
    }
}

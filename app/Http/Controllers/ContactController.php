<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


class ContactController extends Controller
{
    public function store()
    {
        $data = request()->validate($this->rules());            
        Mail::to('sotola@sotola.com')->send(new ContactFormMail($data));
    }
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'reason' => 'required',
            'reason' => 'required',
            'message' => 'required',
        ];
    }

 
}




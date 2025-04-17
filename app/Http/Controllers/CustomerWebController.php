<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerWebController extends Controller
{
    public function create()
    {
        return view('customers.create'); 
    }
}

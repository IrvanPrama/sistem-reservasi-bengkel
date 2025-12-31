<?php

namespace App\Http\Controllers;

use App\Models\ServicePrice;

class ServicePriceController extends Controller
{
    public function index()
    {
        $service_price = ServicePrice::all();

        return view('landing-page.index', compact('service_price'));
    }
}

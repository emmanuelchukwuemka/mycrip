<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('guest.properties.index');
    }

    public function show($id)
    {
        return view('guest.properties.show', ['id' => $id]);
    }

    public function apartments()
    {
        return view('guest.properties.categories.apartments');
    }

    public function houses()
    {
        return view('guest.properties.categories.houses');
    }

    public function land()
    {
        return view('guest.properties.categories.land');
    }

    public function commercial()
    {
        return view('guest.properties.categories.commercial');
    }
}

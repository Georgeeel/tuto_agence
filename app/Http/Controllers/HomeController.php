<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // organisé in ordre decroissante limité a 4 et recuperer le registrement
        $properties = Property::orderBy('created_at', 'desc')->limit(4)->get();
        return view('home', ['properties' => $properties]);
    }
}

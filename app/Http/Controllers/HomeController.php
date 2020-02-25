<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\User;
use App\Apartment;
use App\Condominium;
use App\Dormitory;
use App\House;
use App\Meta;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apartments   = Apartment::query()->get();
        $condominiums = Condominium::query()->get();
        $dormitories  = Dormitory::query()->get();
        $houses       = House::query()->get();
        $properties   = Collect($apartments)->merge($condominiums)->merge($dormitories)->merge($houses);
        $types        = Meta::where('type', 'property-type')->get();
    
        //dd($properties);
        
        return view('home',compact('properties','types'))->with('ptype');
    }
}

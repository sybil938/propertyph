<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Auth;
use App\User;
use App\Profile;
use App\Meta;
use App\Role;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        

        $id         = Auth::user()->id;
        $user       = User::find($id);
        $test       = User::find($id);
        $role_list  = ['property-manager', 'property-supervisor'];
        $roles      = Role::whereIn('slug', $role_list)->get();        
        $profile    = Profile::where('user_id', $id)->get()->first();   

        return view('profile.index', compact('user','roles','profile'));

    }

    public function update(Request $request)
    {     
      
        $id         = Auth::user()->id;
        $user       = User::find($id);
        
        $user->first_name  = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name   = $request->last_name;       
        $user->role_id     = $request->role_id;
        $user->save(); 

        $role_list  = ['property-manager', 'property-supervisor'];
        $roles      = Role::whereIn('slug', $role_list)->get();        
        $profile    = Profile::where('user_id', $id)->get()->first();     
        
        $profile->birthday     = $request->birthday;
        $profile->phone        = $request->phone;
        $profile->house_number = $request->house_number;
        $profile->street       = $request->street;
        $profile->city         = $request->city;
        $profile->province     = $request->province;
        $profile->postal_code  = $request->postal_code;
        $profile->country      = $request->country;
        $profile->save();

        return view('profile.index', compact('user','roles','profile'));
    }

}

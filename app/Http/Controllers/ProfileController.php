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
        $link       = asset('/storage/user/'. $id);  

        return view('profile.index', compact('user','roles','profile','link'));

    }

    public function update(Request $request)
    {          
        $id         = Auth::user()->id;
        $user       = User::find($id);
        $link       = asset('/storage/user/'. $id);
        
        $user->first_name  = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name   = $request->last_name;       
        $user->role_id     = $request->role_id;
        $user->email       = $request->email;
        $user->save(); 

        $role_list  = ['property-manager', 'property-supervisor'];
        $roles      = Role::whereIn('slug', $role_list)->get();        
        $profile    = Profile::where('user_id', $id)->get()->first();     


        if($request->hasFile('image')){  

            //Get Filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just EXT
            $extension = $request->file('image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStoreA = $filename.'_'.time().'.'.$extension;
          
            $path = $request->file('image')->storeAs("public/user/$id", $fileNameToStoreA);    

            $profile->image = $fileNameToStoreA;       
            
        } 

        if ($request->hasFile('image_id')) {

            //Get Filename with the extension
            $filenameWithExt = $request->file('image_id')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just EXT
            $extension = $request->file('image_id')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStoreB = $filename.'_'.time().'.'.$extension;
          
            $path = $request->file('image_id')->storeAs("public/user/$id", $fileNameToStoreB); 

            $profile->image_id = $fileNameToStoreB;
        }     

        $profile->birthday     = $request->birthday;
        $profile->phone        = $request->phone;
        $profile->house_number = $request->house_number;
        $profile->street       = $request->street;
        $profile->city         = $request->city;
        $profile->province     = $request->province;
        $profile->postal_code  = $request->postal_code;
        $profile->country      = $request->country;
        $profile->save();

        return view('profile.index', compact('user','roles','profile','link'));
    }

}
